@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
  <div class="col-md-12">
 @if(session('status'))
  <div class="alert alert-info">
    {{ session('status') }}
  </div>
  @endif


  @if(session('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
  </div>
  @endif
</div>
</div>
<br><br>
    <div class="row">
        <div class="col-md-2 col-md-offset-3">
           <a href="{{ url('home') }}"> <div class="mod-option" >
STOCK & FACTURATION </div></a>
        </div>

    <a href="{{ url('cash/mainoperations/CAISSE-PRINCIPALE') }}"><div class="col-md-2">
            <div class="mod-option" >
OPERATIONS DE CAISSE</div></a>
        </div>

    </div>
</div>
@endsection
