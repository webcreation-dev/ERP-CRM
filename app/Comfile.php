<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comfile extends Model
{
    protected $fillable = ['com_date','category','ref', 'enterprise'
     ,'ifu','phones', 'address','status','email','rpt_fullname','rpt_phone','wid','result','next','date_rdv','discussion', 'activity','user','user','groupid'];

    public function appointments() {
      return $this->hasMany('App\Appointment','comfile_id');
    }

    /**
     * The database connection that should be used by the model.
     *
     * @var string
     */
    protected $connection = 'tenant';
}

