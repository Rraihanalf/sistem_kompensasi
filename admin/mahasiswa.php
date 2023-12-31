<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "link.php"; ?>
</head>

<?php

// Jika form disubmit
if (isset($_POST['submit'])) {
    // Ambil data dari form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);
    $prodi = mysqli_real_escape_string($conn, $_POST['prodi']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $nohp = mysqli_real_escape_string($conn, $_POST['nohp']);

    // Hash password menggunakan fungsi password_hash()
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Simpan data ke database
    $query = "INSERT INTO mahasiswa (username, nim, password, nama, jenis_kelamin, jurusan, prodi, semester, kelas, nohp) VALUES ('$username', '$nim', '$hashedPassword', '$nama', '$jenis_kelamin', '$jurusan', '$prodi', '$semester', '$kelas', '$nohp')";
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
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $username_pengawas = mysqli_real_escape_string($conn, $_POST['username_pengawas']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);
    $prodi = mysqli_real_escape_string($conn, $_POST['prodi']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $nohp = mysqli_real_escape_string($conn, $_POST['nohp']);
    $jumlah_alpha = mysqli_real_escape_string($conn, $_POST['jumlah_alpha']);

    // Cek apakah password kosong atau tidak
    if (!empty($password)) {
        // Hash password menggunakan fungsi password_hash()
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // Update data dengan password baru
        $query = "UPDATE mahasiswa SET username = '$username', username_pengawas = '$username_pengawas',  password = '$hashedPassword', nim = '$nim', nama = '$nama', jenis_kelamin = '$jenis_kelamin', jurusan = '$jurusan', prodi = '$prodi', semester = '$semester', kelas = '$kelas', nohp = '$nohp', jumlah_alpha = '$jumlah_alpha' WHERE id = '$id'";
    } else {
        // Update data tanpa mengubah password
        $query = "UPDATE mahasiswa SET username = '$username', username_pengawas = '$username_pengawas',  nim = '$nim', nama = '$nama', jenis_kelamin = '$jenis_kelamin', jurusan = '$jurusan', prodi = '$prodi', semester = '$semester', kelas = '$kelas', nohp = '$nohp', jumlah_alpha = '$jumlah_alpha' WHERE id = '$id'";
    }

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

    $query = "DELETE FROM mahasiswa WHERE id = '$id'";
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
                                <i class="fas fa-plus-square"></i> Tambah Data Mahasiswa
                            </a>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="nim">NIM:</label>
                                        <input type="text" class="form-control" id="nim" name="nim" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama:</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin:</label>
                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="jurusan">Jurusan:</label>
                                        <input type="text" class="form-control" id="jurusan" name="jurusan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="prodi">Program Studi:</label>
                                        <input type="text" class="form-control" id="prodi" name="prodi" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="semester">Semester:</label>
                                        <input type="number" class="form-control" id="semester" name="semester" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kelas">Kelas:</label>
                                        <input type="text" class="form-control" id="kelas" name="kelas" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nohp">Nomor HP:</label>
                                        <input type="text" class="form-control" id="nohp" name="nohp" required>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary w-100">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataX" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NIM</th>
                                            <th>Username</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Jurusan</th>
                                            <th>Program Studi</th>
                                            <th>Semester</th>
                                            <th>Kelas</th>
                                            <th>Nomor HP</th>
                                            <th>Username Pengawas</th>
                                            <th>Jumlah Alpha</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt = $conn->prepare("SELECT * FROM mahasiswa");
                                        $stmt->execute();
                                        $mahasiswa = $stmt->get_result();
                                        ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($mahasiswa as $data) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= htmlspecialchars($data['nim']); ?></td>
                                                <td><?= htmlspecialchars($data['username']); ?></td>
                                                <td><?= htmlspecialchars($data['nama']); ?></td>
                                                <td><?= htmlspecialchars($data['jenis_kelamin']); ?></td>
                                                <td><?= htmlspecialchars($data['jurusan']); ?></td>
                                                <td><?= htmlspecialchars($data['prodi']); ?></td>
                                                <td><?= htmlspecialchars($data['semester']); ?></td>
                                                <td><?= htmlspecialchars($data['kelas']); ?></td>
                                                <td><?= htmlspecialchars($data['nohp']); ?></td>
                                                <td><?= $data['username_pengawas']; ?></td>
                                                <td><?= $data['jumlah_alpha']; ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal<?= $data['id'] ?>">Edit</a>
                                                    <br><br>
                                                    <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusModal<?= $data['id'] ?>">Hapus</a>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit Mahasiswa -->
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
                                                                    <label for="nim">NIM</label>
                                                                    <input type="text" class="form-control" id="nim" name="nim" value="<?= $data['nim']; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="username">Username</label>
                                                                    <input type="text" class="form-control" id="username" name="username" value="<?= $data['username']; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="password">Password</label>
                                                                    <input type="password" class="form-control" id="password" name="password">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nama">Nama</label>
                                                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama']; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                                                        <option value="Laki-laki" <?= ($data['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                                                                        <option value="Perempuan" <?= ($data['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="jurusan">Jurusan</label>
                                                                    <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?= $data['jurusan']; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="prodi">Program Studi</label>
                                                                    <input type="text" class="form-control" id="prodi" name="prodi" value="<?= $data['prodi']; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="semester">Semester</label>
                                                                    <input type="number" class="form-control" id="semester" name="semester" value="<?= $data['semester']; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="kelas">Kelas</label>
                                                                    <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $data['kelas']; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nohp">Nomor HP</label>
                                                                    <input type="text" class="form-control" id="nohp" name="nohp" value="<?= $data['nohp']; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="jumlah_alpha">Jumlah Alpha</label>
                                                                    <input type="number" class="form-control" id="jumlah_alpha" name="jumlah_alpha" value="<?= $data['jumlah_alpha']; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="username_pengawas">Pilih Pengawas</label>
                                                                    <select class="form-control" id="username_pengawas" name="username_pengawas" required>
                                                                        <?php $pengawas = mysqli_query($conn, "SELECT * FROM pengawas"); ?>
                                                                        <?php foreach ($pengawas as $p) : ?>
                                                                            <option value="<?= $p['username']; ?>"><?= $p['nama']; ?></option>
                                                                        <?php endforeach; ?>
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
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data Mahasiswa</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus data dengan ID Mahasiswa: <b><?= htmlspecialchars($data['id']) ?></b>?
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