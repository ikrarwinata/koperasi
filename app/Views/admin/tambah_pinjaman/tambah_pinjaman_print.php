<!doctype html>
<html>

<head>
    <title><?php echo ($Page->title); ?></title>
    <base href="<?php echo base_url() ?>">
    <link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .word-table {
            border-collapse: collapse !important;
            width: 100%;
        }

        .word-table tr th,
        .word-table tr td {
            padding: 3px 5px;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2><?php echo ($Page->title); ?></h2>
        </div>
    </div>
    <hr>
    <div class="col-lg-12 text-center">
        <h3><?php echo ($Page->subtitle[0]); ?></h3>
    </div>
    <?php echo (dayToString() . ", " . date("d") . " " . monthToString() . " " . date("Y")); ?>
    <hr>
    <table class="word-table" style="margin-bottom: 10px">
        <thead>
            <tr>
                <th>
                Id_pinjaman
            </th>
                <th>
                Id_nasabah
            </th>
                <th>
                Id_jenissimpanpinjam
            </th>
                <th>
                Jumlah_pinjaman
            </th>
                <th>
                Lama_angsuran
            </th>
                <th>
                Total_angsuran
            </th>
                <th>
                Awal_pembayaran
            </th>
                <th>
                Akhir_pembayaran
            </th>
                <th>
                Jaminan
            </th>
                <th>
                Tgl_pencairan
            </th>
                <th>
                Keterangan
            </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $value) : ?>
                <tr>
                    <td class="text-center"><?php echo ( $value->id_pinjaman) ?></td>
                    <td><?php echo ($value->id_nasabah) ?></td>
                    <td><?php echo ($value->id_jenissimpanpinjam) ?></td>
                    <td class="text-center"><?php echo ( $value->jumlah_pinjaman) ?></td>
                    <td class="text-center"><?php echo ( $value->lama_angsuran) ?></td>
                    <td class="text-center"><?php echo ( $value->total_angsuran) ?></td>
                    <td><?php echo ($value->awal_pembayaran) ?></td>
                    <td><?php echo ($value->akhir_pembayaran) ?></td>
                    <td><?php echo ($value->jaminan) ?></td>
                    <td><?php echo ($value->tgl_pencairan) ?></td>
                    <td><?php echo ($value->keterangan) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
<script type="text/javascript">
    window.print();
    timerInterval = setInterval(() => {
        clearInterval(timerInterval);
        window.close();
    }, 3500);
</script>
</html>