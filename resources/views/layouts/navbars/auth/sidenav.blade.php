<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main" style="background-color:#434343 !important">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=""
            target="_blank">
            <img src="{{asset('images/logo.jpeg')}}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="font-weight-bold" style="font-size: 20px; margin-left: 20px;color:#fff;font-family: fangsong;
    font-style: italic;">Quick-Eats</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
        <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2  text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1" style="color:#fff" >Dashboard</span>
                </a>
        </li>
        
        <li class="nav-item">
            <!-- <a data-bs-toggle="collapse" href="#dashboardsExamples" class="nav-link collapsed" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
            <i class="ni ni-single-02  text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1" style="color:#fff">User Management</span>
                </a>
                <div class="collapse" id="dashboardsExamples" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                        <a class="nav-link " href="https://argon-dashboard-pro-laravel.creative-tim.com/automotive">
                        <span class="sidenav-mini-icon"> A </span>
                        <span class="sidenav-normal" style="color:#fff"> View User </span>
                        </a>
                        </li>
                    </ul>
            </div>
            </li> -->
            @if(Auth::user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'users') == true ? 'active' : '' }}" href="{{route('users.index')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1" style="color:#fff">Student Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'vendor') == true ? 'active' : '' }}" href="{{route('vendor.index')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-shop text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1" style="color:#fff">Vendor Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'category') == true ? 'active' : '' }}" href="{{route('category.index')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-app text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1" style="color:#fff">Category Management</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->role == 'vendor')
           
            
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'item') == true ? 'active' : '' }}" href="{{route('item.index')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-money-coins  text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1" style="color:#fff">Item Management</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'advertisement') == true ? 'active' : '' }}" href="{{route('advertisement.index')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-world-2  text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1" style="color:#fff">Advertisement</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'order') == true ? 'active' : '' }}" href="{{route('get.order')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-basket text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1" style="color:#fff">Orders</span>
                </a>
            </li>

        </ul>
    </div>
   
</aside>
