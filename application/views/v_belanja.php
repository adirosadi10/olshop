<div class="card card-solid">
  <div class="card-body pb-0">
    <div class="row">
      <div class="col-sm-12">
        <?php echo form_open('belanja/update'); ?>

        <table class="table" cellpadding="6" cellspacing="1" style="width:100%">

          <tr>
            <th>No.</th>
            <th>Nama Barang</th>
            <th class="text-center" width="110px">QTY</th>
            <th style="text-align:right">Berat</th>
            <th style="text-align:right">Harga</th>
            <th style="text-align:right">Sub-Total</th>
            <th class="text-center">Action</th>
          </tr>

          <?php $i = 1; ?>

          <?php
          $total_berat = 0;
          foreach ($this->cart->contents() as $items) {
            $barang = $this->m_home->detail_barang($items['id']);
            $berat = $items['qty'] * $barang->berat;
            $total_berat = $total_berat + $berat;
          ?>

            <tr>
              <td><?= $i; ?></td>
              <td>
                <?php echo $items['name']; ?>
              </td>
              <td class="text-center"><?php echo form_input(array('name' => $i . '[qty]', 'value' => $items['qty'], 'min' => '1', 'type' => 'number', 'class' => 'form-control', 'maxlength' => '3', 'size' => '5')); ?></td>
              <td style="text-align:right"><?= $berat ?>gr</td>
              <td style="text-align:right">Rp. <?= number_format($items['price']); ?></td>
              <td style="text-align:right">Rp. <?= number_format($items['subtotal']); ?></td>
              <td class="text-center"><a href="<?= base_url('belanja/delete/' . $items['rowid']) ?>" class="btn btn-danger"><i class="fa fa-trash"></i>
                </a></td>
            </tr>

            <?php $i++; ?>
          <?php } ?>


          <tr>
            <td colspan="2"> </td>
            <td style="text-align:left">Total Berat :</td>
            <td style="text-align:right"><strong><?= $total_berat; ?> gr</strong></td>
            <td style="text-align:right">Total.Harga :</td>
            <td style="text-align:right"><strong>Rp. <?= number_format($this->cart->total()); ?></strong></td>
            <td></td>
          </tr>

        </table>

        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
        <a href="<?= base_url('belanja/clear') ?>" class="btn btn-danger"><i class="fa fa-redo"></i> Clear</a>
        <a href="<?= base_url('belanja/checkout') ?>" class="btn btn-success"><i class="fa fa-check"></i> Checkout</a>

        <?php echo form_close() ?>
        <br>
      </div>
    </div>
  </div>
</div>