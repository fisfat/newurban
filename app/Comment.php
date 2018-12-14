<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'user_id',
        'article_id',
        'body',
    ];

    public function article(){
        return $this->belongsTo('App\Article', 'article_id');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

}
