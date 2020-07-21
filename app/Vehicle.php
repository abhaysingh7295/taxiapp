<?php

namespace App;

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
     use HasApiTokens,Notifiable,HasPushSubscriptions;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'make','model','color','registrationNumber','PHCLicenceNumber','seatType','registration_expire','is_logo'
    ];
}
