<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "link.php"; ?>
</head>

<?php

// Jika form disubmit
if (isset($_POST['submit'])) {
    // Ambil data dari form
    $id_pengawas = mysqli_real_escape_string($conn, $_POST['id_pengawas']);
    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $jam = mysqli_real_escape_string($conn, $_POST['jam']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $validasi = mysqli_real_escape_string($conn, $_POST['validasi']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Simpan data ke database
    $query = "INSERT INTO kompensasi (id_pengawas, nim, jam, tanggal, validasi, status) VALUES ('$id_pengawas', '$nim', '$jam', '$tanggal', '$validasi', '$status')";
    if (mysqli_query($conn, $query)) {
        $script = "
            Swal.fire({
                icon: 'success',
                title: 'Data Berhasil Ditambahkan!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    } else {
        $script = "
            Swal.fire({
                icon: 'error',
                title: 'Data Gagal Ditambahkan!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    }
}

if (isset($_POST['edit'])) {
    // Ambil data dari form
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $jam = mysqli_real_escape_string($conn, $_POST['jam']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $kegiatan = mysqli_real_escape_string($conn, $_POST['kegiatan']);
    $validasi = mysqli_real_escape_string($conn, $_POST['validasi']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Update data
    $query = "UPDATE kompensasi SET jam = '$jam', tanggal = '$tanggal', kegiatan = '$kegiatan', validasi = '$validasi', status = '$status' WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        $script = "
            Swal.fire({
                icon: 'success',
                title: 'Data Berhasil di Edit!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    } else {
        $script = "
            Swal.fire({
                icon: 'error',
                title: 'Data Gagal Di-Edit!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    }
}

if (isset($_POST['hapus'])) {
    // Ambil data dari form
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $query = "DELETE FROM kompensasi WHERE id = '$id'";
    if (mysqli_query($conn, $query)) {
        $script = "
            Swal.fire({
                icon: 'success',
                title: 'Data Berhasil Dihapus!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    } else {
        $script = "
            Swal.fire({
                icon: 'error',
                title: 'Data Gagal Di-Hapus!',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        ";
    }
}




?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "sidebar.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "topbar.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="">
                        <p>
                            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fas fa-plus-square"></i> Tambah Data Kompensasi
                            </a>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="nim">NIM:</label>
                                        <select class="form-control" id="nim" name="nim" required>
                                            <?php
                                            $stmt = $conn->prepare("SELECT nim FROM mahasiswa");
                                            $stmt->execute();
                                            $mahasiswa = $stmt->get_result();
                                            ?>
                                            <?php foreach ($mahasiswa as $data) : ?>
                                                <option value="<?= htmlspecialchars($data['nim']); ?>"><?= htmlspecialchars($data['nim']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_pengawas">Pengawas:</label>
                                        <select class="form-control" id="id_pengawas" name="id_pengawas" required>
                                            <?php
                                            $stmt = $conn->prepare("SELECT * FROM pengawas");
                                            $stmt->execute();
                                            $pengawas = $stmt->get_result();
                                            ?>
                                            <?php foreach ($pengawas as $data) : ?>
                                                <option value="<?= htmlspecialchars($data['id']); ?>"><?= htmlspecialchars($data['nama']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="jam">Jam:</label>
                                        <input type="time" class="form-control" id="jam" name="jam" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal:</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="validasi">Validasi:</label>
                                        <select class="form-control" id="validasi" name="validasi" required>
                                            <option value="Belum Diperiksa">Belum Diperiksa</option>
                                            <option value="Valid">Valid</option>
                                            <option value="Tidak Valid">Tidak Valid</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Belum Diperiksa">Belum Diperiksa</option>
                                            <option value="Diterima">Diterima</option>
                                            <option value="Ditolak">Ditolak</option>
                                        </select>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary w-100">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Kompensasi <a class="badge bg-info text-white" href="cetak.php">Cetak Data Kompensasi</a></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataX" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NIM</th>
                                            <th>Pengawas</th>
                                            <th>Jam</th>
                                            <th>Tanggal</th>
                                            <th>Validasi</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt = $conn->prepare("SELECT kompensasi.*, mahasiswa.nama AS nama_mahasiswa, pengawas.nama AS nama_pengawas FROM kompensasi JOIN mahasiswa ON kompensasi.nim = mahasiswa.nim JOIN pengawas ON kompensasi.id_pengawas = pengawas.id");
                                        $stmt->execute();
                                        $kompensasi = $stmt->get_result();
                                        ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($kompensasi as $data) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= htmlspecialchars($data['nim']); ?> | <?= htmlspecialchars($data['nama_mahasiswa']); ?></td>
                                                <td><?= htmlspecialchars($data['nama_pengawas']); ?></td>
                                                <td><?= $data['jam']; ?></td>
                                                <td><?= $data['tanggal']; ?></td>
                                                <td><?= $data['validasi']; ?></td>
                                                <td><?= $data['status']; ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal<?= $data['id'] ?>">Edit</a>
                                                    <br><br>
                                                    <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusModal<?= $data['id'] ?>">Hapus</a>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit Kompensasi -->
                                            <div class="modal fade" id="editModal<?= $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                                                                <div class="form-group">
                                                                    <label for="jam">Jam</label>
                                                                    <input type="time" class="form-control" id="jam" name="jam" value="<?= $data['jam']; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tanggal">Tanggal</label>
                                                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $data['tanggal']; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="kegiatan">Kegiatan</label>
                                                                    <input type="text" class="form-control" id="kegiatan" name="kegiatan" value="<?= $data['kegiatan']; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="validasi">Validasi</label>
                                                                    <select class="form-control" id="validasi" name="validasi" required>
                                                                        <option value="Belum Diperiksa" <?= ($data['validasi'] == 'Belum Diperiksa') ? 'selected' : ''; ?>>Belum Diperiksa</option>
                                                                        <option value="Valid" <?= ($data['validasi'] == 'Valid') ? 'selected' : ''; ?>>Valid</option>
                                                                        <option value="Tidak Valid" <?= ($data['validasi'] == 'Tidak Valid') ? 'selected' : ''; ?>>Tidak Valid</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="status">Status</label>
                                                                    <select class="form-control" id="status" name="status" required>
                                                                        <option value="Belum Diperiksa" <?= ($data['status'] == 'Belum Diperiksa') ? 'selected' : ''; ?>>Belum Diperiksa</option>
                                                                        <option value="Diterima" <?= ($data['status'] == 'Diterima') ? 'selected' : ''; ?>>Diterima</option>
                                                                        <option value="Ditolak" <?= ($data['status'] == 'Ditolak') ? 'selected' : ''; ?>>Ditolak</option>
                                                                    </select>
                                                                </div>
                                                                <button type="submit" name="edit" class="btn btn-primary w-100">Simpan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Hapus -->
                                            <div class="modal fade" id="hapusModal<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data Kompensasi</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus data dengan ID Kompensasi: <b><?= htmlspecialchars($data['id']) ?></b>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                                                <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php $i++; ?>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include "footer.php"; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include "plugin.php"; ?>

    <script>
        $(document).ready(function() {
            $('#dataX').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sLast": "Terakhir",
                        "sNext": "Selanjutnya",
                        "sPrevious": "Sebelumnya"
                    },
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "sSearch": "Cari:",
                    "sEmptyTable": "Tidak ada data yang tersedia dalam tabel",
                    "sLengthMenu": "Tampilkan _MENU_ data",
                    "sZeroRecords": "Tidak ada data yang cocok dengan pencarian Anda"
                }
            });
        });
    </script>

    <script>
        <?php if (isset($script)) {
            echo $script;
        } ?>
    </script>
</body>

</html>