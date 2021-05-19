<div class="col-md-12">
  <!-- general form elements disabled -->
  <div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title">General Elements <?= $barang->nama_barang; ?></h3>
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
      echo form_open_multipart('gambarBarang/add/' . $barang->id_barang)
      ?>

      <div class="row">
        <div class="col-sm-6">
          <!-- checkbox -->
          <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3" placeholder="Keterangan" value="<?= set_value('Keterangan') ?>"></textarea>
          </div>
          <div class="form-group">
            <label for="preview_gambar">Gambar</label>
            <input type="file" name="gambar" required class="form-control" id="preview_gambar">
          </div>

        </div>
        <div class="col-sm-6">
          <!-- select -->
          <img id="gambar_load" src="" width="300px">

        </div>
      </div>
      <div class="modal-footer justify-content-end">
        <a href="<?= base_url('gambarBarang') ?>" class="btn btn-default">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      <?php echo form_close() ?>
      <hr>

      <div class="row">
        <?php foreach ($gambar as $key => $value) { ?>
          <div class="col-sm-3">
            <div class="form-group">
              <img src='<?php echo base_url("assets/gambarBarang/" . $value->gambar) ?>' width="250px" height="200px">
            </div>
            <p><?= $value->keterangan ?></p>
            <!-- <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $value->id_gambar ?>"><i class="fas fa-edit"></i></button> -->
            <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#delete<?= $value->id_gambar ?>"><i class="fas fa-trash"></i> Hapus</button>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<?php foreach ($gambar as $key => $value) { ?>
  <div class="modal fade" id="delete<?= $value->id_gambar ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus <?= $value->keterangan; ?> </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4>Apakah anda yakin akan menghapus data ini?</h4>
          <div class="form-group text-center">
            <img src='<?php echo base_url("assets/gambarBarang/" . $value->gambar) ?>' width="250px" height="200px">
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <a href="<?= base_url('gambarBarang/delete/' . $value->id_barang . '/' . $value->id_gambar) ?>" class="btn btn-primary">Hapus</a>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>

<?php } ?>


<script>
  function bacaGambar(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $(' #gambar_load').attr('src', e.target.result)
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $('#preview_gambar').change(function() {
    bacaGambar(this)
  })
</script>