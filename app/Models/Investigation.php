<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    use HasFactory;

    protected $table = 'investigations';

    // a set of constants for investigation selectable fields

    public const STATUS_PENDING = 0;
    public const STATUS_WIP = 1;
    public const STATUS_DONE = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'result',
        'status',
    ];

    /**
     * Get the related incident.
     */
    public function incident()
    {
        return $this->belongsTo(Incident::class, 'incident_id');
    }

    /**
     * Get the user that handles the investigation.
     */
    public function investigator()
    {
        return $this->belongsTo(User::class, 'investigator_id');
    }

    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case Self::STATUS_PENDING:
                return "Pending";
            case Self::STATUS_WIP:
                return "Work in Progress";
            case Self::STATUS_DONE:
                return "Done";
            default:
                return "-";
        }
    }
}
