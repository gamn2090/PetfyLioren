<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="https://cdn.shopify.com/s/files/1/2656/3744/files/petfy-mobile_320x320_a20c9f71-cd8a-46d0-8773-dc6e06ec2ed9_156x.png?v=1593824086"
            alt="Petfy logo"           
            style="opacity: .8; width:50%">
        <span class="brand-text font-weight-light">Petfy</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('img/avatar5.png') }}" class="img-circle elevation-2" alt="foto perfil">
        </div>        
        <div class="info">
            <a href="#!" class="d-block">{{ucwords(strtolower(Auth::user()->name))}}</a>
        </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->            

            {{-- <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-exclamation-triangle"></i>
                    <p>
                    Errores
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        {{-- <a href="{{route('visualizarErroresNG')}}" class="nav-link">
                        <i class="fa fa-exclamation-triangle nav-icon"></i>
                        <p>Errores de NatGas</p>
                    </a>
                    </li>
                    <li class="nav-item">
                        {{-- <a href="{{route('visualizarErroresDC')}}" class="nav-link"> 
                        <i class="fa fa-exclamation-triangle nav-icon"></i>
                        <p>Errores de Dir. Cardex</p>
                    </a>
                    <li class="nav-item">
                        {{-- <a href="{{route('visualizarErroresPCD')}}" class="nav-link"> 
                        <i class="fa fa-exclamation-triangle nav-icon"></i>
                        <p>Productos con dosis</p>
                    </a>
                    </li>
                </ul>
            </li>         --}}  

            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-upload"></i>
                    <p>
                    Cargar Documentos
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item submenu">
                        <a href="{{route('UpdaloadExcel')}}" class="nav-link">
                        <i class="nav-icon fa fa-list"></i>
                        <p>Facturas</p>
                    </a>
                    </li>
                    <li class="nav-item submenu">
                        <a href="{{route('UpdaloadNdcExcel')}}" class="nav-link"> 
                        <i class="nav-icon fa fa-list"></i>
                        <p>Notas de crédito</p>
                    </a>
                    <li class="nav-item submenu">
                        <a href="#!" class="nav-link"> 
                        <i class="nav-icon fa fa-list"></i>
                        <p>Boletas</p>
                    </a>
                    </li>
                </ul> 
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-paper-plane"></i>
                    <p>
                    Enviar Documentos
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li onclick="checkInvoices()" class="nav-item submenu">
                        <a href="#!" class="nav-link">
                            <i class="nav-icon fa fa-list"></i>
                            <p>Facturas</p>
                        </a>
                    </li>
                    <li class="nav-item submenu">
                        <a onclick="checkNdc()" href="#!" class="nav-link"> 
                        <i class="nav-icon fa fa-list"></i>
                        <p>Notas de crédito</p>
                    </a>
                    <li class="nav-item submenu">
                        <a href="#!" class="nav-link"> 
                        <i class="nav-icon fa fa-list"></i>
                        <p>Boletas</p>
                    </a>
                    </li>
                </ul> 
            </li>

            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-paper-plane"></i>
                    <p>
                    Visualizar Documentos
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item submenu">
                        <a href="{{route('ListaFacturas')}}" class="nav-link">
                        <i class="nav-icon fa fa-list"></i>
                        <p>Facturas</p>
                    </a>
                    </li>
                    <li class="nav-item submenu">
                        <a href="#!" class="nav-link"> 
                        <i class="nav-icon fa fa-list"></i>
                        <p>Notas de crédito</p>
                    </a>
                    <li class="nav-item submenu">
                        <a href="#!" class="nav-link"> 
                        <i class="nav-icon fa fa-list"></i>
                        <p>Boletas</p>
                    </a>
                    </li>
                </ul> 
            </li>

            <li class="nav-item">
                <a href="{{route('FacturasCargadas')}}" class="nav-link">
                    <i class="nav-icon fa fa-list"></i>
                    <p>
                        Revisar Carga
                    </p>
                </a>
            </li>
           
                        
            
        </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>