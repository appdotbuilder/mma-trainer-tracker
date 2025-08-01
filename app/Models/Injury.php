<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Injury
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string $body_part
 * @property string $severity
 * @property string $type
 * @property \Illuminate\Support\Carbon $injury_date
 * @property \Illuminate\Support\Carbon|null $expected_recovery_date
 * @property \Illuminate\Support\Carbon|null $actual_recovery_date
 * @property string $status
 * @property string|null $treatment_notes
 * @property array|null $affected_activities
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $user
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Injury newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Injury newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Injury query()
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereBodyPart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereSeverity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereInjuryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereExpectedRecoveryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereActualRecoveryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereTreatmentNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereAffectedActivities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereUpdatedAt($value)

 * 
 * @mixin \Eloquent
 */
class Injury extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'body_part',
        'severity',
        'type',
        'injury_date',
        'expected_recovery_date',
        'actual_recovery_date',
        'status',
        'treatment_notes',
        'affected_activities',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'injury_date' => 'date',
        'expected_recovery_date' => 'date',
        'actual_recovery_date' => 'date',
        'affected_activities' => 'array',
    ];

    /**
     * Get the user that owns the injury record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include active injuries.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include recovered injuries.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRecovered($query)
    {
        return $query->where('status', 'healed');
    }
}