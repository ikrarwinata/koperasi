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
                                <label for="jumlah_pinjaman" data-toggle="tooltip" title="<?php echo ('Required') ?>">Jumlah_pinjaman&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_jumlah_pinjaman_type')) ?>" name="jumlah_pinjaman" id="jumlah_pinjaman" value="<?php echo ($data->jumlah_pinjaman); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_jumlah_pinjaman')) ?>
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
                                <label for="total_angsuran" data-toggle="tooltip" title="<?php echo ('Required') ?>">Total_angsuran&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_total_angsuran_type')) ?>" name="total_angsuran" id="total_angsuran" value="<?php echo ($data->total_angsuran); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_total_angsuran')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="awal_pembayaran" data-toggle="tooltip" title="<?php echo ('Required') ?>">Awal_pembayaran&nbsp;<code>*</code></label>
                                <input type="date" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_awal_pembayaran_type')) ?>" name="awal_pembayaran" id="awal_pembayaran" value="<?php echo ($data->awal_pembayaran); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_awal_pembayaran')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="akhir_pembayaran" data-toggle="tooltip" title="<?php echo ('Required') ?>">Akhir_pembayaran&nbsp;<code>*</code></label>
                                <input type="date" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_akhir_pembayaran_type')) ?>" name="akhir_pembayaran" id="akhir_pembayaran" value="<?php echo ($data->akhir_pembayaran); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_akhir_pembayaran')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="jaminan" data-toggle="tooltip" title="<?php echo ('Required') ?>">Jaminan&nbsp;<code>*</code></label>
                                <input type="text" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_jaminan_type')) ?>" autocomplete="on" name="jaminan" id="jaminan" maxlength="40" placeholder="Jaminan" value="<?php echo ($data->jaminan); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_jaminan')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="tgl_pencairan" data-toggle="tooltip" title="<?php echo ('Required') ?>">Tgl_pencairan&nbsp;<code>*</code></label>
                                <input type="date" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_tgl_pencairan_type')) ?>" name="tgl_pencairan" id="tgl_pencairan" value="<?php echo ($data->tgl_pencairan); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_tgl_pencairan')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="keterangan" data-toggle="tooltip" title="<?php echo ('Required') ?>">Keterangan&nbsp;<code>*</code></label>
                                <input type="text" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_keterangan_type')) ?>" autocomplete="on" name="keterangan" id="keterangan" maxlength="50" placeholder="Keterangan" value="<?php echo ($data->keterangan); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_keterangan')) ?>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="oldid_pinjaman" class="form-control" name="oldid_pinjaman" style="display:none;" value="<?php echo $data->id_pinjaman ?>">
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
