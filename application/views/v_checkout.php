<div class="invoice p-3 mb-3">
  <!-- title row -->
  <div class="row">
    <div class="col-12">
      <h4>
        <i class="fas fa-globe"></i> AdminLTE, Inc.
        <small class="float-right">Date: <?= date('d-m-Y'); ?></small>
      </h4>
    </div>
    <!-- /.col -->
  </div>

  <!-- Table row -->
  <div class="row">
    <div class="col-12 table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Barang</th>
            <th class="text-center">Qty</th>
            <th style="text-align:right">Berat</th>
            <th style="text-align:right">Harga</th>
            <th style="text-align:right">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>

          <?php
          $total_berat = 0;
          foreach ($this->cart->contents() as $items) {
            $barang = $this->m_home->detail_barang($items['id']);
            $berat = $items['qty'] * $barang->berat;
            $total_berat = $total_berat + $berat;
          ?>
            <tr>
              <td><?= $i; ?></td>
              <td>
                <?php echo $items['name']; ?>
              </td>
              <td class="text-center"><?php echo $items['qty']; ?></td>
              <td style="text-align:right"><?= $berat ?>gr</td>
              <td style="text-align:right">Rp. <?php echo number_format($items['price']); ?></td>
              <td style="text-align:right">Rp. <?php echo number_format($items['subtotal']); ?></td>
            </tr>
            <?php $i++; ?>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
  ?>
  <?php echo form_open('belanja/checkout');
  $no_order = date('Ymd') . strtoupper(random_string('alnum', 8));
  ?>
  <div class="row">
    <div class="col-8">
      <p class="lead">Estimasi</p>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <!-- <label>Nama penerima</label> -->
            <input type="text" required name="nama_penerima" class="form-control" placeholder="Nama Penerima" value="<?= set_value('nama_penerima') ?>">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <!-- <label>No. Hp</label> -->
            <input required type="number" name="no_hp_penerima" class="form-control" placeholder="No. HP" value="<?= set_value('no_hp_penerima') ?>">
          </div>
        </div>
      </div>
      <div class="form-group">
        <!-- <label>Alamat</label> -->
        <textarea required name="alamat" class="form-control" placeholder="Alamat Penerima"> <?= set_value('alamat_penerima') ?></textarea>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Provinsi</label>
            <select name="nama_provinsi" class="form-control">

            </select>
          </div>
        </div>
        <div class="col-sm-6">
          <!-- text input -->
          <div class="form-group">
            <label>Kabupaten / Kota</label>
            <select name="nama_distrik" class="form-control">

            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Ekspedisi</label>
            <select name="ekspedisi" class="form-control">

            </select>
          </div>
        </div>
        <div class="col-sm-6">
          <!-- text input -->
          <div class="form-group">
            <label>Paket</label>
            <select name="paket" class="form-control">

            </select>
          </div>
        </div>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-4">
      <p class="lead">Rincian</p>
      <div class="table-responsive">
        <table class="table">
          <tr>
            <th>Berat:</th>
            <td style="text-align:right"><strong><?= $total_berat; ?> gr</td>
          </tr>
          <tr>
            <th style="width:50%">Total:</th>
            <td style="text-align:right"><strong>Rp. <?php echo number_format($this->cart->total()); ?></td>
          </tr>
          <tr>
            <th>Ongkir:</th>
            <td style="text-align:right"><label id="ongkir"></label></td>
          </tr>
          <tr>
            <th>Total Bayar:</th>
            <td style="text-align:right"><label id="total_bayar"></label></td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <div>
    <input type="text" name="provinsi">
    <input type="text" name="tipe">
    <input type="text" name="distrik">
    <input type="text" name="kodepos">
    <input type="text" name="ekspedisi">
    <input type="text" name="paket">
    <input type="text" name="ongkir">
    <input type="text" name="estimasi">
    <input type="text" name="berat" value="<?= $total_berat; ?>">
    <input type="text" name="no_order" value="<?= $no_order ?>">
    <input type="text" name="total_bayar" value="">

  </div>
  <?php
  $i = 1;
  foreach ($this->cart->contents() as $items) {
    echo form_hidden('qty' . $i, $items['qty']);
    echo form_hidden('price' . $i, $items['price']);
    echo form_hidden('subtotal' . $i, $items['subtotal']);
    $i++;
  }
  ?>
  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-12">
      <a href="<?= base_url('belanja') ?>" class="btn btn-warning text-white"><i class="fas fa-angle-double-left"></i> Kembali ke Keranjang</a>
      <button type="submit" class="btn btn-primary  float-right" style="margin-right: 5px;">
        Lanjutkan <i class="fas fa-angle-double-right"></i>
      </button>
    </div>
  </div>
  <?php echo form_close() ?>
</div>
<script>
  $(document).ready(function() {
    $.ajax({
      type: 'POST',
      url: "<?= base_url('ongkir/provinsi') ?>",
      success: function(hasil_provinsi) {
        $("select[name=nama_provinsi]").html(hasil_provinsi);
        // console.log(hasil_provinsi)
      }
    });
    $("select[name=nama_provinsi]").on("change", function() {
      // Ambil id_provinsi ynag dipilih (dari atribut pribadi)
      var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
      $.ajax({
        type: 'post',
        url: "<?= base_url('ongkir/distrik') ?>",
        data: 'id_provinsi=' + id_provinsi_terpilih,
        success: function(hasil_distrik) {
          $("select[name=nama_distrik]").html(hasil_distrik);
          // console.log(hasil_distrik)
        }
      })
    });
  });
  $("select[name=nama_distrik]").on("change", function() {
    $.ajax({
      type: 'post',
      url: '<?= base_url('ongkir/ekspedisi') ?>',
      success: function(hasil_ekspedisi) {
        $("select[name=ekspedisi]").html(hasil_ekspedisi);
        // console.log(hasil_ekspedisi)
      }
    });
  });
  $("select[name=ekspedisi]").on("change", function() {
    // Mendapatkan data ongkos kirim
    // Mendapatkan ekspedisi yang dipilih
    var ekspedisi_terpilih = $("select[name=ekspedisi]").val();
    // Mendapatkan id_distrik yang dipilih
    var distrik_terpilih = $("option:selected", "select[name=nama_distrik]").attr("id_distrik");
    // Mendapatkan toatal berat dari inputan
    var $total_berat = <?= $berat ?>;
    $.ajax({
      type: 'post',
      url: '<?= base_url('ongkir/paket') ?>',
      data: 'ekspedisi=' + ekspedisi_terpilih + '&distrik=' + distrik_terpilih + '&berat=' + $total_berat,
      success: function(hasil_paket) {
        // console.log(hasil_paket);
        $("select[name=paket]").html(hasil_paket);
        // Meletakkan nama ekspedisi terpilih di input ekspedisi
        $("input[name=ekspedisi]").val(ekspedisi_terpilih);
        console.log(hasil_paket)
        console.log(ekspedisi_terpilih)
      }
    })
  });

  $("select[name=paket]").on("change", function() {
    var paket = $("option:selected", this).attr("paket");
    var dataongkir = $("option:selected", this).attr("ongkir");
    var etd = $("option:selected", this).attr("etd");
    var reverse = dataongkir.toString().split('').reverse().join(''),
      ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join(',').split('').reverse().join('');
    $("input[name=paket]").val(paket);
    $("#ongkir").html("Rp. " + ribuan);
    $("input[name=estimasi]").val(etd);
    $("input[name=ongkir]").val(dataongkir);

    var total_bayar = parseInt(dataongkir) + parseInt(<?= $this->cart->total() ?>)
    var reverse2 = total_bayar.toString().split('').reverse().join(''),
      ribuan_bayar = reverse2.match(/\d{1,3}/g);
    ribuan_bayar = ribuan_bayar.join(',').split('').reverse().join('');
    $("#total_bayar").html("Rp. " + ribuan_bayar);
    $("input[name=total_bayar]").val(total_bayar);
  })
  $("select[name=nama_distrik]").on("change", function() {
    var prov = $("option:selected", this).attr('nama_provinsi');
    var dist = $("option:selected", this).attr('nama_distrik');
    var tipe = $("option:selected", this).attr('tipe_distrik');
    var kodepos = $("option:selected", this).attr('kodepos');

    $("input[name=provinsi]").val(prov);
    $("input[name=distrik]").val(dist);
    $("input[name=tipe]").val(tipe);
    $("input[name=kodepos]").val(kodepos);
  });
</script>