<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenMessage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'msg_text',
        'user_id',
        'token_id',
    ];

    /**
     * Relationships
     */

    // A message belongs to a token
    public function token()
    {
        return $this->belongsTo(Token::class);
    }

    // A message belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
