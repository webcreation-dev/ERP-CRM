<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Warehouse;
use App\User;


class HomeControlleur extends Controller
{

  public function index(){

    return view('home');

  }


  public function salesforces(Request $request){

    if(config('custom.module_sales_force') == false){
      return redirect('/')->with('status', 'Le module de Gestion des Forces de Ventes est desactivé !');
    }

    return view('warehouse/warehouse-home');
  }


}
