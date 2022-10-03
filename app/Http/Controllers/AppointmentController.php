<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comfile;
use App\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;


class AppointmentController extends Controller
{
 public function create(Request $request)
    {

      $comfile_id = $request->id;
     return view('appointment/create',compact('comfile_id'));
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


      $this->validate($request, [
        'app_date' => 'required',
        'type' => 'required',
        'contact' => 'required',
        'result' => 'required',
        'next' => 'required',
      ]);

      $Appointment =   Appointment::create($request->except(['_token','_method']));

      return back()->with('status','Suivi bien ajouté !');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $Appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $Appointment
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
      $appointment = Appointment::find($id);
     return view('appointment/edit', compact('appointment'));
   }

   public function update(Request $request,$id) {

     $this->validate($request, [
        'app_date' => 'required',
        'type' => 'required',
        'contact' => 'required',
        'result' => 'required',
        'next' => 'required',
    ]);

    Appointment::whereId($id)->update($request->except(['_token','_method','society','signature']));

     return back()->with('status','Modification bien effectuée !');
   }

   public function destroy($id) {

    
     $Comfile = Appointment::find($id);
      $Comfile->delete();
      return redirect(
        // URL::signedRoute
        route('comfiles.index'
    // , ['society' => Auth::user()->name_society]
    )
    );  
    }

}
