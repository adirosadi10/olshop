<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
  <div class="container">
    <a href="<?= base_url() ?>" class="navbar-brand">
      <img src="<?= base_url() ?>assets/logo.ico" alt=" Logo" class="brand-image " style="opacity: .8">

      <span class="brand-text font-weight-light"><b>Olshop</b></span>
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="<?= base_url() ?>" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Contact</a>
        </li>

        <?php $kategori = $this->m_home->get_all_kategori() ?>
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Kategori</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <?php foreach ($kategori as $key => $value) { ?>

              <li><a href="c" class="dropdown-item"><?= $value->nama_kategori; ?></a></li>
            <?php } ?>
            <!-- End Level two -->
          </ul>
        </li>
        <li class="nav-item dropdown">
          <?php if ($this->session->userdata('email') == "") { ?>
            <a href="<?= base_url('pelanggan/login') ?>" class="nav-link">
              <span class="brand-text font-weight-light"><b>Log in</b></span>
            </a>
          <?php } else { ?>
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
              <span class="brand-text font-weight-light"><b><?= $this->session->userdata('nama_pelanggan'); ?></b></span>
            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="<?= base_url('pelanggan/akun') ?>" class="dropdown-item dropdown-footer">Akun</a></li>
              <li><a href="<?= base_url('pesanan_saya') ?>" class="dropdown-item dropdown-footer">Pesanan Saya</a></li>
              <li><a href="<?= base_url('pelanggan/logout') ?>" class="dropdown-item dropdown-footer">Logout</a></li>
            </ul>
          <?php } ?>
        </li>
      </ul>
    </div>

    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand">
      <!-- Messages Dropdown Menu -->
      <?php
      $keranjang = $this->cart->contents();
      $jumlah_items = 0;
      foreach ($keranjang as $key => $value) {
        $jumlah_items = $jumlah_items + $value['qty'];
      }
      ?>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-shopping-cart"></i>
          <span class="badge badge-danger navbar-badge"><?= $jumlah_items; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <?php if (empty($keranjang)) { ?>
            <a href="<?= base_url('home') ?>">
              <p>Keranjang masih kosong</p>
            </a>
            <?php } else {
            foreach ($keranjang as $key => $value) {
              $barang = $this->m_home->detail_barang($value['id'])
            ?>

              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="<?= base_url('assets/gambar/' . $barang->gambar) ?>" alt="User Avatar" class="img-size-50 mr-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      <?= $value['name']; ?>
                    </h3>
                    <p class="text-sm"> <?= $value['qty']; ?> x Rp. <?= number_format($value['price'], 0); ?></p>

                    <p class="text-sm text-muted"><i class="far fa-calculator mr-1"></i>Rp. <?= $this->cart->format_number($value['subtotal'], 0); ?></p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
            <?php } ?>
            <a href="#" class="dropdown-item">
              <div class="media">
                <div class="media-body">
                  <tr>
                    <td colspan="2"> </td>
                    <td class="right"><strong>Total : </strong></td>
                    <td class="right">Rp. <?php echo $this->cart->format_number($this->cart->total()); ?></td>
                  </tr>
                </div>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('belanja') ?>" class="dropdown-item dropdown-footer">View Cart</a>
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('belanja/checkout') ?>" class="dropdown-item dropdown-footer">CheckOut

            </a>
          <?php } ?>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->

    </ul>
  </div>
</nav>
<!-- /.navbar -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"> <?= $title ?> </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Olshop</a></li>
            <li class="breadcrumb-item"><a href="#"><?= $title; ?></a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- Main content -->
  <div class="content">
    <div class="container">