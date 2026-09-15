<?php

declare(strict_types=1);

namespace App\Services\VirtualAssistant\Tools;

use App\Services\VirtualAssistant\AssistantToolInterface;
use App\Services\VirtualAssistant\ReadOnlyGuard;
use App\Services\VirtualAssistant\ReadOnlyViolationException;
use Illuminate\Support\Facades\DB;

class RunSqlQueryTool implements AssistantToolInterface
{
    protected ReadOnlyGuard $guard;

    public function __construct(ReadOnlyGuard $guard)
    {
        $this->guard = $guard;
    }

    public function name(): string
    {
        return 'runSqlQuery';
    }

    public function description(): string
    {
        return 'Jalankan query SQL SELECT mentah (read-only) terhadap semua data sistem. Gunakan untuk join kompleks atau agregasi lanjutan yang tidak bisa di-handle queryData. Maksimal 50 baris hasil.';
    }

    public function parameters(): array
    {
        return [
            'type' => 'object',
            'properties' => [
                'query' => [
                    'type' => 'string',
                    'description' => 'SQL SELECT mentah, satu statement, tanpa titik koma.',
                ],
            ],
            'required' => ['query'],
            'additionalProperties' => false,
        ];
    }

    public function execute(array $arguments): array
    {
        $query = $arguments['query'] ?? '';

        try {
            $sql = $this->guard->sanitizeRawSql($query);

            $data = $this->guard->runReadOnly(
                fn () => DB::select($sql)
            );
        } catch (ReadOnlyViolationException $e) {
            return ['error' => $e->getMessage()];
        } catch (\Throwable $e) {
            return ['error' => 'Query gagal dijalankan: '.$e->getMessage()];
        }

        return [
            'data' => $this->stripSensitiveColumns($data),
            'total_rows' => count($data),
        ];
    }

    protected function stripSensitiveColumns(array $rows): array
    {
        $blocked = $this->guard->blockedColumns();

        if ($blocked === [] || $rows === []) {
            return $rows;
        }

        $blocked = array_flip($blocked);

        return array_map(function ($row) use ($blocked) {
            foreach (get_object_vars($row) as $key => $value) {
                if (array_key_exists($key, $blocked)) {
                    unset($row->{$key});
                }
            }

            return $row;
        }, $rows);
    }
}
