<?php
    if (!empty($_SESSION['lang'])) {
        $sessionLang = $_SESSION['lang'];
        require_once ('assets/lang-php/'.$sessionLang.'.php');
    } else {
        require_once ('assets/lang-php/en.php');
    }
?>
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ url('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{asset('assets/logo-dinas.ico')}}" alt="" height="26">
            </span>
            <span class="logo-lg">
                <div class="d-flex align-items-center gap-3">
                    <div><img src="{{asset('assets/logo-dinas.ico')}}" alt="" height="28"></div>
                    <div><h3 class="mb-0 logo-md">KEHATI</h3></div>
                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
                        <i class="bx bx-menu align-middle"></i>
                    </button>
                </div>
            </span>
        </a>
    </div>

    

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                {!! renderMenu() !!}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->