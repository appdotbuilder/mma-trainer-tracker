<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TrainingBlock;
use App\Models\TrainingSession;
use App\Models\Injury;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TrainingDashboardController extends Controller
{
    /**
     * Display the training dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        if (!$user) {
            return Inertia::render('welcome');
        }

        // Get user's training data
        $activeBlocks = TrainingBlock::where('user_id', $user->id)
            ->where('status', 'active')
            ->with('trainingSessions')
            ->latest()
            ->take(3)
            ->get();

        $upcomingSessions = TrainingSession::where('user_id', $user->id)
            ->where('status', 'scheduled')
            ->where('scheduled_at', '>=', now())
            ->with(['trainingBlock', 'workoutLogs.exercise'])
            ->orderBy('scheduled_at')
            ->take(5)
            ->get();

        $recentSessions = TrainingSession::where('user_id', $user->id)
            ->where('status', 'completed')
            ->with(['trainingBlock', 'mmaMetrics', 'workoutLogs.exercise'])
            ->orderBy('completed_at', 'desc')
            ->take(5)
            ->get();

        $activeInjuries = Injury::where('user_id', $user->id)
            ->where('status', 'active')
            ->orderBy('injury_date', 'desc')
            ->take(3)
            ->get();

        // Calculate some basic stats
        $totalSessions = TrainingSession::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        $totalTrainingTime = TrainingSession::where('user_id', $user->id)
            ->where('status', 'completed')
            ->sum('duration_minutes');

        $weeklyStats = TrainingSession::where('user_id', $user->id)
            ->where('status', 'completed')
            ->where('completed_at', '>=', now()->subWeek())
            ->selectRaw('COUNT(*) as sessions, SUM(duration_minutes) as total_minutes')
            ->first();

        return Inertia::render('training-dashboard', [
            'activeBlocks' => $activeBlocks,
            'upcomingSessions' => $upcomingSessions,
            'recentSessions' => $recentSessions,
            'activeInjuries' => $activeInjuries,
            'stats' => [
                'totalSessions' => $totalSessions,
                'totalTrainingTime' => $totalTrainingTime,
                'weeklyStats' => $weeklyStats,
            ],
        ]);
    }
}