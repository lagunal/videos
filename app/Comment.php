<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    
    //relation many to one
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function video(){
        return $this->belongsTo('App\Video', 'video_id');
    }

}
