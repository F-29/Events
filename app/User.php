<?php

namespace App;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Events\UserCreatedEvent;
use App\Events\UserCreatingEvent;
use App\Events\UserSavingEvent;
use App\Events\UserUpdatedEvent;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @package App
 * @inheritDoc Authenticatable
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function logout()
    {
        $this->api_token = null;
        $this->save();
        return $this;
    }

    public function generateApiToken()
    {
        $token = Str::random(128);
        $this->api_token = $token;
        $this->save();
        return $token;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token',
    ];

    // retrieved, creating, created, updating, updated,
    // saving, saved, deleting,  deleted, restoring, restored
//    protected $dispatchesEvents = [
//        'saving' => UserSavingEvent::class,
//        'creating' => UserCreatingEvent::class,
//        'created' => UserCreatedEvent::class,
//        'updated' => UserUpdatedEvent::class
//    ];

    protected $table = "users";

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token', 'user_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
