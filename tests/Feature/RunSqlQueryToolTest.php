<?php

use App\Models\Schedule;
use App\Models\Submission;
use App\Models\User;
use App\Services\VirtualAssistant\Tools\RunSqlQueryTool;

test('runSqlQuery menerima SELECT valid dan mengembalikan data', function () {
    $schedule = Schedule::factory()->create();
    Submission::factory()->create(['schedule_id' => $schedule->id, 'status' => 'pending']);

    $tool = app(RunSqlQueryTool::class);

    $result = $tool->execute([
        'query' => 'SELECT status FROM submissions',
    ]);

    expect($result['error'] ?? null)->toBeNull();
    expect(count($result['data']))->toBe(1);
});

test('runSqlQuery menolak statement INSERT', function () {
    $tool = app(RunSqlQueryTool::class);

    $result = $tool->execute([
        'query' => 'INSERT INTO submissions (status) VALUES ("pending")',
    ]);

    expect($result['error'])->toContain('SELECT');
});

test('runSqlQuery menolak SELECT *', function () {
    $tool = app(RunSqlQueryTool::class);

    $result = $tool->execute([
        'query' => 'SELECT * FROM submissions',
    ]);

    expect($result['error'])->toContain('SELECT *');
});

test('runSqlQuery memfilter kolom sensitif (id, password) dari hasil', function () {
    User::factory()->create(['name' => 'Budi']);

    $tool = app(RunSqlQueryTool::class);

    $result = $tool->execute([
        'query' => 'SELECT id, name FROM users',
    ]);

    expect($result['error'] ?? null)->toBeNull();
    expect($result['data'][0])->toHaveKey('name');
    expect($result['data'][0])->not->toHaveKey('id');
    expect($result['data'][0])->not->toHaveKey('password');
});

test('runSqlQuery menolak multi-statement', function () {
    $tool = app(RunSqlQueryTool::class);

    $result = $tool->execute([
        'query' => 'SELECT status FROM submissions; DROP TABLE submissions',
    ]);

    expect($result['error'])->toContain('satu statement');
});

test('runSqlQuery menolak kolom sensitif', function () {
    User::factory()->create();

    $tool = app(RunSqlQueryTool::class);

    $result = $tool->execute([
        'query' => 'SELECT password FROM users',
    ]);

    expect($result['error'])->toContain('password');
});

test('runSqlQuery membatasi hasil sampai max_rows', function () {
    $schedule = Schedule::factory()->create();
    Submission::factory()->count(60)->create(['schedule_id' => $schedule->id]);

    $tool = app(RunSqlQueryTool::class);

    $result = $tool->execute([
        'query' => 'SELECT status FROM submissions',
    ]);

    expect(count($result['data']))->toBe(50);
});

test('runSqlQuery dieksekusi read-only (tidak ada perubahan data)', function () {
    $schedule = Schedule::factory()->create();
    Submission::factory()->create(['schedule_id' => $schedule->id, 'status' => 'pending']);

    $tool = app(RunSqlQueryTool::class);

    $tool->execute([
        'query' => 'SELECT status FROM submissions',
    ]);

    expect(Submission::count())->toBe(1);
});
