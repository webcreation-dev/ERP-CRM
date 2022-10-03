@extends('layouts.printer')
@section('content')


<table style="width:100%;">
  <tr style="background-color: #8ba7cc !important;">
    <td style="text-align: left;"><strong>FICHES DE PROSPECTION :</strong></td>
    <td style="text-align: right;"><strong>{{$comfile->category}}</strong></td>
  </tr>
  
</table>

<br>

<table style="width:100%; ">
  <tr>
    <td style="text-align: center;"><strong>DATE DE PROSPECTION</strong></td>
    <td style="text-align: center;">{{convertToFrenchDate($comfile->com_date)}}</td>
  </tr>
  <tr>
    <td style="text-align: center;"><strong>NOM DE L'ENTREPRISE</strong></td>
    <td style="text-align: center;">{{$comfile->enterprise}}</td>
  </tr>

  <tr>
    <td style="text-align: center;"><b>N° IFU </b></td>
    <td style="text-align: center;">{{$comfile->ifu}}</td>
  </tr>

  <tr>
    <td style="text-align: center;"><b>TELEPHONES </b></td>
    <td style="text-align: center;">{{$comfile->phones}}</td>
  </tr>

  <tr>
    <td style="text-align: center;"><b>EMAIL </b></td>
    <td style="text-align: center;">{{$comfile->email}}</td>
  </tr>

  <tr>
    <td style="text-align: center;"><b>ADRESSE</b></td>
    <td style="text-align: center;">{{$comfile->address}}</td>
  </tr>
  <tr>
    <td style="text-align: center;"><b>SECTEUR D'ACTIVITE</b></td>
    <td style="text-align: center">{{$comfile->activity}}</td>
  </tr>

  <tr>
    <td style="text-align: center;"><b>REPRESENTANT</b></td>
    <td style="text-align: center;">{{$comfile->rpt_fullname}}</td>
  </tr>

  <tr>
    <td style="text-align: center;"><b>TEL. REPRESENTANT</b></td>
    <td style="text-align: center">{{$comfile->rpt_phone}}</td>
  </tr>

  <tr>
    <td style="text-align: center;"><b>SUJETS DISCUTES</b></td>
    <td style="text-align: center;">{{$comfile->discussion}}</td>
  </tr>

  <tr>
    <td style="text-align: center;"><b>CONCLUSION</b></td>
    <td style="text-align: center;">{{$comfile->result}}</td>
  </tr>


  <tr>
    <td style="text-align: center;"><b>LA SUITE </b></td>
    <td style="text-align: center;">{{$comfile->next}}</td>
  </tr>

</table>

<br><br><br><br>


<table style="width:100%;">
  <tr style="background-color: #8ba7cc  !important;">
    <td style="text-align: left;"><strong>SUIVIS EFFECTUES</strong></td>
  </tr>
</table>

<br>


@forelse($comfile->appointments()->get() as $appointment)
<table>
  <thead>
    <tr>
      <th >DATE</th>
      <th>SUIVI</th>
      <th>CONTACT</th>
      <th>OBJET</th>
      <th >CONCLUSION</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>{{convertToFrenchDate($appointment->app_date)}}</td>
      <td >{{$appointment->type}}</td>
      <td >{{$appointment->contact}}</td>
      <td >{{$appointment->result}}</td>
      <td >{{$appointment->next}}</td>
    </tr>
  </tbody>
</table>
@empty
  <div class="alert alert-danger" style="padding:5px;background-color:#f2dede; border-color:#ebccd1;color:#a94442;">
      Aucun suivi effectuée par rapport à ce client
  </div>
@endforelse

<br><br><br>

<div style="width: 100%;text-align: right; ">
  Générer par <strong>IXIOXI - CRM </strong> le {{date("Y-m-d")}} à {{date("H:i:s")}} 
</div>

@endsection

