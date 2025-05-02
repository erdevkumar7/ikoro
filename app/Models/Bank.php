<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'account_number',
        'branch_code',
        'swift_code',
        'host_id',
    ];

    /**
     * Relationship: A bank belongs to a host.
     */
    public function host()
    {
        return $this->belongsTo(Host::class);
    }
}

