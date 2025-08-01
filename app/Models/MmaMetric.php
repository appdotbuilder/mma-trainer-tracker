<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\MmaMetric
 *
 * @property int $id
 * @property int $training_session_id
 * @property int|null $strike_count
 * @property int|null $strikes_landed
 * @property int|null $takedown_attempts
 * @property int|null $takedowns_successful
 * @property int|null $submission_attempts
 * @property int|null $submissions_successful
 * @property int|null $avg_heart_rate
 * @property int|null $max_heart_rate
 * @property array|null $heart_rate_zones
 * @property int|null $calories_burned
 * @property float|null $distance_covered
 * @property array|null $additional_metrics
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read TrainingSession $trainingSession
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|MmaMetric newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MmaMetric newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MmaMetric query()
 * @method static \Illuminate\Database\Eloquent\Builder|MmaMetric whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MmaMetric whereTrainingSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MmaMetric whereStrikeCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MmaMetric whereStrikesLanded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MmaMetric whereTakedownAttempts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MmaMetric whereTakedownsSuccessful($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MmaMetric whereSubmissionAttempts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MmaMetric whereSubmissionsSuccessful($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MmaMetric whereAvgHeartRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MmaMetric whereMaxHeartRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MmaMetric whereHeartRateZones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MmaMetric whereCaloriesBurned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MmaMetric whereDistanceCovered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MmaMetric whereAdditionalMetrics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MmaMetric whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MmaMetric whereUpdatedAt($value)

 * 
 * @mixin \Eloquent
 */
class MmaMetric extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'training_session_id',
        'strike_count',
        'strikes_landed',
        'takedown_attempts',
        'takedowns_successful',
        'submission_attempts',
        'submissions_successful',
        'avg_heart_rate',
        'max_heart_rate',
        'heart_rate_zones',
        'calories_burned',
        'distance_covered',
        'additional_metrics',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'heart_rate_zones' => 'array',
        'additional_metrics' => 'array',
    ];

    /**
     * Get the training session that owns the MMA metrics.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trainingSession(): BelongsTo
    {
        return $this->belongsTo(TrainingSession::class);
    }
}