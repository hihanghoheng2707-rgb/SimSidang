# Design: Ganti Jenis Sidang - Hapus Nilai Assessment Form

**Tanggal:** 2026-09-05  
**Status:** Draft → Waiting Approval  
**Fitur:** Otomatis delete nilai dosen bila jenis sidang berubah

---

## Ringkasan

Ketika admin mengubah `jenis_sidang_id` pada Schedule, semua `assessment_forms` yang sudah dientri oleh dosen akan dihapus otomatis untuk menjaga konsistensi data dengan template penilaian baru.

---

## Use Case

| Langkah | User | Action |
|---------|------|--------|
| 1 | Admin | Buka halaman edit schedule |
| 2 | Admin | Ganti "Jenis Sidang" ke nilai berbeda |
| 3 | System | Tampilkan modal konfirmasi |
| 4 | Admin | Klik "Ya, Hapus Nilai" |
| 5 | System | Delete assessment_forms + log perubahan |

---

## Dependency Chain

```
Schedule (jenis_sidang_id)  ← UNTUK DIUBAH
  └── submissions
        └── assessment_forms (DIHAPUS)
              └── template_id → AssessmentTemplate → jenis_sidang_id (BERUBAH)
```

**Masalah:** Template penilaian berbeda = item & rumus A/B berbeda = data lama tidak valid lagi.

---

## Backend Logic

### 1. UpdateScheduleRequest

```php
// app/Http/Requests/UpdateScheduleRequest.php
public function withValidator($validator): void
{
    $validator->after(function ($v) {
        $schedule = $this->route('schedule');
        if ($schedule->jenis_sidang_id !== $this->jenis_sidang_id) {
            $count = $schedule->submissions()
                ->whereHas('assessmentForms')
                ->withCount('assessmentForms')
                ->get()
                ->sum('assessment_forms_count');

            if ($count > 0) {
                $v->errors()->add('jenis_sidang_id', 
                    "Jenis sidang berubah. $count data nilai dosen akan dihapus.");
            }
        }
    });
}
```

### 2. ScheduleController::update()

```php
// app/Http/Controllers/Admin/ScheduleController.php
public function update(UpdateScheduleRequest $request, Schedule $schedule)
{
    $this->authorize('viewAdminMenu', User::class);

    $oldJenisSidang = $schedule->jenis_sidang_id;
    $newJenisSidang = $request->jenis_sidang_id;

    $schedule->update($request->only([...]));
    $schedule->dosens()->sync($request->input('dosens', []));

    if ($oldJenisSidang !== $newJenisSidang) {
        $deletedCount = $this->deleteAssessmentForms($schedule);
        $this->logBulkDeletion($schedule, $deletedCount);

        return redirect()->route('admin.schedules.index')
            ->with('success', "Jadwal berhasil diperbarui. $deletedCount data nilai dosen telah dihapus.");
    }

    return redirect()->route('admin.schedules.index')
        ->with('success', 'Jadwal berhasil diperbarui.');
}
```

### 3. Log Service

**Migration baru:** `submission_bulk_logs`

```php
Schema::create('submission_bulk_logs', function (Blueprint $t) {
    $t->id();
    $t->foreignId('schedule_id')->constrained()->cascadeOnDelete();
    $t->foreignId('user_id')->constrained()->cascadeOnDelete();
    $t->string('action'); // 'jenis_sidang_changed'
    $t->json('details'); // { 'from': 1, 'to': 2, 'deleted_forms': 5 }
    $t->timestamps();
});
```

---

## Modal Konfirmasi UI

**Trigger:** Error validation `jenis_sidang_id` muncul

**Modal content:**
```
Perubahan Jenis Sidang

Jenis sidang akan diubah dari "{{ old }}" ke "{{ new }}".

Data yang akan dihapus:
- 5 data nilai dosen yang sudah dientri
- Semua nilai tidak dapat dikembalikan

Lanjutkan?
[Kembatalkan] [Ya, Hapus Semua]
```

---

## Test Coverage

| Test | File | Purpose |
|------|------|---------|
| `jenisSidangChangeDeletesForms` | AdminScheduleTest.php | Verify auto-delete |
| `jenisSidangChangeShowsModal` | AdminScheduleTest.php | Modal muncul bila ada nilai |
| `jenisSidangSameNoDelete` | AdminScheduleTest.php | Tidak delete kalau tidak berubah |
| `bulkLogCreated` | SubmissionBulkLogTest.php | Log perubahan disimpan |

---

## Files yang Diubah

| File | Perubahan |
|------|-----------|
| `app/Http/Requests/UpdateScheduleRequest.php` | +withValidator() |
| `app/Http/Controllers/Admin/ScheduleController.php` | +deleteAssessmentForms(), log bulk |
| `database/migrations/xxxx_create_submission_bulk_logs_table.php` | BARU |
| `resources/views/admin/schedules/edit.blade.php` | +modal konfirmasi |
| `tests/Feature/AdminScheduleConflictTest.php` | +test baru |
| `tests/Feature/SubmissionBulkLogTest.php` | BARU |

---

## Rollback Strategy

Tidak ada rollback otomatis. Jika mengubah jenis sidang secara tidak sengaja:
1. Rekam ulang nilai dosen (manual)
2. Ganti jenis sidang kembali

---

## Approval Checklist

- [ ] Design sudah penuh kapancil
- [ ] User setuju implementasi

---

Spec saved to: `.opencode/plans/2026-09-05-ganti-jenis-sidang-design.md`