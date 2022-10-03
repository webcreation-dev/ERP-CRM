<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="base_url" content="{{ url('/') }}">
  <title>{{ config('app.name', 'EasyControl') }}</title>
  <!-- Styles   <link href="{{url('public/css/jquery-ui.css')}}" rel="stylesheet" type="text/css" />-->
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('css/app.css')}}" rel="stylesheet">
  <link href="{{asset('css/style.css')}}" rel="stylesheet">

  <!-- Scripts -->
  <script type="text/javascript" src="{{url('public/js/custom.js')}}"></script>
  <script>
    window.Laravel = <?php echo json_encode([
      'csrfToken' => csrf_token(),
      ]); ?>
  </script>
  @livewireStyles
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <!-- Collapsed Hamburger -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
            data-target="#app-navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Branding Image -->
          <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'EasyControl') }}
          </a>

        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav navbar-left">
            </span>
            <li>
              <span class="appTitle">
            </li>
          </ul>
          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            <li><a href="{{ url('/login') }}">
                <!--Se connecter  -->
              </a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->login}} <span class="caret"></span>
              </a>

              <ul class="dropdown-menu" role="menu">

                <li>
                  <a href="{{ url('/export-pdf') }}">Liste Client</a>
                </li>
                <hr style="margin-top: 5px; margin-bottom: 5px;">
                <li>
                  <a href="{{ url('/logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
                    Déconnexion
                  </a>
                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </li>
                
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    @yield('content')
  </div>

  <!-- Scripts <script type="text/javascript" src="{{asset('js/jquery-ui.min.js')}}"></script>-->
  <script src="{{asset('js/app.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/bootstrap-table.js')}}"></script>


  @yield('script')

  <script type="text/javascript">
    $(document).ready(function() {

       $('.alert').fadeOut(10000);
       $("#printbtn").click();
       $("#printbtn2").click();

     });

  function generatePassInfos(id){
    $("#pid").val(id);
    $.ajax({
     type:'GET',
     data: 'id='+ id,
     url:'{{url("/getout")}}',
     success:function(data){
       $("#duration-span").text(data.nh +'h '+ data.nm +'m '+data.ns+'s');
       $("#cost-span").text(data.cost+' FCFA');
       $("#cost").val(data.cost);
       $("#endDate").val(data.endDate);
       $("#duration").val(data.nh +'h '+ data.nm +'m '+data.ns+'s');
       $("#room").val(data.room);     }
     });
  }

  function numbersonly(e){
    var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=27 && unicode!=38 && unicode!=39 && unicode!=40 && unicode!=9){ //if the key isn't the backspace key (which we should allow)
          if (unicode<48||unicode>57)
            return false
        }
      }

      function dismissModal(){
       $('.modal').hide();
       return true;
     }

       function baseUrl() {
      return $('meta[name="base_url"]').attr('content') || '';
    }




  </script>

  @livewireScripts
</body>

</html>