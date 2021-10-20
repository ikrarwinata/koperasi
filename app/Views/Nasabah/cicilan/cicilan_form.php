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
                    <form action="<?php echo ($action) ?>" method="post">
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="jml_pinjaman" data-toggle="tooltip" title="<?php echo ('Required') ?>">Jumlah Pinjaman&nbsp;<code>*</code></label>
                                <input type="text" class="form-control" value="Rp. <?php echo (formatNumber($data->jml_pinjaman)); ?>" readonly />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="sisa_pinjaman" data-toggle="tooltip" title="<?php echo ('Required') ?>">Sisa Pinjaman&nbsp;<code>*</code></label>
                                <input type="text" class="form-control" value="Rp. <?php echo (formatNumber($data->sisa_pinjaman)); ?>" readonly />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_sisa_pinjaman')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="lama_angsuran" data-toggle="tooltip" title="<?php echo ('Required') ?>">Lama Angsuran&nbsp;<code>*</code></label>
                                <input type="number" class="form-control" value="<?php echo ($data->lama_angsuran); ?>" readonly />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="angsuran_ke" data-toggle="tooltip" title="<?php echo ('Required') ?>">Angsuran Ke&nbsp;<code>*</code></label>
                                <input type="number" class="form-control" value="<?php echo ($data->angsuran_ke); ?>" readonly />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="total_bayar" data-toggle="tooltip" title="<?php echo ('Required') ?>">Total Bayar&nbsp;<code>*</code></label>
                                <input type="text" class="form-control" value="Rp. <?php echo (formatNumber($data->total_bayar)); ?>" readonly />
                            </div>
                        </div>
                        <input type="hidden" name="total_bayar" id="total_bayar" value="<?php echo ($data->total_bayar); ?>" />
                        <input type="hidden" name="id_pinjaman" id="id_pinjaman" value="<?php echo ($data->id_pinjaman); ?>" />
                        <input type="hidden" class="form-control" name="angsuran_ke" id="angsuran_ke" value="<?php echo ($data->angsuran_ke); ?>" />
                        <input type="hidden" id="oldid_cicilan" class="form-control" name="oldid_cicilan" style="display:none;" value="<?php echo $data->id_cicilan ?>">
                        <div class="d-flex p-2 bd-highlight">
                            <div class="form-group">
                                <a class="btn btn-sm btn-danger" href="<?php echo base_url('Nasabah/Tambah_pinjaman/index') ?>"><?php echo 'Cancel' ?></a>
                                <button class="btn btn-sm btn-primary" type="submit"><?php echo 'Save' ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>