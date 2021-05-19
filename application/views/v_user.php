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
            <th>Nama User</th>
            <th>Username</th>
            <th>Password</th>
            <th>Level</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($user as $key => $value) { ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $value->nama_user; ?></td>
              <td><?= $value->username; ?></td>
              <td><?= $value->password; ?></td>
              <td><?php
                  if ($value->level_user == 1) {
                    echo '<span class="badge bg-primary">Admin</span>';
                  } elseif ($value->level_user == 2) {
                    echo '<span class="badge bg-success">User</span>';
                  } else {
                    echo '<span class="badge bg-warning">Pelanggan</span>';
                  }

                  ?>
              </td>
              <td>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $value->user_id ?>"><i class="fas fa-edit"></i></button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $value->user_id ?>"><i class="fas fa-trash"></i></button>
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
        <?php echo form_open('user/add') ?>
        <div class="form-group">
          <label for="inputNamaUser">Nama User</label>
          <input type="text" class="form-control" name="nama_user" required id="inputNamaUser" placeholder="Nama User">
        </div>
        <div class="form-group">
          <label for="inputUsername">Username</label>
          <input type="text" class="form-control" name="username" required id="inputUsername" placeholder="Username">
        </div>
        <div class="form-group">
          <label for="InputPassword">Password</label>
          <input type="password" name="password" class="form-control" required id="InputPassword" placeholder="Password">
        </div>
        <div class="form-group">
          <label>Level</label>
          <select name="level_user" class="form-control">
            <option value="1" selected>Admin</option>
            <option value="2">User</option>
          </select>
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
<?php foreach ($user as $key => $value) { ?>
  <div class="modal fade" id="delete<?= $value->user_id ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus <?= $value->nama_user; ?> </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4>Apakah anda yakin akan menghapus data ini?</h4>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <a href="<?= base_url('user/delete/' . $value->user_id) ?>" class="btn btn-primary">Hapus</a>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>

<?php } ?>
<?php foreach ($user as $key => $value) { ?>
  <div class="modal fade" id="edit<?= $value->user_id ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Default Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo form_open('user/edit/' . $value->user_id) ?>
          <div class="form-group">
            <label for="inputNamaUser">Nama User</label>
            <input type="text" class="form-control" value="<?= $value->nama_user ?>" name="nama_user" required id="inputNamaUser" placeholder="Nama User">
          </div>
          <div class="form-group">
            <label for="inputUsername">Username</label>
            <input type="text" class="form-control" name="username" value="<?= $value->username ?>" required id="inputUsername" placeholder="Username">
          </div>
          <div class="form-group">
            <label for="InputPassword">Password</label>
            <input type="password" value="<?= $value->password ?>" name="password" class="form-control" required id="InputPassword" placeholder="Password">
          </div>
          <div class="form-group">
            <label>Select</label>
            <select name="level_user" class="form-control">
              <option value="1" <?php if ($value->level_user == 1) {
                                  echo "selected";
                                } ?>>Admin</option>
              <option value="2" <?php if ($value->level_user == 2) {
                                  echo "selected";
                                } ?>>User</option>
            </select>
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