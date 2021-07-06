<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    protected $table = 'incidents';

    // a set of constants for incident selectable fields

    public const STATUS_STAGING = 1;
    public const STATUS_INVESTIGATION = 2;
    public const STATUS_CORRECTIVE_ACTION = 3;
    public const STATUS_DONE = 4;
    public const STATUS_APPROVED = 5;

    public const SEVERITY_VERY_LOW = 1;
    public const SEVERITY_LOW = 2;
    public const SEVERITY_MEDIUM = 3;
    public const SEVERITY_HIGH = 4;
    public const SEVERITY_VERY_HIGH = 5;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'severity',
        'status'
    ];

    /**
     * Get the related investigation.
     */
    public function investigation()
    {
        return $this->hasOne(Investigation::class);
    }

    /**
     * Get the related investigation.
     */
    public function action()
    {
        return $this->hasOne(Action::class);
    }

    /**
     * Get the user that created the incident.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get users involved in the incident.
     */
    public function collaborators()
    {
        return $this->hasMany(IncidentCollaborator::class);
    }

    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case Self::STATUS_STAGING:
                return "Staging";
            case Self::STATUS_INVESTIGATION:
                return "Investigation in Progress";
            case Self::STATUS_CORRECTIVE_ACTION:
                return "Corrective Action in Progress";
            case Self::STATUS_DONE:
                return "Done";
            case Self::STATUS_APPROVED:
                return "Approved";
            default:
                return "-";
        }
    }

    public function getSeverityLabelAttribute()
    {
        switch ($this->severity) {
            case Self::SEVERITY_VERY_LOW:
                return "Very Low";
            case Self::SEVERITY_LOW:
                return "Low";
            case Self::SEVERITY_MEDIUM:
                return "Medium";
            case Self::SEVERITY_HIGH:
                return "High";
            case Self::SEVERITY_VERY_HIGH:
                return "Very High";
            default:
                return "-";
        }
    }

    public function isCollaborator(User $user)
    {
        return !empty(
            $this->collaborators->where('user_id', $user->id)
        );
    }
}
