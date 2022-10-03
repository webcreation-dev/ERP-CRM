
@extends('layouts.printer')
@section('content')


<table style="width:100%;">
  <tr style="background-color: #8ba7cc !important;">
    <td style="text-align: left;"><strong>LISTE CLIENT ET CONTACT</strong></td>
  </tr>
</table>

<br>

@forelse($comfiles as $comfile)
  <table>
    <thead>
      <tr>
        <th >CLIENT</th>
        <th>CONTACT</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{$comfile->enterprise}}</td>
        <td>{{$comfile->phones}}</td>
      </tr>
    </tbody>
  </table>
@empty
  <div class="alert alert-danger" style="padding:5px;background-color:#f2dede; border-color:#ebccd1;color:#a94442;">
      Aucun client enregistré 
  </div>
@endforelse

<br><br><br>

<div style="width: 100%;text-align: right; ">
  Générer par <strong>IXIOXI - CRM </strong> le {{date("Y-m-d")}} à {{date("H:i:s")}} 
</div>


@endsection