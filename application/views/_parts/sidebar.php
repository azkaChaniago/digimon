<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active': '' ?>">
        <a class="nav-link" href="<?php echo site_url('admin') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <!-- <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'posts' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-clipboard"></i>
            <span>Indirect Sales</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/superuser/') ?>">Coverage</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/superuser/') ?>">Target Assignment</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/superuser/') ?>">Histori Order</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/superuser/') ?>">Scorecard</a>
        </div>
    </li> -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('admin/superuser/user') ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>User</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('admin/superuser/outlet') ?>">
            <i class="fas fa-fw fa-store"></i>
            <span>Outlet</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('admin/superuser/tdc') ?>">
            <i class="fas fa-fw fa-building"></i>
            <span>TDC</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('admin/superuser/marketing') ?>">
            <i class="fas fa-fw fa-suitcase"></i>
            <span>Marketing / Canvasser</span></a>
    </li>
</ul>
