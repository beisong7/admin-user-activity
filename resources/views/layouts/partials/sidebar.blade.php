<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
    <a class="nav-link {{ Route::is('dashboard')?'':'collapsed' }}" href="{{ route('dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
    </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
    <a class="nav-link {{ Route::is('activity/calender')?'':'collapsed' }}" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Activities</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
        <a href="{{ route('activity.calendar') }}">
            <i class="bi bi-circle"></i><span>Calendar View</span>
        </a>
        </li>
        <li>
        <a href="{{ route('activity.index')}}">
            <i class="bi bi-circle"></i><span>Activity List</span>
        </a>
        </li>
    </ul>
    </li><!-- End Tables Nav -->

    <li class="nav-item">
    <a class="nav-link {{ Route::is('users')?'':'collapsed' }}" href="{{ route('user.index') }}">
        <i class="bi bi-person"></i>
        <span>Users</span>
    </a>
    </li><!-- End Profile Page Nav -->

</ul>

</aside><!-- End Sidebar-->
