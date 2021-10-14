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
                    <form action="<?php echo ($action) ?>" method="post">
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="id_tambahsimpanan" data-toggle="tooltip" title="<?php echo ('Required') ?>">Id_tambahsimpanan&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_id_tambahsimpanan_type')) ?>" name="id_tambahsimpanan" id="id_tambahsimpanan" value="<?php echo ($data->id_tambahsimpanan); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_id_tambahsimpanan')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="id_nasabah" data-toggle="tooltip" title="<?php echo ('Required') ?>">Id_nasabah&nbsp;<code>*</code></label>
                                <select class="form-control <?php echo (session()->getFlashdata('ci_flash_message_id_nasabah_type')) ?>" id="id_nasabah" name="id_nasabah" placeholder="id_nasabah">
                                    <option value="<?php echo ($data->id_nasabah) ?>"><?php echo ($data->id_nasabah) ?></option>
                                </select>
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_id_nasabah')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="saldo" data-toggle="tooltip" title="<?php echo ('Required') ?>">Saldo&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_saldo_type')) ?>" name="saldo" id="saldo" value="<?php echo ($data->saldo); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_saldo')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="id_jenissimpanpinjam" data-toggle="tooltip" title="<?php echo ('Required') ?>">Id_jenissimpanpinjam&nbsp;<code>*</code></label>
                                <select class="form-control <?php echo (session()->getFlashdata('ci_flash_message_id_jenissimpanpinjam_type')) ?>" id="id_jenissimpanpinjam" name="id_jenissimpanpinjam" placeholder="id_jenissimpanpinjam">
                                    <option value="<?php echo ($data->id_jenissimpanpinjam) ?>"><?php echo ($data->id_jenissimpanpinjam) ?></option>
                                </select>
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_id_jenissimpanpinjam')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="tanggal" data-toggle="tooltip" title="<?php echo ('Required') ?>">Tanggal&nbsp;<code>*</code></label>
                                <input type="date" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_tanggal_type')) ?>" name="tanggal" id="tanggal" value="<?php echo ($data->tanggal); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_tanggal')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="nominal" data-toggle="tooltip" title="<?php echo ('Required') ?>">Nominal&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_nominal_type')) ?>" name="nominal" id="nominal" value="<?php echo ($data->nominal); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_nominal')) ?>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="oldid_tambahsimpanan" class="form-control" name="oldid_tambahsimpanan" style="display:none;" value="<?php echo $data->id_tambahsimpanan ?>">
                        <div class="d-flex p-2 bd-highlight">
                            <div class="form-group">
                                <a class="btn btn-sm btn-danger" href="<?php echo base_url($Page->parent.'/index') ?>"><?php echo 'Cancel' ?></a>
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
