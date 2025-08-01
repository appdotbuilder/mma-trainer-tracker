<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Exercise
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $category
 * @property array|null $muscle_groups
 * @property string|null $equipment
 * @property string|null $instructions
 * @property bool $is_custom
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, WorkoutLog> $workoutLogs
 * @property-read int|null $workout_logs_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise query()
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereMuscleGroups($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereEquipment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereIsCustom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereUpdatedAt($value)
 * @method static \Database\Factories\ExerciseFactory factory($count = null, $state = [])

 * 
 * @mixin \Eloquent
 */
class Exercise extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'category',
        'muscle_groups',
        'equipment',
        'instructions',
        'is_custom',
        'created_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'muscle_groups' => 'array',
        'is_custom' => 'boolean',
    ];

    /**
     * Get the user that created the exercise.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the workout logs for the exercise.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workoutLogs(): HasMany
    {
        return $this->hasMany(WorkoutLog::class);
    }

    /**
     * Scope a query to only include standard exercises.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStandard($query)
    {
        return $query->where('is_custom', false);
    }

    /**
     * Scope a query to only include custom exercises.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCustom($query)
    {
        return $query->where('is_custom', true);
    }
}