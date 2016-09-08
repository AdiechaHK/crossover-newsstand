<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class News extends Model
{

	protected $fillable = ['title', 'image', 'text', 'user_id'];

    public function publisher()
    {
		return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function event_at($format = 'D d M, Y [H:i a]')
    {
		$date = new DateTime($this->event_at);
		return $date->format($format);
    }
}
