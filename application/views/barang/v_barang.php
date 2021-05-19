<div class="col-md-12">
  <div class="card card-gray">
    <div class="card-header">
      <h3 class="card-title">Primary Outline</h3>

      <div class="card-tools">
        <a href="<?= base_url('barang/add') ?>" class="btn btn-grey"><i class="fas fa-plus"></i> Add
        </a>
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
            <th>Kategori</th>
            <th>Nama barang</th>
            <th>Gambar</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($barang as $key => $value) { ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $value->nama_kategori; ?></td>
              <td><?= $value->nama_barang; ?></td>
              <td><img src="<?= base_url('assets/gambar/' . $value->gambar)  ?>" width="150px"></td>
              <td>Rp. <?= number_format($value->harga, 0); ?></td>
              <td><?= $value->jumlah; ?></td>
              <td>
                <a href="<?= base_url('barang/edit/' . $value->id_barang) ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $value->id_barang ?>"><i class="fas fa-trash"></i></button>
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
<?php foreach ($barang as $key => $value) { ?>
  <div class="modal fade" id="delete<?= $value->id_barang ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus <?= $value->nama_barang; ?> </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4>Apakah anda yakin akan menghapus data ini?</h4>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <a href="<?= base_url('barang/delete/' . $value->id_barang) ?>" class="btn btn-primary">Hapus</a>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>

<?php } ?>