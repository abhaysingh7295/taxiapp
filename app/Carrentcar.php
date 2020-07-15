<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Illuminate\Database\Eloquent\Model;

class Carrentcar extends Model
{
    use HasApiTokens,Notifiable,HasPushSubscriptions;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'VehiclesTitle','VehiclesType','company_id','VehiclesOverview','PricePerDay','FuelType','ModelYear','SeatingCapacity','Vimage1','AirConditioner','PowerDoorLocks','AntiLockBrakingSystem','BrakeAssist','PowerSteering','DriverAirbag','PassengerAirbag','PowerWindows','CDPlayer','CentralLocking','CrashSensor','LeatherSeats'
    ];
}
