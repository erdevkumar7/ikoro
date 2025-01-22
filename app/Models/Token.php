<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'user_id',
        'status',
        'awaiting_reply',
    ];

    /**
     * Relationships
     */

    // A token belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A token has many messages
    public function tokenmessages()
    {
        return $this->hasMany(TokenMessage::class);
    }
}
