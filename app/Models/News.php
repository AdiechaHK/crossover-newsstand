<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{

	protected $fillable = ['title', 'image', 'text', 'user_id'];

    public function publisher() {
		return $this->belongsTo('App\Models\User', 'user_id');
    }
}
