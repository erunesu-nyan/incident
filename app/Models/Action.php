<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $table = 'actions';

    public $STATUS_PENDING = 0;
    public $STATUS_WIP = 1;
    public $STATUS_DONE = 2;

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
     * Get the user that handles the corrective action.
     */
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }
}
