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
                                <label for="id_user" data-toggle="tooltip" title="<?php echo ('Required') ?>">Id_user&nbsp;<code>*</code></label>
                                <input type="number" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_id_user_type')) ?>" name="id_user" id="id_user" value="<?php echo ($data->id_user); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_id_user')) ?>
                                </div>
                            </div>
                        </div>
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
                                <label for="password" data-toggle="tooltip" title="<?php echo ('Required') ?>">Password&nbsp;<code>*</code></label>
                                <input type="password" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_password_type')) ?>" autocomplete="on" name="password" id="password" maxlength="100" placeholder="Your password.." value="<?php echo ($data->password); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_password')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="nama" data-toggle="tooltip" title="<?php echo ('Required') ?>">Nama&nbsp;<code>*</code></label>
                                <input type="text" class="form-control <?php echo (session()->getFlashdata('ci_flash_message_nama_type')) ?>" autocomplete="on" name="nama" id="nama" maxlength="100" placeholder="Nama" value="<?php echo ($data->nama); ?>" required />
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_nama')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="Hak_akses" data-toggle="tooltip" title="<?php echo ('Required') ?>">Hak_akses&nbsp;<code>*</code></label>
                                <select class="form-control <?php echo (session()->getFlashdata('ci_flash_message_Hak_akses_type')) ?>" id="Hak_akses" name="Hak_akses" placeholder="Hak_akses">
                                    <option value="<?php echo ($data->Hak_akses) ?>"><?php echo ($data->Hak_akses) ?></option>
                                </select>
                                <div class="invalid-feedback">
                                    <?php echo (session()->getFlashdata('ci_flash_message_Hak_akses')) ?>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="oldid_user" class="form-control" name="oldid_user" style="display:none;" value="<?php echo $data->id_user ?>">
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
