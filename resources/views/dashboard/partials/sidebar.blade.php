<!-- Sidebar -->
<div class="sidebar" data-background-color="white">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header  py-4 my-2" data-background-color="white">
            <a href="{{route('home')}}" class="logo">

              <img  src={{asset("dashboard/assets/img/Logo.png")}} alt="navbar brand" class="navbar-brand" height="47" /> 
             {{--  <h2 class="m-0 text-primary "><i class="fa fa-book me-3"></i>{{config('app.name')}}</h2>--}}
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                {{--                <li class="nav-item active">--}}
                {{--                    <a--}}
                {{--                        data-bs-toggle="collapse"--}}
                {{--                        href="#dashboard"--}}
                {{--                        class="collapsed"--}}
                {{--                        aria-expanded="false"--}}
                {{--                    >--}}
                {{--                        <i class="fas fa-home"></i>--}}
                {{--                        <p>Dashboard</p>--}}
                {{--                        <span class="caret"></span>--}}
                {{--                    </a>--}}
                {{--                    <div class="collapse" id="dashboard">--}}
                {{--                        <ul class="nav nav-collapse">--}}
                {{--                            <li>--}}
                {{--                                <a href="../demo1/index.html">--}}
                {{--                                    <span class="sub-item">Dashboard 1</span>--}}
                {{--                                </a>--}}
                {{--                            </li>--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                </li>--}}

                <li class="nav-item sidebar-menu__item {{ request()->routeIs('dashboard.') ? 'active' : '' }}">
                    <a href="{{route('dashboard.')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="fas fa-th-large"></i></span>
                        <span class="text">Dashboard</span>
                    </a>
                </li>


                {{-- هنا الجديد--}}
                @role ('teacher')
                <li class="nav-item sidebar-menu__item {{ request()->routeIs('dashboard.courses.index') ? 'active' : '' }}">
                    <a href="{{route('dashboard.courses.index')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="fas fa-graduation-cap"></i></span>
                        <span class="text">{{__('labels.stages')}}</span>
                    </a>
                </li>
                <li class="nav-item sidebar-menu__item {{ request()->routeIs('students.index') ? 'active' : '' }}">
                    <a href="{{route('students.index')}}"class="sidebar-menu__link">
                        <span class="icon"><i class="fas fa-users"></i></span>
                        <span class="sub-item">{{__('labels.students')}}</span>

                    </a>
                </li>

                <li class="nav-item sidebar-menu__item {{ request()->routeIs('dashboard.codes.index') ? 'active' : '' }}">
                    <a href="{{route('dashboard.codes.index')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="fas fa-key"></i></span>
                        <span class="sub-item">{{__('labels.codes')}}</span>
                    </a>
                </li>
                <li class="nav-item sidebar-menu__item {{ request()->routeIs('dashboard.homework.index') ? 'active' : '' }}">
                    <a href="{{route('dashboard.homework.index')}} "class="sidebar-menu__link">
                    <span class="icon"><i class="fas fa-book"></i></span>
                    <span class="sub-item">Homework</span>
                    </a>
                </li>

                <li class="nav-item sidebar-menu__item {{ request()->routeIs('quizzes.index') ? 'active' : '' }}">
                    <a href="{{route('quizzes.index')}} "class="sidebar-menu__link">
                        <span class="icon"><i class="fas fa-question"></i></span>
                        <span class="sub-item">Quizzes</span>
                    </a>
                </li>
                <li class="nav-item sidebar-menu__item {{ request()->routeIs('dashboard.quiz_corrections.index') ? 'active' : '' }}">
                    <a href="{{route('dashboard.quiz_corrections.index')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="fas fa-question-circle"></i></span>
                        <span class="sub-item">Quiz correction</span>
                    </a>
                </li>
                <li class="nav-item sidebar-menu__item {{ request()->routeIs('dashboard.booklets.index') ? 'active' : '' }}">
                    <a href="{{route('dashboard.booklets.index')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="fas fa-chalkboard-teacher"></i></span>
                        <span class="sub-item">Booklets</span>
                    </a>
                </li>
                @endrole
          {{--      <li class="nav-item ">
                
    <span class="text-dark text-sm px-4 pt-4 fw-semibold border-top border-gray-100 d-block text-uppercase">Settings</span>
</li>--}}
<li class="nav-item sidebar-menu__item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
    <a href="{{ route('profile.edit') }}" class="sidebar-menu__link">
        <span class="icon"><i class="fas fa-cog"></i></span>
        <span class="text">Account Settings</span>
    </a>
