<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-solid fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Diary Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
        <a class="nav-link {{ request()->is('admin*') ? 'active-bg' : '' }}" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Nav Item - Charts -->
    <li class="nav-item {{ Str::is('diaries*', request()->route()->getName()) ? 'active' : '' }}">
    <a class="nav-link {{ Str::is('diaries*', request()->route()->getName()) ? 'active-bg' : '' }}" href="{{ route('diaries.index') }}">
        <i class="fas fa-solid fa-book-open"></i>
        <span>Diaries</span>
    </a>
</li>

    <!-- Nav Item - Tables -->
    <li class="nav-item  {{ Str::is('documentations*', request()->route()->getName()) ? 'active' : '' }}">
        <a class="nav-link {{ Str::is('documentations*', request()->route()->getName()) ? 'active-bg' : '' }}" href="{{ route('documentations.index') }}">
            <i class="fas fa-solid fa-images"></i>
            <span>Documentations</span></a>
    </li>
    {{-- @if(Session::get('USERROLE') == 1 || Session::get('USERROLE') == 2) --}}
    <hr class="sidebar-divider">

    <!-- Nav Item - Approval Requests (Accessible by admin and supervisor) -->
    <li class="nav-item {{ Str::is('approval-requests*', request()->route()->getName()) ? 'active' : '' }}">
        <a class="nav-link {{ Str::is('approval-requests*', request()->route()->getName()) ? 'active-bg' : '' }}" href="{{ route('approval-requests.index') }}">
            <i class="fas fa-solid fa-file-circle-check"></i>
            <span>Approval Requests</span></a>
    </li>
    
 
    {{-- @endif --}}

    {{-- @if(Session::get('USERROLE') == 1) --}}
   
        <!-- Nav Item - Users (Accessible only by admin) -->
        <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
            <a class="nav-link {{ request()->is('users*') ? 'active-bg' : '' }}" href="{{ route('users.index') }}">
                <i class="fas fa-solid fa-users"></i> 
                <span>Users</span>
            </a>
        </li>
        
        {{-- @endif --}}

</ul>