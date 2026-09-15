<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RevisionNote;
use App\Models\Schedule;
use App\Models\Submission;
use App\Models\SubmissionStatusLog;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = Cache::remember('dashboard:stats', 300, function () {
            return [
                'mahasiswa' => User::where('role', 'mahasiswa')->count(),
                'dosen' => User::where('role', 'dosen')->count(),
                'submissions' => Submission::count(),
                'revisi_terbuka' => RevisionNote::where('status_poin', 'open')->count(),
            ];
        });

        $schedules = Cache::remember('dashboard:schedules', 300, function () {
            return Schedule::withCount('submissions')->orderBy('tanggal_sidang')->get();
        });

        $submissionStatus = Cache::remember('dashboard:status', 300, function () {
            return Submission::groupBy('status')
                ->pluck(DB::raw('count(*)'), 'status')
                ->toArray();
        });

        $scheduleSubmissions = $schedules;

        $revisionStats = Cache::remember('dashboard:revision', 300, function () {
            return RevisionNote::groupBy('status_poin')
                ->pluck(DB::raw('count(*)'), 'status_poin')
                ->toArray();
        });

        $statusTrend = Cache::remember('dashboard:trend', 300, function () {
            return SubmissionStatusLog::selectRaw('DATE(created_at) as date, status_baru, count(*) as total')
                ->groupBy('date', 'status_baru')
                ->orderBy('date')
                ->get()
                ->groupBy('date')
                ->map(fn ($items) => $items->pluck('total', 'status_baru'))
                ->toArray();
        });

        return view('admin.dashboard', compact(
            'stats',
            'schedules',
            'submissionStatus',
            'scheduleSubmissions',
            'revisionStats',
            'statusTrend'
        ));
    }
}
