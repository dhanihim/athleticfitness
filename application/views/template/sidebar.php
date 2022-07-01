<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-dumbbell"></i>
                </div>
                <div class="sidebar-brand-text mx-2">Athletic Fitness</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url("admin") ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url("coach") ?>">
                    <i class="fas fa-fw fa-user-astronaut"></i>
                    <span>Coach</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url("member") ?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Member</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url("pricelist") ?>">
                    <i class="fas fa-fw fa-wallet"></i>
                    <span>Pricelist</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url("schedule") ?>">
                    <i class="fas fa-fw fa-business-time"></i>
                    <span>Schedule</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Action
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url("payment") ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Payment</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url("participant") ?>">
                    <i class="fas fa-fw fa-clipboard"></i>
                    <span>Participant</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->