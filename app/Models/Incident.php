<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    protected $table = 'incidents';

    public $STATUS_STAGING = 0;
    public $STATUS_INVESTIGATION = 1;
    public $STATUS_CORRECTIVE_ACTION = 2;
    public $STATUS_DONE = 3;
    public $STATUS_APPROVED = 4;

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
}
