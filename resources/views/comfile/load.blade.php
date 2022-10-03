
<br>
<div class="">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

  @foreach ($comfiles as $comfile)

  <div class="panel panel-default">
    <div class="panel-heading active" role="tab" id="headingOne" style="background:#aad2ee;">
      <h4 class="panel-title">

        <a style="display: inline-block;" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$comfile->id}}" aria-expanded="true" aria-controls="collapseOne">
         <u>REF # {{$comfile->id}} 
          {{-- @if(Auth::user()->hasRole('admin')) --}}
           - {{$comfile->user}} 
           {{-- @endif  --}}
          </u> | <b> {{ reduireChaineCar($comfile->enterprise, 20) }}</b> | <button>{{ $comfile->appointments()->get()->count()}}</button>
       </a>
     </h4>

     <div class="btn-group action-btn-group pull-right" role="group" style=" margin-top: -25px; ">
      <button type="button" class="btn btn-sm btn-li dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <small>ACTION</small>
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu">

        <li> <a title="Suivi" class="btn btn-small btn-light btn-sm" href="{{ route('appointments.create', ['id' => $comfile->id])}}"><i class="fa fa-file-text" aria-hidden="true"></i> AJOUTER UN SUIVI </a></li>

        {{-- <li> <a title="Suivi" class="btn btn-small btn-warning btn-sm" href="{{ URL::signedRoute('comfiles.journal', ['society' => Auth::user()->name_society, 'id' => $comfile->id])}}"><i class="fa fa-file-text" aria-hidden="true"></i> PASSER EN CLIENT </a></li> --}}
        {{-- <li> <a title="Suivi" class="btn btn-small btn-warning btn-sm" href="{{ url('comfiles/journal?id='.$comfile->id)}}"><i class="fa fa-file-text" aria-hidden="true"></i> PASSER EN CLIENT </a></li> --}}

        <li> <a title="Modifier" class="btn btn-small btn-info btn-sm" href="{{ route('comfiles.edit', ['comfile' => $comfile])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> MODIFIER</a></li>

        {{-- @if (Auth::user()->hasRole('admin')) --}}
        <li><form onsubmit="return deleteConfirmation();" action="{{ route('comfiles.destroy', ['comfile' => $comfile])}}" method="POST">
         {{ csrf_field() }}
         {{ method_field('DELETE') }}
         <button style="width: 100%" title="supprimer" type="submit" class="btn-sm btn-danger btn ">
          <i class="fa fa-times" aria-hidden="true"></i> SUPPRIMER</button>
        </form></li>
        {{-- @endif --}}
      </ul>
    </div>
  </div>
  <div id="collapse{{$comfile->id}}" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
    <div class="panel-body">

     <div class="row">
       <div class="col-md-6">
        <table class="table table-tripped">
          <tr>
            <td width="30%"><b> DATE DE PROPECTION </b></td>
            <td>{{convertToFrenchDate($comfile->com_date)}} </td>
          </tr>
          <tr>
            <td><b> NOM DE L'ENTREPRISE </b></td>
            <td> <b>{{$comfile->enterprise}} </b>  <br>

              @if($comfile->category =="NOUVEAU")
              <span class="" style="padding:1px 10px; border-radius: 3px; font-size: 11px; background: green; color: #fff"> {{$comfile->category}} </span> @endif

              @if($comfile->category =="ANCIEN")
              <span class="bg-primary" style="padding:1px 10px; border-radius: 3px; font-size: 11px;"> {{$comfile->category}}</span> @endif

            </td>
          </tr>

          <tr>
            <td><b>N° IFU </b></td>
            <td>{{$comfile->ifu}}</td>
          </tr>

          <tr>
            <td><b>TELEPHONES  </b></td>
            <td>{{$comfile->phones}}</td>
          </tr>

          <tr>
            <td><b>EMAIL </b></td>
            <td>{{$comfile->email}}</td>
          </tr>

          <tr>
            <td><b>ADRESSE</b></td>
            <td>{{$comfile->address}}</td>
          </tr>

          <tr>
            <td><b>SECTEUR D'ACTIVITE</b></td>
            <td>{{$comfile->activity}}</td>
          </tr>

          <tr>
            <td><b>REPRESENTANT</b></td>
            <td>{{$comfile->rpt_fullname}}</td>
          </tr>

          <tr>
            <td><b>TEL. REPRESENTANT</b></td>
            <td>{{$comfile->rpt_phone}}</td>
          </tr>

          <tr>
            <td><b>SUJETS DISCUTES</b></td>
            <td>{{$comfile->discussion}}</td>
          </tr>

          <tr>
            <td><b>CONCLUSION</b></td>
            <td>{{$comfile->result}}</td>
          </tr>


          <tr>
            <td><b>LA SUITE </b></td>
            <td>{{$comfile->next}}</td>
          </tr>

        </table>
      </div>
      <div class="col-md-6" style="background:#f4f4f4f4">
       <div style="overflow-y: auto;max-height: 700px; padding-top: 10px ;">                                                       
        <b>  SUIVIS EFFECTUES </b>  <a style="padding:1px 5px; float: right;" title="Modifier" class="btn btn-sm btn-primary" href="{{ route('appointments.create', ['id' => $comfile->id])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ajouter un suivi</a>

        @foreach($comfile->appointments()->get() as $appointment)
        <table class="table ">
          <tr>
            <td>
              <b>Date : </b> {{convertToFrenchDate($appointment->app_date)}} <br>
              <b>Suvi : </b>{{$appointment->type}} <br>
              <b>Contact : </b>{{$appointment->contact}} <br>
              <b>Objet : </b>{{$appointment->result}} <br>
              <b>Conculsion :  </b> {{$appointment->next}} <br>  <br>

<table>
  <tr>
    <td> <a style="padding:1px 5px;" title="Modifier" class="btn btn-sm btn-info" href="{{ route('appointments.edit', ['appointment' => $appointment])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modifier</a> &nbsp;</td>
    <td>
      {{-- @if (Auth::user()->hasRole('admin')) --}}
               <form onsubmit="return deleteConfirmation();" action="{{ route('appointments.destroy', ['appointment' => $appointment])}}" method="POST">
         {{ csrf_field() }}
         {{ method_field('DELETE') }}
         <button style="padding:1px 5px;" title="supprimer" type="submit" class="btn btn-sm btn-danger">
          <i class="fa fa-times" aria-hidden="true"></i> Supprimer</button>
        </form>
        {{-- @endif --}}
    </td>

  </tr>
</table>




            </td>
          </tr>
        </table>
        @endforeach


      </div>

    </div>
</div>

  </div>
</div>
</div>


@endforeach


</div>
</div>

{{ $comfiles->links() }}
