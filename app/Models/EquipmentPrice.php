<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentPrice extends Model
{
    use HasFactory;

    protected $table = 'equipment_prices';

    protected $guarded = [];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
        // return $this->belongsTo(Equipment::class, 'equipment_id', 'id');
    }

}
