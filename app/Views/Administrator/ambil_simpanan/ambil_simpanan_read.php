<?php
$this->extend($Template->container);
$this->section('content'); ?>
<div class="col-12">
    <?php if (session()->getFlashdata('ci_flash_message') != NULL) : ?>
    <div class="alert text-center mb-1 mt-0 <?php echo session()->getFlashdata('ci_flash_message_type') ?>" role="alert">
        <small><?php echo session()->getFlashdata('ci_flash_message') ?></small>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="card">
                <div class="card-body">
                    <table class="table table-light table-striped">
                        <tbody>
                            <tr>
                            <th width="15%">ID Transaksi</th><td>: <?php echo ($data->id_ambilsimpanan); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">ID Nasabah</th><td>: <?php echo ($data->id_nasabah); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">Saldo Nasabah</th><td>: <?php echo ($data->saldo); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">Tanggal Pengajuan</th><td>: <?php echo (formatDate($data->tanggal)); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">Nominal Ambil</th><td>: Rp. <?php echo (formatNumber($data->nominal)); ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex p-2 bd-highlight">
                        <a class="btn btn-sm btn-danger" href="<?php echo base_url($Page->parent . '/index') ?>"><?php echo 'Cancel' ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>
