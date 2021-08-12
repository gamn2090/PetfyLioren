<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/favicon-32x32.png')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>.::PetfyLioren::.</title>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!--CSS NECESARIOS PARA EL DATATABLE-->
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}" defer> 
    <link rel="stylesheet" href="{{asset('css/dataTables.style.css')}}" defer> 
    <link rel="stylesheet" href="{{ asset('css/alertify.min.css') }}"/>

    <style>
        .little-icon{
            width: 50%;
        }
        .submenu{
            padding-left: 15px;
            font-size: 12px;
        }
    </style>
    @yield('css')
    
</head>
<body class="hold-transition sidebar-mini">
    <div style="min-height: 100vh" id="app">
        <!-- Site wrapper -->
        <div class="wrapper">
            @guest
            @else
                <!-- Navbar -->
                @include('layouts.navbar')
                <!-- /.navbar -->
                <!-- Main Sidebar Container -->
                @include('layouts.sidebar')
            @endguest              
                
            @guest
                @yield('content')
            @else
            <div style="min-height: 100vh" class="content-wrapper">
                @yield('content')
            </div>
            @endguest
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
    </div>
    <!-- jQuery -->
    
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>    
    <!-- SCRIPTS PARA EL DATATABLE -->

    <script src="{{asset('js/jquery.dataTables.min.js')}}" defer></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/alertify.min.js') }}"></script>
    <script>
        function enviarNotas() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var request = $.ajax({
                url: "SendNdc",
                type: "POST",
                dataType: "json"
            });

            request.done(function (data) {
                alertify.alert('Alerta',data);
            });
        }

        function checkNdc() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var request = $.ajax({
                url: "checkNdc",
                type: "POST",
                dataType: "json"
            });

            request.done(function (data) {
                if(data > 0)
                    alertify.confirm('Confirmar Acción', "Tiene "+data+" notas de crédito por enviar, seguro que desea enviarlas todas ahora?",
                        function () { enviarNotas() },
                        function () { alertify.error('Envío cancelado') 
                    });
                else
                    alertify.alert("Aviso","Actualmente no tiene notas de crédito pendientes por enviar");
            });
        }
        
        function enviarFacturas() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var request = $.ajax({
                url: "SendInvoices",
                type: "POST",
                dataType: "json"
            });

            request.done(function (data) {
                alertify.alert('Alerta',data);
            });
        }

        function checkInvoices() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var request = $.ajax({
                url: "checkInvoices",
                type: "POST",
                dataType: "json"
            });

            request.done(function (data) {
                if(data > 0)
                    alertify.confirm('Confirmar Acción', "Tiene "+data+" facturas por enviar, seguro que desea enviarlas todas ahora?",
                        function () { enviarFacturas() },
                        function () { alertify.error('Envío cancelado') 
                    });
                else
                    alertify.alert("Aviso","Actualmente no tiene facturas pendientes por enviar");
            });
        }
    </script>
    @yield('scripts')
</body>
       
</html>
