<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Submission;
class Question extends Model
{
    protected $fillable = [
        'id','question_html', 'solution', 'explanation',
    ];
    protected $hidden=[
        'solution','explanation'  
    ];
    public function submissions(){
        $this->hasMany(Submission::class);
    }
    public function posts(){
        $this->hasMany(Post::class);
    }
    
    public function evaluate(Submission $submission){
        $parsed_submission = $submission->submission_text;
        $parsed_submission=preg_replace("#[[:punct:]]#", "", $parsed_submission);  //Remove punctuation
        $parsed_submission=preg_replace("# #", "", $parsed_submission);  //Remove spaces
        $parsed_submission=strtolower($parsed_submission);  //To lower case
        
        //Now compare
        if(strcasecmp($parsed_submission,$this->solution) ==0)
            return true;
        else 
            return false;
        
        
    }
}
