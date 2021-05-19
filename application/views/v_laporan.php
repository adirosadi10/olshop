<div class="col-md-4">
  <div class="card card-gray">
    <div class="card-header">
      <h3 class="card-title">Laporan Harian</h3>
    </div>
    <?php echo form_open('laporan/lap_harian') ?>
    <div class="card-body">
      <div class="form-group">
        <label>Tanggal : </label>
        <div class="input-group date" id="reservationdate" data-target-input="nearest">
          <input type="text" name="date" class="form-control datetimepicker-input" data-target="#reservationdate" />
          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer d-flex justify-content-end">
      <button type="submit" class="btn btn-primary">Cetak</button>
    </div>
    <?php echo form_close() ?>
  </div>
</div>
<div class="col-md-4">
  <div class="card card-gray">
    <div class="card-header">
      <h3 class="card-title">Laporan Bulanan</h3>
    </div>

    <?php echo form_open('laporan/lap_bulanan') ?>

    <div class="card-body">
      <div class="form-group">
        <label>Date:</label>
        <div class="input-group date" id="reservation" data-target-input="nearest">
          <input type="text" name="bulan" class="form-control datetimepicker-input" data-target="#reservation" />
          <div class="input-group-append" data-target="#reservation" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer d-flex justify-content-end">
      <button type="submit" class="btn btn-primary">Cetak</button>
    </div>
    <?php echo form_close() ?>

  </div>
</div>
<div class="col-md-4">
  <div class="card card-gray">
    <div class="card-header">
      <h3 class="card-title">Laporan Tahunan</h3>
    </div>
    <?php echo form_open('laporan/lap_tahunan') ?>

    <div class="card-body">
      <div class="form-group">
        <label>Date:</label>
        <div class="input-group date" id="reservationyear" data-target-input="nearest">
          <input type="text" name="tahun" class="form-control datetimepicker-input" data-target="#reservationyear" />
          <div class="input-group-append" data-target="#reservationyear" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer d-flex justify-content-end">
      <button type="submit" class="btn btn-primary">Cetak</button>
    </div>
    <?php echo form_close() ?>

  </div>
</div>

<!-- date-range-picker -->
<script src="<?= base_url() ?>template/plugins/moment/moment.min.js"></script>
<script src="<?= base_url() ?>template/plugins/daterangepicker/daterangepicker.js"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url() ?>template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script>
  $(function() {
    //Date range picker
    $('#reservationdate').datetimepicker({
      format: 'YYYY/MM/DD',
      pickTime: false
    });
    $('#reservation').datetimepicker({
      format: 'YYYY/MM'
    });
    $('#reservationyear').datetimepicker({
      format: 'YYYY'
    });

  })
</script>