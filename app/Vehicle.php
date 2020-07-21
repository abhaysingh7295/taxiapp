<?php

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
        'id', 'make','model','color','registrationNumber','PHCLicenceNumber','seatType','registration_expire','is_logo','is_ft','is_pt','is_schedule','is_notes','is_induction','is_companyscar'
    ];
    /**
     * The services that belong to the user.
     */
    public function documents()
    {
        return $this->hasMany('App\VehicleDocument');
    }

    /**
     * The services that belong to the user.
     */
    public function document($id)
    {
        return $this->hasOne('App\VehicleDocument')->where('document_id', $id)->first();
    }

    /**
     * The services that belong to the user.
     */
    public function pending_documents()
    {
        return $this->hasMany('App\VehicleDocument')->where('status', 'ASSESSING')->count();
    }

    public function active_documents()
    {
        return $this->hasMany('App\VehicleDocument')->where('status', 'ACTIVE')->count();
    }

}

