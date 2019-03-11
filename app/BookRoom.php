<?php

namespace App;

use App\Reservation;

class BookRoom
{
	/**
	 * Reservation instance.
	 *
	 * @var \App\Reservation
	 */
	protected $reservation;

	/**
	 * Create a new event instance.
	 *
	 * @param  \App\Reservation  $reservation
	 * @return void
	 */
	public function __construct(Reservation $reservation)
	{
		$this->reservation = $reservation;
	}

	/**
	 * Returns reservation instance.
	 *
	 * @return \App\Reservation
	 */
	public function getReservation()
	{
		return $this->reservation;
	}
}