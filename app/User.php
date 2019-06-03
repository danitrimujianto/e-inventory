<?php

namespace App;

use App\Notifications\ResetPassword as ResetPasswordNotification;
use App\Notifications\NotifPurchase as NotifPurchase;
use App\Notifications\NotificationHandover as NotificationHandover;
use App\Notifications\NotificationHandoverRetur as NotificationHandoverRetur;
use App\Notifications\NotificationService as NotificationService;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tipeuser()
    {
      return $this->belongsTo('App\UserType', 'usertype_id');
    }

    public function karyawan()
    {
      return $this->belongsTo('App\Karyawan', 'karyawan_id');
    }

    public function sendPasswordResetNotification($token)
    {

    $this->notify(new ResetPasswordNotification($token));

    }

    public function NotifPurchase($data, $email)
    {

    $this->notify(new NotifPurchase($data, $email));

    }

    public function NotifHandover($data, $email)
    {

    $this->notify(new NotificationHandover($data, $email));

    }

    public function NotifHandoverRetur($data, $email)
    {

    $this->notify(new NotificationHandoverRetur($data, $email));

    }

    public function NotifService($data, $email)
    {

    $this->notify(new NotificationService($data, $email));

    }
}
