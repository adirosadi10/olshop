<div class="col-md-12">
  <!-- general form elements disabled -->
  <div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title">General Elements</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <?php
      echo validation_errors('<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
      if (isset($error_upload)) {
        echo '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . $error_upload . '</div>';
      }
      echo form_open_multipart('barang/add')
      ?>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Kategori</label>
            <select name="id_kategori" class="form-control">
              <option value="">Pilih Kategori</option>
              <?php foreach ($kategori as $key => $value) { ?>
                <option value="<?php echo $value->id_kategori ?>"><?= $value->nama_kategori; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-sm-6">
          <!-- text input -->
          <div class="form-group">
            <label>Nama Barang</label>
            <input name="nama_barang" required class="form-control" value="<?= set_value('nama_barang') ?>" placeholder="Nama barang">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <!-- checkbox -->
          <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3" placeholder="Keterangan" value="<?= set_value('Keterangan') ?>"></textarea>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Harga</label>
                <input type="number" required name="harga" class="form-control" value="<?= set_value('harga') ?>" placeholder="Harga">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Stok</label>
                <input type="number" required name="jumlah" class="form-control" value="<?= set_value('jumlah') ?>" placeholder="Stok">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Berat</label>
                <input type="number" required name="berat" class="form-control" value="<?= set_value('berat') ?>" placeholder="Berat">
              </div>
            </div>
            <div class="col-sm-6">
              <!-- radio -->
              <div class="form-group">
                <label>Status</label>
                <div class="d-flex  justify-content-start">
                  <div class="form-check mr-2">
                    <input class="form-check-input" value="on" type="radio" name="status">
                    <label class="form-check-label">ON</label>
                  </div>
                  <div class="form-check ml-2">
                    <input class="form-check-input" value="off" type="radio" name="status" checked>
                    <label class="form-check-label">OFF</label>
                  </div>

                </div>


              </div>
            </div>
          </div>

        </div>
        <div class="col-sm-6">
          <!-- select -->
          <div class="form-group">
            <label for="preview_gambar">Gambar</label>
            <input type="file" name="gambar" required class="form-control" id="preview_gambar">
          </div>
          <div class="row">
            <div class="col-sm-12">
              <img id="gambar_load" src="" width="300px">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-end">
        <a href="<?= base_url('barang') ?>" class="btn btn-default">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      <?php echo form_close() ?>
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