<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="invoice p-3 mb-3">
        <div class="row">
          <div class="col-12">
            <h4>
              <img src="<?= base_url() ?>assets/logo.ico" width="50px" alt=" Logo" class="brand-image align-bottom" style="opacity: .8">
              <span class="brand-text font-weight-light">Penjualan Tahunan</span>
              <small class="float-right">Tahun : <?= $tahun ?></small>
            </h4>
          </div>
        </div>
        <div class="row">
          <div class="col-12 table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Bulan</th>
                  <th style="text-align:right">Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $grand_total = 0;
                foreach ($tahunan as $key => $value) {
                  $grand_total += $value->tot_sub;
                ?>
                  <tr>
                    <td>
                      <?php if (substr($value->tanggal_pesan, 5, 2) == 01) {
                        echo "Januari";
                      } elseif (substr($value->tanggal_pesan, 5, 2) == 02) {
                        echo "Februari";
                      } elseif (substr($value->tanggal_pesan, 5, 2) == 03) {
                        echo "Maret";
                      } elseif (substr($value->tanggal_pesan, 5, 2) == 04) {
                        echo "April";
                      } elseif (substr($value->tanggal_pesan, 5, 2) == 05) {
                        echo "Mei";
                      } elseif (substr($value->tanggal_pesan, 5, 2) == 06) {
                        echo "Juni";
                      } elseif (substr($value->tanggal_pesan, 5, 2) == 07) {
                        echo "Juli";
                      } elseif (substr($value->tanggal_pesan, 6, 1) == 8) {
                        echo "Agustus";
                      } elseif (substr($value->tanggal_pesan, 6, 1) == 9) {
                        echo "September";
                      } elseif (substr($value->tanggal_pesan, 5, 2) == 10) {
                        echo "Oktober";
                      } elseif (substr($value->tanggal_pesan, 5, 2) == 11) {
                        echo "November";
                      } else {
                        echo "Desember";
                      } ?>
                    </td>
                    <td style="text-align:right">Rp. <?= number_format($value->tot_sub); ?></td>
                  </tr>
                <?php } ?>
                <tr>
                  <!-- <td colspan="3"> </td> -->
                  <td style="text-align:left">Total Penjualan :</td>
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