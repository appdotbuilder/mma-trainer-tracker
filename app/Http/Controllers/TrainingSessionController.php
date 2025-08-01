<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrainingSessionRequest;
use App\Http\Requests\UpdateTrainingSessionRequest;
use App\Models\TrainingSession;
use App\Models\TrainingBlock;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TrainingSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainingSessions = TrainingSession::where('user_id', Auth::id())
            ->with(['trainingBlock', 'mmaMetrics'])
            ->latest('scheduled_at')
            ->paginate(15);

        return Inertia::render('training-sessions/index', [
            'trainingSessions' => $trainingSessions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trainingBlocks = TrainingBlock::where('user_id', Auth::id())
            ->where('status', '!=', 'completed')
            ->latest()
            ->get();

        return Inertia::render('training-sessions/create', [
            'trainingBlocks' => $trainingBlocks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrainingSessionRequest $request)
    {
        $trainingSession = TrainingSession::create([
            'user_id' => Auth::id(),
            ...$request->validated()
        ]);

        return redirect()->route('training-sessions.show', $trainingSession)
            ->with('success', 'Training session created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingSession $trainingSession)
    {
        // Ensure user can only view their own training sessions
        if ($trainingSession->user_id !== Auth::id()) {
            abort(403);
        }

        $trainingSession->load([
            'trainingBlock',
            'workoutLogs.exercise',
            'mmaMetrics'
        ]);

        return Inertia::render('training-sessions/show', [
            'trainingSession' => $trainingSession
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingSession $trainingSession)
    {
        // Ensure user can only edit their own training sessions
        if ($trainingSession->user_id !== Auth::id()) {
            abort(403);
        }

        $trainingBlocks = TrainingBlock::where('user_id', Auth::id())
            ->where('status', '!=', 'completed')
            ->latest()
            ->get();

        return Inertia::render('training-sessions/edit', [
            'trainingSession' => $trainingSession,
            'trainingBlocks' => $trainingBlocks
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainingSessionRequest $request, TrainingSession $trainingSession)
    {
        // Ensure user can only update their own training sessions
        if ($trainingSession->user_id !== Auth::id()) {
            abort(403);
        }

        $trainingSession->update($request->validated());

        return redirect()->route('training-sessions.show', $trainingSession)
            ->with('success', 'Training session updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingSession $trainingSession)
    {
        // Ensure user can only delete their own training sessions
        if ($trainingSession->user_id !== Auth::id()) {
            abort(403);
        }

        $trainingSession->delete();

        return redirect()->route('training-sessions.index')
            ->with('success', 'Training session deleted successfully.');
    }
}