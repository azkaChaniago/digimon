<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="images/user.png" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('user') ?></div>
                <div class="email"><?php echo $this->session->userdata('access') ?></div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="<?php echo site_url('login/logout') ?>"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="<?php echo $this->uri->segment(2) == 'indirect' ? 'active': ''?>">
                    <a href="<?php echo site_url('indirect/indirect') ?>">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="<?php echo $this->uri->segment(2) == 'outlet' ? 'active': ''?>">
                    <a href="<?php echo site_url('indirect/outlet') ?>">
                        <i class="material-icons">store</i>
                        <span>Outlet</span>
                    </a>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'distribusi' || $this->uri->segment(2) == 'distribusicollector') { echo 'active'; }?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">my_location</i>
                        <span>Target Assignment</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?php echo $this->uri->segment(2) == 'distribusi' ? 'active': ''?>">
                            <a href="<?php echo site_url('indirect/distribusi') ?>">Canvasser</a>
                        </li>
                        <li class="<?php echo $this->uri->segment(2) == 'distribusicollector' ? 'active': ''?>">
                            <a href="<?php echo site_url('indirect/distribusicollector') ?>">Collector</a>
                        </li>
                    </ul>
                </li>
                <li class="<?php echo $this->uri->segment(2) == 'historiorder' ? 'active': ''?>">
                    <a href="<?php echo site_url('indirect/historiorder') ?>">
                        <i class="material-icons">timer</i>
                        <span>Histori Order</span>
                    </a>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'scorecard' || $this->uri->segment(2) == 'scorecardcollector') { echo 'active'; }?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">grade</i>
                        <span>Scorecard</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?php echo $this->uri->segment(2) == 'scorecard' ? 'active': ''?>">
                            <a href="<?php echo site_url('indirect/scorecard') ?>">Canvasser</a>
                        </li>
                        <li class="<?php echo $this->uri->segment(2) == 'scorecardcollector' ? 'active': ''?>">
                            <a href="<?php echo site_url('indirect/scorecardcollector') ?>">Collector</a>
                        </li>
                    </ul>
                </li>
                <li class="<?php if($this->uri->segment(2) == 'sharereguler' || $this->uri->segment(2) == 'sharebroadband' || $this->uri->segment(2) == 'marketchart') { echo 'active'; }?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">share</i>
                        <span>Market Audit</span>
                    </a>
                    <ul class="ml-menu">
                        <!-- <li class="<?php echo $this->uri->segment(2) == 'marketchart' ? 'active': ''?>">
                            <a href="<?php echo site_url('indirect/marketchart') ?>">Marketshare Charts</a>
                        </li> -->
                        <li class="<?php echo $this->uri->segment(2) == 'sharereguler' ? 'active': ''?>">
                            <a href="javascript:void(0);" class="menu-toggle">Marketshare Reguler</a>
                            <ul class="ml-menu">
                                <li class="<?php echo $this->uri->segment(3) == 'market' ? 'active': ''?>">
                                    <a href="<?php echo site_url('indirect/sharereguler/market') ?>">Marketshare</a>
                                </li>
                                <li class="<?php echo $this->uri->segment(3) == 'recharge' ? 'active': ''?>">
                                    <a href="<?php echo site_url('indirect/sharereguler/recharge') ?>">Rechargeshare</a>
                                </li>
                                <li class="<?php echo $this->uri->segment(3) == 'sales' ? 'active': ''?>">
                                    <a href="<?php echo site_url('indirect/sharereguler/sales') ?>">Salesshare</a>
                                </li>
                            </ul>
                        </li>
                        <li class="<?php echo $this->uri->segment(2) == 'sharebroadband' ? 'active': ''?>">
                            <a href="<?php echo site_url('indirect/sharebroadband') ?>">Marketshare Broadband</a>
                        </li>
                    </ul>
                </li>
                <li class="<?php echo $this->uri->segment(2) == 'galeri' ? 'active': ''?>">
                    <a href="<?php echo site_url('indirect/galeri') ?>">
                        <i class="material-icons">photo_library</i>
                        <span>Galeri Foto</span>
                    </a>
                </li>        
                <li class="<?php echo $this->uri->segment(2) == 'laporan' ? 'active': ''?>">
                    <a href="<?php echo site_url('indirect/laporan') ?>">
                        <i class="material-icons">assignment_turned_in</i>
                        <span>Laporan</span>
                    </a>
                </li>                
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                Copyright &copy; <?php echo SITE_NAME . " " . Date('Y') ?> 
                <br>
                Template by <a href="javascript:void(0);">AdminBSB - Material Design</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.5
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
            <!-- <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li> -->
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                <ul class="demo-choose-skin">
                    <li data-theme="red" class="active">
                        <div class="red"></div>
                        <span>Red</span>
                    </li>
                    <li data-theme="pink">
                        <div class="pink"></div>
                        <span>Pink</span>
                    </li>
                    <li data-theme="purple">
                        <div class="purple"></div>
                        <span>Purple</span>
                    </li>
                    <li data-theme="deep-purple">
                        <div class="deep-purple"></div>
                        <span>Deep Purple</span>
                    </li>
                    <li data-theme="indigo">
                        <div class="indigo"></div>
                        <span>Indigo</span>
                    </li>
                    <li data-theme="blue">
                        <div class="blue"></div>
                        <span>Blue</span>
                    </li>
                    <li data-theme="light-blue">
                        <div class="light-blue"></div>
                        <span>Light Blue</span>
                    </li>
                    <li data-theme="cyan">
                        <div class="cyan"></div>
                        <span>Cyan</span>
                    </li>
                    <li data-theme="teal">
                        <div class="teal"></div>
                        <span>Teal</span>
                    </li>
                    <li data-theme="green">
                        <div class="green"></div>
                        <span>Green</span>
                    </li>
                    <li data-theme="light-green">
                        <div class="light-green"></div>
                        <span>Light Green</span>
                    </li>
                    <li data-theme="lime">
                        <div class="lime"></div>
                        <span>Lime</span>
                    </li>
                    <li data-theme="yellow">
                        <div class="yellow"></div>
                        <span>Yellow</span>
                    </li>
                    <li data-theme="amber">
                        <div class="amber"></div>
                        <span>Amber</span>
                    </li>
                    <li data-theme="orange">
                        <div class="orange"></div>
                        <span>Orange</span>
                    </li>
                    <li data-theme="deep-orange">
                        <div class="deep-orange"></div>
                        <span>Deep Orange</span>
                    </li>
                    <li data-theme="brown">
                        <div class="brown"></div>
                        <span>Brown</span>
                    </li>
                    <li data-theme="grey">
                        <div class="grey"></div>
                        <span>Grey</span>
                    </li>
                    <li data-theme="blue-grey">
                        <div class="blue-grey"></div>
                        <span>Blue Grey</span>
                    </li>
                    <li data-theme="black">
                        <div class="black"></div>
                        <span>Black</span>
                    </li>
                </ul>
            </div>
            <!-- <div role="tabpanel" class="tab-pane fade" id="settings">
                <div class="demo-settings">
                    <p>GENERAL SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Report Panel Usage</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Email Redirect</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>SYSTEM SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Notifications</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Auto Updates</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>ACCOUNT SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Offline</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Location Permission</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div> -->
        </div>
    </aside>
    <!-- #END# Right Sidebar -->
</section>