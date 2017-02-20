<?php

namespace App\Policies;

use App\User;
use App\Question;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    // public function show(User $user){
    //     return true;
    // }
    // public function post(User $user){
    //     return !$user->is_admin();
    // }
    public function showById(User $user, Question $question){
        if($user->is_admin())
            return true;
        else{
            return $user->level == $question->id;
        }
    }
    public function postById(User $user, Question $question){
        if($user->is_admin())
            return true;
        else{
            return $user->level == $question->id;
        }
    }
}
