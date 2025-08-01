<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrainingBlockRequest;
use App\Http\Requests\UpdateTrainingBlockRequest;
use App\Models\TrainingBlock;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TrainingBlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainingBlocks = TrainingBlock::where('user_id', Auth::id())
            ->with('trainingSessions')
            ->latest()
            ->paginate(10);

        return Inertia::render('training-blocks/index', [
            'trainingBlocks' => $trainingBlocks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('training-blocks/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrainingBlockRequest $request)
    {
        $trainingBlock = TrainingBlock::create([
            'user_id' => Auth::id(),
            ...$request->validated()
        ]);

        return redirect()->route('training-blocks.show', $trainingBlock)
            ->with('success', 'Training block created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingBlock $trainingBlock)
    {
        // Ensure user can only view their own training blocks
        if ($trainingBlock->user_id !== Auth::id()) {
            abort(403);
        }

        $trainingBlock->load(['trainingSessions.mmaMetrics', 'trainingSessions.workoutLogs.exercise']);

        return Inertia::render('training-blocks/show', [
            'trainingBlock' => $trainingBlock
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingBlock $trainingBlock)
    {
        // Ensure user can only edit their own training blocks
        if ($trainingBlock->user_id !== Auth::id()) {
            abort(403);
        }

        return Inertia::render('training-blocks/edit', [
            'trainingBlock' => $trainingBlock
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainingBlockRequest $request, TrainingBlock $trainingBlock)
    {
        // Ensure user can only update their own training blocks
        if ($trainingBlock->user_id !== Auth::id()) {
            abort(403);
        }

        $trainingBlock->update($request->validated());

        return redirect()->route('training-blocks.show', $trainingBlock)
            ->with('success', 'Training block updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingBlock $trainingBlock)
    {
        // Ensure user can only delete their own training blocks
        if ($trainingBlock->user_id !== Auth::id()) {
            abort(403);
        }

        $trainingBlock->delete();

        return redirect()->route('training-blocks.index')
            ->with('success', 'Training block deleted successfully.');
    }
}