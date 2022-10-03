<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="author" content="">
  <title>{{ config('app.name', 'EasyControl') }}</title>
  <!-- Bootstrap core CSS-->
  <link href="{{url('public/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{url('public/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="{{url('public/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{url('public/css/sb-admin.css')}}" rel="stylesheet">
  <link  rel="shortcut icon" type="image/x-icon" href="{{url('public/images/logotype.ico')}}"/>
  @livewireStyles
</head>

<body class="fixed-nav sticky-footer" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg fixed-top" id="mainNav">

     @yield('appname')

    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">

          @yield('dashbordlink')

        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Aller à la boutique">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#shopMenuCollspace">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Aller à la boutique</span>
          </a>
          <ul class="sidenav-second-level collapse" id="shopMenuCollspace">
            @foreach($shops as $shop)
            <li><a href="{{url('shop-home/'.$shop->id)}}">{{$shop->code}}</a></li>
            @endforeach
          </ul>
        </li>

      <!--  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Allez au magasin">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#storeMenuCollspace" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Aller au magasin</span>
          </a>
          <ul class="sidenav-second-level collapse" id="storeMenuCollspace">

           @foreach($stores as $store)
           <li><a href="{{url('store-home/'.$store->id)}}">{{$store->code}}</a></li>
           @endforeach

         </ul>
       </li> -->

       <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Aller à l'entrepôt">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#warehouseMenuCollspace" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-file"></i>
          <span class="nav-link-text">Aller à l'entrepôt</span>
        </a>
        <ul class="sidenav-second-level collapse" id="warehouseMenuCollspace">
          @foreach($warehouses as $warehouse)
          <li><a href="{{url('warehouse-home/'.$warehouse->id)}}">{{$warehouse->code}}</a></li>
          @endforeach
        </ul>
      </li>

      @if (Auth::user()->hasRole('admin'))
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Admin Menu">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-sitemap"></i>
          <span class="nav-link-text">Admin Menu</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseMulti">
         <li>
          <a href="{{ url('/groups') }}">
            Gérer les entreprises
          </a>
        </li>

        <li>
          <a href="{{ url('/warehouses') }}">
           Gérer les entrepôts
         </a>
       </li>

       <li>
        <a href="{{ url('/stores') }}">
         Gérer les magasins
       </a>
     </li>

     <li>
      <a href="{{ url('/shops') }}">
       Gérer les boutiques
     </a>
   </li>
   <li>
    <a href="{{ url('/reports') }}">
      Consulter les Etats
    </a>
  </li>
  <li>
    <a href="{{ url('/users') }}">
     Gérer les utilisateurs
   </a>
 </li>
</ul>
</li>
@endif
<li class="nav-item" title="">
  <a class="nav-link" href="{{ url('/users/changepassword') }}">
   <i class="fa fa-fw fa-wrench"></i></i>
   <span class="nav-link-text">Changer mot de passe</span>
 </a>
</li>

</ul>
<ul class="navbar-nav sidenav-toggler">
  <li class="nav-item">
    <a class="nav-link text-center" id="sidenavToggler">
      <i class="fa fa-fw fa-angle-left"></i>
    </a>
  </li>
</ul>

<ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-user-circle" aria-hidden="true"></i> {{ Auth::user()->login}}
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" class="nav-link logout" >
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>

            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
          </li>
        </ul>
      </div>
    </nav>
    <div class="content-wrapper">
      <div class="container-fluid">


       @yield('content')


       <footer class="sticky-footer">
        <div class="container">
          <div class="text-center">
            <small>Copyright © {{ Auth::user()->group}} {{Auth::user()->groupphone}} - <?php echo date('Y');?></small>
          </div>
        </div>
      </footer>

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
      </a>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{url('public/jquery/jquery.min.js')}}"></script>
    <script src="{{url('public/popper/popper.min.js')}}"></script>
    <script src="{{url('public/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{url('public/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{url('public/chart.js/Chart.min.js')}}"></script>
    <script src="{{url('public/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{url('public/datatables/dataTables.bootstrap4.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{url('js/sb-admin.min.js')}}"></script>
    <!-- Custom scripts for this page-->
    <script src="{{url('public/js/sb-admin-datatables.min.js')}}"></script>
    <script src="{{url('public/js/sb-admin-charts.min.js')}}"></script>
    <script src="{{url('public/js/custom.js')}}"></script>
  </div>
</ul>
@livewireScripts
</body>

</html>
