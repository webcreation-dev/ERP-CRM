<?php

use Illuminate\Support\Facades\Auth;
use App\User;


function hasAdmin($id) {

    $user = User::where("id", $id)->first();
    if($user->profil == "admin") {
        return true;
    }else {
        return false;
    }      
}

if(!function_exists('format_hour')){

  function format_hour($date){
    $date = explode(' ', $date);
    return  $date[1];
  }
}

if(!function_exists('format_date')){

	function format_date($date){
		$date = explode(' ', $date);
		$date = explode('-', $date[0]);
		return  $date[2].'-'.$date[1].'-'.$date[0];
	}
}

if(!function_exists('convertToEnglishDate')){
	function convertToEnglishDate($s){
		$date = strtotime($s);
		return  date('Y-m-d H:i:s', $date);
	}
}

if(!function_exists('convertToFrenchDate')){
  function convertToFrenchDate($s){

    $date = strtotime($s);
    return date('d/m/Y H:i', $date);
  }
}

if(!function_exists('format_money')){
	function format_money($p){
		//return retourne au format francais les montants;
   return number_format($p, env('DECIMAL_NUM'), '.', ' ');
 }
}



if(!function_exists('reduireChaineCar')){
   function reduireChaineCar($chaine, $nb_car, $delim='...') {
  $length = $nb_car;
  if($nb_car < strlen($chaine)){
  while (($chaine[$length] != " ") && ($length > 0)) {
   $length--;
  }
  if ($length == 0) return substr($chaine, 0, $nb_car) . $delim;
   else return substr($chaine, 0, $length) . $delim;
  }else return $chaine;
}
  }












