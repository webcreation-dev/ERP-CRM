<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
   public $timestamps = false;

   public function users()
   {
       return $this->belongsToMany('App\User', 'users_roles');
   }

   /**
     * The database connection that should be used by the model.
     *
     * @var string
     */
    protected $connection = 'tenant';
}
