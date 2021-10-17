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
                    <table class="table table-light table-striped">
                        <tbody>
                            <tr>
                            <th width="15%">ID Nasabah</th><td>: <?php echo ($data->id_nasabah); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">Username</th><td>: <?php echo ($data->username); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">Nama</th><td>: <?php echo ($data->nama); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">HP</th><td>: <?php echo ($data->no_hp); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">Tanggal Lahir</th><td>: <?php echo ($data->ttl); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">Jenis Kelamin</th><td>: <?php echo ($data->jekel); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">Agama</th><td>: <?php echo ($data->agama); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">Alamat</th><td>: <?php echo ($data->alamat); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">Pendidikan Terakhir</th><td>: <?php echo ($data->pndidikan_terakhir); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">Pekerjaan</th><td>: <?php echo ($data->pekerjaan); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">ID Jenis Simpan Pinjam</th><td>: <?php echo ($data->id_jenissimpanpinjam); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">Penghasilan</th><td>: Rp. <?php echo (formatNumber($data->penghasilan_perbulan)); ?></td>
                        </tr>
                            <tr>
                            <th width="15%">Foto KTP</th><td>: <a href="<?php echo (base_url($data->foto_ktp)) ?>" class="btn btn-sm btn-default">File</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex p-2 bd-highlight">
                        <a class="btn btn-sm btn-danger" href="<?php echo base_url($Page->parent . '/index') ?>"><?php echo 'Cancel' ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>
