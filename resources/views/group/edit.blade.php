
@extends('layouts.app')
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
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">Modifier une Structure  </div>
                <center class="error">(*) Obligatoire</center>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"  action="{{ route('groups.update', $group)}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                         {{ method_field('PUT')}}
                         <input id="id" type="hidden" class="form-control" name="id" value="{{ $group->id }}">

                        <div class="form-group form-group-sm {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-3 control-label">Name <span class="error">* </span></label>
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $group->name }}">

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group form-group-sm {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-3 control-label">E-mail <span class="error">* </span></label>
                            <div class="col-md-8">
                                <input id="email" type="text" class="form-control" name="email" value="{{ $group->email }}">

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                     <div class="form-group form-group-sm {{ $errors->has('identification') ? ' has-error' : '' }}">
                            <label for="identification" class="col-md-3 control-label">RCCM/IFU <span class="error">* </span></label>
                            <div class="col-md-8">
                                <input id="identification" type="text" class="form-control" name="identification" value="{{$group->identification }}">

                                @if ($errors->has('identification'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('identification') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group form-group-sm {{ $errors->has('phones') ? ' has-error' : '' }}">
                            <label for="phones" class="col-md-3 control-label">Téléphones <span class="error">* </span></label>
                            <div class="col-md-8">
                                <input id="phones" type="text" class="form-control" name="phones" value="{{ $group->phones }}">

                                @if ($errors->has('phones'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phones') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group form-group-sm {{ $errors->has('whatsapp') ? ' has-error' : '' }}">
                            <label for="whatsapp" class="col-md-3 control-label">N° Whatsapp <span class="error"> </span></label>
                            <div class="col-md-8">
                                <input id="whatsapp" type="text" class="form-control" name="whatsapp" value="{{ $group->whatsapp }}">

                                @if ($errors->has('whatsapp'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('whatsapp') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group form-group-sm {{ $errors->has('momoNumber') ? ' has-error' : '' }}">
                            <label for="momoNumber" class="col-md-3 control-label">N° MTN Money <span class="error"> </span></label>
                            <div class="col-md-8">
                                <input id="momoNumber" type="text" class="form-control" name="momoNumber" value="{{ $group->momoNumber }}">

                                @if ($errors->has('momoNumber'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('momoNumber') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>




                         <div class="form-group form-group-sm {{ $errors->has('floozNumber') ? ' has-error' : '' }}">
                            <label for="phones" class="col-md-3 control-label">N° Moov Money <span class="error"> </span></label>
                            <div class="col-md-8">
                                <input id="floozNumber" type="text" class="form-control" name="floozNumber" value="{{ $group->floozNumber }}">

                                @if ($errors->has('floozNumber'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('floozNumber') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                         <div class="form-group form-group-sm {{ $errors->has('bankAccount') ? ' has-error' : '' }}">
                            <label for="bankAccount" class="col-md-3 control-label">Compte bancaire <span class="error"> </span></label>
                            <div class="col-md-8">
                                <input id="bankAccount" type="text" class="form-control" name="bankAccount" value="{{ $group->bankAccount }}">

                                @if ($errors->has('bankAccount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bankAccount') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>




                        <div class="form-group form-group-sm {{ $errors->has('localisation') ? ' has-error' : '' }}">
                            <label for="localisation" class="col-md-3 control-label">Situation Géo. <span class="error"></span></label>
                            <div class="col-md-8">
                                <input id="localisation" type="text" class="form-control" name="localisation" value="{{ $group->localisation }}">

                                @if ($errors->has('localisation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('localisation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group form-group-sm {{ $errors->has('service') ? ' has-error' : '' }}">
                            <label for="service" class="col-md-3 control-label">Services  <span class="error"></span></label>
                            <div class="col-md-8">
                               <textarea name="service" class="form-control">{{ $group->service}}</textarea>
                                @if ($errors->has('service'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('service')}}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class=" row form-group {{ $errors->has('picture') ? ' has-error' : '' }}">
                            <label for="picture" class="col-md-4 control-label">LOGO<span class="error"></span></label>
                            <div class="col-md-8">
                                <input id="picture" type="file" class="form-control form-control-sm" name="picture" value="" >
                                @if ($errors->has('picture'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('picture') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group form-group-sm {{ $errors->has('manager') ? ' has-error' : '' }}">
                            <label for="localisation" class="col-md-3 control-label">Manager <span class="error">* </span></label>
                            <div class="col-md-8">
                                <input id="manager" type="text" class="form-control" name="manager" value="{{ $group->manager }}">

                                @if ($errors->has('manager'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('manager') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group form-group-sm {{ $errors->has('createDate') ? ' has-error' : '' }}">
                            <label for="createDate" class="col-md-3 control-label">Date de Création <span class="error"></span></label>
                            <div class="col-md-8">
                                <input id="createDate" type="text" class="form-control datepicker" name="createDate" value="{{ $group->createDate }}">

                                @if ($errors->has('createDate'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('createDate') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                    <div class="form-group form-group-sm">
                        <div class="col-md-8 col-md-offset-3">
                            <button type="submit" class="btn btn-primary btn-sm">
                             <span class ="glyphicon glyphicon-ok"> </span> Enregistrer
                         </button>

                         <a href="javascript:history.back()" class="btn btn-danger btn-sm">
                           <span class="glyphicon glyphicon-remove"></span>   Annuler
                       </a>
                   </div>
               </div>
           </form>
       </div>

       <div class="panel-footer"></div>
   </div>
</div>
</div>
</div>
@endsection














