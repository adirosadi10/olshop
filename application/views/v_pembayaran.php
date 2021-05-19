<div class="row">
  <div class="col-sm-6">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Petunjuk</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <h4>Total Bayar : Rp. <?= number_format($konfirmasi->total_bayar) ?></h4>
        <p>Silahkan lakukan transfer ke rekening dibawah ini</p>

        <?php foreach ($data_bank as $key => $value) { ?>
          <hr>
          <h6 style="text-transform: uppercase;"><b><?= $value->akun_bank; ?></b></h6>
          <p class="mb-0">No Rekening : <?= $value->no_rekening; ?></p>
          <p class="mb-0">Atas Nama : <?= $value->atas_nama; ?></p>
        <?php } ?>
      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <!-- general form elements disabled -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Nomor Order : <?= $konfirmasi->no_order ?></h3>
      </div>
      <!-- /.card-header -->
      <?php
      echo validation_errors('<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
      if (isset($error_upload)) {
        echo '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . $error_upload . '</div>';
      }
      echo form_open_multipart('pesanan_saya/bayar/' . $konfirmasi->pesanan_id)
      ?>
      <div class="card-body">
        <div class="input-group mb-3">
          <label for="inputNoRekening" class="col-sm-3 col-form-label">No Rekening</label>
          <input name="no_rekening" required class="form-control" placeholder="No Rekening">
        </div>
        <div class="input-group mb-3">
          <label for="inputAkunBank" class="col-sm-3 col-form-label">Nama Bank</label>
          <input id="inputAkunBank" name="akun_bank" required class="form-control" placeholder="Nama Bank">
        </div>
        <div class="input-group mb-3">
          <label for="inputAtasNama" class="col-sm-3 col-form-label">Atas Nama</label>
          <input name="atas_nama" required class="form-control" placeholder="Atas Nama">

        </div>
        <div class="input-group mb-3">
          <label for="inputCatatan" class="col-sm-3 col-form-label">Catatan</label>
          <textarea name="catatan" class="form-control" placeholder="Catatan"></textarea>

        </div>
        <div class="input-group mb-3">
          <label for="inputCatatan" class="col-sm-3 col-form-label">Gambar</label>
          <input type="file" name="bukti_transfer" required class="form-control" id="preview_gambar">

        </div>
        <div class="row">
          <div class="col-sm-3"></div>
          <div class="col-sm-9">
            <img id="gambar_load" src="" width="300px">
          </div>
        </div>
        <?php foreach ($ubah_jumlah as $key => $value) { ?>
          <input type="text" name="id_barang" value="<?= $value->id_barang ?>">
          <input type="text" name="jumlah" value="<?= $value->jumlah ?>">
          <input type="text" name="qty" value="<?= $value->qty ?>">
          <input type="text" name="sisa" value="<?= $sisa = $value->jumlah - $value->qty ?>">

          <!-- <input type="text" name="no_order" value="<?= $value->jumlah ?><?= $value->qty ?>"> -->
        <?php } ?>
        <input hidden type="text" name="no_order" value="<?= $konfirmasi->no_order ?>">
      </div>
      <div class="card-footer">
        <a href="<?= base_url('pesanan_saya') ?>" class="btn btn-warning text-white"><i class="fas fa-angle-double-left"></i> Kembali ke Pesanan</a>
        <button type="submit" class="btn btn-primary float-right">Konfirmasi</button>

      </div>
      <?php form_close() ?>
    </div>
  </div>
</div>
<script>
  function bacaGambar(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#gambar_load').attr('src', e.target.result)
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $('#preview_gambar').change(function() {
    bacaGambar(this)
  })
</script>