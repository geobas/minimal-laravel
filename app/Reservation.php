<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
	protected $fillable = [
		'room_id',
	];

    //
    public function client()
    {
    	return $this->belongsTo('App\Client', 'client_id', 'id');
    }

    public function room()
    {
    	return $this->belongsTo('App\Room', 'room_id', 'id');
    }
}
