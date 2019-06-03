<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Modal extends Model
{
  protected $fillable = [
    'title',
    'description',
    'status',
    'assign',
    'approve',
    'parent_id'
  ];

  public $timestamps = false;

  // Modal model
  // loads only direct children - 1 level
  public function children()
  {
    return $this->hasMany(Modal::class, 'parent_id');
  }

  // parent
  public function parent()
  {
    return $this->belongsTo(Modal::class, 'parent_id');
  }

  public function childrenRecursive()
  {
   return $this->children()->with('childrenRecursive');
  }

}
