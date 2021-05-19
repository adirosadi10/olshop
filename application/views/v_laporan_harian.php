<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="invoice p-3 mb-3">
        <div class="row">
          <div class="col-12">
            <h4>
              <img src="<?= base_url() ?>assets/logo.ico" width="50px" alt=" Logo" class="brand-image align-bottom" style="opacity: .8">
              <span class="brand-text font-weight-light">Penjualan Harian</span>
              <small class="float-right">Date: <?= $tanggal ?></small>
            </h4>

          </div>
        </div>
        <div class="row">
          <div class="col-12 table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No Order</th>
                  <th>Product</th>
                  <th style="text-align:right">Harga</th>
                  <th style="text-align:center">Qty</th>
                  <th style="text-align:right">Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $grand_total = 0;
                foreach ($harian as $key => $value) {
                  $grand_total += $value->subtotal;
                ?>
                  <tr>
                    <td><?= $value->no_order ?></td>
                    <td><?= $value->nama_barang; ?></td>
                    <td style="text-align:right">Rp. <?= number_format($value->harga); ?></td>
                    <td style="text-align:center"><?= $value->qty ?></td>
                    <td style="text-align:right">Rp. <?= number_format($value->subtotal); ?></td>
                  </tr>
                <?php } ?>
                <tr>
                  <td colspan="3"> </td>
                  <td style="text-align:left">Total Berat :</td>
                  <td style="text-align:right">Rp. <?= number_format($grand_total); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <div class="row no-print">
          <div class="col-12">
            <a href="<?= base_url('laporan') ?>" class="btn btn-default"><i class="fas fa-angle-double-left"></i> Kembali</a>
            <button onclick="window.print()" class="btn btn-primary float-right"><i class="fas fa-print"></i> Print</button>
          </div>
        </div>
      </div>
      <!-- /.invoice -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</div><!-- /.container-fluid -->