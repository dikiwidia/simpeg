<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="row top_tiles">
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-user"></i></div>
          <div class="count"><?php echo read_custom_numrows_table('speg_data_karyawan'); ?></div>
          <h3>Karyawan</h3>
          <p>Keseluruhan yang terdaftar</p>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-briefcase"></i></div>
          <div class="count"><?php echo read_custom_numrows_table('speg_data_unit'); ?></div>
          <h3>Unit</h3>
          <p>Departemen kerja tersedia</p>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-exchange"></i></div>
          <div class="count"><?php echo read_custom_numrows_table('speg_transaksi_k'); ?></div>
          <h3>Transaksi</h3>
          <p>Gaji karyawan (bulanan)</p>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-check-square-o"></i></div>
          <div class="count"><?php echo read_custom_numrows('speg_supervisi',array('dari_konfirmasi_supervisi' => 'Y', 'ke_konfirmasi_supervisi' => 'Y')); ?></div>
          <h3>Tugas</h3>
          <p>Yang telah diselesaikan</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="jumbotron">
      <h1>Sistem Informasi Manajemen Kepegawaian</h1>
      <p>Selamat Datang <strong>Administrator</strong></p>
    </div>
  </div>
  <a class="btn btn-app" href="<?php echo base_url(); ?>master/bio">
      <span class="badge bg-green">Baru</span>
      <i class="fa fa-user"></i> Biodata
    </a>
    <a class="btn btn-app" href="<?php echo base_url(); ?>master/gaji">
      <span class="badge bg-green">Baru</span>
      <i class="fa fa-usd"></i> Master Gaji
    </a>
    <a class="btn btn-app" href="<?php echo base_url(); ?>master/tunjangan">
      <span class="badge bg-green">Baru</span>
      <i class="fa fa-calculator"></i> Tunjangan
    </a>
    <a class="btn btn-app" href="<?php echo base_url(); ?>master/potongan">
      <span class="badge bg-green">Baru</span>
      <i class="fa fa-level-down"></i> Potongan
    </a>
    <a class="btn btn-app" href="<?php echo base_url(); ?>master/jabstruk">
      <span class="badge bg-green">Baru</span>
      <i class="fa fa-pagelines"></i> Jabatan
    </a>
    <a class="btn btn-app" href="<?php echo base_url(); ?>master/unit">
      <span class="badge bg-green">Baru</span>
      <i class="fa fa-briefcase"></i> Unit
    </a>
    <a class="btn btn-app" href="<?php echo base_url(); ?>trans/bgkar/new">
      <span class="badge bg-green">Baru</span>
      <i class="fa fa-exchange"></i> Transaksi
    </a>
    <a class="btn btn-app" href="<?php echo base_url(); ?>karyawan/jabstruk/new">
      <span class="badge bg-green">Baru</span>
      <i class="fa fa-code-fork"></i> Struktural
    </a>
    <a class="btn btn-app" href="<?php echo base_url(); ?>karyawan/angkat/new">
      <span class="badge bg-green">Baru</span>
      <i class="fa fa-users"></i> Karyawan
    </a>
    <a class="btn btn-app" href="<?php echo base_url(); ?>karyawan/golgaji/new">
      <span class="badge bg-green">Baru</span>
      <i class="fa fa-money"></i> Gol. Gaji
    </a>
    <a class="btn btn-app" href="<?php echo base_url(); ?>keluar">
      <i class="fa fa-sign-out"></i> Keluar
    </a>
</div>