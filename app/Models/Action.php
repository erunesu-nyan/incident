<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $table = 'actions';

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
        'repeatable',
        'status',
        'corrective_action_form_file_path',
    ];

    /**
     * Get the related incident.
     */
    public function incident()
    {
        return $this->belongsTo(Incident::class, 'incident_id');
    }

    /**
     * Get the user that handles the corrective action.
     */
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
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
