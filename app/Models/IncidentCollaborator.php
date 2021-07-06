<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentCollaborator extends Model
{
    use HasFactory;

    protected $table = 'incident_collaborators';

    /**
     * Get the incident related with the collaborator entity.
     */
    public function incident()
    {
        return $this->belongsTo(Incident::class, 'author_id');
    }

    /**
     * Get the user related with the collaborator entity.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
