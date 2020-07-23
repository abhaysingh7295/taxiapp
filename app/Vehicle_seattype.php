<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle_seattype extends Model {

    protected $table = 'vehicle_seattypes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function Vehicleluggage() {
        return $this->hasMany(Vehicleluggage::class, 'seattype');
    }

}
