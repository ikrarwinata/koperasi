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
                                                    <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('id_user') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                        <?php if ($sortcolumn == "id_user"): ?>
                                                            <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                        <?php endif ?>
                                                        Id_user
                                                    </a>
                                                </th>
                                               <th style="transform: rotate(0);">
                                                    <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('username') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                        <?php if ($sortcolumn == "username"): ?>
                                                            <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                        <?php endif ?>
                                                        Username
                                                    </a>
                                                </th>
                                               <th style="transform: rotate(0);">
                                                    <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('password') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                        <?php if ($sortcolumn == "password"): ?>
                                                            <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                        <?php endif ?>
                                                        Password
                                                    </a>
                                                </th>
                                               <th style="transform: rotate(0);">
                                                    <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('nama') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                        <?php if ($sortcolumn == "nama"): ?>
                                                            <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                        <?php endif ?>
                                                        Nama
                                                    </a>
                                                </th>
                                               <th style="transform: rotate(0);">
                                                    <a href="<?php echo (base_url($Page->parent . '/index?sortcolumn=' . base64_encode('Hak_akses') . '&sortorder=' . ($sortorder == 'ASC' ? 'DESC' : 'ASC'))); ?>" class="stringetched-link text-decoration-none" style="text-decoration: none;color: #243245;">
                                                        <?php if ($sortcolumn == "Hak_akses"): ?>
                                                            <i class="fas fa-sort-alpha-<?php echo ($sortorder == 'DESC' ? 'down' : 'up'); ?>"></i>&nbsp;
                                                        <?php endif ?>
                                                        Hak_akses
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
                                                <td class="align-middle"><input type="checkbox" class="child-table-checkbox" name="removeme[]" value="<?php echo $value->id_user ?>" checked="true"></td>
                                                <td class="text-center"><?php echo ($value->id_user) ?></td>
                                               <td><?php echo ($value->username) ?></td>
                                               <td><?php echo ($value->password) ?></td>
                                               <td><?php echo ($value->nama) ?></td>
                                               <td><?php echo ($value->Hak_akses) ?></td>
                                                <td>
                                                    <span class="float-right">
                                                        <div class="dropdown dropleft">
                                                            <button class="btn btn-sm btn-info dropdown-toggle ml-2" type="button" id="<?php echo ('actionMenuButton' . $counter) ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="<?php echo('Show options') ?>">
                                                                <i class="fa fa-ellipsis-h"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="<?php echo ('actionMenuButton' . $counter) ?>">
                                                                <a class="dropdown-item" href="<?php echo base_url($Page->parent.'/read/'.urlencode(base64_encode($value->id_user)) )?>" title="<?php echo('Show detail') ?>">
                                                                    <i class="fa fa-eye fa-lg"></i>&nbsp;
                                                                    <?php echo('Show') ?>
                                                                </a>
                                                                <a class="dropdown-item" href="<?php echo base_url($Page->parent.'/update/'.urlencode(base64_encode($value->id_user)) )?>" title="<?php echo('Update item') ?>">
                                                                    <i class="fa fa-edit fa-lg"></i>&nbsp;
                                                                    <?php echo('Update Item') ?>
                                                                </a>
                                                                <a class="dropdown-item" href="<?php echo base_url($Page->parent.'/delete/'.urlencode(base64_encode($value->id_user)) )?>" onclick="javascript: return confirm('<?php echo('Are you sure want to delete this item ?') ?>')" title="<?php echo('Delete this item') ?>">
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
