<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Laravel') }}</title>

<meta charset="utf-8" />
<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
<link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />


<!-- CSS Files -->
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/light-bootstrap-dashboard.css?v=2.0.1') }}" rel="stylesheet" />
<!-- CSS Just for demo purpose, don't include it in your project -->
<link href="{{ asset('assets/css/demo.css" rel="stylesheet') }}" />


<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
<script src="https://unpkg.com/vue@2.1.6/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>


{{--<script src="https://unpkg.com/vue@latest"></script>--}}
{{--<!-- use the latest release -->--}}
{{--<script src="https://unpkg.com/vue-select@latest"></script>--}}