</li>

             {{--   <li class="nav-item">
                    <a href="{{route('profile.edit')}}">
                        <span class="icon"><i class="fas fa-cog"></i></span>
                        <span class="sub-item">Setting</span>
                    </a>
                </li>--}}
             {{--      <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                    <h4 class="text-section">Components</h4>
                </li>

             @role ('teacher')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-book"></i>
                        <p>Academic</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{route('dashboard.courses.index')}}">
                                    <span class="sub-item">{{__('labels.stages')}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('students.index')}}">
                                    <span class="sub-item">{{__('labels.students')}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('dashboard.codes.index')}}">
                                    <span class="sub-item">{{__('labels.codes')}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('dashboard.homework.index')}}">
                                    <span class="sub-item">Homework</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('quizzes.index')}}">
                                    <span class="sub-item">Quizzes</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('dashboard.quiz_corrections.index')}}">
                                    <span class="sub-item">Quiz correction</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('dashboard.booklets.index')}}">
                                    <span class="sub-item">Booklets</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endrole
                --}}

                @role ('student')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-book"></i>
                        <p>Academic</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{route('dashboard.lectures.index')}}">
                                    <span class="sub-item">Lectures</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('dashboard.homework.index')}}">
                                    <span class="sub-item">Homework</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('quizzes.index')}}">
                                    <span class="sub-item">Quizzes</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('dashboard.quiz_corrections.index')}}">
                                    <span class="sub-item">Quiz correction</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('dashboard.booklets.index')}}">
                                    <span class="sub-item">Booklets</span>
                                </a>
                            </li>
                        
                        </ul>
                    </div>
                </li>
                @endrole
                @role ('parent')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-book"></i>
                        <p>Academic data</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{route('scores.index')}}">
                                    <span class="sub-item">Scores</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endrole
             {{--   <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-user-tie"></i>
                        <p>Personal</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{route('profile.edit')}}">
                                    <span class="sub-item">settings</span>
                                </a>
                            </li>
                        </ul>
                    </div> --}}
                </li>
                {{--                <li class="nav-item">--}}
                {{--                    <a data-bs-toggle="collapse" href="#forms">--}}
                {{--                        <i class="fas fa-pen-square"></i>--}}
                {{--                        <p>Forms</p>--}}
                {{--                        <span class="caret"></span>--}}
                {{--                    </a>--}}
                {{--                    <div class="collapse" id="forms">--}}
                {{--                        <ul class="nav nav-collapse">--}}
                {{--                            <li>--}}
                {{--                                <a href="forms/forms.html">--}}
                {{--                                    <span class="sub-item">Basic Form</span>--}}
                {{--                                </a>--}}
                {{--                            </li>--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a data-bs-toggle="collapse" href="#tables">--}}
                {{--                        <i class="fas fa-table"></i>--}}
                {{--                        <p>Tables</p>--}}
                {{--                        <span class="caret"></span>--}}
                {{--                    </a>--}}
                {{--                    <div class="collapse" id="tables">--}}
                {{--                        <ul class="nav nav-collapse">--}}
                {{--                            <li>--}}
                {{--                                <a href="tables/tables.html">--}}
                {{--                                    <span class="sub-item">Basic Table</span>--}}
                {{--                                </a>--}}
                {{--                            </li>--}}
                {{--                            <li>--}}
                {{--                                <a href="tables/datatables.html">--}}
                {{--                                    <span class="sub-item">Datatables</span>--}}
                {{--                                </a>--}}
                {{--                            </li>--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a data-bs-toggle="collapse" href="#maps">--}}
                {{--                        <i class="fas fa-map-marker-alt"></i>--}}
                {{--                        <p>Maps</p>--}}
                {{--                        <span class="caret"></span>--}}
                {{--                    </a>--}}
                {{--                    <div class="collapse" id="maps">--}}
                {{--                        <ul class="nav nav-collapse">--}}
                {{--                            <li>--}}
                {{--                                <a href="maps/googlemaps.html">--}}
                {{--                                    <span class="sub-item">Google Maps</span>--}}
                {{--                                </a>--}}
                {{--                            </li>--}}
                {{--                            <li>--}}
                {{--                                <a href="maps/jsvectormap.html">--}}
                {{--                                    <span class="sub-item">Jsvectormap</span>--}}
                {{--                                </a>--}}
                {{--                            </li>--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a data-bs-toggle="collapse" href="#charts">--}}
                {{--                        <i class="far fa-chart-bar"></i>--}}
                {{--                        <p>Charts</p>--}}
                {{--                        <span class="caret"></span>--}}
                {{--                    </a>--}}
                {{--                    <div class="collapse" id="charts">--}}
                {{--                        <ul class="nav nav-collapse">--}}
                {{--                            <li>--}}
                {{--                                <a href="charts/charts.html">--}}
                {{--                                    <span class="sub-item">Chart Js</span>--}}
                {{--                                </a>--}}
                {{--                            </li>--}}
                {{--                            <li>--}}
                {{--                                <a href="charts/sparkline.html">--}}
                {{--                                    <span class="sub-item">Sparkline</span>--}}
                {{--                                </a>--}}
                {{--                            </li>--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="widgets.html">--}}
                {{--                        <i class="fas fa-desktop"></i>--}}
                {{--                        <p>Widgets</p>--}}
                {{--                        <span class="badge badge-success">4</span>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a data-bs-toggle="collapse" href="#submenu">--}}
                {{--                        <i class="fas fa-bars"></i>--}}
                {{--                        <p>Menu Levels</p>--}}
                {{--                        <span class="caret"></span>--}}
                {{--                    </a>--}}
                {{--                    <div class="collapse" id="submenu">--}}
                {{--                        <ul class="nav nav-collapse">--}}
                {{--                            <li>--}}
                {{--                                <a data-bs-toggle="collapse" href="#subnav1">--}}
                {{--                                    <span class="sub-item">Level 1</span>--}}
                {{--                                    <span class="caret"></span>--}}
                {{--                                </a>--}}
                {{--                                <div class="collapse" id="subnav1">--}}
                {{--                                    <ul class="nav nav-collapse subnav">--}}
                {{--                                        <li>--}}
                {{--                                            <a href="#">--}}
                {{--                                                <span class="sub-item">Level 2</span>--}}
                {{--                                            </a>--}}
                {{--                                        </li>--}}
                {{--                                        <li>--}}
                {{--                                            <a href="#">--}}
                {{--                                                <span class="sub-item">Level 2</span>--}}
                {{--                                            </a>--}}
                {{--                                        </li>--}}
                {{--                                    </ul>--}}
                {{--                                </div>--}}
                {{--                            </li>--}}
                {{--                            <li>--}}
                {{--                                <a data-bs-toggle="collapse" href="#subnav2">--}}
                {{--                                    <span class="sub-item">Level 1</span>--}}
                {{--                                    <span class="caret"></span>--}}
                {{--                                </a>--}}
                {{--                                <div class="collapse" id="subnav2">--}}
                {{--                                    <ul class="nav nav-collapse subnav">--}}
                {{--                                        <li>--}}
                {{--                                            <a href="#">--}}
                {{--                                                <span class="sub-item">Level 2</span>--}}
                {{--                                            </a>--}}
                {{--                                        </li>--}}
                {{--                                    </ul>--}}
                {{--                                </div>--}}
                {{--                            </li>--}}
                {{--                            <li>--}}
                {{--                                <a href="#">--}}
                {{--                                    <span class="sub-item">Level 1</span>--}}
                {{--                                </a>--}}
                {{--                            </li>--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                </li>--}}
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
