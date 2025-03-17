 <!-- ! Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li>
        <a class="active" href="/">
        <span class="icon home" aria-hidden="true">
        </span>Dashboard</a>
    </li>
 
    <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Danh muc</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="buttons.html">Them moi danh muc</a>
            <a class="collapse-item" href="cards.html">Danh sach danh muc</a>
            </div>
        </div>
     </li>
    <!-- Nav Item - Utilities Collapse Menu -->
     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" 
        aria-expanded="true" aria-controls="collapseUtilities">
            <span>Bien the</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="buttons.html">Them moi bien the</a>
            <a class="collapse-item" href="cards.html">Danh sach bien the</a>
            </div>
        </div>
     </li>
        <-- San pham -->
     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" 
        aria-expanded="true" aria-controls="collapseUtilities">
            <span>San pham</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="buttons.html">Them moi san pham</a>
            <a class="collapse-item" href="cards.html">Danh sach san pham</a>
            </div>
        </div>
     </li>

     <-- Thong ke -->
     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" 
        aria-expanded="true" aria-controls="collapseUtilities">
            <span>Thong ke</span>
        </a>
        <div id="collapseStatistics" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="buttons.html">Doanh thu</a>
            <a class="collapse-item" href="cards.html">So luong san pham</a>
            </div>
        </div>
     </li>

     <-- don hang-->
     <li class="nav-item">
        <a class="nav-link" href="#">
            <span>Don hang</span>
        </a>
    </li>

    <--khach hang -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <span>Khach hang</span>
        </a>
    </li>

    <-- Binh luan -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <span>Binh luan</span>
        </a>
    </li>

    <--Sidebar Togger (Sidebar)-->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
  </ul>
    <!-- End of Sidebar --> 

    <-- Scoll to Top Button -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready
                    to end your current session.</div>
                <div class="modal-footer"></div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>





