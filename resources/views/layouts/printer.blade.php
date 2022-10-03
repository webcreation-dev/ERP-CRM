<!DOCTYPE html>
<!-- saved from url=(0058)https://colorlib.com/etc/tb/Table_Responsive_v1/index.html -->
<html lang="en">

<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="base_url" content="{{ url('/') }}">
  <title>{{ config('app.name', 'EasyControl') }}</title>

  <style>
	table {
  border: 1px solid #F0F2F5;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}

table tr {
  background-color: rgb(236, 228, 228);
  border: 1px solid black;
  padding: .35em;
}

table td {
  padding: .625em;
  text-align: center;
}

table th {
  padding: .625em;
}

  </style>

</head>

<body cz-shortcut-listen="true">


    @yield('content')

	
</body>

</html>