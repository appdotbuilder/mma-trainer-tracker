<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\WorkoutLog
 *
 * @property int $id
 * @property int $training_session_id
 * @property int $exercise_id
 * @property int $order
 * @property int $sets_completed
 * @property int|null $target_sets
 * @property array|null $set_details
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read TrainingSession $trainingSession
 * @property-read Exercise $exercise
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|WorkoutLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkoutLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkoutLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkoutLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkoutLog whereTrainingSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkoutLog whereExerciseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkoutLog whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkoutLog whereSetsCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkoutLog whereTargetSets($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkoutLog whereSetDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkoutLog whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkoutLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkoutLog whereUpdatedAt($value)

 * 
 * @mixin \Eloquent
 */
class WorkoutLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'training_session_id',
        'exercise_id',
        'order',
        'sets_completed',
        'target_sets',
        'set_details',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'set_details' => 'array',
    ];

    /**
     * Get the training session that owns the workout log.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trainingSession(): BelongsTo
    {
        return $this->belongsTo(TrainingSession::class);
    }

    /**
     * Get the exercise that was performed.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
}