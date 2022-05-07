<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/hotel_hebat_logo.ico') }}" />

  <title> {{ $title }} </title>

  {{-- my style css --}}
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
    }
  </style>

</head>

<body>

  @include('partials.navbar')

  <div class="container mt-4">
    @yield('container')
  </div>


  <script src="{{ asset('assett/js/bootstrap.min.js') }}"></script>
</body>

</html>