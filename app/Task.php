<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{   
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'status',
        'assign',
        'complete',
        'parent_id',
        'startDate',
        'dueDate'
        
      ];

      public $timestamps = false;

    public function children()
    {
        return $this->hasMany(Task::class, 'parent_id');
    }

    // parent
    public function parent()
    {
        return $this->belongsTo(Task::class, 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function projects()
    {
        return $this->belongsTo('App\Project');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

}
