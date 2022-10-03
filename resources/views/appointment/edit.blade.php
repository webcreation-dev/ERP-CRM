@extends('layouts.app')

@section('appname')
@include('layouts.warehouse-appname')
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
        @if (session('status'))
        <div class="alert alert-success alert-sm col-md-8 ">
            <center>{!! session('status') !!} </center>
        </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading"> <b> Modification suivi </b> &nbsp; &nbsp; | &nbsp;<small>(*)
                        Obligatoire</small> </div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"
                        action="{{ route('appointments.update', ['appointment' => $appointment])}}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT')}}

                        <div class=" row form-group {{ $errors->has('app_date') ? ' has-error' : '' }}">
                            <label for="app_date" class="col-md-3 control-label">DATE DE SUIVI <span class="error">*
                                </span></label>
                            <div class="col-md-8">
                                <input id="app_date" type="date" class="form-control form-control-sm" name="app_date"
                                    value="{{ $appointment->app_date}}" required>

                                @if ($errors->has('app_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('app_date') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class=" row form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-3 control-label">TYPE DE SUIVI <span
                                    class="error">*</span></label>
                            <div class="col-md-8">

                                <select onchange="suggestProductReference(this.id)" required="required" name="type"
                                    id="type" class="form-control form-control-sm single-select2">
                                    <option value=""></option>
                                    <option @if($appointment->type =="PRESENTIEL") selected="selected"@endif
                                        value="PRESENTIEL">PRESENTIEL</option>
                                    <option @if($appointment->type =="TELEPHONIQUE") selected="selected"@endif
                                        value="TELEPHONIQUE">TELEPHONIQUE</option>
                                    <option @if($appointment->type =="MAIL") selected="selected"@endif value="MAIL">MAIL
                                    </option>
                                </select>

                                @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group {{ $errors->has('contact') ? ' has-error' : '' }} row">

                            <label for="contact" class="col-md-3 control-label">CONTACT<span class="error">
                                    *</span></label>
                            <div class="col-md-8">
                                <input name="contact" class="form-control form-control-sm"
                                    value="{{$appointment->contact}}" />
                                @if ($errors->has('contact'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contact') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class=" row form-group {{ $errors->has('result') ? ' has-error' : '' }}">
                            <label for="result" class="col-md-3 control-label">OBJET <span
                                    class="error">*</span></label>
                            <div class="col-md-8">
                                <textarea required name="result"
                                    class="form-control form-control-sm">{{$appointment->result}}</textarea>
                                @if ($errors->has('result'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('result') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class=" row form-group {{ $errors->has('next') ? ' has-error' : '' }}">
                            <label for="next" class="col-md-3 control-label">CONCLUSION <span
                                    class="error">*</span></label>
                            <div class="col-md-8">

                                <textarea required name="next"
                                    class="form-control form-control-sm">{{$appointment->next}}</textarea>

                                @if ($errors->has('next'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('next') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>



                        <div class=" row form-store">
                            <div class="col-md-11 text-right">
                                <button type="submit" class="btn btn-primary btn" style="padding :10px;">
                                    <span class="glyphicon glyphicon-ok"> </span> <b>ENREGISTRER</b>
                                </button>
                                <br>
                                <br>
                                <a href="{{ route('comfiles.index')}}"
                                    class="btn btn-danger btn">
                                    <span class="glyphicon glyphicon-remove"></span> Retour
                                </a>

                            </div>
                        </div>
                    </form>
                </div>
                <br>
                <div class="panel-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection