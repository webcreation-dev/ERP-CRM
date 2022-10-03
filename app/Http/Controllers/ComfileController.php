<?php

namespace App\Http\Controllers;

use App\Comfile;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;


class ComfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

      $q = request('q');
      $comfiles = Comfile::orderBy('created_at','desc')
      ->where('enterprise', 'like', "%$q%")
      ->paginate(25);
      $comfiles =  $comfiles->appends(['q'=>$q]);
    

     if ($request->ajax()) {
       return view('comfile/load', ['comfiles' => $comfiles])->render();
     }
     return view('comfile/index', compact('comfiles'));

   }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('comfile/create');
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd(Comfile::all());

      $this->validate($request, [
        'com_date' => 'required',
        'category' => 'required',
        'ifu' => 'unique:comfiles',
        'enterprise' => 'required|unique:comfiles',
        'phones' => 'required|unique:comfiles',
        'rpt_fullname' => 'required',
        'activity' => 'required',
        'discussion' => 'required',
      ]);
      // dd($request->enterprise);

      $request->request->add(['ref' => 'ref', 'wid' => 1]);

      $Comfile =   Comfile::create($request->except(['_token','_method']));
      // return redirect(URL::signedRoute('comfiles.index', ['society' => Auth::user()->name_society]));
      return redirect(
        // URL::signedRoute
        route('comfiles.index'
    // , ['society' => Auth::user()->name_society]
    )
    ); 
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Comfile  $comfile
     * @return \Illuminate\Http\Response
     */
    public function show(Comfile $comfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comfile  $comfile
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
      $comfile = Comfile::find($id);
      return view('comfile/edit', compact('comfile'));
    }

    public function passClient($id) {
      $comfile = Comfile::find($id);
      $comfile->status = 'client';
      $comfile->save();
      $comfile->category = 'CLIENT';
      $comfile->save();
      
      return back();
    }

    public function update(Request $request,$id) {

     $this->validate($request, [
       'com_date' => 'required',
       'category' => 'required',
       'ifu' => 'required',
       'enterprise' => 'required',
       'phones' => 'required',
       'rpt_fullname' => 'required',
       'activity' => 'required',
       'discussion' => 'required',
     ]);


     Comfile::whereId($id)->update($request->except(['_token','_method','groupid','society','signature']));

    //  return redirect(URL::signedRoute('comfiles.index', ['society' => Auth::user()->name_society]));
    return redirect(
      // URL::signedRoute
      route('comfiles.index'
  // , ['society' => Auth::user()->name_society]
  )
  ); 
   }

   public function destroy($id) {

     $Comfile = Comfile::find($id);
     $Comfile->delete();

    return back();
    //  return redirect(route(URL::signedRoute('comfiles.index', ['society' => Auth::user()->name_society])));
   }

 }
