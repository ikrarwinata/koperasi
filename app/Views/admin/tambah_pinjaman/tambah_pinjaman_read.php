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
                            <th width="15%">id_pinjaman</th><td>: <?php echo ($data->id_pinjaman); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">id_nasabah</th><td>: <?php echo ($data->id_nasabah); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">id_jenissimpanpinjam</th><td>: <?php echo ($data->id_jenissimpanpinjam); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">jumlah_pinjaman</th><td>: <?php echo ($data->jumlah_pinjaman); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">lama_angsuran</th><td>: <?php echo ($data->lama_angsuran); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">total_angsuran</th><td>: <?php echo ($data->total_angsuran); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">awal_pembayaran</th><td>: <?php echo ($data->awal_pembayaran); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">akhir_pembayaran</th><td>: <?php echo ($data->akhir_pembayaran); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">jaminan</th><td>: <?php echo ($data->jaminan); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">tgl_pencairan</th><td>: <?php echo ($data->tgl_pencairan); ?></td>
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
