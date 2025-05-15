<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $table = 'payment_details';

    protected $fillable = [
        'user_id',
        'client_id',
        'gig_id',
        'duration',
        'payment_intent_id',
        'payment_method',
        'amount',
        'currency',
        'status',
        'payment_type',
    ];

    public function booking()
    {
        return $this->hasOne(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userDetails()
    {
        return $this->belongsTo(Client::class, 'user_id', 'user_id');
    }

    public function gig()
    {
        return $this->belongsTo(Gig::class, 'gig_id');
    }
}
