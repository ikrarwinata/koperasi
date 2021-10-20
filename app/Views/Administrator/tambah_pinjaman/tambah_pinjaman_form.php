<?php
$this->extend($Template->container);
$this->section('content'); ?>
<div class="col-12">
    <?php if (session()->getFlashdata('ci_flash_message') != NULL) : ?>
        <div class="alert text-center mb-1 mt-0 <?php echo session()->getFlashdata('ci_flash_message_type') ?>" role="alert">
            <small><?php echo session()->getFlashdata('ci_flash_message') ?></small>
        </div>
    <?php endif; ?>
    <input type="hidden" id="bunga_pinjaman" value="<?php echo ($data->bunga) ?>">
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
                                <label for="jumlah_pinjaman" data-toggle="tooltip" title="<?php echo ('Required') ?>">Jumlah Pinjaman&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_jumlah_pinjaman_type')) ?>" name="jumlah_pinjaman" id="jumlah_pinjaman" value="<?php echo ($data->jumlah_pinjaman); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_jumlah_pinjaman')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="lama_angsuran" data-toggle="tooltip" title="<?php echo ('Required') ?>">Lama Angsuran <small>(bulan)</small>&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_lama_angsuran_type')) ?>" name="lama_angsuran" id="lama_angsuran" value="<?php echo ($data->lama_angsuran); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_lama_angsuran')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="total_angsuran" data-toggle="tooltip" title="<?php echo ('Required') ?>">Total Angsuran&nbsp;<code>*</code></label>
                                <input type="text" class="form-control" id="angsuran" value="" readonly />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_total_angsuran')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="awal_pembayaran" data-toggle="tooltip" title="<?php echo ('Required') ?>">Awal Pembayaran&nbsp;<code>*</code></label>
                                <input type="date" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_awal_pembayaran_type')) ?>" name="awal_pembayaran" id="awal_pembayaran" value="<?php echo ($data->awal_pembayaran); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_awal_pembayaran')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="akhir_pembayaran" data-toggle="tooltip" title="<?php echo ('Required') ?>">Akhir Pembayaran&nbsp;<code>*</code></label>
                                <input type="text" class="form-control" id="akhir_pembayaran2" value="<?php echo ($data->akhir_pembayaran); ?>" readonly />
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
                                <label for="tgl_pencairan" data-toggle="tooltip" title="<?php echo ('Required') ?>">Tanggal Pencairan&nbsp;<code>*</code></label>
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
                        <input type="hidden" name="total_angsuran" id="total_angsuran" />
                        <input type="hidden" name="sisa" id="sisa" />
                        <input type="hidden" name="akhir_pembayaran" id="akhir_pembayaran" value="" />
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