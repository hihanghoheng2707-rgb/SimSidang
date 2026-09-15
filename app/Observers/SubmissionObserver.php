<?php

namespace App\Observers;

use App\Models\Submission;
use App\Models\SubmissionStatusLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SubmissionObserver
{
    public function created(Submission $submission): void
    {
        Cache::forget('dashboard:stats');
        Cache::forget('dashboard:schedules');
        Cache::forget('dashboard:status');
        Cache::forget('dashboard:trend');
    }

    public function updating(Submission $submission): void
    {
        if ($submission->isDirty('file_path')) {
            $this->deleteAiCache($submission->id);
        }
    }

    public function updated(Submission $submission): void
    {
        if ($submission->wasChanged('status')) {
            SubmissionStatusLog::create([
                'submission_id' => $submission->id,
                'status_lama' => $submission->getOriginal('status'),
                'status_baru' => $submission->status,
                'diubah_oleh' => Auth::id(),
            ]);
        }

        Cache::forget('dashboard:stats');
        Cache::forget('dashboard:trend');
    }

    public function deleting(Submission $submission): void
    {
        $filePath = $submission->file_path;
        if ($filePath && Storage::disk('local')->exists($filePath)) {
            Storage::disk('local')->delete($filePath);
        }
        $this->deleteAiCache($submission->id);

        Cache::forget('dashboard:stats');
        Cache::forget('dashboard:schedules');
        Cache::forget('dashboard:status');
        Cache::forget('dashboard:trend');
    }

    private function deleteAiCache(int $submissionId): void
    {
        Storage::disk('local')->delete([
            'ai-cache/'.$submissionId.'.md',
            'ai-cache/'.$submissionId.'_response.json',
        ]);
    }
}
