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
                                <label for="id_nasabah_admin" data-toggle="tooltip" title="<?php echo ('Required') ?>">Nasabah&nbsp;<code>*</code></label>
                                <select class="form-control select2bs4 <?php echo (session()->getFlashdata('ci_flash_message_id_nasabah_type')) ?>" id="id_nasabah_admin" name="id_nasabah" placeholder="id_nasabah">
                                    <option value="--------------">Pilih Nasabah</option>
                                    <?php foreach ($datanasabah as $key => $value) : ?>
                                        <option value="<?php echo ($value->id_nasabah) ?>" <?php echo (inputSelect($value->id_nasabah, $data->id_nasabah)) ?>><?php echo ($value->nama) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_id_nasabah')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="saldo" data-toggle="tooltip" title="<?php echo ('Required') ?>">Saldo Saat Ini&nbsp;<code>*</code></label>
                                <input type="text" class="form-control" value="" id="display-saldo" readonly />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="nominal" data-toggle="tooltip" title="<?php echo ('Required') ?>">Nominal&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_nominal_type')) ?>" name="nominal" id="nominal_ambil" value="<?php echo ($data->nominal); ?>" min="1" required placeholder="Masukan nilai yang akan diambil" />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_nominal')) ?>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="saldo" id="saldo" value="" />
                        <input type="hidden" id="oldid_ambilsimpanan" class="form-control" name="oldid_ambilsimpanan" style="display:none;" value="<?php echo $data->id_ambilsimpanan ?>">
                        <div class="d-flex p-2 bd-highlight">
                            <div class="form-group">
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