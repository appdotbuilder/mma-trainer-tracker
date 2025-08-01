<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\TrainingBlock
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property string $status
 * @property array|null $goals
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, TrainingSession> $trainingSessions
 * @property-read int|null $training_sessions_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingBlock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingBlock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingBlock query()
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingBlock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingBlock whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingBlock whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingBlock whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingBlock whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingBlock whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingBlock whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingBlock whereGoals($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingBlock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingBlock whereUpdatedAt($value)
 * @method static \Database\Factories\TrainingBlockFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class TrainingBlock extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'goals',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'goals' => 'array',
    ];

    /**
     * Get the user that owns the training block.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the training sessions for the training block.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trainingSessions(): HasMany
    {
        return $this->hasMany(TrainingSession::class);
    }

    /**
     * Scope a query to only include active training blocks.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}