<?php
//koneksi
session_start();
include("koneksi.php");

//pemberian kode id secara otomatis
$carikode = $koneksi->query("SELECT id_alternatif FROM tab_alternatif") or die(mysqli_error($koneksi));
$datakode = $carikode->fetch_array();
$jumlah_data = mysqli_num_rows($carikode);

if ($datakode) {
    $kode = $jumlah_data + 1;
    $kode_otomatis = str_pad($kode, 0, STR_PAD_LEFT);
} else {
    $kode_otomatis = "1";
}

?>



<head>
    <meta charset="utf-8">
    <title>Kelompok 3 - SIB 3D</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">KELOMPOK 3</h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="kelompok.php" class="nav-item nav-link"><i class="bi bi-person me-2"></i>Anggota</a>
                    <a href="index.php" class="nav-item nav-link"><i class="bi bi-book me-2"></i>Pengertian</a>
                    <a href="kriteria.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Kriteria</a>
                    <a href="alternatif.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Alternatif</a>
                    <a href="nilmat.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Nilai Matriks</a>
                    <a href="hasiltopsis.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Metode Topsis</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-2">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-5">
                </form>
            </nav>
            <!-- Navbar End -->

            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h3 class="mb-4">Tabel Alternatif</h3>

                            <div class="panel-body">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="">
                                        <!--form alternatif-->
                                        <form class="form" action="alternatiftambah.php" method="post">
                                            <div class="form-group my-4">
                                                <input class="form-control" type="text" name="id_alter" value="<?php echo $kode_otomatis ?>" readonly>
                                            </div>
                                            <div class="form-group my-4">
                                                <input class="form-control" type="text" name="nm_alter" placeholder="Nama Alternatif">
                                            </div>
                                            <div class="form-group my-4">
                                                <input class="btn btn-primary mb-3" type="submit" name="simpan" value="Tambah">
                                            </div>
                                        </form>
                                        <!--form alternatif-->
                                    </div>
                                </div>
                            </div>
                            <!--panel body-->
                        </div>
                    </div>
                </div>

            </div>

            <!-- Table End -->
            <?php

            if (isset($_POST['simpan'])) {
                $id_alter   = $_POST['id_alter'];
                $alternatif = $_POST['nm_alter'];

                $masuk = "INSERT INTO tab_alternatif VALUES ('" . $id_alter . "','" . $alternatif . "')";
                $buat  = $koneksi->query($masuk);

                if ($buat) {
                    echo "<script>alert('Input Data Berhasil') </script>";
                    echo "<script>window.location.href = \"alternatif.php\" </script>";
                } else {
                    echo "<script>alert('Input Data Gagal') </script>";
                }
            }

            ?>

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Kelompok 3</a> - SIB-3D
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>