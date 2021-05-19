<div class="col-md-12">
  <div class="card card-gray">
    <div class="card-header">
      <h3 class="card-title">Primary Outline</h3>

      <div class="card-tools">

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
            <th>Nama barang</th>
            <th>Gambar</th>
            <th>Jumlah</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($gambarBarang as $key => $value) { ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $value->nama_barang; ?></td>
              <td><img src="<?= base_url('assets/gambar/' . $value->gambar)  ?>" width="150px"></td>

              <td><?= $value->jumlah_gambar; ?></td>
              <td>
                <a href="<?= base_url('gambarBarang/add/' . $value->id_barang) ?>" class="btn btn-primary"><i class="fas fa-plus"></i>
                </a>
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