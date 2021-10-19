<?php
$this->extend($Template->container);
$this->section('content');
?>
<div class="col-12">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 mb-3">
            <form action="<?php echo base_url($Page->parent . '/index') ?>" class="form-inline" method="post">
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
            <form action="<?php echo base_url($Page->parent . '/index') ?>" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="keyword" value="<?php echo $keyword; ?>">
                    <span class="input-group-btn">
                        <?php if ($keyword <> '') : ?>
                            <a href="<?php echo base_url($Page->parent . '/index') ?>" class="btn btn-default"><?php echo 'Reset' ?></a>
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

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="card">
                <div class="card-header">
                    <h2>Data <?php echo $Page->title; ?></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive-sm table-responsive-md">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="60px" class="text-center">#</th>
                                            <th style="transform: rotate(0);">
                                                <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('tanggal') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                    <?php if ($sortcolumn == "tanggal") : ?>
                                                        <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                    <?php endif ?>
                                                    Tanggal
                                                </a>
                                            </th>
                                            <th style="transform: rotate(0);">
                                                <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('nominal') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                    <?php if ($sortcolumn == "nominal") : ?>
                                                        <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                    <?php endif ?>
                                                    Nominal Transaksi
                                                </a>
                                            </th>
                                            <th style="transform: rotate(0);">
                                                <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('saldo') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                    <?php if ($sortcolumn == "saldo") : ?>
                                                        <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                    <?php endif ?>
                                                    Saldo
                                                </a>
                                            </th>
                                            <th class="text-center" style="transform: rotate(0);">
                                                <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('jenis_transaksi') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                    <?php if ($sortcolumn == "jenis_transaksi") : ?>
                                                        <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                    <?php endif ?>
                                                    Jenis Transaksi
                                                </a>
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
                                            <td>Rp. <?php echo (formatNumber($value->nominal)) ?></td>
                                            <td>Rp. <?php echo (formatNumber($value->saldo)) ?></td>
                                            <td class="text-center">
                                                <?php if ($value->jenis_transaksi == "add") : ?>
                                                    <span class="badge badge-success">Simpan</span>
                                                <?php else : ?>
                                                    <span class="badge badge-warning">Ambil</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php $lastMonth = $sM; ?>
                                    <?php endforeach; ?>
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
                        <?php echo $pager->makeLinks($currentPage, $perPage, $totalrecord, 'custom_pagination') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>;