<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clinic_name','user_id','clinic_phone' ,'clinic_email','clinic_about'
    ];

    public function clinicSlots(){
        return $this->hasMany('App\ClinicSlot','clinic_id')->orderBy('day');
    }
}
