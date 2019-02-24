<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicSlot extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','clinic_id','day' ,'start_time','end_time'
    ];
}
