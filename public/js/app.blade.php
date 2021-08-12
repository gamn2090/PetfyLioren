<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ChevereFact') }}</title>    
    <link rel="icon" href="{{asset('img/1.ico')}}" >
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!--librerias del template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/myStyles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/weather-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/lib/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/lib/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/lib/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/menubar/sidebar.css') }}" rel="stylesheet">

    <link href="{{ asset('css/lib/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">  
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">  
    <!-- Alertify -->
    <link rel="stylesheet" href="{{ asset('css/vendor/alertify.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/vendor/default.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/vendor/semantic.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/vendor/boostrapDatepicker.css') }}"/> 
    <!--CSS NECESARIOS PARA EL DATATABLE-->
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}" defer> 
    <link rel="stylesheet" href="{{asset('css/dataTables.style.css')}}" defer> 
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap');
        *{
            font-family: 'PT Sans', sans-serif;
        }
        .little-icon{
            width: 50%;
        } 

        .modal-dialog{
            overflow-y: initial !important
        }
        .modal-body{
            max-height: 50vh;
            overflow-y: auto;
        }        
            
    </style>
    @yield('css')

</head>
<body>
        <main class="py-4">
            
            @yield('content')
            <div class="loading" style="display: none; z-index:1100">
                <img src="{{asset('img/gif/Logo.gif')}}" alt="">
            </div>
            
        </main>
    </div>
   
    <!-- Scripts -->
    
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script type="text/javascript">

	$(document).ready(function(){
		$(document).ajaxStart(function() {
			  $(".loading").css("display", "block");
			  $('.btn').attr('disabled', 'disabled');

		}).ajaxStop(function() {
			  $(".loading").css("display", "none");
			  $('.btn').removeAttr('disabled', 'disabled');
		});
    });
    
    </script>
    
    <script src="{{ asset('js/lib/jquery.nanoscroller.min.js') }}"></script>
    <!-- nano scroller -->
    <script src="{{ asset('js/lib/menubar/sidebar.js') }}"></script>
    <script src="{{ asset('js/lib/preloader/pace.min.js') }}"></script>
    <!-- sidebar -->
    <script src="{{ asset('js/lib/bootstrap.min.js') }}"></script>

    <!-- bootstrap -->

    <script src="{{ asset('js/lib/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('js/lib/circle-progress/circle-progress-init.js') }}"></script>
   
    <script src="{{ asset('js/vendor/alertify.min.js') }}"></script>
    <script src="{{ asset('js/vendor/datepicker.js') }}"></script>

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/select2.js') }}"></script>

    <script src="{{ asset('js/JsInvoice.js') }}"></script> 
    <script src="{{ asset('js/JsClient.js') }}"></script> 
    <script src="{{ asset('js/JsNdc.js') }}"></script> 
    <script src="{{ asset('js/JsMisc.js') }}"></script> 

    <!-- SCRIPTS PARA EL DATATABLE -->

    <script src="{{asset('js/jquery.dataTables.min.js')}}" defer></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>

    <script>
    alertify.defaults = {
        // dialogs defaults
        autoReset:true,
        basic:false,
        closable:true,
        closableByDimmer:true,
        frameless:false,
        maintainFocus:true, // <== global default not per instance, applies to all dialogs
        maximizable:true,
        modal:true,
        movable:true,
        moveBounded:false,
        overflow:true,
        padding: true,
        pinnable:true,
        pinned:true,
        preventBodyShift:false, // <== global default not per instance, applies to all dialogs
        resizable:true,
        startMaximized:false,
        transition:'pulse',

        // notifier defaults
        notifier:{
            // auto-dismiss wait time (in seconds)  
            delay:5,
            // default position
            position:'bottom-right',
            // adds a close button to notifier messages
            closeButton: false
        },

        // language resources 
        glossary:{
            // dialogs default title
            title:'¡Alerta!',
            // ok button text
            ok: 'OK',
            // cancel button text
            cancel: 'Cancelar'            
        },

        // theme settings
        theme:{
            // class name attached to prompt dialog input textbox.
            input:'ajs-input',
            // class name attached to ok button
            ok:'ajs-ok',
            // class name attached to cancel button 
            cancel:'ajs-cancel'
        }
    };      
    
    </script>

<script>
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    /*facturas*/
    $( "#fechaIni" ).datepicker({
        beforeShow: function(input, inst) {
            $(document).off('focusin.bs.modal');
        },
        onClose:function(){
            $(document).on('focusin.bs.modal');
        },
        format: 'yyyy-mm-dd'
    });
    $( "#fechaFin" ).datepicker({
        beforeShow: function(input, inst) {
            $(document).off('focusin.bs.modal');
        },
        onClose:function(){
            $(document).on('focusin.bs.modal');
        },
        format: 'yyyy-mm-dd'
    });
    
</script>

    @yield('scripts')
</body>
</html>
