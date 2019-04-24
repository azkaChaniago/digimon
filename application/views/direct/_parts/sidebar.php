<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active': '' ?>">
        <a class="nav-link" href="<?php echo site_url('direct') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('direct/event') ?>">
            <i class="fas fa-fw fa-comments"></i>
            <span>Event</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('direct/penjualanharian') ?>">
            <i class="fas fa-fw fa-comments"></i>
            <span>Penjualan Harian</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('direct/saleling') ?>">
            <i class="fas fa-fw fa-comments"></i>
            <span>Foto Selling</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('direct/downlinegt') ?>">
            <i class="fas fa-fw fa-comments"></i>
            <span>Downline GT</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('direct/hvc') ?>">
            <i class="fas fa-fw fa-comments"></i>
            <span>HVC</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('direct/mercent') ?>">
            <i class="fas fa-fw fa-comments"></i>
            <span>Mercent</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('direct/sekolah') ?>">
            <i class="fas fa-fw fa-comments"></i>
            <span>Sekolah</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('direct/marketsharesekolah') ?>">
            <i class="fas fa-fw fa-comments"></i>
            <span>Market Share Sekolah</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('direct/komunitas') ?>">
            <i class="fas fa-fw fa-comments"></i>
            <span>Komunitas</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('direct/marketing') ?>">
            <i class="fas fa-fw fa-comments"></i>
            <span>Marketing</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('direct/tdc') ?>">
            <i class="fas fa-fw fa-comments"></i>
            <span>TDC</span></a>
    </li>
</ul>
