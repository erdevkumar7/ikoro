<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gig extends Model
{
    use HasFactory;

    protected $table = 'gigs';

    protected $guarded = [];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function task() {
        return $this->belongsTo(Task::class);
    }
    
    public function host() {
        return $this->belongsTo(Host::class, 'host_id', 'user_id');
    }
    
    public function equipmentPrice() {
        return $this->belongsTo(EquipmentPrice::class);
        // return $this->belongsTo(EquipmentPrice::class, 'equipment_price_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'gig_id');
    }

    public function equipment() {
        return $this->belongsTo(Equipment::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function state() {
        return $this->belongsTo(State::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function zip() {
        return $this->belongsTo(Zipcode::class);
    }

    public function media() {
        return $this->hasMany(GigMedia::class);
    }

    public function features() {
        return $this->hasMany(GigFeature::class);
    }

}
