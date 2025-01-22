<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GigMedia extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'id';

    public $timestamps = false;
}
