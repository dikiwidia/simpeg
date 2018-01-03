<?php
$url = base_url();
$ses = $this->session->userdata['user']
?>
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>Menu Utama</h3>
    <ul class="nav side-menu">
      <?php 
        if($ses['level_user'] > 2){
          echo '<li><a href="'.$url.'"><i class="fa fa-dashboard"></i> '.user_data('nama_user').'</a></li>';
        } else {
      ?>
      <li><a><i class="fa fa-user"></i> <?php echo user_data('nama_user');?> <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?php echo $url; ?>">Biodata</a></li>
          <li><a href="<?php echo $url; ?>user/tugas">Penugasan</a></li>
          <li><a href="<?php echo $url; ?>user/gaji">Gaji</a></li>
          <li><a href="<?php echo $url; ?>user/cuti">Cuti</a></li>
          <li><a href="<?php echo $url; ?>user/akun">Pengaturan Akun</a></li>
        </ul>
      </li>
      <?php } if($ses['level_user'] > 1){?>
      <li><a><i class="fa fa-users"></i> Karyawan<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?php echo $url; ?>karyawan/angkat">Data Karyawan</a></li>
          <li><a href="<?php echo $url; ?>karyawan/jabstruk">Jabatan Struktural</a></li>
          <!-- NEW FEATURE !
          <li><a href="<?php echo $url; ?>karyawan/tugas">Data Penugasan Karyawan</a></li>
          <li><a href="<?php echo $url; ?>karyawan/cuti">Data Cuti Karyawan</a></li>
          -->
          <li><a href="<?php echo $url; ?>karyawan/golgaji">Data Gaji Karyawan</a></li>
        </ul>
      </li>
      <?php } if($ses['level_user'] > 1){ ?>
      <li><a><i class="fa fa-database"></i> Master Data <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?php echo $url; ?>master/bio">Biodata</a></li>
          <li><a href="<?php echo $url; ?>master/gaji">Gaji Golongan</a></li>
          <li><a href="<?php echo $url; ?>master/tunjangan">Tunjangan</a></li>
          <li><a href="<?php echo $url; ?>master/potongan">Potongan</a></li>
          <li><a href="<?php echo $url; ?>master/jabstruk">Jabatan Struktural</a></li>
          <li><a href="<?php echo $url; ?>master/unit">Unit Kerja</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-exchange"></i> Transaksi <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?php echo $url; ?>trans/bgkar">Transaksi Gaji Karyawan</a></li>
          <!-- NEW FEATURE !
          <li><a href="<?php echo $url; ?>trans/bgdos">Transaksi Gaji Dosen</a></li>
          <li><a href="<?php echo $url; ?>trans/riwayat">Riwayat Transaksi</a></li>
          -->
        </ul>
      </li>
      <?php } if($ses['level_user'] > 2) {?>
      <!-- NEW FEATURE !
      <li><a><i class="fa fa-cog"></i> Pengaturan <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?php echo $url; ?>pengaturan/">Nama Perusahaan</a></li>
        </ul>
      </li>
      -->
      <?php } ?>
    </ul>
  </div>
</div>
<!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url(); ?>keluar">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>

<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="<?php echo $url ?>upload/admin.png" alt=""><?php echo $ses['nama_user']; ?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="<?php echo $url; ?>pengaturan"><i class="fa fa-wrench pull-right"></i>  Pengaturan</a></li>
            <li><a href="<?php echo $url; ?>keluar"><i class="fa fa-sign-out pull-right"></i> Keluar</a></li>
          </ul>
        </li>

        
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->