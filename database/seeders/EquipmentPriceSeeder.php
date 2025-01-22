<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EquipmentPrice;

class EquipmentPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EquipmentPrice::factory()->create([
            'equipment_id' => '1',
            'equipment_name' => 'Smart Phone and Gimbal',
            'price' => '30',
            'minutes' => '30',
        ]);

        EquipmentPrice::factory()->create([
            'equipment_id' => '2',
            'equipment_name' => 'Drones Only',
            'price' => '50',
            'minutes' => '30',
        ]);
        
        EquipmentPrice::factory()->create([
            'equipment_id' => '3',
            'equipment_name' => 'Smart Phone & Drone',
            'price' => '60',
            'minutes' => '30',
        ]);

        EquipmentPrice::factory()->create([
            'equipment_id' => '4',
            'equipment_name' => 'Professional Camera and Drones',
            'price' => '80',
            'minutes' => '30',
        ]);
        
        EquipmentPrice::factory()->create([
            'equipment_id' => '5',
            'equipment_name' => 'Professional Camera only',
            'price' => '50',
            'minutes' => '60',
        ]);

    }
}
