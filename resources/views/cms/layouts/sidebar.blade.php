<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard')}}" class="brand-link">
        @if (!empty($setting->logo))
            <img src="{{ asset('uploads/logo/' . $setting->logo) }}" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
        @else
            <img src="{{ asset('assets/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
        @endif
        <span class="brand-text font-weight-light">{{ !empty($setting->name) ? $setting->name : 'Institute' }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (!empty(auth()->user()->profile_pic) && file_exists('uploads/users/' . auth()->user()->profile_pic))
                    <img height="30px" src="{{ asset('uploads/users/' . auth()->user()->profile_pic) }}"
                        class="img-circle elevation-2" alt="User Image">
                @else
                    <img height="30px" src="{{ asset('assets/adminlte/dist/img/user2-160x160.jpg') }}"
                        class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name ?? '' }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link @if (Route::currentRouteName() == 'dashboard') active @endif">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @can('admin', new App\Models\User())
                    <li class="nav-item @if (in_array(Route::currentRouteName(), ['user.index', 'role.index', 'module.index', 'permission.index'])) menu-open @endif">
                        <a href="#" class="nav-link  @if (in_array(Route::currentRouteName(), ['user.index', 'role.index', 'module.index', 'permission.index'])) active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p> User Management <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'user.index') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            @can('superAdmin', new App\Models\User())
                                <li class="nav-item">
                                    <a href="{{ route('role.index') }}"
                                        class="nav-link @if (Route::currentRouteName() == 'role.index') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('permission.index') }}"
                                        class="nav-link @if (Route::currentRouteName() == 'permission.index') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Permissions</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('module.index') }}"
                                        class="nav-link @if (Route::currentRouteName() == 'module.index') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Modules</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                <li class="nav-item @if (in_array(Route::currentRouteName(), ['student.index','student.create','manageStudentInstallment'])) menu-open @endif">
                    <a href="#" class="nav-link  @if (in_array(Route::currentRouteName(), ['student.index','student.create','manageStudentInstallment'])) active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p> Student Management <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('student.create') }}"
                                class="nav-link @if (Route::currentRouteName() == 'student.create') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Register Student</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('student.index') }}"
                                class="nav-link @if (Route::currentRouteName() == 'student.index') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Students</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('manageStudentInstallment') }}"
                                class="nav-link @if (Route::currentRouteName() == 'manageStudentInstallment') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Students Fees</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item @if (in_array(Route::currentRouteName(), ['course.index','course.create','qualification.index'])) menu-open @endif">
                    <a href="#" class="nav-link  @if (in_array(Route::currentRouteName(), ['course.index','course.create','qualification.index'])) active @endif">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p> Course Management <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('course.create') }}"
                                class="nav-link @if (Route::currentRouteName() == 'course.create') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Course</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('course.index') }}"
                                class="nav-link @if (Route::currentRouteName() == 'course.index') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Courses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('qualification.index') }}"
                                class="nav-link @if (Route::currentRouteName() == 'qualification.index') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Qualifications</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('monthlyCollection') }}"
                        class="nav-link @if (Route::currentRouteName() == 'monthlyCollection') active @endif">
                        <i class="fa fa-cash-register nav-icon"></i>
                        <p>Monthly Collection</p>
                    </a>
                </li>

                @can('admin', new App\Models\User())
                    <li class="nav-item">
                        <a href="{{ route('setting.index') }}"
                            class="nav-link @if (in_array(Route::currentRouteName(), ['setting.index', 'setting.create', 'setting.edit'])) active @endif">
                            <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                            <p>Setting</p>
                        </a>
                    </li>
                @endcan

                @can('superAdmin', new App\Models\User())
                    <li class="nav-item">
                        <a href="{{ route('activityLogs') }}"
                            class="nav-link @if (Route::currentRouteName() == 'activityLogs') active @endif">
                            <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                            <p>Activity Logs</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
