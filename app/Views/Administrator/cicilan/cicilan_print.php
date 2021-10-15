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
                Id_cicilan
            </th>
                <th>
                Id_nasabah
            </th>
                <th>
                Id_jenissimpanpinjam
            </th>
                <th>
                Tgl_bayar
            </th>
                <th>
                Jml_pinjaman
            </th>
                <th>
                Lama_angsuran
            </th>
                <th>
                Angsuran_ke
            </th>
                <th>
                Total_bayar
            </th>
                <th>
                Sisa_pinjaman
            </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $value) : ?>
                <tr>
                    <td class="text-center"><?php echo ( $value->id_cicilan) ?></td>
                    <td><?php echo ($value->id_nasabah) ?></td>
                    <td><?php echo ($value->id_jenissimpanpinjam) ?></td>
                    <td><?php echo ($value->tgl_bayar) ?></td>
                    <td class="text-center"><?php echo ( $value->jml_pinjaman) ?></td>
                    <td class="text-center"><?php echo ( $value->lama_angsuran) ?></td>
                    <td class="text-center"><?php echo ( $value->angsuran_ke) ?></td>
                    <td class="text-center"><?php echo ( $value->total_bayar) ?></td>
                    <td class="text-center"><?php echo ( $value->sisa_pinjaman) ?></td>
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