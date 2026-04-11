<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ asset('admin_assets/images/logo.ico') }}">
        <title>5Petal</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="{{ asset('admin_assets/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/css/tempusdominus-bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/css/adminlte.min.css') }}">

        <link rel="stylesheet" href="{{ asset('admin_assets/css/OverlayScrollbars.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/css/summernote-bs4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/css/admin_custom.css') }}">
        <script src="{{ asset('admin_assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/moment.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/jquery.overlayScrollbars.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/jquery.repeater.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/adminlte.min.js') }}"></script>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="{{ asset('admin_assets/images/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
            </div>
            <nav class="main-header navbar navbar-expand navbar-white navbar-light main_header">
                <ul class="navbar-nav nav_humberger">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20"><path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM64 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L96 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z"/></svg>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav profienav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20"><path d="M32 32C14.3 32 0 46.3 0 64l0 96c0 17.7 14.3 32 32 32s32-14.3 32-32l0-64 64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L32 32zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7 14.3 32 32 32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0 0-64zM320 32c-17.7 0-32 14.3-32 32s14.3 32 32 32l64 0 0 64c0 17.7 14.3 32 32 32s32-14.3 32-32l0-96c0-17.7-14.3-32-32-32l-96 0zM448 352c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64-64 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l96 0c17.7 0 32-14.3 32-32l0-96z"/></svg>
                        </a>
                    </li>
                    <li class="nav-item notification_btn">
                        <button>
                            <svg class="fill-current duration-300 ease-in-out" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.1999 14.9343L15.6374 14.0624C15.5249 13.8937 15.4687 13.7249 15.4687 13.528V7.67803C15.4687 6.01865 14.7655 4.47178 13.4718 3.31865C12.4312 2.39053 11.0812 1.7999 9.64678 1.6874V1.1249C9.64678 0.787402 9.36553 0.478027 8.9999 0.478027C8.6624 0.478027 8.35303 0.759277 8.35303 1.1249V1.65928C8.29678 1.65928 8.24053 1.65928 8.18428 1.6874C4.92178 2.05303 2.4749 4.66865 2.4749 7.79053V13.528C2.44678 13.8093 2.39053 13.9499 2.33428 14.0343L1.7999 14.9343C1.63115 15.2155 1.63115 15.553 1.7999 15.8343C1.96865 16.0874 2.2499 16.2562 2.55928 16.2562H8.38115V16.8749C8.38115 17.2124 8.6624 17.5218 9.02803 17.5218C9.36553 17.5218 9.6749 17.2405 9.6749 16.8749V16.2562H15.4687C15.778 16.2562 16.0593 16.0874 16.228 15.8343C16.3968 15.553 16.3968 15.2155 16.1999 14.9343ZM3.23428 14.9905L3.43115 14.653C3.5999 14.3718 3.68428 14.0343 3.74053 13.6405V7.79053C3.74053 5.31553 5.70928 3.23428 8.3249 2.95303C9.92803 2.78428 11.503 3.2624 12.6562 4.2749C13.6687 5.1749 14.2312 6.38428 14.2312 7.67803V13.528C14.2312 13.9499 14.3437 14.3437 14.5968 14.7374L14.7655 14.9905H3.23428Z" fill=""></path>
                            </svg>
                            <span></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right border-box">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.profile.edit') }}" class="dropdown-item">
                                        <i class="fas fa-user-edit mr-2"></i> Edit Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.change.password.form') }}" class="dropdown-item">
                                        <i class="fas fa-key mr-2"></i> Change Password
                                    </a>
                                </li>
                            </ul>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </li>
                    <li class="nav-item dropdown profile_dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <p>{{ Auth::user()->name ?? Auth::user()->email }}</p>
                            <div class="profile_div">
                                @if(Auth::user()->profile_image)
                                    <img src="{{ asset('admin_assets/uploads/' . Auth::user()->profile_image) }}" class="img_div" alt="">
                                @else
                                    <img src="{{ asset('admin_assets/images/avatar.png') }}" class="img_div" alt="">
                                @endif
                            </div>
                            <svg class="ease-in-out" width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.410765 0.910734C0.736202 0.585297 1.26384 0.585297 1.58928 0.910734L6.00002 5.32148L10.4108 0.910734C10.7362 0.585297 11.2638 0.585297 11.5893 0.910734C11.9147 1.23617 11.9147 1.76381 11.5893 2.08924L6.58928 7.08924C6.26384 7.41468 5.7362 7.41468 5.41077 7.08924L0.410765 2.08924C0.0853277 1.76381 0.0853277 1.23617 0.410765 0.910734Z" fill=""></path>
                            </svg>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right border-box">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.profile.edit') }}" class="dropdown-item">
                                        <i class="fas fa-user-edit mr-2"></i> Edit Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.change.password.form') }}" class="dropdown-item">
                                        <i class="fas fa-key mr-2"></i> Change Password
                                    </a>
                                </li>
                            </ul>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar">
                <div class="sidebar_div">
                    <div class="brand-link">
                        <a href="{{ route('admin.dashboard') }}" >
                            <img src="{{ asset('admin_assets/images/AdminLTELogo.png') }}" alt="AdminLTE Logo">
                        </a>
                    </div>
                    <div class="sidebar">
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <li class="nav-item">
                                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.10322 0.956299H2.53135C1.5751 0.956299 0.787598 1.7438 0.787598 2.70005V6.27192C0.787598 7.22817 1.5751 8.01567 2.53135 8.01567H6.10322C7.05947 8.01567 7.84697 7.22817 7.84697 6.27192V2.72817C7.8751 1.7438 7.0876 0.956299 6.10322 0.956299ZM6.60947 6.30005C6.60947 6.5813 6.38447 6.8063 6.10322 6.8063H2.53135C2.2501 6.8063 2.0251 6.5813 2.0251 6.30005V2.72817C2.0251 2.44692 2.2501 2.22192 2.53135 2.22192H6.10322C6.38447 2.22192 6.60947 2.44692 6.60947 2.72817V6.30005Z" fill=""></path>
                                            <path d="M15.4689 0.956299H11.8971C10.9408 0.956299 10.1533 1.7438 10.1533 2.70005V6.27192C10.1533 7.22817 10.9408 8.01567 11.8971 8.01567H15.4689C16.4252 8.01567 17.2127 7.22817 17.2127 6.27192V2.72817C17.2127 1.7438 16.4252 0.956299 15.4689 0.956299ZM15.9752 6.30005C15.9752 6.5813 15.7502 6.8063 15.4689 6.8063H11.8971C11.6158 6.8063 11.3908 6.5813 11.3908 6.30005V2.72817C11.3908 2.44692 11.6158 2.22192 11.8971 2.22192H15.4689C15.7502 2.22192 15.9752 2.44692 15.9752 2.72817V6.30005Z" fill=""></path>
                                            <path d="M6.10322 9.92822H2.53135C1.5751 9.92822 0.787598 10.7157 0.787598 11.672V15.2438C0.787598 16.2001 1.5751 16.9876 2.53135 16.9876H6.10322C7.05947 16.9876 7.84697 16.2001 7.84697 15.2438V11.7001C7.8751 10.7157 7.0876 9.92822 6.10322 9.92822ZM6.60947 15.272C6.60947 15.5532 6.38447 15.7782 6.10322 15.7782H2.53135C2.2501 15.7782 2.0251 15.5532 2.0251 15.272V11.7001C2.0251 11.4188 2.2501 11.1938 2.53135 11.1938H6.10322C6.38447 11.1938 6.60947 11.4188 6.60947 11.7001V15.272Z" fill=""></path>
                                            <path d="M15.4689 9.92822H11.8971C10.9408 9.92822 10.1533 10.7157 10.1533 11.672V15.2438C10.1533 16.2001 10.9408 16.9876 11.8971 16.9876H15.4689C16.4252 16.9876 17.2127 16.2001 17.2127 15.2438V11.7001C17.2127 10.7157 16.4252 9.92822 15.4689 9.92822ZM15.9752 15.272C15.9752 15.5532 15.7502 15.7782 15.4689 15.7782H11.8971C11.6158 15.7782 11.3908 15.5532 11.3908 15.272V11.7001C11.3908 11.4188 11.6158 11.1938 11.8971 11.1938H15.4689C15.7502 11.1938 15.9752 11.4188 15.9752 11.7001V15.272Z" fill=""></path>
                                        </svg>
                                        <p>Dashboard</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                        <svg class="fill-primary dark:fill-white" width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.18418 8.03751C9.31543 8.03751 11.0686 6.35313 11.0686 4.25626C11.0686 2.15938 9.31543 0.475006 7.18418 0.475006C5.05293 0.475006 3.2998 2.15938 3.2998 4.25626C3.2998 6.35313 5.05293 8.03751 7.18418 8.03751ZM7.18418 2.05626C8.45605 2.05626 9.52168 3.05313 9.52168 4.29063C9.52168 5.52813 8.49043 6.52501 7.18418 6.52501C5.87793 6.52501 4.84668 5.52813 4.84668 4.29063C4.84668 3.05313 5.9123 2.05626 7.18418 2.05626Z" fill=""></path>
                                            <path d="M15.8124 9.6875C17.6687 9.6875 19.1468 8.24375 19.1468 6.42188C19.1468 4.6 17.6343 3.15625 15.8124 3.15625C13.9905 3.15625 12.478 4.6 12.478 6.42188C12.478 8.24375 13.9905 9.6875 15.8124 9.6875ZM15.8124 4.7375C16.8093 4.7375 17.5999 5.49375 17.5999 6.45625C17.5999 7.41875 16.8093 8.175 15.8124 8.175C14.8155 8.175 14.0249 7.41875 14.0249 6.45625C14.0249 5.49375 14.8155 4.7375 15.8124 4.7375Z" fill=""></path>
                                            <path d="M15.9843 10.0313H15.6749C14.6437 10.0313 13.6468 10.3406 12.7874 10.8563C11.8593 9.61876 10.3812 8.79376 8.73115 8.79376H5.67178C2.85303 8.82814 0.618652 11.0625 0.618652 13.8469V16.3219C0.618652 16.975 1.13428 17.4906 1.7874 17.4906H20.2468C20.8999 17.4906 21.4499 16.9406 21.4499 16.2875V15.4625C21.4155 12.4719 18.9749 10.0313 15.9843 10.0313ZM2.16553 15.9438V13.8469C2.16553 11.9219 3.74678 10.3406 5.67178 10.3406H8.73115C10.6562 10.3406 12.2374 11.9219 12.2374 13.8469V15.9438H2.16553V15.9438ZM19.8687 15.9438H13.7499V13.8469C13.7499 13.2969 13.6468 12.7469 13.4749 12.2313C14.0937 11.7844 14.8499 11.5781 15.6405 11.5781H15.9499C18.0812 11.5781 19.8343 13.3313 19.8343 15.4625V15.9438H19.8687Z" fill=""></path>
                                        </svg>
                                        <p>Users</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-tags"></i>
                                        <p>Categories</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                                        <svg class="fill-primary dark:fill-white" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21.1063 18.0469L19.3875 3.23126C19.2157 1.71876 17.9438 0.584381 16.3969 0.584381H5.56878C4.05628 0.584381 2.78441 1.71876 2.57816 3.23126L0.859406 18.0469C0.756281 18.9063 1.03128 19.7313 1.61566 20.3844C2.20003 21.0375 2.99066 21.3813 3.85003 21.3813H18.1157C18.975 21.3813 19.8 21.0031 20.35 20.3844C20.9 19.7656 21.2094 18.9063 21.1063 18.0469ZM19.2157 19.3531C18.9407 19.6625 18.5625 19.8344 18.15 19.8344H3.85003C3.43753 19.8344 3.05941 19.6625 2.78441 19.3531C2.50941 19.0438 2.37191 18.6313 2.44066 18.2188L4.12503 3.43751C4.19378 2.71563 4.81253 2.16563 5.56878 2.16563H16.4313C17.1532 2.16563 17.7719 2.71563 17.875 3.43751L19.5938 18.2531C19.6282 18.6656 19.4907 19.0438 19.2157 19.3531Z" fill=""></path>
                                            <path d="M14.3345 5.29375C13.922 5.39688 13.647 5.80938 13.7501 6.22188C13.7845 6.42813 13.8189 6.63438 13.8189 6.80625C13.8189 8.35313 12.547 9.625 11.0001 9.625C9.45327 9.625 8.1814 8.35313 8.1814 6.80625C8.1814 6.6 8.21577 6.42813 8.25015 6.22188C8.35327 5.80938 8.07827 5.39688 7.66577 5.29375C7.25327 5.19063 6.84077 5.46563 6.73765 5.87813C6.6689 6.1875 6.63452 6.49688 6.63452 6.80625C6.63452 9.2125 8.5939 11.1719 11.0001 11.1719C13.4064 11.1719 15.3658 9.2125 15.3658 6.80625C15.3658 6.49688 15.3314 6.1875 15.2626 5.87813C15.1595 5.46563 14.747 5.225 14.3345 5.29375Z" fill=""></path>
                                        </svg>
                                        <p>Products</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5C21 5.55 20.55 6 20 6H19V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V6H4C3.45 6 3 5.55 3 5C3 4.45 3.45 4 4 4H7ZM9 3V4H15V3H9ZM7 6V19H17V6H7Z" fill=""/>
                                            <path d="M9 8H15V10H9V8ZM9 12H15V14H9V12ZM9 16H13V18H9V16Z" fill=""/>
                                        </svg>
                                        <p>Orders</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.theme-options') }}" class="nav-link {{ request()->routeIs('admin.theme-options') ? 'active' : '' }}">
                                        <svg version="1.1" id="Uploaded to svgrepo.com" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                width="22" height="22" viewBox="0 0 32 32" xml:space="preserve">
                                            <path class="feather_een" d="M7,8.05V5.5C7,5.224,6.776,5,6.5,5S6,5.224,6,5.5v2.55C4.306,8.295,3,9.738,3,11.5s1.306,3.205,3,3.45
                                                V26.5C6,26.776,6.224,27,6.5,27S7,26.776,7,26.5V14.95c1.694-0.245,3-1.688,3-3.45S8.694,8.295,7,8.05z M6.5,14
                                                C5.122,14,4,12.878,4,11.5C4,10.121,5.122,9,6.5,9S9,10.121,9,11.5C9,12.878,7.878,14,6.5,14z M16,17.05V5.5
                                                C16,5.224,15.776,5,15.5,5S15,5.224,15,5.5v11.55c-1.694,0.245-3,1.688-3,3.45s1.306,3.205,3,3.45v2.55c0,0.276,0.224,0.5,0.5,0.5
                                                s0.5-0.224,0.5-0.5v-2.55c1.694-0.245,3-1.688,3-3.45S17.694,17.295,16,17.05z M15.5,23c-1.378,0-2.5-1.122-2.5-2.5
                                                c0-1.379,1.122-2.5,2.5-2.5s2.5,1.121,2.5,2.5C18,21.878,16.878,23,15.5,23z M28,14.5c0-1.762-1.306-3.205-3-3.45V5.5
                                                C25,5.224,24.776,5,24.5,5S24,5.224,24,5.5v5.55c-1.694,0.245-3,1.688-3,3.45s1.306,3.205,3,3.45v8.55c0,0.276,0.224,0.5,0.5,0.5
                                                s0.5-0.224,0.5-0.5v-8.55C26.694,17.705,28,16.262,28,14.5z M24.5,17c-1.378,0-2.5-1.122-2.5-2.5c0-1.379,1.122-2.5,2.5-2.5
                                                s2.5,1.121,2.5,2.5C27,15.878,25.878,17,24.5,17z"/>
                                            </svg>
                                        <p>Theme Options</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.season-category.index') }}" class="nav-link {{ request()->routeIs('admin.season-category.*') ? 'active' : '' }}">
                                        <svg fill="#000000" width="22" height="22" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M31.772 16.043l-15.012-15.724c-0.189-0.197-0.449-0.307-0.721-0.307s-0.533 0.111-0.722 0.307l-15.089 15.724c-0.383 0.398-0.369 1.031 0.029 1.414 0.399 0.382 1.031 0.371 1.414-0.029l1.344-1.401v14.963c0 0.552 0.448 1 1 1h6.986c0.551 0 0.998-0.445 1-0.997l0.031-9.989h7.969v9.986c0 0.552 0.448 1 1 1h6.983c0.552 0 1-0.448 1-1v-14.968l1.343 1.407c0.197 0.204 0.459 0.308 0.722 0.308 0.249 0 0.499-0.092 0.692-0.279 0.398-0.382 0.411-1.015 0.029-1.413zM26.985 14.213v15.776h-4.983v-9.986c0-0.552-0.448-1-1-1h-9.965c-0.551 0-0.998 0.445-1 0.997l-0.031 9.989h-4.989v-15.777c0-0.082-0.013-0.162-0.032-0.239l11.055-11.52 10.982 11.507c-0.021 0.081-0.036 0.165-0.036 0.252z"></path>
                                        </svg>
                                        <p>Season Category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.manage-home-pages') }}" class="nav-link {{ request()->routeIs('admin.manage-home-pages') ? 'active' : '' }}">
                                        <svg fill="#000000" width="22" height="22" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M40,47H8a2,2,0,0,1-2-2V3A2,2,0,0,1,8,1H40a2,2,0,0,1,2,2V45A2,2,0,0,1,40,47ZM10,43H38V5H10Z"/>
                                            <circle cx="15" cy="24" r="2"/><circle cx="15" cy="31" r="2"/><circle cx="15" cy="38" r="2"/>
                                            <path d="M33,26H22a2,2,0,0,1,0-4H33a2,2,0,0,1,0,4Z"/>
                                            <path d="M33,33H22a2,2,0,0,1,0-4H33a2,2,0,0,1,0,4Z"/>
                                            <path d="M33,40H22a2,2,0,0,1,0-4H33a2,2,0,0,1,0,4Z"/>
                                        </svg>
                                        <p>Manage Home Pages</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.5 11C9.433 11 11 9.433 11 7.5C11 5.567 9.433 4 7.5 4C5.567 4 4 5.567 4 7.5C4 9.433 5.567 11 7.5 11Z" fill=""/>
                                            <path d="M13 7H20V9H13V7ZM13 11H20V13H13V11ZM13 15H20V17H13V15Z" fill=""/>
                                            <path d="M7.5 13C4.462 13 2 15.462 2 18.5V20H13V18.5C13 15.462 10.538 13 7.5 13Z" fill=""/>
                                        </svg>
                                        <p>Testimonials</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.reels.index') }}" class="nav-link {{ request()->routeIs('admin.reels.*') ? 'active' : '' }}">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2" y="2" width="20" height="20" rx="2.18" stroke="currentColor" stroke-width="2"/>
                                            <path d="M7 2v20M17 2v20M2 12h20M2 7h5M17 7h5M2 17h5M17 17h5" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                        <p>Watch & Buy Reels</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.leads.index') }}" class="nav-link {{ request()->routeIs('admin.leads.index') ? 'active' : '' }}">
                                        <svg fill="#000000" width="22" height="22" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                            <title>Leads</title>
                                            <path d="M24 4a8 8 0 1 1-8 8 8 8 0 0 1 8-8m0-4a12 12 0 1 0 12 12A12 12 0 0 0 24 0z"/>
                                            <path d="M24 22c-10.493 0-19 8.507-19 19a2 2 0 0 0 2 2h34a2 2 0 0 0 2-2c0-10.493-8.507-19-19-19zm-15.93 17c.98-6.348 6.356-11 12.93-11s11.95 4.652 12.93 11H8.07z"/>
                                        </svg>
                                        <p>Manage Leads</p>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <!-- /.sidebar-menu -->
                    </div>
                </div>
            </aside>
            @yield('content')
        </div>



        <script>
            // description
                $('#catDescription,#proShortDesc,#proLongDesc,#footer_description,#below_banner_description').summernote(
                    {
                        height: 200,
                        focus: true    
                    }
                );
            // description end

            // datatables
                $('#custDataTable,#seasonCategoryTable,#categoriesTable,#productsTable').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": false,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                });
            // datatables end

            // repeaters 
                $('.add_info_repeater').repeater({
                    initEmpty: false,
                    show: function () {
                        $(this).slideDown();
                    },
                    hide: function (deleteElement) {
                        if (confirm('Are you sure you want to delete this image?')) {
                            $(this).slideUp(deleteElement, function() {
                                $(this).remove();
                            });
                        }
                    },
                });
                $('.qa_repeater').repeater({
                    initEmpty: false,
                    show: function () {
                        $(this).slideDown();
                    },
                    hide: function (deleteElement) {
                        if (confirm('Are you sure you want to delete this image?')) {
                            $(this).slideUp(deleteElement, function() {
                                $(this).remove();
                            });
                        }
                    },
                }); 
                $('.add_pro_images_repeater').repeater({
                    initEmpty: false,
                    show: function () {
                        $(this).slideDown();
                        updateMainImageRadioButtons();
                    },
                    hide: function (deleteElement) {
                        if (confirm('Are you sure you want to delete this image?')) {
                            $(this).slideUp(deleteElement, function() {
                                $(this).remove();
                                updateMainImageRadioButtons();
                            });
                        }
                    },
                    ready: function(setIndexes) {
                        updateMainImageRadioButtons();
                    }
                });
                $('.product_gallery_images_repeater').repeater({
                    initEmpty: false,
                    show: function () {
                        $(this).slideDown();
                        var index = $(this).closest('[data-repeater-item]').index();
                        var inputSelector = 'input[name="product_gallery_images[' + index + '][pro_image]"]';
                        $(inputSelector).closest('.input-group').find('.img-thumbnail').attr('src', '').hide();
                    },
                    hide: function (deleteElement) {
                        if (confirm('Are you sure you want to delete this image?')) {
                            $(this).slideUp(deleteElement, function() {
                                $(this).remove();
                            });
                        }
                    },
                });
            // repeaters end

            // global
                function getFormattedDateTime(date) {
                    return date.toISOString().slice(0, 16);
                }

                document.addEventListener('DOMContentLoaded', function() {
                    var alert = document.getElementById('success-alert');
                    if (alert) {
                        setTimeout(function() {
                            alert.classList.add('fade-out');
                            setTimeout(function() {
                                alert.style.display = 'none';
                            }, 1000); // Matches the fade-out duration
                        }, 3000); // Display duration (3 seconds)
                    }
                });
            // global end

            // product page code
                function updateMainImageRadioButtons() {
                    // Assign values to all radio buttons to ensure the first one is selected by default
                    $('.main_image').each(function(index) {
                        $(this).val(index);
                        // Automatically select the first radio button
                        if (index === 0) {
                            $(this).prop('checked', true);
                        }
                    });
                }

                // Ensure only one radio button is selected at a time
                $(document).on('change', '.main_image', function() {
                    // Uncheck all other radio buttons
                    $('.main_image').not(this).prop('checked', false);
                });
                window.onload = function() {
                    var saleStartInput = document.getElementById('sale_start');
                    var saleEndInput = document.getElementById('sale_end');
                    if(saleStartInput && saleEndInput){
                        var now = new Date();
                        saleStartInput.min = getFormattedDateTime(now);
                        saleStartInput.addEventListener('change', function() {
                            var saleStartDate = new Date(saleStartInput.value);
                            var saleEndDate = new Date(saleEndInput.value);
                            saleEndInput.min = getFormattedDateTime(saleStartDate);
                            if (saleEndInput.value && saleEndDate < saleStartDate) {
                                saleEndInput.value = getFormattedDateTime(saleStartDate);
                            }
                        });
                        saleEndInput.min = getFormattedDateTime(now);
                    }
                }
            // product page code end

 
            $('#upload_image').change(function() {
                const input = this;
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview-img').attr('src', e.target.result);
                        $('#image-preview').show();
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });
            $('#cat_banner_image').change(function() {
                const input = this;
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview-cat-banner-image').attr('src', e.target.result);
                        $('#cat-banner-image-preview').show();
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });
            $('#upload_image2').change(function() {
                const input = this;
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview-img2').attr('src', e.target.result);
                        $('#image-preview2').show();
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });
            $('#upload_image_fpl').change(function() {
                const input = this;
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview-img-fpl').attr('src', e.target.result);
                        $('#image-preview-fpl').show();
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });


        </script>
    </body>
</html>
