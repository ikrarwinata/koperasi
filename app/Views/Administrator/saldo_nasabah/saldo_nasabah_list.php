<?php
$this->extend($Template->container);
$this->section('content');
?>
<div class="col-12">
    <div class="row">
        <div class="col-12 mb-5">
            <form action="<?php echo (base_url($Page->parent . "/read")) ?>" method="POST">
                <div class="form-row">
                    <div class="col-8">
                        <select class="form-control select2bs4" name="id_nasabah" placeholder="Pilih Nasabah Untuk Ditampilkan" style="width: 100%;">
                            <option value="--------------">Pilih Nasabah Untuk Ditampilkan</option>
                            <?php foreach ($datanasabah as $key => $value) : ?>
                                <option value="<?php echo ($value->id_nasabah) ?>" <?php echo (inputSelect($value->id_nasabah, session("id_nasabah"))) ?>><?php echo ($value->nama) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary form-control"><i class="fa fa-search"></i>&nbsp;Tampilkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 mb-3">
                            <form action="<?php echo base_url($Page->parent . '/read') ?>" class="form-inline" method="post">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <?php echo 'Data per-Page :' ?>
                                        </div>
                                    </div>
                                    <input type="hidden" name="keyword" value="<?php echo $keyword; ?>">
                                    <input type="number" class="form-control" min="2" max="9999999999" name="perPage" value="<?php echo $perPage ?>">
                                    <button class="btn btn-secondary" type="submit"><?php echo 'Show' ?></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <form action="<?php echo base_url($Page->parent . '/read') ?>" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="keyword" value="<?php echo $keyword; ?>">
                                    <span class="input-group-btn">
                                        <?php if ($keyword <> '') : ?>
                                            <a href="<?php echo base_url($Page->parent . '/read') ?>" class="btn btn-default"><?php echo 'Reset' ?></a>
                                        <?php endif; ?>
                                        <button class="btn btn-primary" type="submit"><?php echo 'Search' ?></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php if (session()->getFlashdata('ci_flash_message') != NULL) : ?>
                        <div class="alert text-center mb-1 mt-0 <?php echo session()->getFlashdata('ci_flash_message_type') ?>" role="alert">
                            <small><?php echo session()->getFlashdata('ci_flash_message') ?></small>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive-sm table-responsive-md">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="60px" class="text-center">#</th>
                                            <th>
                                                Tanggal
                                            </th>
                                            <th>
                                                Saldo
                                            </th>
                                            <th>
                                                Nominal Transaksi
                                            </th>
                                            <th class="text-center">
                                                Jenis Transaksi
                                            </th>
                                        </tr>
                                    </thead>
                                    </tbody>
                                    <?php
                                    $counter = $start;
                                    $lastMonth = 0;
                                    foreach ($data as $value) :
                                        $sM = formatDate(
                                            $value->tanggal,
                                            FALSE,
                                            "m"
                                        );
                                    ?>
                                        <?php if ($sM > $lastMonth && $lastMonth >= 1) : ?>
                                            <tr>
                                                <td class="text-center bg-secondary text-separator-line" colspan="5">
                                                    Bunga Simpanan Ditambahkan
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td class="text-center"><?php echo $counter++ ?></td>
                                            <td><?php echo (formatDate($value->tanggal, FALSE, "d M Y")) ?></td>
                                            <td>Rp. <?php echo (formatNumber($value->saldo)) ?></td>
                                            <td>
                                                <?php if ($value->jenis_transaksi == "add") : ?>
                                                    <span class="text-success">Rp. <?php echo (formatNumber($value->nominal)) ?></span>
                                                <?php else : ?>
                                                    <span class="text-danger">Rp. <?php echo (formatNumber($value->nominal)) ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($value->jenis_transaksi == "add") : ?>
                                                    <span class="badge badge-success">Simpan</span>
                                                <?php else : ?>
                                                    <span class="badge badge-danger">Ambil</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php $lastMonth = $sM; ?>
                                    <?php endforeach; ?>
                                    <?php if (count($data) <= 0 && $data != NULL): ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada untuk ditampilkan</td>
                                        </tr>
                                    <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center" colspan="3">Saldo Akhir</th>
                                            <th colspan="2">Rp.<?php echo (formatNumber($saldo)) ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <!-- pagination -->
                        <?php if ($pager != NULL) : ?>
                            <?php echo $pager->makeLinks($currentPage, $perPage, $totalrecord, 'custom_pagination') ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>;