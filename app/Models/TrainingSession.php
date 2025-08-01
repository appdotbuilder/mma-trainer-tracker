<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\TrainingSession
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $training_block_id
 * @property string $title
 * @property string|null $description
 * @property \Illuminate\Support\Carbon $scheduled_at
 * @property \Illuminate\Support\Carbon|null $started_at
 * @property \Illuminate\Support\Carbon|null $completed_at
 * @property int|null $duration_minutes
 * @property string $type
 * @property string $intensity
 * @property string $status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $user
 * @property-read TrainingBlock|null $trainingBlock
 * @property-read \Illuminate\Database\Eloquent\Collection<int, WorkoutLog> $workoutLogs
 * @property-read int|null $workout_logs_count
 * @property-read MmaMetric|null $mmaMetrics
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingSession whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingSession whereTrainingBlockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingSession whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingSession whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingSession whereScheduledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingSession whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingSession whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingSession whereDurationMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingSession whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingSession whereIntensity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingSession whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingSession whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingSession whereUpdatedAt($value)
 * @method static \Database\Factories\TrainingSessionFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class TrainingSession extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'training_block_id',
        'title',
        'description',
        'scheduled_at',
        'started_at',
        'completed_at',
        'duration_minutes',
        'type',
        'intensity',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'scheduled_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the user that owns the training session.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the training block that the session belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trainingBlock(): BelongsTo
    {
        return $this->belongsTo(TrainingBlock::class);
    }

    /**
     * Get the workout logs for the training session.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workoutLogs(): HasMany
    {
        return $this->hasMany(WorkoutLog::class);
    }

    /**
     * Get the MMA metrics for the training session.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mmaMetrics(): HasOne
    {
        return $this->hasOne(MmaMetric::class);
    }

    /**
     * Scope a query to only include completed sessions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}