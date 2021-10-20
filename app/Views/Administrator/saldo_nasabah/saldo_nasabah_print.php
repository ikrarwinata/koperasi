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
                Id_nasabah
            </th>
                <th>
                Saldo
            </th>
                <th>
                Tanggal
            </th>
                <th>
                Nominal
            </th>
                <th>
                Jenis_transaksi
            </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $value) : ?>
                <tr>
                    <td class="text-center"><?php echo ( $value->id_nasabah) ?></td>
                    <td class="text-center"><?php echo ( $value->saldo) ?></td>
                    <td><?php echo ($value->tanggal) ?></td>
                    <td class="text-center"><?php echo ( $value->nominal) ?></td>
                    <td><?php echo ($value->jenis_transaksi) ?></td>
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