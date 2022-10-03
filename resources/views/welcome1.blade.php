<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="base_url" content="{{ url('/') }}">
        <title>{{ config('app.name', 'EasyControl') }}</title>
        <style>
           p {
            margin:0 auto;
            width:300px
            }
            button {
            padding:10px
            }
           
        </style>
         <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    </head>
    <body class="antialiased">

       <!--  @if (session('notCreateNow'))
            <div class="alert alert-danger" role="alert">
                {!! session('notCreateNow') !!}
            </div>
        @endif -->

        @auth
        
        <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-2" style="padding:10px 15px">
                  <a href="{{ url('/home') }}" class="btn btn-info  "><span class=""></span>Accueil
                  </a>
            </div>
            <div class="col-md-5"></div>
        </div>
        @else
        <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-2" style="padding:10px 15px">
                  <a href="{{ route('sso.login') }}" class="btn btn-info "><span class=""></span>Connectez avec IXIOXI
                  </a>
            </div>
            <div class="col-md-5"></div>
        </div>
        @endauth



        <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
        <script>
             $(document).ready(function() {
                $('.alert').fadeOut(10000);
            });
        </script>

    </body>
</html>
