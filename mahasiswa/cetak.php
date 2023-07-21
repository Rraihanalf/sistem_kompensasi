<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "link.php"; ?>
</head>

<body id="page-top">

    <center>
        <h3 class="my-5">Lampiran Data Kompensasi</h3>
    </center>

    <?php $username = $_SESSION['username'];
    $mhs = query("SELECT * FROM mahasiswa WHERE username = '$username'")[0];
    $nim = $mhs['nim']; ?>

    <table class="container table-bordered" id="dataX" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>NIM</th>
                <th>Jam</th>
                <th>Tanggal</th>
                <th>Validasi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $stmt = $conn->prepare("SELECT * FROM kompensasi WHERE nim = '$nim'");
            $stmt->execute();
            $kompensasi = $stmt->get_result();
            ?>
            <?php $i = 1; ?>
            <?php foreach ($kompensasi as $data) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= htmlspecialchars($data['nim']); ?></td>
                    <td><?= $data['jam']; ?></td>
                    <td><?= $data['tanggal']; ?></td>
                    <td><?= $data['validasi']; ?></td>
                    <td><?= $data['status']; ?></td>
                </tr>


                <?php $i++; ?>
            <?php endforeach; ?>

        </tbody>
    </table>

    <?php include "plugin.php"; ?>

    <script>
        window.print();
    </script>
</body>

</html>