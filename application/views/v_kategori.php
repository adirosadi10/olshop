<div class="col-md-12">
  <div class="card card-gray">
    <div class="card-header">
      <h3 class="card-title">Primary Outline</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i> Add
        </button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <?php
      if ($this->session->flashdata('sukses')) {
        echo '<div class="alert alert-success alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo $this->session->flashdata('sukses');
        echo '</div>';
      }
      ?>
      <table class="table table-bordered table-striped" id="example1">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama kategori</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($kategori as $key => $value) { ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $value->nama_kategori; ?></td>
              <td>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $value->id_kategori ?>"><i class="fas fa-edit"></i></button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $value->id_kategori ?>"><i class="fas fa-trash"></i></button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<div class="modal fade" id="add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Default Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open('kategori/add') ?>
        <div class="form-group">
          <label for="inputNamakategori">Nama kategori</label>
          <input type="text" class="form-control" name="nama_kategori" required id="inputNamakategori" placeholder="Nama kategori">
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      <?php echo form_close() ?>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php foreach ($kategori as $key => $value) { ?>
  <div class="modal fade" id="delete<?= $value->id_kategori ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus <?= $value->nama_kategori; ?> </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4>Apakah anda yakin akan menghapus data ini?</h4>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <a href="<?= base_url('kategori/delete/' . $value->id_kategori) ?>" class="btn btn-primary">Hapus</a>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>

<?php } ?>
<?php foreach ($kategori as $key => $value) { ?>
  <div class="modal fade" id="edit<?= $value->id_kategori ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Kategori</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo form_open('kategori/edit/' . $value->id_kategori) ?>
          <div class="form-group">
            <label for="inputNamakategori">Nama kategori</label>
            <input type="text" class="form-control" value="<?= $value->nama_kategori ?>" name="nama_kategori" required id="inputNamakategori" placeholder="Nama kategori">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        <?php echo form_close() ?>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php } ?>