

<div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
        <li class="nav-item mr-auto">

        </li>
        <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
    </ul>
</div>

<div class="shadow-bottom"></div>
<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item"><a href="{{url('/dashboard')}}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">@lang('lang.Dashboard')</span></a> </li>
        <li class=" nav-item"><a href="{{route('dashboard.type')}}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">نوع المنتج</span></a> </li>
        <li class=" nav-item"><a href="{{route('dashboard.attribute')}}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">خصائص المنتج</span></a> </li>
        <li class=" nav-item"><a href="{{route('dashboard.product')}}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard"> المنتج</span></a> </li>


    </ul>
</div>