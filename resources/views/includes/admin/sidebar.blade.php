    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
          <div class="sidebar-brand-text mx-3">
              Larashop Administrator </div>  
                  
        </a>
        
  
  
        <!-- Divider -->
        <hr class="sidebar-divider">
  
        <!-- Heading -->
        <div class="sidebar-heading">
          Interface home
        </div>
        
        {{-- home --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>home</span></a>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          Data Users
        </div>

         <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-cog"></i>
            <span>Manage Users</span>
          </a>
          <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">This Components Users:</h6>
              <a class="collapse-item" href="{{ route('data-users.index') }}">Data users</a>
              <a class="collapse-item" href="{{ route('create-users.create') }}">Add Users</a>
            </div>
          </div>
        </li>
                 
                
        <!-- Divider -->
        <hr class="sidebar-divider">
  
        <!-- Heading -->
        <div class="sidebar-heading">
          Categories
        </div>
        
          <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Manage Categories</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">This Components Users:</h6>
              <a class="collapse-item" href="{{ route('categories.index') }}">Data categories</a>
              <a class="collapse-item" href="{{ route('categories.create') }}">Add Category</a>
            </div>
          </div>
        </li>



        <!-- Heading -->
        <div class="sidebar-heading">
          Books
        </div>

         <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Buku</span>
          </a>
          <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{ route('book.index') }}">Data Buku</a>
              <a class="collapse-item" href="{{ route('book.create') }}">Add Buku</a>
            </div>
          </div>
        </li>

        <!-- Heading -->
        <div class="sidebar-heading">
          orders
        </div>

         <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTree" aria-expanded="true" aria-controls="collapseTree">
            <i class="fas fa-fw fa-cog"></i>
            <span>Orders</span>
          </a>
          <div id="collapseTree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{ route('orders.index') }}">Data Orders</a>
            </div>
          </div>
        </li>

         <!-- Divider -->
         <hr class="sidebar-divider">
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
  
      </ul>
      <!-- End of Sidebar -->