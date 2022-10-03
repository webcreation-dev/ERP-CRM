<div class="container">
  <div class="row">
    @if (session('status'))
    <div class="alert alert-danger alert-sm col-md-8 col-md-offset-2">
      <center>{!! session('status') !!} </center>
    </div>
    @endif
  </div>

  <div class="row">
    <div class="col-md-12" style="padding:10px 15px">
      <span class="listTitle">Fiches de Prospections</span>
      <a href="{{ route('comfiles.create')}}" class="btn btn-success pull-right"><span class=""></span>Nouvelle Fiche
      </a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 " style="padding:10px 15px;">
      <input wire:model.debounce.250ms="search" type="text" class="form-control w-auto"
        placeholder="Rechercher par le nom de l'entreprise...">
    </div>


    @if (hasAdmin(Auth::user()->id))
    <div class="col-md-3" style="padding:10px 15px;">
      <select id="filtreUser" wire:model="filtreUser" class="form-control">
        <option disabled selected value="">Filtrer par commercial</option>
        @foreach ($users as $user)
        <option value="{{$user->name}}">{{ $user->name }}</option>
        @endforeach
        <option value="all">Tous</option>
      </select>
    </div>
    @endif

    <div class="col-md-3" style="padding:10px 15px;">
      <select id="filtreType" wire:model="filtreType" class="form-control">
        <option disabled selected value="">Filtrer par type</option>
        <option value="prospect">Prospect</option>
        <option value="client">Client</option>
        <option value="all">Tous</option>
      </select>
    </div>

  </div>

  <div class="">
    <section class="list-section">
      @include("livewire.load")
    </section>
  </div>

</div>


</div>
<!--End col -->
</div><!-- end row-->

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