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
                Nama
            </th>
                <th>
                No_hp
            </th>
                <th>
                Ttl
            </th>
                <th>
                Jekel
            </th>
                <th>
                Agama
            </th>
                <th>
                Alamat
            </th>
                <th>
                Pndidikan_terakhir
            </th>
                <th>
                Pekerjaan
            </th>
                <th>
                Id_jenissimpanpinjam
            </th>
                <th>
                Penghasilan_perbulan
            </th>
                <th>
                Foto_ktp
            </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $value) : ?>
                <tr>
                    <td class="text-center"><?php echo ( $value->id_nasabah) ?></td>
                    <td><?php echo ($value->nama) ?></td>
                    <td><?php echo ($value->no_hp) ?></td>
                    <td><?php echo ($value->ttl) ?></td>
                    <td><?php echo ($value->jekel) ?></td>
                    <td><?php echo ($value->agama) ?></td>
                    <td><?php echo ($value->alamat) ?></td>
                    <td><?php echo ($value->pndidikan_terakhir) ?></td>
                    <td><?php echo ($value->pekerjaan) ?></td>
                    <td><?php echo ($value->id_jenissimpanpinjam) ?></td>
                    <td class="text-center"><?php echo ( $value->penghasilan_perbulan) ?></td>
                    <td class="text-center">
                            <?php if (isset($value->foto_ktp) && $value->foto_ktp != NULL): ?>
                            <a href="<?php echo (base_url($value->foto_ktp)) ?>" class="btn btn-sm btn-default">File</a>
                        <?php endif ?>
                    </td>
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