<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" sizes="16x16" href="/image/favicon.png">
  <title>{{$title}} - SAMS</title>

  <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.css')}}"/>
  <link rel="stylesheet" href="{{ asset('bower_components/metisMenu/dist/metisMenu.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('bower_components/animate.css/animate.min.css') }}"/>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>

</head>
<body class="fix-header">

<div class="preloader">
  <svg class="circular" viewBox="25 25 50 50">
    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
  </svg>
</div>

@include('dashboard.blocks.header')
<main id="wrapper">
  @include('dashboard.blocks.sidebar')

  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h1 class="page-title h4">{{$title}}</h1>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <a href="https://wrappixel.com/templates/ampleadmin/" target="_blank"
             class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">
            Beauty button
          </a>
          <ol class="breadcrumb">
            <li><a href="#">Панель управления</a></li>
            <li class="active">{{$title}}</li>
          </ol>
        </div>
      </div>

      <div class="white-box">
        @yield('content')
      </div>

    </div>
    <footer class="footer text-center"> 2020 &copy; SAMS</footer>
  </div>
</main>

<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>