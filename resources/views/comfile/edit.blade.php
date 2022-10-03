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
        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading"> <b> Editer la fiche de prospection </b> &nbsp; &nbsp;  |  &nbsp;<small>(*) Obligatoire</small> </div>

                <div class="panel-body">
                   <form class="form-horizontal" role="form" method="POST"  action="{{ route('comfiles.update')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT')}}

                        <input type="hidden" value="{{ Auth::user()->groupid }}" name="groupid">
                        <input type="hidden" value="{{ Auth::user()->login }}" name="user">

                        <div class=" row form-group {{ $errors->has('com_date') ? ' has-error' : '' }}">
                            <label for="com_date" class="col-md-3 control-label">DATE DE PROSPECTION <span class="error">* </span></label>
                            <div class="col-md-8">
                                <input id="com_date" type="date" class="form-control form-control-sm" name="com_date" value="{{ $comfile->com_date}}"  required>

                                @if ($errors->has('com_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('com_date') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class=" row form-group {{ $errors->has('categid') ? ' has-error' : '' }}">
                            <label for="category" class="col-md-3 control-label">TYPE CLIENT<span class="error">*</span></label>
                            <div class="col-md-8">

                                <select onchange="suggestProductReference(this.id)" required="required" name="category" id="category" class="form-control form-control-sm single-select2">
                                    <option value=""></option>
                                    <option @if($comfile->category =="NOUVEAU") selected="selected"@endif value="NOUVEAU">NOUVEAU</option>
                                    <option @if($comfile->category =="ANCIEN") selected="selected"@endif value="ANCIEN">ANCIEN</option>
                                </select>

                                @if ($errors->has('category'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <hr>
                        <div class="bg-primary" style="padding: 10px">
                          <b>  L'ENTREPRISE VISITEE</b>
                      </div> <br>
                      <div class="row form-group {{ $errors->has('enterprise') ? ' has-error' : '' }} row">

                        <label for="enterprise" class="col-md-3 control-label">NOM DE L'ENTREPRISE<span class="error"> *</span></label>
                        <div class="col-md-8">
                            <input id="enterprise" type="text" class="form-control form-control-sm" name="enterprise" value="{{$comfile->enterprise }}" required >
                            @if ($errors->has('enterprise'))
                            <span class="help-block">
                                <strong>{{ $errors->first('enterprise') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class=" row form-group {{ $errors->has('ifu') ? ' has-error' : '' }}">
                        <label for="ifu" class="col-md-3 control-label">IFU DE L'ENTREPRISE </label>
                        <div class="col-md-8">
                            <input onkeypress="return numbersonly(event)" id="ifu" type="text" class="form-control form-control-sm" name="ifu" value="{{$comfile->ifu}}" >

                            @if ($errors->has('ifu'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ifu') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group {{ $errors->has('phones') ? ' has-error' : '' }} row">

                        <label for="phones" class="col-md-3 control-label">TELEPHONES DE L'ENTREPRISE<span class="error"> *</span></label>
                        <div class="col-md-8">
                            <input  id="phones" type="text" class="form-control form-control-sm" name="phones" value="{{ $comfile->phones }}" required >
                            @if ($errors->has('phones'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phones') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group {{ $errors->has('email') ? ' has-error' : '' }} row">
                        <label for="email" class="col-md-3 control-label">EMAIL DE L'ENTREPRISE</label>
                        <div class="col-md-8">
                            <input  id="email" type="email" class="form-control form-control-sm" name="email" value="{{ $comfile->email }}" >
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="row form-group {{ $errors->has('address') ? ' has-error' : '' }} row">

                        <label for="address" class="col-md-3 control-label">ADRESSE DE L'ENTREPRISE<span class="error"> *</span></label>
                        <div class="col-md-8">
                            <textarea name="address" class="form-control form-control-sm" >{{ $comfile->address}}</textarea>
                            @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group {{ $errors->has('activity') ? ' has-error' : '' }} row">

                        <label for="activity" class="col-md-3 control-label">SECTEUR D'ACTIVITE <span class="error"> *</span></label>
                        <div class="col-md-8">
                            <textarea name="activity" class="form-control form-control-sm" > {{$comfile->activity}}</textarea>
                            @if ($errors->has('activity'))
                            <span class="help-block">
                                <strong>{{ $errors->first('activity') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <hr>
                    <div class="bg-primary" style="padding: 10px">
                      <b>  REPRESENTANT RENCONTRE</b>
                  </div><br>

                  <div class="row form-group {{ $errors->has('rpt_fullname') ? ' has-error' : '' }} row">

                    <label for="rpt_fullname" class="col-md-3 control-label">NOM COMPLET DU REPRESENTANT<span class="error"> *</span></label>
                    <div class="col-md-8">
                        <input name="rpt_fullname" class="form-control form-control-sm" value="{{ $comfile->rpt_fullname }}" />
                        @if ($errors->has('rpt_fullname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('rpt_fullname') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="row form-group {{ $errors->has('rpt_phone') ? ' has-error' : '' }} row">

                    <label for="rpt_phone" class="col-md-3 control-label">TELEPHONE DU REPRESENTANT<span class="error"> *</span></label>
                    <div class="col-md-8">
                        <input  id="rpt_phone" type="text" class="form-control form-control-sm" name="rpt_phone" value="{{$comfile->rpt_phone}}" required >
                        @if ($errors->has('rpt_phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('rpt_phone') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <hr>
                <div class="bg-primary" style="padding: 10px">
                  <b>  LA VISITE</b>
              </div><br>

              <div class="row form-group {{ $errors->has('enterprise') ? ' has-error' : '' }} row">
                 <label for="discussion" class="col-md-3 control-label">SUJETS DISCUTES<span class="error"> *</span></label>
                <div class="col-md-8">
                    <textarea required name="discussion" class="form-control form-control-sm">{{ $comfile->discussion}} </textarea>
                    @if ($errors->has('discussion'))
                    <span class="help-block">
                        <strong>{{ $errors->first('discussion') }}</strong>
                    </span>
                    @endif
                </div>
            </div>


            <div class=" row form-group {{ $errors->has('level') ? ' has-error' : '' }}">
                <label for="result" class="col-md-3 control-label">CONCLUSION<span class="error">*</span></label>
                <div class="col-md-8">
                   <textarea required name="result" class="form-control form-control-sm" >{{ $comfile->result}} </textarea>
                   @if ($errors->has('result'))
                   <span class="help-block">
                    <strong>{{ $errors->first('result') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class=" row form-group {{ $errors->has('next') ? ' has-error' : '' }}">
            <label for="next" class="col-md-3 control-label">QUELLE EST LA SUITE ? <span class="error">*</span></label>
            <div class="col-md-8">

               <textarea required name="next" class="form-control form-control-sm" >{{ $comfile->next}} </textarea>
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
               <span class ="glyphicon glyphicon-ok"> </span> <b>ENREGISTRER</b>
           </button>
           <br>
           <br>
           <a href="javascript:history.back()" class="btn btn-danger btn">
             <span class="glyphicon glyphicon-remove"></span>   Annuler
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
