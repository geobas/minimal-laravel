<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'floor',
        'description'
    ];

    /**
     * A Room has many Reservations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    /**
     * Fetch available rooms for a specific duration.
     *
     * @param  string $start_date
     * @param  string $end_date
     * @return \Illuminate\Support\Collection
     */
    public function getAvailableRooms($start_date, $end_date)
    {
        $availableRooms = DB::table('rooms as r')
                                    ->select('r.id', 'r.name')
                                    ->whereRaw("
                                        r.id NOT IN (
                                            SELECT b.room_id FROM reservations b
                                            WHERE NOT(
                                                 b.date_out < '{$start_date}' OR
                                                 b.date_in > '{$end_date}'
                                            )
                                        )
                                    ")
                                    ->orderBy('r.id')
                                    ->get();
        return $availableRooms;
    }

    /**
     * Check if a room is booked for a specific duration.
     *
     * @param  string  $room_id
     * @param  string  $start_date
     * @param  string  $end_date
     * @return @return \Illuminate\Support\Collection
     */
    public function isRoomBooked($room_id, $start_date, $end_date)
    {
        $availableRooms = DB::table('reservations')
                                    ->whereRaw("
                                        NOT(
                                            date_out < '{$start_date}' OR
                                            date_in > '{$end_date}'
                                        )
                                    ")
                                    ->where('room_id', $room_id)
                                    ->count();
        return $availableRooms;
    }
}
