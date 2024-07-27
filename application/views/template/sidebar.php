

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <!-- <a href="<?= base_url('C_Dashboard') ?>" class="brand-link">
        <img src="<?= base_url('assets/template'); ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Bank Sampah</span>
      </a> -->

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="assets/img/user.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
          <?php if ($this->session->userdata('level') == 1) : ?>
            <a href="<?= base_url('C_Admin') ?>" class="d-block"><?= $this->session->userdata('nama'); ?></a>
          <?php else : ?>
            <a href="<?= base_url('C_Nasabah') ?>" class="d-block"><?= $this->session->userdata('nama'); ?></a>
            <?php endif; ?>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            

            <?php if ($this->session->userdata('level') == 1) : ?>
              <li class="nav-item">
                <a href="<?= base_url('C_Admin') ?>" class="nav-link">
                  <i class="fas fa-user-cog nav-icon"></i>
                  <p>Admin</p>
                </a>
              </li>
            <?php endif; ?>

            <li class="nav-item">
              <a href="<?= base_url('C_Nasabah') ?>" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>Nasabah</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= base_url('C_Sampah') ?>" class="nav-link">
                <i class="fas fa-trash nav-icon"></i>
                <p>Sampah</p>
              </a>
            </li>
           

            <li class="nav-item">
              <a href="<?= base_url('C_Setor_sampah') ?>" class="nav-link">
                <i class="fas fa-dumpster nav-icon"></i>
                <p>Setor Sampah</p>
              </a>
            </li>
            

            <li class="nav-item">
              <a href="<?= base_url('C_Tarik_saldo') ?>" class="nav-link">
                <i class="fas fa-money-bill-wave nav-icon"></i>
                <p>Tarik Saldo</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= base_url('C_Dashboard') ?>" class="nav-link">
                <i class="fas fa-tachometer-alt nav-icon"></i>
                <p>Jadwal Kegiatan</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= base_url('C_Pemilahan') ?>" class="nav-link">
                <i class="fas fa-graduation-cap nav-icon"></i>
                <p>Edukasi</p>
              </a>
            </li>
           

            <li class="nav-item">
              <a href="<?= base_url('auth/logout'); ?>" class="nav-link">
                <i class="fas fa-sign-out-alt nav-icon"></i>
                <p>Keluar</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h5 class="m-0 text-dark"><?= $title ?></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#"></a></li>
                <!-- <li class="breadcrumb-item active"><?= $title ?></li> -->
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content -->
        </div>

        
        <!-- /.content-wrapper -->