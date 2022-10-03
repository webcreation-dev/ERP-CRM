<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['app_date','type','contact', 'result','next','comfile_id'];


    public function comfile() {
        return $this->belongsTo('App\Comfile','comfile_id');
    }

    /**
     * The database connection that should be used by the model.
     *
     * @var string
     */
    protected $connection = 'tenant';


}
