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
                                <label for="saldo" data-toggle="tooltip" title="<?php echo ('Required') ?>">Saldo Saat Ini&nbsp;<code>*</code></label>
                                <input type="text" class="form-control" value="Rp. <?php echo (formatNumber($data->saldo)); ?>" readonly />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="nominal" data-toggle="tooltip" title="<?php echo ('Required') ?>">Nominal Simpan&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_nominal_type')) ?>" name="nominal" id="nominal" value="<?php echo ($data->nominal); ?>" required placeholder="Masukan nilai yang akan anda simpan" />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_nominal')) ?>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="oldid_tambahsimpanan" class="form-control" name="oldid_tambahsimpanan" style="display:none;" value="<?php echo $data->id_tambahsimpanan ?>">
                        <input type="hidden" name="saldo" value="<?php echo ($data->saldo); ?>" />
                        <input type="hidden" name="id_jenissimpanpinjam" id="id_jenissimpanpinjam" value="<?php echo ($data->id_jenissimpanpinjam); ?>" />
                        <div class="d-flex p-2 bd-highlight">
                            <div class="form-group">
                                <button class="btn btn-sm btn-danger" onclick="window.history.go(-1)">Cancel</button>
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