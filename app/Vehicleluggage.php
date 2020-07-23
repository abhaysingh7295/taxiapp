<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicleluggage extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'seattype',
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

    public function Vehicle_seattype() {
        return $this->belongsTo(Vehicle_seattype::class, 'id');
    }

}
