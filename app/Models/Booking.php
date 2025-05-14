<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function clientDetails()
    {
        return $this->hasOne(Client::class, 'user_id', 'client_id'); // This refers to the clients table
    }

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id', 'id');
    }

      public function hostDetails()
    {
        return $this->hasOne(Host::class, 'user_id', 'host_id'); // This refers to the clients table
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    public function gig()
    {
        return $this->belongsTo(Gig::class, 'gig_id');
    }

    public function feature()
    {
        return $this->belongsTo(GigFeature::class, 'feature_id');
    }

    public function payment()
    {
        return $this->belongsTo(PaymentDetail::class, 'payment_detail_id');
    }
}
