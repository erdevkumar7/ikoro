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
    ];
}
