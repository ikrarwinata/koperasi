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
                            <th width="15%">Id_jenissimpanpinjam</th><td>: <?php echo ($data->Id_jenissimpanpinjam); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">nasabah</th><td>: <?php echo ($data->nasabah); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">jenis</th><td>: <?php echo ($data->jenis); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">bunga_simpanan</th><td>: <?php echo ($data->bunga_simpanan); ?>%</td>
                        </tr>
                            <tr>
                            <th width="15%">bunga_pinjaman</th><td>: <?php echo ($data->bunga_pinjaman); ?>%</td>
                        </tr>
                            <tr>
                            <th width="15%">denda_pinjaman</th><td>: <?php echo ($data->denda_pinjaman); ?>%</td>
                        </tr>
                            <tr>
                            <th width="15%">keterangan</th><td>: <?php echo ($data->keterangan); ?></td>
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
