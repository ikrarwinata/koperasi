<?php
$this->extend($Template->container);
$this->section('content'); ?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?php echo $Page->title; ?></h3>
        </div>
    </div>
    <div class="clearfix"></div>

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
                            <th width="15%">id_cicilan</th><td>: <?php echo ($data->id_cicilan); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">id_pinjaman</th><td>: <?php echo ($data->id_pinjaman); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">id_nasabah</th><td>: <?php echo ($data->id_nasabah); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">id_jenissimpanpinjam</th><td>: <?php echo ($data->id_jenissimpanpinjam); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">tgl_bayar</th><td>: <?php echo ($data->tgl_bayar); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">jml_pinjaman</th><td>: <?php echo ($data->jml_pinjaman); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">lama_angsuran</th><td>: <?php echo ($data->lama_angsuran); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">angsuran_ke</th><td>: <?php echo ($data->angsuran_ke); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">total_bayar</th><td>: <?php echo ($data->total_bayar); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">sisa_pinjaman</th><td>: <?php echo ($data->sisa_pinjaman); ?></td>
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
