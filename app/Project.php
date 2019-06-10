<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'group',
        'brief',
        'milestones',
        'supervisorDetails',
        'clientDetails',
        'startDate',
        'endDate'
      ];
    
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
