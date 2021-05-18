<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    use HasFactory;

    protected $table = 'investigations';

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
        'repeatable',
        'result',
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
     * Get the user that handles the investigation.
     */
    public function investigator()
    {
        return $this->belongsTo(User::class, 'investigator_id');
    }
}
