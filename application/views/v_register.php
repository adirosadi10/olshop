<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Register</p>
        <?php
        echo validation_errors('<div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');

        echo form_open('pelanggan/register') ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" value="<?= set_value('nama_pelanggan') ?>" name="nama_pelanggan" required placeholder="Nama Lengkap">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" value="<?= set_value('email') ?>" name="email" required placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" value="<?= set_value('password') ?>" name="password" required placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" value="<?= set_value('repassword') ?>" name="repassword" required placeholder="Re-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <p>Sudah punya akun?
              <a href="<?= base_url('pelanggan/login') ?>" class="text-center">Login</a>
            </p>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
        <?php echo form_close() ?>

      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <div class="col-sm-4"></div>
</div>
<br>
<br>
<br>