<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'name', 'email', 'password','institute','dob',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function submissions(){
        $this->hasMany(Submission::class);
    }
    public function posts(){
        $this->hasMany(Post::class);
    }
    
    public function is_admin(){
        if($this->is_admin)
            return true;
        else {
            return false;
        }
    }
}
