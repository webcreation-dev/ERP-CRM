<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;

class GroupController extends Controller
{

   public function index() {
     $groups = Group::orderBy('created_at','desc')->paginate(10);
     return view('group/index', compact('groups'));
  }

  public function create() {
     return view('group/create');
  }

   // return custommer add form
  public function store(Request $request) {
     //Validation des champs
     $this->validate($request, [
      'name' => 'required|unique:groups',
      'email' => 'required|unique:groups',
      'identification' => 'required',
      'phones' => 'required',
      'picture' => 'image|mimes:jpeg,png,jpg,gif,svg',
      'manager' => 'required'
   ]);

     if($request->picture && $product){
      $imageName = $request->code.''.time().'.'.$request->picture->getClientOriginalExtension();
      $request->picture->move(public_path('images'), $imageName);
      $product->update(['picture' => $imageName]);
   }

   $group = Group::create($request->except(['picture','_token','_method']));

   if($request->picture && $group){
      $imageName = str_replace(" ", "-", str_replace("'", "", $request->name)).time().'.'.$request->picture->getClientOriginalExtension();
      $request->picture->move(public_path('images'), $imageName);
      $group->update(['picture' => $imageName]);
   }

   return redirect(route('groups.index'));

}

public function edit($id) {
  $group = Group::find($id);
  return view('group/edit', compact('group'));
}

public function update(Request $request) {

  $this->validate($request, [
     'name' => 'required',
     'email' => 'required',
     'identification' => 'required',
     'phones' => 'required',
     'manager' => 'required'
  ]);

  $group = Group::whereId($request->id)->first();
  $group->update($request->except(['picture','_token','_method']));
  if($request->picture && $group){
   $imageName = str_replace(" ", "-", str_replace("'", "", $request->name)).time().'.'.$request->picture->getClientOriginalExtension();
   $request->picture->move(public_path('images'), $imageName);
   $group->update(['picture' => $imageName]);
}
return redirect(route('groups.index'));
}

public function destroy($id) {
  $group = Group::find($id);
  $group->delete();
  return redirect(route('groups.index'));

}
}
