<div class="col-sm-12">
  <div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
      <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#semua" role="tab" aria-controls="semua" aria-selected="true">Semua</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Belum Bayar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Di Verifikasi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="custom-tabs-four-proses-tab" data-toggle="pill" href="#custom-tabs-four-proses" role="tab" aria-controls="custom-tabs-four-proses" aria-selected="false">Di Proses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Di Kirim</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" id="custom-tabs-four-selesai-tab" data-toggle="pill" href="#custom-tabs-four-selesai" role="tab" aria-controls="custom-tabs-four-selesai" aria-selected="false">Selesai</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <div class="tab-content" id="custom-tabs-four-tabContent">
        <div class="tab-pane fade show active" id="semua" role="tabpanel" aria-labelledby="semua">
          <table class="table">
            <tr>
              <th>No. Order</th>
              <th>total_bayar</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            <?php $no = 1;
            foreach ($semua_pesanan as $key => $value) { ?>
              <tr>
                <td><?= $value->no_order; ?></td>
                <td>Rp. <?= number_format($value->total_bayar) ?>
                <td><?php if ($value->status == 0) {
                      echo "Belum dibayar";
                    } elseif ($value->status == 1) {
                      echo "Menunggu verifikasi";
                    } elseif ($value->status == 2) {
                      echo "Sedang diProses";
                    } elseif ($value->status == 3) {
                      echo "Sedang dalam Pengiriman";
                    } else {
                      echo "Selesai";
                    } ?></td>
                <td>
                  <?php if ($value->status == 0) { ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#detail<?= $value->pesanan_id ?>"><i class="fas fa-edit"></i> Detail</button>
                    <a href="<?= base_url('pesanan_saya/bayar/' . $value->pesanan_id) ?>" class="btn btn-sm btn-primary">Bayar</a>
                  <?php } elseif ($value->status == 1 and 2) { ?>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#bayar<?= $value->pesanan_id ?>"><i class="fas fa-edit"></i> Bukti Bayar</button>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#detail<?= $value->pesanan_id ?>"><i class="fas fa-edit"></i> Detail</button>
                  <?php  } elseif ($value->status == 3) { ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#lacak<?= $value->pesanan_id ?>"><i class="fas fa-edit"></i></button>
                    <a href="<?= base_url('pesanan_saya/selesai/' . $value->pesanan_id) ?>" class="btn btn-sm btn-primary">Selesai</a>
                  <?php  } else { ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#lacak<?= $value->pesanan_id ?>"><i class="fas fa-edit"></i> Lacak</button>
                  <?php } ?>
                </td>
              </tr>
            <?php } ?>
          </table>
        </div>
        <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
          <table class="table">
            <tr>
              <th>No. Order</th>
              <th>total_bayar</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            <?php $no = 1;
            foreach ($belum_bayar as $key => $value) { ?>
              <tr>
                <td><?= $value->no_order; ?></td>
                <td>Rp. <?= number_format($value->total_bayar) ?>
                <td>Belum Dibayar</td>
                <td>
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#detail<?= $value->pesanan_id ?>"><i class="fas fa-edit"></i> Detail</button>
                  <a href="<?= base_url('pesanan_saya/bayar/' . $value->pesanan_id) ?>" class="btn btn-sm btn-primary">Bayar</a>
                </td>
              </tr>
            <?php } ?>
          </table>
        </div>
        <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
          <table class="table">
            <tr>
              <th>No. Order</th>
              <th>Total Bayar</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            <?php $no = 1;
            foreach ($verifikasi as $key => $value) { ?>
              <tr>
                <td><?= $value->no_order; ?></td>
                <td>Rp. <?= number_format($value->total_bayar) ?></td>
                <td>Menunggu Verifikasi</td>
                <td>
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#bayar<?= $value->pesanan_id ?>"><i class="fas fa-edit"></i> Bukti Bayar</button>
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#detail<?= $value->pesanan_id ?>"><i class="fas fa-edit"></i> Detail</button>
                </td>
              </tr>
            <?php } ?>
          </table>
        </div>
        <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
          <table class="table">
            <tr>
              <th>No. Order</th>
              <th>Total Bayar</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            <?php $no = 1;
            foreach ($kirim as $key => $value) { ?>
              <tr>
                <td><?= $value->no_order; ?></td>
                <td>Rp. <?= number_format($value->total_bayar) ?></td>
                <td>Sedang Dikirim</td>
                <td>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#lacak<?= $value->pesanan_id ?>"><i class="fas fa-edit"></i> Lacak</button>
                  <a href="<?= base_url('pesanan_saya/selesai/' . $value->pesanan_id) ?>" class="btn btn-sm btn-primary">Selesai</a>
                </td>
              </tr>
            <?php } ?>
          </table>
        </div>
        <div class="tab-pane fade" id="custom-tabs-four-proses" role="tabpanel" aria-labelledby="custom-tabs-four-proses-tab">
          <table class="table">
            <tr>
              <th>No. Order</th>
              <th>Total Bayar</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            <?php $no = 1;
            foreach ($proses as $key => $value) { ?>
              <tr>
                <td><?= $value->no_order; ?></td>
                <td>Rp. <?= number_format($value->total_bayar) ?></td>
                <td>Sedang Diproses</td>
                <td>
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#bayar<?= $value->pesanan_id ?>"><i class="fas fa-edit"></i> Bukti Bayar</button>
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#detail<?= $value->pesanan_id ?>"><i class="fas fa-edit"></i> Detail</button>
                </td>
              </tr>
            <?php } ?>
          </table>
        </div>
        <div class="tab-pane fade" id="custom-tabs-four-selesai" role="tabpanel" aria-labelledby="custom-tabs-four-selesai-tab">
          <table class="table">
            <tr>
              <th>No. Order</th>
              <th>Total Bayar</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            <?php $no = 1;
            foreach ($selesai as $key => $value) { ?>
              <tr>
                <td><?= $value->no_order; ?></td>
                <td>Rp. <?= number_format($value->total_bayar) ?></td>
                <td>Selesai</td>
                <td>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#lacak<?= $value->pesanan_id ?>"><i class="fas fa-edit"></i> Lacak</button>
                </td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
    <!-- /.card -->
  </div>
</div>
<?php foreach ($detail_bayar as $key => $value) { ?>
  <div class="modal fade" id="bayar<?= $value->pesanan_id ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">No Order : <?= $value->no_order  ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row mb-0">
            <p class="col-sm-3 col-form-label">Bank </p>
            <p class="col-sm-9 col-form-label" style="text-transform: uppercase;">: <?= $value->bank  ?></p>
          </div>
          <div class="form-group row my-0">
            <p class="col-sm-3 col-form-label">No Rekening </p>
            <p class="col-sm-9 col-form-label">: <?= $value->no_rekening  ?></p>
          </div>
          <div class="form-group row my-0">
            <p class="col-sm-3 col-form-label ">Atas Nama </p>
            <p class="col-sm-9 col-form-label" style="text-transform: uppercase;">: <?= $value->atas_nama  ?></p>
          </div>
          <div class="form-group row my-0">
            <p class="col-sm-3 col-form-label">Total Bayar </p>
            <p class="col-sm-9 col-form-label">: Rp. <?= number_format($value->total_bayar) ?></p>
          </div>
          <img class="img-fluid paid" src="<?= base_url('assets/bukti_transfer/' . $value->bukti_transfer) ?>" alt="">

          <div class="modal-footer justify-content-end">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>

<?php } ?>
<?php foreach ($detail as $key => $value) { ?>
  <div class="modal fade" id="detail<?= $value->pesanan_id ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">No Order : <?= $value->no_order  ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table">
            <tr>
              <th>ID barang</th>
              <th>Total Bayar</th>
              <th>Status</th>
              <th>Action</th>
            </tr>

            <tr>
              <td><?= $value->barang_id; ?></td>
              <td><?= $value->harga; ?></td>
              <td><?= $value->qty; ?></td>
              <td><?= $value->subtotal; ?></td>
            </tr>

          </table>
          <div class="modal-footer justify-content-end">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>

<?php } ?>
<?php $no = 1;
foreach ($detail_bayar as $key => $value) { ?>
  <div class="modal fade" id="lacak<?= $value->pesanan_id ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">No Order : <?= $value->no_order  ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input hidden id="awb<?= $value->pesanan_id ?>" value="8825112045716759">
          <input hidden id="ekspedisi<?= $value->pesanan_id ?>" value="jne">
          <div id="mbody" class="card" style="border: none;">
            <table class="table">
              <tr>
                <th>No Resi : </th>
                <td style="text-align:right"><label>8825112045716759</label></td>
              </tr>
              <tr>
                <th>Kurir : </th>
                <td style="text-align:right"><label>JNE</label></td>
              </tr>
              <tr>
                <th>Tanggal : </th>
                <td style="text-align:right"><label id="date"></label></td>
              </tr>
              <tr>
                <th style="width:50%">Keterangan : </th>
                <td style="text-align:right"><label id="desc"></label></td>
              </tr>
              <tr>
                <th>Lokasi : </th>
                <td style="text-align:right"><label id="loc"></label></td>
              </tr>
            </table>
          </div>
          <div class="modal-footer justify-content-end">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button id="cek<?= $value->pesanan_id ?>" class="btn btn-primary float-right">Lacak</button>
          </div>
        </div>


        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
<?php $no++;
} ?>
<script>
  <?php $no = 1;
  foreach ($detail_bayar as $key => $value) { ?>
    $("#cek<?= $value->pesanan_id ?>").on("click", function() {
      $.ajax({
        url: 'https://api.binderbyte.com/v1/track?api_key=f14596130b8872ca306fbc6c16e423fab04a9957c109ec341c2a9250ebfad3d9',
        type: 'get',
        dataType: 'json',
        data: {
          'courier': $('#ekspedisi<?= $value->pesanan_id ?>').val(),
          'awb': $('#awb<?= $value->pesanan_id ?>').val()
        },
        success: function(result) {
          if (result.status == 200) {
            let resi = result.data;
            console.log(resi);
            $("#date").html(resi.history[0].date);
            $("#desc").html(resi.history[0].desc);
            $("#loc").html(resi.history[0].loc);
          }
        }
      });
    });
  <?php } ?>
</script>