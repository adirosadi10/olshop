<div class="col-md-12">
  <!-- general form elements disabled -->
  <div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title">Setting Lokasi</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <?php
      if ($this->session->flashdata('pesan')) {
        echo '<div class="alert alert-success alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo $this->session->flashdata('pesan');
        echo '</div>';
      }
      echo form_open('pelanggan/akun')
      ?>
      <!-- text input -->
      <div class="form-group">
        <label>Nama Lengkap</label>
        <input name="nama_pelanggan" required class="form-control" value="" placeholder="Nama Lengkap">

      </div>
      <div class="form-group">
        <label>Email</label>
        <input name="email" required class="form-control" value="" placeholder="Email">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input name="Password" required class="form-control" value="" placeholder="Password ">
      </div>

      <div class="modal-footer justify-content-end">
        <a href="<?= base_url('home') ?>" class="btn btn-default">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      <?php echo form_close() ?>
    </div>
  </div>
</div>
</div>
</div>