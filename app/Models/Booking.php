<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['passenger_id', 'trip_id', 'bus_seat_id', 'start_station_id', 'end_station_id'];

    public function passenger(): BelongsTo
    {
        return $this->belongsTo(User::class, 'passenger_id');
    }

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    public function seat(): BelongsTo
    {
        return $this->belongsTo(Seat::class);
    }

    public function start_station(): BelongsTo
    {
        return $this->belongsTo(Station::class);
    }

    public function end_station(): BelongsTo
    {
        return $this->belongsTo(Station::class);
    }
}
