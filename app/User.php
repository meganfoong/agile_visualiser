<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'first_name', 'last_name', 'email', 'password','is_supervisor', 'parent_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function is_supervisor()
    {
        if (auth()->user()->is_supervisor == 1) {
            return true;
        }
        return false;
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_verified_at' => 'datetime',
    ];

    public function projects()
    {
        return $this->belongsToMany('App\Project');
    }

    public function tasks()
    {
        return $this->belongsToMany('App\Task');
    }

    public static function insertData($data)
    {
        $value = User::where('id', $data['id'])->get();
        //dd($data);
        if ($value->count() == 0) {
            User::insert($data);
        }
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function students()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    // parent
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
}
