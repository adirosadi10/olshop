<div class="card card-solid">
  <div class="card-body">
    <div class="row">
      <div class="col-12 col-sm-6">
        <h3 class="d-inline-block d-sm-none"><?= $detail_barang->nama_barang; ?></h3>
        <div class="col-12">
          <img src="<?= base_url('assets/gambar/' . $detail_barang->gambar) ?>" class="product-image" alt="Product Image">
        </div>
        <div class="col-12 product-image-thumbs">
          <div class="product-image-thumb active"><img src="<?= base_url('assets/gambar/' . $detail_barang->gambar) ?>" alt="Product Image"></div>
          <?php foreach ($detail_gambar as $key => $value) { ?>
            <div class="product-image-thumb"><img src="<?= base_url('assets/gambarBarang/' . $value->gambar) ?>" alt="Product Image"></div>
          <?php } ?>
        </div>
      </div>
      <div class="col-12 col-sm-6">
        <h3 class="my-3"><?= $detail_barang->nama_barang; ?></h3>
        <p><?= $detail_barang->keterangan; ?></p>
        <p><?= $detail_barang->berat; ?>g</p>

        <hr>
        <div class="text-color pt-2 mt-4">
          <h2 class="mb-0">
            Rp. <?= number_format($detail_barang->harga, 0); ?>
          </h2>
        </div>
        <hr>
        <?php
        echo form_open('belanja/add');
        echo form_hidden('id', $detail_barang->id_barang);
        echo form_hidden('price', $detail_barang->harga);
        echo form_hidden('name', $detail_barang->nama_barang);
        echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
        ?>
        <div class="mt-4">
          <div class="row">
            <div class="col-sm-2">
              <input type="number" name="qty" class="form-control sm" value="1" min="1">
            </div>
            <div class="col-sm-8">
              <button class="btn btn-sm btn-primary swalDefaultSuccess">
                <i class="fas fa-cart-plus"></i> Tambah
              </button>
            </div>
          </div>
        </div>
        <?php echo form_close() ?>
        <div class="mt-4 product-share">
          <a href="#" class="text-gray">
            <i class="fab fa-facebook-square fa-2x"></i>
          </a>
          <a href="#" class="text-gray">
            <i class="fab fa-twitter-square fa-2x"></i>
          </a>
          <a href="#" class="text-gray">
            <i class="fas fa-envelope-square fa-2x"></i>
          </a>
          <a href="#" class="text-gray">
            <i class="fas fa-rss-square fa-2x"></i>
          </a>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>template/dist/js/demo.js"></script>
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