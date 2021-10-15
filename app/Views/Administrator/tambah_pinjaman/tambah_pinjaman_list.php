<?php 
$this->extend($Template->container);
$this->section('content');
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?php echo $Page->title; ?></h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 mb-3">
            <?php echo form_open_multipart(base_url($Page->parent.'/fromExcel'), 'class="form-inline"'); ?>
            <a href="<?php echo base_url($Page->parent.'/create') ?>" class="btn btn-sm btn-primary"><?php echo 'Create New Item' ?></a>&nbsp;
            <!--ENDIMPORTEXCELFILE-->
            <!--EXPORTBUTTONS-->
            <div class="dropdown">
                <button class="btn btn-sm btn-info dropdown-toggle ml-2 <?php echo (count($data) == 0 ? 'disabled' : NULL) ?>" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Export
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <!--EXPORTTOEXCEL-->
                    <a class="dropdown-item" href="<?php echo base_url($Page->parent.'/toExcel') ?>">Export Excel</a>
                    <!--ENDEXPORTTOEXCEL-->
                    <!--ENDEXPORTTOWORD-->
                    <!--ENDEXPORTTOPDF-->
                    <!--PRINTALL-->
                    <a class="dropdown-item" href="<?php echo base_url($Page->parent.'/printAll') ?>" target="_blank">Print All</a>
                    <!--ENDPRINTALL-->
                </div>
            </div>
            <!--ENDEXPORTBUTTONS-->
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <form action="<?php echo base_url($Page->parent.'/index') ?>" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="keyword" value="<?php echo $keyword; ?>">
                    <span class="input-group-btn">
                        <?php if ($keyword <> ''): ?>
                        <a href="<?php echo base_url($Page->parent.'/index') ?>" class="btn btn-default"><?php echo 'Reset' ?></a>
                        <?php endif; ?>
                        <button class="btn btn-primary" type="submit"><?php echo 'Search' ?></button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <form action="<?php echo base_url($Page->parent.'/index') ?>" class="form-inline" method="post">
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
    </div>

    <?php if (session()->getFlashdata('ci_flash_message')!=NULL): ?>
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
                    <form action="<?php echo(site_url($Page->parent . '/deleteBatch')) ?>" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive-sm table-responsive-md">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th width="60px" class="text-center">#</th>
                                                <th class="align-middle" width="40px"><input type="checkbox" class="table-parent-checkbox" checked="true"></th>
                                                <th style="transform: rotate(0);">
                                                    <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('id_pinjaman') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                        <?php if ($sortcolumn == "id_pinjaman"): ?>
                                                            <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                        <?php endif ?>
                                                        Id_pinjaman
                                                    </a>
                                                </th>
                                               <th style="transform: rotate(0);">
                                                    <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('id_nasabah') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                        <?php if ($sortcolumn == "id_nasabah"): ?>
                                                            <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                        <?php endif ?>
                                                        Id_nasabah
                                                    </a>
                                                </th>
                                               <th style="transform: rotate(0);">
                                                    <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('id_jenissimpanpinjam') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                        <?php if ($sortcolumn == "id_jenissimpanpinjam"): ?>
                                                            <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                        <?php endif ?>
                                                        Id_jenissimpanpinjam
                                                    </a>
                                                </th>
                                               <th style="transform: rotate(0);">
                                                    <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('jumlah_pinjaman') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                        <?php if ($sortcolumn == "jumlah_pinjaman"): ?>
                                                            <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                        <?php endif ?>
                                                        Jumlah_pinjaman
                                                    </a>
                                                </th>
                                               <th style="transform: rotate(0);">
                                                    <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('lama_angsuran') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                        <?php if ($sortcolumn == "lama_angsuran"): ?>
                                                            <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                        <?php endif ?>
                                                        Lama_angsuran
                                                    </a>
                                                </th>
                                               <th style="transform: rotate(0);">
                                                    <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('total_angsuran') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                        <?php if ($sortcolumn == "total_angsuran"): ?>
                                                            <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                        <?php endif ?>
                                                        Total_angsuran
                                                    </a>
                                                </th>
                                               <th style="transform: rotate(0);">
                                                    <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('awal_pembayaran') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                        <?php if ($sortcolumn == "awal_pembayaran"): ?>
                                                            <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                        <?php endif ?>
                                                        Awal_pembayaran
                                                    </a>
                                                </th>
                                               <th style="transform: rotate(0);">
                                                    <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('akhir_pembayaran') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                        <?php if ($sortcolumn == "akhir_pembayaran"): ?>
                                                            <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                        <?php endif ?>
                                                        Akhir_pembayaran
                                                    </a>
                                                </th>
                                               <th style="transform: rotate(0);">
                                                    <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('jaminan') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                        <?php if ($sortcolumn == "jaminan"): ?>
                                                            <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                        <?php endif ?>
                                                        Jaminan
                                                    </a>
                                                </th>
                                               <th style="transform: rotate(0);">
                                                    <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('tgl_pencairan') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                        <?php if ($sortcolumn == "tgl_pencairan"): ?>
                                                            <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                        <?php endif ?>
                                                        Tgl_pencairan
                                                    </a>
                                                </th>
                                               <th style="transform: rotate(0);">
                                                    <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('keterangan') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                        <?php if ($sortcolumn == "keterangan"): ?>
                                                            <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                        <?php endif ?>
                                                        Keterangan
                                                    </a>
                                                </th>
                                                <th width="80px">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        </tbody>
                                        <?php
                                            $counter=$start;
                                            foreach ($data as $value):
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $counter++ ?></td>
                                                <td class="align-middle"><input type="checkbox" class="child-table-checkbox" name="removeme[]" value="<?php echo $value->id_pinjaman ?>" checked="true"></td>
                                                <td class="text-center"><?php echo ($value->id_pinjaman) ?></td>
                                               <td><?php echo ($value->id_nasabah) ?></td>
                                               <td><?php echo ($value->id_jenissimpanpinjam) ?></td>
                                               <td class="text-center"><?php echo ($value->jumlah_pinjaman) ?></td>
                                               <td class="text-center"><?php echo ($value->lama_angsuran) ?></td>
                                               <td class="text-center"><?php echo ($value->total_angsuran) ?></td>
                                               <td><?php echo ($value->awal_pembayaran) ?></td>
                                               <td><?php echo ($value->akhir_pembayaran) ?></td>
                                               <td><?php echo ($value->jaminan) ?></td>
                                               <td><?php echo ($value->tgl_pencairan) ?></td>
                                               <td><?php echo ($value->keterangan) ?></td>
                                                <td>
                                                    <span class="float-right">
                                                        <div class="dropdown dropleft">
                                                            <button class="btn btn-sm btn-info dropdown-toggle ml-2" type="button" id="<?php echo ('actionMenuButton' . $counter) ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="<?php echo('Show options') ?>">
                                                                <i class="fa fa-ellipsis-h"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="<?php echo ('actionMenuButton' . $counter) ?>">
                                                                <a class="dropdown-item" href="<?php echo base_url($Page->parent.'/read/'.urlencode(base64_encode($value->id_pinjaman)) )?>" title="<?php echo('Show detail') ?>">
                                                                    <i class="fa fa-eye fa-lg"></i>&nbsp;
                                                                    <?php echo('Show') ?>
                                                                </a>
                                                                <a class="dropdown-item" href="<?php echo base_url($Page->parent.'/update/'.urlencode(base64_encode($value->id_pinjaman)) )?>" title="<?php echo('Update item') ?>">
                                                                    <i class="fa fa-edit fa-lg"></i>&nbsp;
                                                                    <?php echo('Update Item') ?>
                                                                </a>
                                                                <a class="dropdown-item" href="<?php echo base_url($Page->parent.'/delete/'.urlencode(base64_encode($value->id_pinjaman)) )?>" onclick="javascript: return confirm('<?php echo('Are you sure want to delete this item ?') ?>')" title="<?php echo('Delete this item') ?>">
                                                                    <i class="fa fa-trash fa-lg"></i>&nbsp;
                                                                    <?php echo('Delete this items') ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php if (count($data) >= 1): ?>
                                <button type="submit" class="btn btn-sm btn-outline-warning ml-2 mt-2 mb-2" title="<?php echo 'Delete all selected items' ?>" onclick="return confirm('<?php echo 'Are you sure want to delete selected items ?' ?>')">
                                    <i class="fa fa-minus-square"></i>&nbsp;<?php echo 'Delete selected items' ?>
                                </button>
                            <?php endif; ?>
                            <a href="<?php echo site_url($Page->parent.'/truncate') ?>" class="btn btn-sm btn-outline-danger ml-2 mt-2 mb-2 <?php echo (count($data) == 0 ? 'disabled' : NULL) ?>" onclick="return confirm('<?php echo 'Are you sure want to clear all items ?' ?>')">
                                <i class="fa fa-trash"></i>&nbsp;<?php echo 'Clear All Data' ?>
                            </a>
                        </div>
                    </form>
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
