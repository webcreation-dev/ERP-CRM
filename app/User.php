<?php

namespace App;
use App\Role;
use App\Group;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class User extends Authenticatable
{
  use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'name', 'login','email', 'profil','password','groupid','name_society','database'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    /**
     * The database connection that should be used by the model.
     *
     * @var string
     */
    protected $connection = 'tenant';

    public function roles()
    {
      return $this->belongsToMany('App\Role', 'users_roles');
    }

   public function isUser()
   {
     $roles = $this->roles->toArray();
     return !empty($roles);
   }

   public function hasRole($check)
   {
     return in_array($check, array_pluck ( $this->roles->toArray(), 'name'));
   }


   private function getIdInArray($array, $term)
   {
    foreach ($array as $key => $value) {
     if ($value == $term) {
       return $key;
     }
   }

 }


 public function makeProfil($title)
 {
   $assigned_roles = array();

   $db_roles = Role::all()->toArray();

   for( $i = 0; $i< count($db_roles); $i++){
    $roles[$db_roles[$i]['id']] = $db_roles[$i]['name'];
  }

  switch ($title) {
   case 'admin':
   $assigned_roles[] = $this->getIdInArray($roles, 'create');
   $assigned_roles[] = $this->getIdInArray($roles, 'read');
   $assigned_roles[] = $this->getIdInArray($roles, 'edit');
   $assigned_roles[] = $this->getIdInArray($roles, 'delete');
   $assigned_roles[] = $this->getIdInArray($roles, 'add_paiement');
   $assigned_roles[] = $this->getIdInArray($roles, 'admin');

   break;
   case 'user':
   $assigned_roles[] = $this->getIdInArray($roles, 'create');
   $assigned_roles[] = $this->getIdInArray($roles, 'read');
   $assigned_roles[] = $this->getIdInArray($roles, 'edit');
   $assigned_roles[] = $this->getIdInArray($roles, 'delete');
   $assigned_roles[] = $this->getIdInArray($roles, 'add_paiement');
   break;
   case 'cashier':
   $assigned_roles[] = $this->getIdInArray($roles, 'add_paiement');
   break;

   default:
   throw new \Exception("Le profil choisi n'existe pas");
 }
 $this->roles()->attach($assigned_roles);
}


}
