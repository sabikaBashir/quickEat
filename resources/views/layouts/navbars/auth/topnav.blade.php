<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl
        {{ str_contains(Request::url(), 'virtual-reality') == true ? ' mt-3 mx-3 bg-primary' : '' }}" id="navbarBlur"
        data-scroll="false" style="background-color: white;margin-top: 17px;">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
           
            <h6 class="font-weight-bolder text-white mb-0">{{ $title }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                   </div>
            </div>
            <ul class="navbar-nav  justify-content-end">
            <li class="nav-item px-3 d-flex align-items-center">
                <a href="{{route('edit-profile')}}" class="nav-link text-white font-weight-bold px-0">
                    <i class="fa fa-user me-sm-1"></i>
                    <span class="d-sm-inline d-none">{{Auth::user()->name ?? ''}}</span>
                 </a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ route('logout') }}" class="nav-link text-white font-weight-bold px-0">
                            <i class="fa fa-sign-out me-sm-1"></i>
                        </a>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link  p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line "></i>
                            <i class="sidenav-toggler-line "></i>
                            <i class="sidenav-toggler-line "></i>
                        </div>
                    </a>
                </li>
               
            
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
