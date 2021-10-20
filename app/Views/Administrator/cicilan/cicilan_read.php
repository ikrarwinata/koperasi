<?php
$this->extend($Template->container);
$this->section('content');
?>
<div class="col-12">

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
                    <table>
                        <thead>
                            <tr>
                                <td>ID Pinjaman</td>
                                <td>: <?php echo ($pinjaman->id_pinjaman) ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Pinjaman</td>
                                <td>: Rp. <?php echo (formatNumber($pinjaman->jumlah_pinjaman)) ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Sisa Pinjaman Saat Ini</td>
                                <td>: Rp. <?php echo (formatNumber($pinjaman->sisa)) ?></td>
                            </tr>
                            <tr>
                                <td>Lama Angsuran</td>
                                <td>: <?php echo (formatNumber($pinjaman->lama_angsuran)) ?> <small>(bulan)</small></td>
                            </tr>
                            <tr>
                                <td>Angsuran perBulan</td>
                                <td>: Rp. <?php echo (formatNumber($pinjaman->total_angsuran)) ?></td>
                            </tr>
                            <tr>
                                <td>Awal Pembayaran</td>
                                <td>: <?php echo (formatDate($pinjaman->awal_pembayaran, FALSE, "d M Y")) ?></td>
                            </tr>
                            <tr>
                                <td>Akhir Pembayaran</td>
                                <td>: <?php echo (formatDate($pinjaman->akhir_pembayaran, FALSE, "d M Y")) ?></td>
                            </tr>
                            <tr>
                                <td>Jaminan</td>
                                <td>: <?php echo ($pinjaman->jaminan) ?></td>
                            </tr>
                            <tr>
                                <td>Awal Pembayaran</td>
                                <td>: <?php echo (formatDate($pinjaman->awal_pembayaran, FALSE, "d M Y")) ?></td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>: <?php echo ($pinjaman->keterangan) ?></td>
                            </tr>
                        </thead>
                    </table>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive-sm table-responsive-md">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="60px" class="text-center">#</th>

                                            <th style="transform: rotate(0);">
                                                Tanggal Transaksi
                                            </th>
                                            <th class="text-center" style="transform: rotate(0);">
                                                Angsuran Ke
                                            </th>
                                            <th style="transform: rotate(0);">
                                                Total Bayar
                                            </th>
                                            <th style="transform: rotate(0);">
                                                Sisa Pinjaman
                                            </th>
                                        </tr>
                                    </thead>
                                    </tbody>
                                    <?php
                                    $counter = 1;
                                    foreach ($data as $value) :
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $counter++ ?></td>
                                            <td><?php echo (formatDate($value->tgl_bayar)) ?></td>
                                            <td class="text-center"><?php echo ($value->angsuran_ke) ?></td>
                                            <td>Rp. <?php echo (formatNumber($value->total_bayar)) ?></td>
                                            <td>Rp. <?php echo (formatNumber($value->sisa_pinjaman)) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>;