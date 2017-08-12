<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	public $with = ['user', 'likes'];
	
    protected $fillable = ['content', 'user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function likes()
    {
    	return $this->hasMany(Like::class);
    }
}
