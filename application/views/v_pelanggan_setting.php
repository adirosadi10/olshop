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
      echo form_open('admin/setting')
      ?>
      <div class="row">
        <div class="col-sm-12">
          <!-- text input -->
          <div class="form-group">
            <label>Nama Toko</label>
            <input name="nama_toko" required class="form-control" value="<?= $dataset->nama_toko ?>" placeholder="Nama Toko">
          </div>
        </div>
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
            <label>Distrik</label>
            <select name="nama_distrik" class="form-control">
              <option value="<?= $dataset->lokasi ?>"><?= $dataset->lokasi ?></option>

            </select>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-sm-6">
          <!-- checkbox -->
          <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat" value="<?= set_value('alamat') ?>"><?= $dataset->alamat ?></textarea>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>No. Telp</label>
            <input type="number" required name="no_telp" class="form-control" value="<?= $dataset->no_telp ?>" placeholder="No. Telp">
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>Email</label>
            <input type="text" required name="email" class="form-control" value="<?= $dataset->email ?>" placeholder="Email">
          </div>
        </div>


      </div>
      <div class="modal-footer justify-content-end">
        <a href="<?= base_url('admin') ?>" class="btn btn-default">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      <?php echo form_close() ?>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $.ajax({
      type: 'POST',
      url: "<?= base_url('ongkir/provinsi') ?>",
      success: function(hasil_provinsi) {
        $("select[name=nama_provinsi]").html(hasil_provinsi);
        console.log(hasil_provinsi)
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
        }
      })
    });


  });
</script>