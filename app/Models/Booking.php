<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $guarded = [];

    public function client() {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function host() {
        return $this->belongsTo(User::class, 'host_id', 'id');
    }

    public function admin() {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

}
