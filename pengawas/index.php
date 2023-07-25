<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "link.php"; ?>
</head>

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

                    <!-- Page Heading -->
                    <div class="align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <br>
                        <?php $username = $_SESSION['username']; ?>
                        <?php $pengawas = query("SELECT * FROM pengawas WHERE username = '$username'")[0]; ?>
                        <p class="text-success">Selamat Datang, <?= $pengawas['nama']; ?></p>
                    </div>

                    <!-- Content Row -->

                    <div class="row" style="margin-top: 100px;">
                        <div class="col">
                            <img src="../img/poliban.jpg" width="300" class="img-fluid" alt="">
                        </div>
                        <div class="col">
                            Tanggal Hari Ini :
                            <p>
                                <?= date('d m Y'); ?>
                            </p>
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
</body>

</html>