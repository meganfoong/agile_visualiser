<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'body', 'project_id', 'type'
    ];

    public function projects()
    {
        return $this->belongsTo(Project::class);
    }

}
