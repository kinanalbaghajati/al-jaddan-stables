@php
    $prefix = Request::route()->getPrefix();
    $route = Request::route()->getName();
    $url = Request::url();
@endphp

<section class="sidebar">

    <div class="user-profile">
        <div class="ulogo">
            <a href="{{route('dashboard')}}">
                <!-- logo for regular state and mobile devices -->
                <div class="d-flex align-items-center justify-content-center">
                    <img src="{{asset('backend_theme/static_images/main-logo.svg')}}" alt="" >
{{--                    style="background-color: whitesmoke;padding-top: 3%; padding-bottom: 3%;padding-left: 15%;padding-right: 15%;border-radius: 5px"--}}
                </div>
                <h3><b>Al-jaddan</b> Stables</h3>
            </a>
        </div>
    </div>

    <!-- sidebar menu-->
    <ul class="sidebar-menu" data-widget="tree">

        <li @if($route == 'dashboard') class="active" @endif>
            <a href="{{route('dashboard')}}">
                <i data-feather="pie-chart"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @can('admin_tab')
            <li class="header nav-small-cap">Admin Tabs</li>
            <li class="treeview @if($prefix == 'admins') active menu-open @endif">
                <a href="#">
                    <i class="fa fa-user-o" style="font-size: 20px"></i>
                    <span>Admins</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li @if($route == 'admins.index') class="active" @endif><a href="{{route('admins.index')}}"><i
                                class="ti-more"></i>all Admins </a></li>
                </ul>
            </li>
        @endcan
        @can('roles_tab')
            <li class="treeview @if($prefix == 'roles') active menu-open @endif">
                <a href="#">
                    <i class="fa fa-cog " style="font-size: 20px"></i><span>roles</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li @if($route == 'role.index') class="active" @endif ><a href="{{route('role.index')}}"><i
                                class="ti-more"></i>all Roles</a></li>
                </ul>
            </li>
        @endcan
        @can('horses')
        <li class="header nav-small-cap">Content Tabs</li>
        <li class="treeview @if($prefix == 'horses') active menu-open @endif">
            <a href="#">
                <i class="fa fa-heart " style="font-size: 20px"></i>
                <span>All Horses</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li @if((str_contains($url, 'stallion'))) class="active" @endif><a
                        href="{{route('horses.index','stallion')}}"><i class="ti-more"></i>Stallions</a></li>
                <li @if((str_contains($url, 'mare'))) class="active" @endif><a
                        href="{{route('horses.index','mare')}}"><i class="ti-more"></i>Mares</a></li>
                <li @if((str_contains($url, 'offspring'))) class="active" @endif><a
                        href="{{route('horses.index','offspring')}}"><i class="ti-more"></i>Offsprings</a></li>
                @can('create_horse')
                <li @if($route == 'horse.create') class="active" @endif><a href="{{route('horse.create')}}"><i
                            class="ti-more"></i>Create Horse</a></li>
                @endcan
            </ul>
        </li>
        @endcan

        <li class="treeview @if($prefix == 'contents') active menu-open @endif">
            <a href="#">
                <i class="fa fa-th-large"></i>
                <span>Home Page</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                @can('main_title')
                <li @if($route == 'main.title.index') class="active" @endif><a href="{{route('main.title.index')}}"><i
                            class="ti-more"></i>Main Title</a></li>
                @endcan
                    @can('first_section')
                <li @if($route == 'first.content.index') class="active" @endif><a
                        href="{{route('first.content.index')}}"><i class="ti-more"></i>First Section</a></li>
                    @endcan
                    @can('second_section')
                <li @if($route == 'second.content.index') class="active" @endif><a
                        href="{{route('second.content.index')}}"><i class="ti-more"></i>Second Section</a></li>
                    @endcan
                    @can('gallery')
                <li @if($route == 'gallery.index') class="active" @endif><a href="{{route('gallery.index')}}"><i
                            class="ti-more"></i>Gallery</a></li>
                    @endcan
            </ul>
        </li>
        @can('contact_us')
        <li class="treeview @if($prefix == 'contact') active menu-open @endif">
            <a href="#">
                <i class="fa fa-phone" style="font-size: 20px"></i>
                <span>Contact Us</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li @if($route == 'contact.index') class="active" @endif><a href="{{route('contact.index')}}"><i
                            class="ti-more"></i>Contacts</a></li>
            </ul>
        </li>
        @endcan

    </ul>
</section>
