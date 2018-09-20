<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
		'title',
        'name',
        'last_name',
        'address',
        'zip_code',
        'city',
        'state',
        'email',
    ];

	protected $guarded = [
		// 'last_name',
	];

    public function reservations()
    {
    	return $this->hasMany('App\Reservation');
    }
}
