@extends('layouts.app')

@section('appname')
@include('layouts.warehouse-appname')
@endsection

@section('content')

<div class="container">
  <div class="row">
    @if (session('status'))
    <div  class="alert alert-danger alert-sm col-md-8 col-md-offset-2">
      <center>{!! session('status') !!} </center>
    </div>
    @endif
  </div>

  <div class="row">
    <div class="col-md-6" style="padding:10px 15px">
      <span class="listTitle" >Fiches de Prospections</span>  <a href="{{ route('home2')}}" class="btn btn-success pull-right"><span class=""></span>Nouvelle Fiche </a>
    </div>

    <div class="col-md-6 " style="padding:10px 15px">
     <input id="search-input" type="text" class="form-control w-auto" placeholder="Rechercher par le nom de l'entreprise...">
    </div>

</div>

        <div class="">
          <section class="list-section">
           @include('comfile.load')
         </section>
       </div>

   </div>


 </div><!--End col -->
</div><!-- end row-->

@endsection

@section('script')

<script type="text/javascript">
  $(function() {

    var pageLoadValue = $('#page-load-value').val();

    if(typeof(pageLoadValue)  !== "undefined") $('#createModal').modal('show');

    var pendingCall = { timeStamp: null, procID: null };

    $('body').on('click', '.pagination a', function(e) {
      e.preventDefault();
      var timeStamp = Date.now();
      $('#list a').css('color', '#dfecf6');
      $('#accordion').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000; width:30px" src="{{url("public/images/loading.gif")}}" />');

      var url = $(this).attr('href');
      getItems(url,timeStamp);
      window.history.pushState("", "", url);

      if (pendingCall.procID) {
        clearTimeout(pendingCall.procID)
      };
     //set the time before call 3000 = 3 seconds
     pendingCall = { timeStamp: timeStamp, procID: setTimeout(getItems(url), 1000) };
   });


//////***********************  Recherche *****************////////////////
$('body').on('keyup', '#search-input', function(e) {
  e.preventDefault();
  var timeStamp = Date.now();
  $('#list a').css('color', '#dfecf6');
  $('#list').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000; width:30px" src="{{asset("images/loading.gif")}}" />');

  var q = $('#search-input').val();
  var url = baseUrl()+'/s_salesforces'+ '?q=' + q;

  getItems(url,timeStamp);

  window.history.pushState("", "", url);

  if (pendingCall.procID) {
    clearTimeout(pendingCall.procID)
  };
     //set the time before call 3000 = 3 seconds
     pendingCall = { timeStamp: timeStamp, procID: setTimeout(getItems(url), 100) };

   });

/*********************** Les functions appélées ******************/
function getItems(url,timeStamp) {
  $.ajax({
    url : url
  }).done(function (data) {
    if (pendingCall.timeStamp != timeStamp) { return false; }
    $('.list-section').html(data);
    pendingCall.procID = null;
  }).fail(function () {
    console.log('Echec d\'envoi de requête ajax !');
  });
}
});

</script>

@endsection