<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="<?= base_url() ?>assets/slide/banner1.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?= base_url() ?>assets/slide/banner2.png" alt="Second slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<div class="card card-solid">
  <div class="card-body pb-0">
    <div class="row d-flex align-items-stretch">
      <?php foreach ($barang as $key => $value) { ?>
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
          <?php
          echo form_open('belanja/add');
          echo form_hidden('id', $value->id_barang);
          echo form_hidden('qty', 1);
          echo form_hidden('price', $value->harga);
          echo form_hidden('name', $value->nama_barang);
          echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
          ?>
          <div class="card bg-light">
            <div class="card-header text-muted border-bottom-0">
              <img src="<?= base_url('assets/gambar/' . $value->gambar) ?>" width="100%">
            </div>
            <div class="card-body pt-0">
              <a href="#">
                <h2 class="lead" style="text-decoration: none;"><b><?= $value->nama_barang; ?></b></h2>
              </a>
              <p class="text-muted text-sm"><b>Rp. <?= number_format($value->harga, 0); ?></b></p>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-6">
                  <div class="text-left">
                    <a href="<?= base_url('home/detail_barang/' . $value->id_barang) ?>" class="btn btn-sm btn-success">
                      <i class="fas fa-eye"></i> Details
                    </a>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <div class="text-right">
                    <button class="btn btn-sm btn-primary swalDefaultSuccess">
                      <i class="fas fa-cart-plus"></i> Tambah
                    </button>
                  </div>
                </div>
                <!-- /.col -->
              </div>


            </div>
          </div>
          <?php echo form_close() ?>
        </div>
      <?php }  ?>
    </div>
  </div>
</div>

<script src="<?= base_url() ?>template/plugins/sweetalert2/sweetalert2.min.js"></script>
<script type="text/javascript">
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
  })
</script>