@extends('layouts.app')
@section('content')


<div class="container">

    <div class="row">
<div class="col-lg-8 col-sm-12 ">
    @if (session('status'))
    <div  class="alert alert-danger alert-sm ">
     <b> <center>{!! session('status') !!} </center></b>
    </div>
    @endif
  </div>
</div>

    <div class="row" >


        <div class="col-lg-3 col-sm-6">

            <div class="card hovercard">
               <a href="{{ route('comfiles.index')}}"> <div class="cardheader card-3">

                </div></a>

                <div class="avatar">
                    <img alt="" src="{{asset('images/test7.jpg')}}">
                </div>
             
                <br>
                <div class="info">
                    <div class="title">
                        <a href="{{ route('comfiles.index')}}"> Forces de Vente </a>
                    </div>
                    <div class="desc">Suivi Prospections</div>
                    <div class="desc">Portefeuille Client </div>
                    <div class="desc">SAV & Rapports</div>
                </div>

            </div>
        </div>



    </div>



</div>

@endsection


