<?php
declare(strict_types=1);

namespace App\Domain\Entity;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

/**
 * App\Domain\Entity\User
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'profile_icon_photo',
        'profile_header_photo',
        'self_produce',
        'birth_year',
        'birth_month',
        'birth_day',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_year' => 'integer',
        'birth_month' => 'integer',
        'birth_day' => 'integer',
        'follow' => 'integer',
        'follower' => 'integer',
    ];

    /**
     * ユーザの投稿情報を取得
     */
    public function posts()
    {
        return $this->hasMany('App\Domain\Entity\Post');
    }
}
