<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    use HasFactory;

    protected $table = 'hosts';

    protected $guarded = [];

    protected $primaryKey = 'id';

    public function user() {
        return $this->belongsTo(User::class);
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
    
    public function gigs() {
        return $this->hasMany(Gig::class, 'host_id', 'user_id');
    }

    public function bank() {
        return $this->hasOne(Bank::class);
    }
}



