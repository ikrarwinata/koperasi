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
                    <?php echo (form_open_multipart($action)); ?>
                    <div class="form-row">
                        <div class="col-12 mb-3">
                            <label for="username" data-toggle="tooltip" title="<?php echo ('Required') ?>">Username&nbsp;<code>*</code></label>
                            <input type="text" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_username_type')) ?>" autocomplete="on" name="username" id="username" maxlength="30" placeholder="Username" value="<?php echo ($data->username); ?>" required />
                            <div class="invalid-feedback">
                                <?php echo (session()->getFlashdata('ci_flash_message_username')) ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 mb-3">
                            <label for="password" data-toggle="tooltip" title="<?php echo ('Required') ?>">Password&nbsp;</label>
                            <input type="password" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_password_type')) ?>" autocomplete="on" name="password" id="password" maxlength="30" placeholder="Password" value="" />
                            <div class="invalid-feedback">
                                <?php echo (session()->getFlashdata('ci_flash_message_password')) ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 mb-3">
                            <label for="nama" data-toggle="tooltip" title="<?php echo ('Required') ?>">Nama&nbsp;<code>*</code></label>
                            <input type="text" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_nama_type')) ?>" autocomplete="on" name="nama" id="nama" maxlength="60" placeholder="Nama" value="<?php echo ($data->nama); ?>" required />
                            <div class="invalid-feedback">
                                <?php echo (session()->getFlashdata('ci_flash_message_nama')) ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6 mb-3">
                            <label for="no_hp" data-toggle="tooltip" title="<?php echo ('Required') ?>">HP&nbsp;<code>*</code></label>
                            <input type="text" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_no_hp_type')) ?>" autocomplete="on" name="no_hp" id="no_hp" maxlength="20" placeholder="Nomor HP yang dapat dihubungi" value="<?php echo ($data->no_hp); ?>" required />
                            <div class="invalid-feedback">
                                <?php echo (session()->getFlashdata('ci_flash_message_no_hp')) ?>
                            </div>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="ttl" data-toggle="tooltip" title="<?php echo ('Required') ?>">Tanggal Lahir&nbsp;<code>*</code></label>
                            <input type="date" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_ttl_type')) ?>" name="ttl" id="ttl" value="<?php echo ($data->ttl); ?>" required />
                            <div class="invalid-feedback">
                                <?php echo (session()->getFlashdata('ci_flash_message_ttl')) ?>
                            </div>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="jekel" data-toggle="tooltip" title="<?php echo ('Required') ?>">Jekel&nbsp;<code>*</code></label><br>
                            <input type="radio" name="jekel" id="pria" value="pria" required <?php echo (inputSelect($data->jekel, 'pria', 'checked')) ?> />&nbsp;<label for="pria">Pria</label>
                            <input type="radio" name="jekel" id="wanita" value="wanita" class="ml-5" required <?php echo (inputSelect($data->jekel, 'wanita', 'checked')) ?> />&nbsp;<label for="wanita">Wanita</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6 mb-3">
                            <label for="agama" data-toggle="tooltip" title="<?php echo ('Required') ?>">Agama&nbsp;<code>*</code></label>
                            <select class="form-control <?php echo (session()->getFlashdata('ci_flash_message_agama_type')) ?>" id="agama" name="agama" placeholder="agama">
                                <option value="Islam" <?php echo (inputSelect($data->agama, "Islam")) ?>>Islam</option>
                                <option value="Kristen" <?php echo (inputSelect($data->agama, "Kristen")) ?>>Kristen</option>
                                <option value="Katolik" <?php echo (inputSelect($data->agama, "Katolik")) ?>>Katolik</option>
                                <option value="Hindu" <?php echo (inputSelect($data->agama, "Hindu")) ?>>Hindu</option>
                                <option value="Buddha" <?php echo (inputSelect($data->agama, "Buddha")) ?>>Buddha</option>
                                <option value="Konghucu" <?php echo (inputSelect($data->agama, "Konghucu")) ?>>Konghucu</option>
                            </select>
                            <div class="invalid-feedback">
                                <?php echo (session()->getFlashdata('ci_flash_message_agama')) ?>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="pndidikan_terakhir" data-toggle="tooltip" title="<?php echo ('Required') ?>">Pendidikan Terakhir&nbsp;<code>*</code></label>
                            <select class="form-control <?php echo (session()->getFlashdata('ci_flash_message_pndidikan_terakhir_type')) ?>" id="pndidikan_terakhir" name="pndidikan_terakhir" placeholder="pndidikan_terakhir">
                                <option value="SD" <?php echo (inputSelect($data->pndidikan_terakhir, "SD")) ?>>Sekolah Dasar</option>
                                <option value="SMP" <?php echo (inputSelect($data->pndidikan_terakhir, "SMP")) ?>>SMP Sederajat</option>
                                <option value="SMA" <?php echo (inputSelect($data->pndidikan_terakhir, "SMA")) ?>>SMA Sederajat</option>
                                <option value="Diploma" <?php echo (inputSelect($data->pndidikan_terakhir, "Diploma")) ?>>Diploma</option>
                                <option value="Sarjana" <?php echo (inputSelect($data->pndidikan_terakhir, "Sarjana")) ?>>Sarjana</option>
                            </select>
                            <div class="invalid-feedback">
                                <?php echo (session()->getFlashdata('ci_flash_message_pndidikan_terakhir')) ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 mb-3">
                            <label for="alamat" data-toggle="tooltip" title="<?php echo ('Required') ?>">Alamat&nbsp;<code>*</code></label>
                            <textarea class="form-control <?php echo (session()->getFlashdata('ci_flash_message_alamat_type')) ?>" rows="3" name="alamat" id="alamat" maxlength="65535" placeholder="Alamat" required><?php echo ($data->alamat); ?></textarea>
                            <div class="invalid-feedback">
                                <?php echo (session()->getFlashdata('ci_flash_message_alamat')) ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 mb-3">
                            <label for="id_jenissimpanpinjam" data-toggle="tooltip" title="<?php echo ('Required') ?>">Jenis Simpan Pinjam&nbsp;<code>*</code></label>
                            <select class="form-control <?php echo (session()->getFlashdata('ci_flash_message_id_jenissimpanpinjam_type')) ?>" id="id_jenissimpanpinjam" name="id_jenissimpanpinjam" placeholder="id_jenissimpanpinjam">
                                <?php foreach ($jenissimpanpinjam as $key => $value) : ?>
                                    <option value="<?php echo ($value->id_jenissimpanpinjam) ?>" <?php echo (inputSelect($value->id_jenissimpanpinjam, $data->id_jenissimpanpinjam)) ?>><?php echo (ucfirst($value->nasabah) . " :: " . strSentence($value->jenis)) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?php echo (session()->getFlashdata('ci_flash_message_id_jenissimpanpinjam')) ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6 mb-3">
                            <label for="pekerjaan" data-toggle="tooltip" title="<?php echo ('Required') ?>">Pekerjaan Saat Ini&nbsp;<code>*</code></label>
                            <input type="text" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_pekerjaan_type')) ?>" autocomplete="on" name="pekerjaan" id="pekerjaan" maxlength="40" placeholder="Pekerjaan" value="<?php echo ($data->pekerjaan); ?>" required />
                            <div class="invalid-feedback">
                                <?php echo (session()->getFlashdata('ci_flash_message_pekerjaan')) ?>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="penghasilan_perbulan" data-toggle="tooltip" title="<?php echo ('Required') ?>">Penghasilan&nbsp;<code>*</code></label>
                            <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_penghasilan_perbulan_type')) ?>" name="penghasilan_perbulan" id="penghasilan_perbulan" value="<?php echo ($data->penghasilan_perbulan); ?>" required />
                            <div class="invalid-feedback">
                                <?php echo (session()->getFlashdata('ci_flash_message_penghasilan_perbulan')) ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 mb-3">
                            <label for="foto_ktp" data-toggle="tooltip" title="<?php echo ('Required') ?>">Foto KTP&nbsp;<code>*</code></label>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <input type="hidden" id="oldfoto_ktp" class="hide hidden d-none" name="oldfoto_ktp" style="display:none;" value="<?php echo (isset($data->foto_ktp) ? $data->foto_ktp : NULL); ?>">
                                    <input type="file" name="foto_ktp" id="foto_ktp" accept="*" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_foto_ktp_type')) ?>">
                                    <div class="invalid-feedback">
                                        <?php echo (session()->getFlashdata('ci_flash_message_foto_ktp')) ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <?php if (isset($data->foto_ktp) && $data->foto_ktp != NULL) : ?>
                                        <a href="<?php echo (base_url($data->foto_ktp)) ?>" class="btn btn-md btn-default"><img src="<?php echo (base_url($data->foto_ktp)) ?>" style="max-width: 100%;"></a>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="oldusername" class="form-control" name="oldusername" style="display:none;" value="<?php echo $data->oldusername ?>">
                    <input type="hidden" id="oldid_nasabah" class="form-control" name="oldid_nasabah" style="display:none;" value="<?php echo $data->id_nasabah ?>">
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