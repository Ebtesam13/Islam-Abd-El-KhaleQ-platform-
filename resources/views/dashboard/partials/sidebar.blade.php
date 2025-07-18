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
                <li class="nav-item sidebar-menu__item {{ request()->routeIs('dashboard.') ? 'active' : '' }}">
                    <a href="{{route('dashboard.')}}" class="sidebar-menu__link">
                        <span class="icon"><i class="fas fa-th-large"></i></span>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
          
@role('teacher')
<li class="nav-item sidebar-menu__item {{ request()->routeIs('dashboard.courses.index') ? 'active' : '' }}">
    <a href="{{ route('dashboard.courses.index') }}" class="sidebar-menu__link">
        <span class="icon"><i class="fas fa-graduation-cap"></i></span>
        <span class="text">{{ __('labels.stages') }}</span>
    </a>
</li>
<li class="nav-item sidebar-menu__item {{ request()->routeIs('students.index') ? 'active' : '' }}">
    <a href="{{ route('students.index') }}" class="sidebar-menu__link">
        <span class="icon"><i class="fas fa-users"></i></span>
        <span class="text">{{ __('labels.students') }}</span>
    </a>
</li>
<li class="nav-item sidebar-menu__item {{ request()->routeIs('dashboard.codes.index') ? 'active' : '' }}">
    <a href="{{ route('dashboard.codes.index') }}" class="sidebar-menu__link">
        <span class="icon"><i class="fas fa-key"></i></span>
        <span class="text">{{ __('labels.codes') }}</span>
    </a>
</li>
<li class="nav-item sidebar-menu__item {{ request()->routeIs('dashboard.homework.index') ? 'active' : '' }}">
    <a href="{{ route('dashboard.homework.index') }}" class="sidebar-menu__link">
        <span class="icon"><i class="fas fa-book"></i></span>
        <span class="text">Homework</span>
    </a>
</li>
<li class="nav-item sidebar-menu__item {{ request()->routeIs('quizzes.index') ? 'active' : '' }}">
    <a href="{{ route('quizzes.index') }}" class="sidebar-menu__link">
        <span class="icon"><i class="fas fa-question"></i></span>
        <span class="text">Quizzes</span>
    </a>
</li>
<li class="nav-item sidebar-menu__item {{ request()->routeIs('dashboard.quiz_corrections.index') ? 'active' : '' }}">
    <a href="{{ route('dashboard.quiz_corrections.index') }}" class="sidebar-menu__link">
        <span class="icon"><i class="fas fa-question-circle"></i></span>
        <span class="text">Quiz correction</span>
    </a>
</li>
<li class="nav-item sidebar-menu__item {{ request()->routeIs('dashboard.booklets.index') ? 'active' : '' }}">
    <a href="{{ route('dashboard.booklets.index') }}" class="sidebar-menu__link">
        <span class="icon"><i class="fas fa-chalkboard-teacher"></i></span>
        <span class="text">Booklets</span>
    </a>
</li>
@endrole

{{-- STUDENT MENU --}}
@role('student')
<li class="nav-item sidebar-menu__item {{ request()->routeIs('dashboard.lectures.index') ? 'active' : '' }}">
    <a href="{{ route('dashboard.lectures.index') }}" class="sidebar-menu__link">
        <span class="icon"><i class="fas fa-video"></i></span>
        <span class="text">Lectures</span>
    </a>
</li>
<li class="nav-item sidebar-menu__item {{ request()->routeIs('dashboard.homework.index') ? 'active' : '' }}">
    <a href="{{ route('dashboard.homework.index') }}" class="sidebar-menu__link">
        <span class="icon"><i class="fas fa-book"></i></span>
        <span class="text">Homework</span>
    </a>
</li>
<li class="nav-item sidebar-menu__item {{ request()->routeIs('quizzes.index') ? 'active' : '' }}">
    <a href="{{ route('quizzes.index') }}" class="sidebar-menu__link">
        <span class="icon"><i class="fas fa-question"></i></span>
        <span class="text">Quizzes</span>
    </a>
</li>
<li class="nav-item sidebar-menu__item {{ request()->routeIs('dashboard.quiz_corrections.index') ? 'active' : '' }}">
    <a href="{{ route('dashboard.quiz_corrections.index') }}" class="sidebar-menu__link">
        <span class="icon"><i class="fas fa-question-circle"></i></span>
        <span class="text">Quiz correction</span>
    </a>
</li>
<li class="nav-item sidebar-menu__item {{ request()->routeIs('dashboard.booklets.index') ? 'active' : '' }}">
    <a href="{{ route('dashboard.booklets.index') }}" class="sidebar-menu__link">
        <span class="icon"><i class="fas fa-chalkboard-teacher"></i></span>
        <span class="text">Booklets</span>
    </a>
</li>
@endrole

{{-- PARENT MENU --}}
@role('parent')
<li class="nav-item sidebar-menu__item {{ request()->routeIs('scores.index') ? 'active' : '' }}">
    <a href="{{ route('scores.index') }}" class="sidebar-menu__link">
        <span class="icon"><i class="fas fa-chart-bar"></i></span>
        <span class="text">Scores</span>
    </a>
</li>
@endrole

{{-- ACCOUNT SETTINGS --}}
<li class="nav-item sidebar-menu__item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
    <a href="{{ route('profile.edit') }}" class="sidebar-menu__link">
        <span class="icon"><i class="fas fa-cog"></i></span>
        <span class="text">Account Settings</span>
    </a>
</li>

            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
