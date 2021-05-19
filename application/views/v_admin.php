<div class="col-lg-3 col-6">
  <div class="info-box">
    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-bill-wave"></i></span>
    <div class="info-box-content">
      <span class="info-box-text text-blaxk">Pendapatan</span>
      <span class="info-box-text text-blaxk">Hari Ini</span>
      <span class="info-box-number">
        Rp. <?= number_format($hari_ini['tqty']); ?>
      </span>
      <!-- <a href="<?= base_url('barang') ?>" class="small-box-footer">More info</a> -->
    </div>
    <!-- /.info-box-content -->
  </div>

  <!-- /.info-box -->
</div>
<div class="col-lg-3 col-6">

  <div class="info-box">
    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Pesanan Baru</span>
      <span class="info-box-number">
        <?= $pesanan_baru; ?>
      </span>
      <a href="<?= base_url('admin/pesanan') ?>" class="small-box-footer">More info</a>
    </div>
    <!-- /.info-box-content -->
  </div>

  <!-- /.info-box -->
</div>
<div class="col-lg-3 col-6">

  <div class="info-box">
    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cubes"></i></span>

    <div class="info-box-content">
      <span class="info-box-text text-blaxk">Barang</span>
      <span class="info-box-number">
        <?= $total_barang; ?>
      </span>
      <a href="<?= base_url('barang') ?>" class="small-box-footer">More info</a>
    </div>
    <!-- /.info-box-content -->
  </div>

  <!-- /.info-box -->
</div>
<div class="col-lg-3 col-6">

  <div class="info-box">
    <span class="info-box-icon bg-blue elevation-1"><i class="fas fa-list"></i></span>

    <div class="info-box-content">
      <span class="info-box-text text-black">Kategori</span>
      <span class="info-box-number">
        <?= $total_kategori; ?>
      </span>
      <a href="<?= base_url('kategori') ?>" class="small-box-footer">More info</a>
    </div>
    <!-- /.info-box-content -->
  </div>

  <!-- /.info-box -->
</div>




<div class="col-lg-12">
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title text-center">Grafik Penjualan</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
        </button>
        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
      </div>
    </div>
    <div class="card-body">
      <?php foreach ($grafik as $key  => $value) {
        $a = number_format($value->tqty);
        $bulan[] = $value->nama;
        $total[] = $value->tqty;
      } ?>
      <p class="text-center"></p>
      <div class="chart">
        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
</div>
<script src="<?= base_url() ?>template/plugins/chart.js/Chart.min.js"></script>
<script>
  $(function() {
    var areaChartData = {
      labels: <?php echo json_encode($bulan) ?>,
      datasets: [{
          label: 'Penjualan',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: <?php echo json_encode($total) ?>
        },

      ]
    }
    var areaChartOptions = {
      maintainAspectRatio: false,
      responsive: true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false,
          }
        }],
        yAxes: [{
          ticks: {
            beginAtZero: true
          },
          gridLines: {
            display: true,
          }
        }]
      }
    }


    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)


    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: areaChartOptions,
    })
  })
</script>