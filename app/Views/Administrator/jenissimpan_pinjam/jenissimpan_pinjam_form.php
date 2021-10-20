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
                                <label for="nasabah" data-toggle="tooltip" title="<?php echo ('Required') ?>">Tipe Nasabah&nbsp;<code>*</code></label><br>
                                <input type="radio" name="nasabah" id="nasabah" value="masyarakat" required <?php echo (inputSelect($data->nasabah, 'masyarakat', 'checked')) ?> />&nbsp;<label for="nasabah">Masyarakat</label>
                                <input type="radio" name="nasabah" id="anggota" value="anggota" class="ml-5" required <?php echo (inputSelect($data->nasabah, 'anggota', 'checked')) ?> />&nbsp;<label for="anggota">Anggota</label>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="jenis" data-toggle="tooltip" title="<?php echo ('Required') ?>">Jenis&nbsp;<code>*</code></label><br>
                                <input type="radio" name="jenis" id="simp_berjangka" value="simp_berjangka" required <?php echo (inputSelect($data->jenis, 'simp_berjangka', 'checked')) ?> />&nbsp;<label for="simp_berjangka">Simpanan Berjangka</label>
                                <input type="radio" name="jenis" id="simp_biasa" value="simp_biasa" class="ml-5" required <?php echo (inputSelect($data->jenis, 'simp_biasa', 'checked')) ?> />&nbsp;<label for="simp_biasa">Simpanan Biasa</label>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="col-4 mb-3">
                                <label for="bunga_simpanan" data-toggle="tooltip" title="<?php echo ('Required') ?>">Bunga Simpanan&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_bunga_simpanan_type')) ?>" name="bunga_simpanan" id="bunga_simpanan" value="<?php echo ($data->bunga_simpanan); ?>" required placeholder="%" max="100"/>
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_bunga_simpanan')) ?>
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <label for="bunga_pinjaman" data-toggle="tooltip" title="<?php echo ('Required') ?>">Bunga Pinjaman&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_bunga_pinjaman_type')) ?>" name="bunga_pinjaman" id="bunga_pinjaman" value="<?php echo ($data->bunga_pinjaman); ?>" required placeholder="%" max="100"/>
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_bunga_pinjaman')) ?>
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <label for="denda_pinjaman" data-toggle="tooltip" title="<?php echo ('Required') ?>">Denda Pinjaman&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_denda_pinjaman_type')) ?>" name="denda_pinjaman" id="denda_pinjaman" value="<?php echo ($data->denda_pinjaman); ?>" required placeholder="%" max="100"/>
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
                        <input type="hidden" id="oldid_jenissimpanpinjam" class="form-control" name="oldid_jenissimpanpinjam" style="display:none;" value="<?php echo $data->id_jenissimpanpinjam ?>">
                        <div class="d-flex p-2 bd-highlight">
                            <div class="form-group">
                                <a class="btn btn-sm btn-danger" href="<?php echo base_url($Page->parent . '/index') ?>"><?php echo 'Cancel' ?></a>
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