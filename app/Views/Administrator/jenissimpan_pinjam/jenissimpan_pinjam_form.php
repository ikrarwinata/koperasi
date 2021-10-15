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
                                <label for="Id_jenissimpanpinjam" data-toggle="tooltip" title="<?php echo ('Required') ?>">Id_jenissimpanpinjam&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_Id_jenissimpanpinjam_type')) ?>" name="Id_jenissimpanpinjam" id="Id_jenissimpanpinjam" value="<?php echo ($data->Id_jenissimpanpinjam); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_Id_jenissimpanpinjam')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="nasabah" data-toggle="tooltip" title="<?php echo ('Required') ?>">Nasabah&nbsp;<code>*</code></label>
                                <input type="radio" name="nasabah" id="nasabah" value="<?php echo ($data->nasabah); ?>" required />&nbsp;<label for="nasabah">nasabah</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="jenis" data-toggle="tooltip" title="<?php echo ('Required') ?>">Jenis&nbsp;<code>*</code></label>
                                <input type="radio" name="jenis" id="jenis" value="<?php echo ($data->jenis); ?>" required />&nbsp;<label for="jenis">jenis</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="bunga_simpanan" data-toggle="tooltip" title="<?php echo ('Required') ?>">Bunga_simpanan&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_bunga_simpanan_type')) ?>" name="bunga_simpanan" id="bunga_simpanan" value="<?php echo ($data->bunga_simpanan); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_bunga_simpanan')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="bunga_pinjaman" data-toggle="tooltip" title="<?php echo ('Required') ?>">Bunga_pinjaman&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_bunga_pinjaman_type')) ?>" name="bunga_pinjaman" id="bunga_pinjaman" value="<?php echo ($data->bunga_pinjaman); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_bunga_pinjaman')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="denda_pinjaman" data-toggle="tooltip" title="<?php echo ('Required') ?>">Denda_pinjaman&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_denda_pinjaman_type')) ?>" name="denda_pinjaman" id="denda_pinjaman" value="<?php echo ($data->denda_pinjaman); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_denda_pinjaman')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="keterangan" data-toggle="tooltip" title="<?php echo ('Required') ?>">Keterangan&nbsp;<code>*</code></label>
                                <input type="text" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_keterangan_type')) ?>" autocomplete="on" name="keterangan" id="keterangan" maxlength="30" placeholder="Keterangan" value="<?php echo ($data->keterangan); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_keterangan')) ?>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="oldId_jenissimpanpinjam" class="form-control" name="oldId_jenissimpanpinjam" style="display:none;" value="<?php echo $data->Id_jenissimpanpinjam ?>">
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
