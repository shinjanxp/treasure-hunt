<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question_html', 'solution', 'explanation_html','serial_number',
    ];
    public function submissions(){
        $this->hasMany(Submission::class);
    }
    public function posts(){
        $this->hasMany(Post::class);
    }
}
