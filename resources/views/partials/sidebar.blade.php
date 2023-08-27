 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-laugh-wink"></i>
         </div>
         <div class="sidebar-brand-text mx-3">School Management</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     @if(Auth::user()->role == 'Admin')
     <li class="nav-item active">
         <a class="nav-link" href="/users">
             <i class="fas fa-fw fa-user-alt"></i>
             <span>User Management</span></a>
     </li>
     <li class="nav-item active">
         <a class="nav-link" href="/classes">
             <i class="fas fa-fw fa-list-alt"></i>
             <span>Class Management</span></a>
     </li>
     <li class="nav-item active">
         <a class="nav-link" href="/students">
             <i class="fas fa-fw fa-list-alt"></i>
             <span>Student Management</span></a>
     </li>
     <li class="nav-item active">
         <a class="nav-link" href="/attendants">
             <i class="fas fa-fw fa-list-alt"></i>
             <span>Attandance Management</span></a>
     </li>
    @elseif(Auth::user()->role == 'Teacher')
        <li class="nav-item active">
            <a class="nav-link" href="/students">
                <i class="fas fa-fw fa-list-alt"></i>
                <span>Student Management</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="/attendants">
                <i class="fas fa-fw fa-list-alt"></i>
                <span>Attandance Management</span></a>
        </li>
    @else
        <li class="nav-item active">
            <a class="nav-link" href="/students">
                <i class="fas fa-fw fa-list-alt"></i>
                <span>Student Information</span></a>
        </li>
    @endif
 </ul>
 <!-- End of Sidebar -->