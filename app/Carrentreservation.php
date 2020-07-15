<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Illuminate\Database\Eloquent\Model;

class Carrentreservation extends Model
{
    use HasApiTokens,Notifiable,HasPushSubscriptions;
     protected $fillable = [
        'id', 'userid', 'VehicleId', 'FromDate', 'ToDate', 'message', '	Status', 'PostingDate', 'created_at', 'updated_at'
    ];
}
