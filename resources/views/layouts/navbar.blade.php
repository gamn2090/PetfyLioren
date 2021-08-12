<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>  
    </ul>      

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->                    
        <div class="nav-item">
            <li class="user-footer">
                <div class="pull-right">
                <a style="color: black;" href="#"
                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                <i style="font-size: 30px; margin-top: 8px; padding-left: 10px;" class="fas fa-sign-out-alt"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                </div>
            </li> 
        </div>                                 
        
    </ul>
</nav>