@extends('layouts.warehouse-base')

@section('appname')
@include('layouts.warehouse-appname')
@endsection

@section('dashbordlink')
@include('layouts.warehouse-dashbordlink')
@endsection

@section('content')

<div class="container">
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif


  <div class="row">
    <div class="col-md-6 col-md-offset-2">
      <div class="panel panel-info">
        <div class="panel-heading"> <b> Détail du Produit  </b></div>
        <hr>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST"  action="{{ route('wproducts.update', $wproduct)}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT')}}

            <input type="hidden" value="{{ Auth::user()->groupid }}" name="groupid">
            <input type="hidden" value="{{ session('wid')}}" name="wid">
            <input type="hidden" value="{{ Auth::user()->login }}" name="user">
            <input type="hidden" value="0" name="stock">

            <div class=" row form-group {{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="col-md-4 control-label">DESIGNATION  </label>
              <div class="col-md-8">
               {{ $wproduct->name }}
             </div>
           </div>

           <div class=" row form-group {{ $errors->has('code') ? ' has-error' : '' }}">
            <label for="code" class="col-md-4 control-label">REFERENCE  </label>
            <div class="col-md-8">
              {{ $wproduct->code }}
            </div>
          </div>

          <div class=" row form-group {{ $errors->has('barcode') ? ' has-error' : '' }}">
            <label for="barcode" class="col-md-4 control-label">CODE-BARRE <span class="error"> </span></label>
            <div class="col-md-8">
              {{  $wproduct->barcode }} &nbsp;  &nbsp; &nbsp;

              @if($wproduct->barcode) <?php echo DNS1D::getBarcodeHTML($wproduct->barcode, "C128",1,33,"black", true);?>@endif
            </div>
          </div>

          <div class=" row form-group {{ $errors->has('entryPrice') ? ' has-error' : '' }}">
            <label for="entryPrice" class="col-md-4 control-label">P. U. GROSSISTE</label>
            <div class="col-md-8">
              {{ format_money($wproduct->entryPrice ) }}
            </div>
          </div>

          <div class="row form-group {{ $errors->has('outPrice') ? ' has-error' : '' }} row">
            <label for="outPrice" class="col-md-4 control-label">P.U. DETAILLANT<span class="error"></span></label>
            <div class="col-md-8">
              {{ format_money($wproduct->outPrice ) }}
            </div>
          </div>

          <div class=" row form-group {{ $errors->has('level') ? ' has-error' : '' }}">
            <label for="level" class="col-md-4 control-label"> SEUIL D'ALERTE</label>
            <div class="col-md-8">
              {{ $wproduct->level }}
            </div>
          </div>


          <div class=" row form-group {{ $errors->has('unit') ? ' has-error' : '' }}">
            <label for="unit" class="col-md-4 control-label">UGS</label>
            <div class="col-md-8">
             {{ $wproduct->unit }}
           </div>
         </div>


         <div class=" row form-group {{ $errors->has('type') ? ' has-error' : '' }}">
          <label for="type" class="col-md-4 control-label">TYPE</label>
          <div class="col-md-8">
            @if($wproduct->type == 'PRODUIT') PRODUIT @endif
            @if($wproduct->type == 'SERVICE') SERVICE @endif
          </div>
        </div>


        <div class=" row form-group {{ $errors->has('categid') ? ' has-error' : '' }}">
          <label for="unit" class="col-md-4 control-label">CATEGORIE</label>
          <div class="col-md-8">
           <?php $caterogy =  $wproduct->category()->get() ?>   {{$caterogy[0]->name}}

         </div>
       </div>

       <input id="supplier" type="hidden" class="form-control" name="supplier" value="{{ $wproduct->supplier }}" >

                      <!--  <div class="row form-group {{ $errors->has('supplier') ? ' has-error' : '' }}">
                            <label for="supplier" class="col-md-4 control-label">FOURNISSEUR<span class="error"></span></label>
                            <div class="col-md-8">
                                <input id="supplier" type="text" class="form-control" name="supplier" value="{{ $wproduct->supplier }}" >
                                @if ($errors->has('supplier'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('supplier') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                      -->
                      <hr>
                      <div class="form-store">
                       <a href="javascript:history.back()" class="btn btn-danger btn-sm">
                         <span class="glyphicon glyphicon-remove"></span>   Retour à la liste
                       </a>

                       <a title="Modifier" class="btn-sm btn btn-info" href="{{ route('wproducts.edit',$wproduct)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modifier</a>
                     </div>
                   </form>
                 </div>
               </div>
             </div>

             <div col-md-4>
              <br><br>
              @if( $wproduct->picture )
              IMAGE DU PRODUIT <br>
              <div style="padding: 5px; background: #f1f1f1;">
                <img width="250" src="{{url('public/images/'.$wproduct->picture) }}" alt="image"></div>
                @endif
              </div>
            </div>

          </div>
          @endsection














