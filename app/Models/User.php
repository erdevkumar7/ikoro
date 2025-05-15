<?php



namespace App\Models;



use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;



class User extends Authenticatable implements MustVerifyEmail

{

    use HasFactory, Notifiable;



    /**

     * The attributes that are mass assignable.

     *

     * @var array<int, string>

     */

    protected $fillable = [

        'name',

        'email',

        'password',

        'role',

        'email_verified_at', 

        'remember_token',

        'facebook_id'

    ];



    /**

     * The attributes that should be hidden for serialization.

     *

     * @var array<int, string>

     */

    protected $hidden = [

        'password',

        'remember_token',

    ];



    /**

     * Get the attributes that should be cast.

     *

     * @return array<string, string>

     */

    protected function casts(): array

    {

        return [

            'email_verified_at' => 'datetime',

            'password' => 'hashed',

        ];

    }



    public function host() {

        return $this->hasOne(Host::class);

    }



    public function client() {

        return $this->hasOne(Client::class);

    }



    public function wallet() {

        return $this->hasOne(Wallet::class);

    }

    

    public function tokens()

    {

        return $this->hasMany(Token::class);

    }



    public function tokenMessages()

    {

        return $this->hasMany(TokenMessage::class);

    }

}

