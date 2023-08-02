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
    <li class="nav-item active">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>


    
    <!-- Divider -->
    <hr class="sidebar-divider">

       <!-- Heading -->
       <div class="sidebar-heading">
        Users
        </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('diaries.index') }}">
            <i class="fas fa-solid fa-book-open"></i>
            <span>Diaries</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('documentations.index') }}">
            <i class="fas fa-solid fa-images"></i>
            <span>Documentations</span></a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Supervisor
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('approval-requests.index') }}">
            <i class="fas fa-solid fa-file-circle-check"></i>
            <span>Approval Requests</span></a>
    </li>
    
    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-solid fa-users"></i> 
             <span>Users</span></a>
    </li>
</ul>