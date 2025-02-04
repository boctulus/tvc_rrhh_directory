<x-laravel-ui-adminlte::adminlte-layout>
    @if(app()->environment('production'))
        <?php $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true); ?>
        <link rel="stylesheet" href="{{ asset('build/'.$manifest['resources/sass/app.scss']['file']) }}">
        <script type="module" src="{{ asset('build/'.$manifest['resources/js/app.js']['file']) }}"></script>
    @else
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @endif

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Main Header -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('images/logos/logotvc2020white-mini.png') }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                            <span class="d-none d-md-inline">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-primary">
                                <img src="{{ asset('images/logos/logotvc2020white-mini.png') }}"
                                    class="img-circle elevation-2" alt="User Image">
                                <p>
                                    {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                                    <small>Member since {{ Auth::check() ? Auth::user()->created_at->format('M. Y') : 'N/A' }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                <a href="#" class="btn btn-default btn-flat float-right"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Sign out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <!-- Left side column. contains the logo and sidebar -->
            @include('layouts.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div>

            <!-- Main Footer -->
            <footer class="main-footer">                
                <strong>Copyright &copy; 2000-2025 TVC</strong> Todos los derechos reservados.
            </footer>
        </div>
    </body>
</x-laravel-ui-adminlte::adminlte-layout>
