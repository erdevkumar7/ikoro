<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert equipment data
        $equipments = [
            'Smart Phone and Gimbal',
            'Drones Only',
            'Smart Phone and Drone',
            'Professional Camera and Drones',
            'Professional Camera',
        ];

        foreach ($equipments as $equipment) {
            DB::table('equipments')->insert([
                'name' => $equipment,
            ]);
        }

        // Insert equipment prices
        $prices = [
            // Smart Phone and Gimbal
            ['equipment_id' => 1, 'duration_minutes' => 30, 'price' => 10000],
            ['equipment_id' => 1, 'duration_minutes' => 60, 'price' => 15000],
            ['equipment_id' => 1, 'duration_minutes' => 90, 'price' => 23000],
            ['equipment_id' => 1, 'duration_minutes' => 120, 'price' => 31000],

            // Drones Only
            ['equipment_id' => 2, 'duration_minutes' => 30, 'price' => 50000],
            ['equipment_id' => 2, 'duration_minutes' => 60, 'price' => 100000],
            ['equipment_id' => 2, 'duration_minutes' => 90, 'price' => 150000],
            ['equipment_id' => 2, 'duration_minutes' => 120, 'price' => 200000],

            // Smart Phone and Drone
            ['equipment_id' => 3, 'duration_minutes' => 30, 'price' => 80000],
            ['equipment_id' => 3, 'duration_minutes' => 60, 'price' => 150000],
            ['equipment_id' => 3, 'duration_minutes' => 90, 'price' => 230000],
            ['equipment_id' => 3, 'duration_minutes' => 120, 'price' => 310000],

            // Professional Camera and Drones
            ['equipment_id' => 4, 'duration_minutes' => 30, 'price' => 150000],
            ['equipment_id' => 4, 'duration_minutes' => 60, 'price' => 300000],
            ['equipment_id' => 4, 'duration_minutes' => 90, 'price' => 450000],
            ['equipment_id' => 4, 'duration_minutes' => 120, 'price' => 600000],

            // Professional Camera
            ['equipment_id' => 5, 'duration_minutes' => 30, 'price' => 150000],
            ['equipment_id' => 5, 'duration_minutes' => 60, 'price' => 300000],
            ['equipment_id' => 5, 'duration_minutes' => 90, 'price' => 450000],
            ['equipment_id' => 5, 'duration_minutes' => 120, 'price' => 600000],
        ];

        DB::table('equipment_prices')->insert($prices);
    }
}
