<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Seat;
use App\Models\Station;
use App\Models\Trip;
use App\Models\TripStation;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Stations
        $stations = ['Cairo', 'Giza', 'AlFayyum', 'AlMinya', 'Asyut'];
        $stationsCount = count($stations);

        for ($i = 0; $i < $stationsCount; $i++) {
            Station::create(['name' => $stations[$i], 'order' => $i + 1]);
        }

        // Bus
        $bus = Bus::create(['plate_number' => fake()->bothify('??? ###'), 'available_seats' => 12]);

        // Seats 1-12
        for ($i = 1; $i <= 12; $i++) {
            Seat::create(['id' => $i, 'bus_id' => $bus->id]);
        }

        // Trip: Cairo to Asyut
        $trip = Trip::create([
            'name' => 'Cairo to Asyut',
            'bus_id' => $bus->id,
            'starts_at' => now()->addWeek(),
        ]);

        // Stops
        $stopOrder = 1;
        foreach (['Cairo', 'AlFayyum', 'AlMinya', 'Asyut'] as $name) {  // Note: Giza not in example, add if needed
            $station = Station::where('name', $name)->first();
            TripStation::create(['trip_id' => $trip->id, 'station_id' => $station->id, 'order' => $stopOrder++]);
        }
    }
}
