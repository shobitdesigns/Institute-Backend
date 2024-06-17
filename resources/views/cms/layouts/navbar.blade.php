<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                    class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                @if (!empty(auth()->user()->profile_pic) && file_exists('uploads/users/' . auth()->user()->profile_pic))
                    <img height="30px" src="{{ asset('uploads/users/' . auth()->user()->profile_pic) }}"
                        class="img-circle elevation-2" alt="User Image">
                @else
                    <img height="30px" src="{{ asset('assets/adminlte/dist/img/user2-160x160.jpg') }}"
                        class="img-circle elevation-2" alt="User Image">
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="{{ route('changePassword') }}" class="dropdown-item">
                    Change Password
                </a>

                <div class="dropdown-divider"></div>
                @can('superAdmin', new App\Models\User())
                    <a href="{{ route('switchUserForm') }}" class="dropdown-item"> Switch User </a>
                @endcan
                @if (session()->has('original_user'))
                    <a href="{{ route('logoutSwitchUser') }}" class="dropdown-item">Return Back</a>
                @else
                    <div class="dropdown-divider"></div>
                    <a href="javascript:void(0)" onclick="document.getElementById('logout-form').submit();"
                        class="dropdown-item">
                        Logout
                    </a>
                @endif

                <form action="{{ route('logout') }}" id="logout-form" method="post">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
