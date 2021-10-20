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
                                <label for="id_cicilan" data-toggle="tooltip" title="<?php echo ('Required') ?>">Id_cicilan&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_id_cicilan_type')) ?>" name="id_cicilan" id="id_cicilan" value="<?php echo ($data->id_cicilan); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_id_cicilan')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="id_pinjaman" data-toggle="tooltip" title="<?php echo ('Required') ?>">Id_pinjaman&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_id_pinjaman_type')) ?>" name="id_pinjaman" id="id_pinjaman" value="<?php echo ($data->id_pinjaman); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_id_pinjaman')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="id_nasabah" data-toggle="tooltip" title="<?php echo ('Required') ?>">Id_nasabah&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_id_nasabah_type')) ?>" name="id_nasabah" id="id_nasabah" value="<?php echo ($data->id_nasabah); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_id_nasabah')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="id_jenissimpanpinjam" data-toggle="tooltip" title="<?php echo ('Required') ?>">Id_jenissimpanpinjam&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_id_jenissimpanpinjam_type')) ?>" name="id_jenissimpanpinjam" id="id_jenissimpanpinjam" value="<?php echo ($data->id_jenissimpanpinjam); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_id_jenissimpanpinjam')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="tgl_bayar" data-toggle="tooltip" title="<?php echo ('Required') ?>">Tgl_bayar&nbsp;<code>*</code></label>
                                <input type="date" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_tgl_bayar_type')) ?>" name="tgl_bayar" id="tgl_bayar" value="<?php echo ($data->tgl_bayar); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_tgl_bayar')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="jml_pinjaman" data-toggle="tooltip" title="<?php echo ('Required') ?>">Jml_pinjaman&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_jml_pinjaman_type')) ?>" name="jml_pinjaman" id="jml_pinjaman" value="<?php echo ($data->jml_pinjaman); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_jml_pinjaman')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="lama_angsuran" data-toggle="tooltip" title="<?php echo ('Required') ?>">Lama_angsuran&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_lama_angsuran_type')) ?>" name="lama_angsuran" id="lama_angsuran" value="<?php echo ($data->lama_angsuran); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_lama_angsuran')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="angsuran_ke" data-toggle="tooltip" title="<?php echo ('Required') ?>">Angsuran_ke&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_angsuran_ke_type')) ?>" name="angsuran_ke" id="angsuran_ke" value="<?php echo ($data->angsuran_ke); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_angsuran_ke')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="total_bayar" data-toggle="tooltip" title="<?php echo ('Required') ?>">Total_bayar&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_total_bayar_type')) ?>" name="total_bayar" id="total_bayar" value="<?php echo ($data->total_bayar); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_total_bayar')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="sisa_pinjaman" data-toggle="tooltip" title="<?php echo ('Required') ?>">Sisa_pinjaman&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_sisa_pinjaman_type')) ?>" name="sisa_pinjaman" id="sisa_pinjaman" value="<?php echo ($data->sisa_pinjaman); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_sisa_pinjaman')) ?>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="oldid_cicilan" class="form-control" name="oldid_cicilan" style="display:none;" value="<?php echo $data->id_cicilan ?>">
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
