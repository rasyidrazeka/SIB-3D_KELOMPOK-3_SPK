<?php
//koneksi
session_start();
include("koneksi.php");

$tampil = $koneksi->query("SELECT b.nama_alternatif,c.nama_kriteria,a.nilai,c.bobot,c.status
      FROM
        tab_topsis a
        JOIN
          tab_alternatif b USING(id_alternatif)
        JOIN
          tab_kriteria c USING(id_kriteria)");

$data      = array();
$kriterias = array();
$bobot     = array();
$nilai_kuadrat = array();
$status = array();

if ($tampil) {
  while ($row = $tampil->fetch_object()) {
    if (!isset($data[$row->nama_alternatif])) {
      $data[$row->nama_alternatif] = array();
    }
    if (!isset($data[$row->nama_alternatif][$row->nama_kriteria])) {
      $data[$row->nama_alternatif][$row->nama_kriteria] = array();
    }
    if (!isset($nilai_kuadrat[$row->nama_kriteria])) {
      $nilai_kuadrat[$row->nama_kriteria] = 0;
    }
    $bobot[$row->nama_kriteria] = $row->bobot;
    $data[$row->nama_alternatif][$row->nama_kriteria] = $row->nilai;
    $nilai_kuadrat[$row->nama_kriteria] += pow($row->nilai, 2);
    $kriterias[] = $row->nama_kriteria;
    $status[$row->nama_kriteria] = $row->status;
  }
}

$kriteria     = array_unique($kriterias);
$jml_kriteria = count($kriteria);
?>

<head>
  <meta charset="utf-8">
  <title>DarkPan - Bootstrap 5 Admin Template</title>
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
            <h3 class="mb-4">Evaluation Matrix (x<sub>ij</sub>)</h3>
            <table class="table table-striped table-bordered table-hover" style="border-color: white;">
              <thead>
                <tr>
                  <th class="text-center align-middle" rowspan='3'>No</th>
                  <th class="text-center align-middle" rowspan='3'>Alternatif</th>
                  <th class="text-center align-middle" rowspan='3'>Nama</th>
                  <th class="text-center" colspan='<?php echo $jml_kriteria; ?>'>Kriteria</th>
                </tr>
                <tr>
                  <?php
                  foreach ($kriteria as $k)
                    echo "<th align='center'>$k</th>\n";
                  ?>
                </tr>
                <tr>
                  <?php
                  for ($n = 1; $n <= $jml_kriteria; $n++)
                    echo "<th align='center'>K$n</th>";
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                foreach ($data as $nama => $krit) {
                  echo "<tr>
                                <td align='center'>" . (++$i) . "</td>
                                <th align='center'>A$i</th>
                                <td align='center'>$nama</td>";
                  foreach ($kriteria as $k) {
                    echo "<td align='center'>$krit[$k]</td>";
                  }
                  echo "</tr>\n";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
          <div class="col-sm-12 col-xl-6">
            <h3 class="mb-4">Rating Kinerja Ternormalisasi (r<sub>ij</sub>)</h3>
            <table class="table table-striped table-bordered table-hover" style="border-color: white;">
              <thead>
                <tr>
                  <th class="text-center align-middle" rowspan='3'>No</th>
                  <th class="text-center align-middle" rowspan='3'>Alternatif</th>
                  <th class="text-center align-middle" rowspan='3'>Nama</th>
                  <th class="text-center" colspan='<?php echo $jml_kriteria; ?>'>Kriteria</th>
                </tr>
                <tr>
                  <?php
                  foreach ($kriteria as $k)
                    echo "<th>$k</th>\n";
                  ?>
                </tr>
                <tr>
                  <?php
                  for ($n = 1; $n <= $jml_kriteria; $n++)
                    echo "<th>K$n</th>";
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                foreach ($data as $nama => $krit) {
                  echo "<tr>
                      <td>" . (++$i) . "</td>
                      <th>A{$i}</th>
                      <td>{$nama}</td>";
                  foreach ($kriteria as $k) {
                    echo
                    "<td align='center'>" . round(($krit[$k] / sqrt($nilai_kuadrat[$k])), 4) .
                      "</td>";
                  }
                  echo
                  "</tr>\n";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
          <div class="col-sm-12 col-xl-6">
            <h3 class="mb-4">Rating Bobot Ternormalisasi(y<sub>ij</sub>)</h3>
            <table class="table table-striped table-bordered table-hover" style="border-color: white;">
              <thead>
                <tr>
                  <th class="text-center align-middle" rowspan='3'>No</th>
                  <th class="text-center align-middle" rowspan='3'>Alternatif</th>
                  <th class="text-center align-middle" rowspan='3'>Nama</th>
                  <th colspan='<?php echo $jml_kriteria; ?>'>Kriteria</th>
                </tr>
                <tr>
                  <?php
                  foreach ($kriteria as $k)
                    echo "<th>$k</th>\n";
                  ?>
                </tr>
                <tr>
                  <?php
                  for ($n = 1; $n <= $jml_kriteria; $n++)
                    echo "<th>K$n</th>";
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                $y = array();
                foreach ($data as $nama => $krit) {
                  echo "<tr>
                      <td>" . (++$i) . "</td>
                      <th>A{$i}</th>
                      <td>{$nama}</td>";
                  foreach ($kriteria as $k) {
                    $y[$k][$i - 1] = round(($krit[$k] / sqrt($nilai_kuadrat[$k])), 4) * $bobot[$k];
                    echo "<td align='center'>" . $y[$k][$i - 1] . "</td>";
                  }
                  echo
                  "</tr>\n";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
          <div class="col-sm-12 col-xl-6">
            <h3 class="mb-4">Solusi Ideal positif (A<sup>+</sup>)</h3>
            <table class="table table-striped table-bordered table-hover" style="border-color: white;">
              <thead>
                <tr>
                  <th class="text-center" colspan='<?php echo $jml_kriteria; ?>'>Kriteria</th>
                </tr>
                <tr>
                  <?php
                  foreach ($kriteria as $k)
                    echo "<th>$k</th>\n";
                  ?>
                </tr>
                <tr>
                  <?php
                  for ($n = 1; $n <= $jml_kriteria; $n++)
                    echo "<th>y<sub>{$n}</sub><sup>+</sup></th>";
                  ?>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php
                  $yplus = array();
                  foreach ($kriteria as $k) {
                    $yplus[$k] = ($status[$k] == 'Benefit' ? max($y[$k]) : min($y[$k]));

                    echo "<th>$yplus[$k]</th>";
                  }
                  ?>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
          <div class="col-sm-12 col-xl-6">
            <h3 class="mb-4">Solusi Ideal negatif (A<sup>-</sup>)</h3>
            <table class="table table-striped table-bordered table-hover" style="border-color: white;">
              <thead>
                <tr>
                  <th class="text-center" colspan='<?php echo $jml_kriteria; ?>'>Kriteria</th>
                </tr>
                <tr>
                  <?php
                  foreach ($kriteria as $k)
                    echo "<th>{$k}</th>\n";
                  ?>
                </tr>
                <tr>
                  <?php
                  for ($n = 1; $n <= $jml_kriteria; $n++)
                    echo "<th>y<sub>{$n}</sub><sup>-</sup></th>";
                  ?>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php
                  $ymin = array();
                  foreach ($kriteria as $k) {
                    $ymin[$k] = ($status[$k] == 'Cost' ? max($y[$k]) : min($y[$k]));
                    echo "<th>{$ymin[$k]}</th>";
                  }

                  ?>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
          <div class="col-sm-12 col-xl-6">
            <h3 class="mb-4">Jarak positif (D<sub>i</sub><sup>+</sup>)</h3>
            <table class="table table-striped table-bordered table-hover" style="border-color: white;">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Alternatif</th>
                  <th>Nama</th>
                  <th>D<suo>+</sup></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                $dplus = array();
                foreach ($data as $nama => $krit) {
                  echo "<tr>
                      <td>" . (++$i) . "</td>
                      <th>A{$i}</th>
                      <td>{$nama}</td>";
                  foreach ($kriteria as $k) {
                    if (!isset($dplus[$i - 1])) $dplus[$i - 1] = 0;
                    $dplus[$i - 1] += pow($yplus[$k] - $y[$k][$i - 1], 2);
                  }
                  echo "<td>" . round(sqrt($dplus[$i - 1]), 4) . "</td>
                     </tr>\n";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
          <div class="col-sm-12 col-xl-6">
            <h3 class="mb-4">Jarak negatif (D<sub>i</sub><sup>-</sup>)</h3>
            <table class="table table-striped table-bordered table-hover" style="border-color: white;">
              </thead>
              <tbody>
                <?php
                $i = 0;
                $dmin = array();
                foreach ($data as $nama => $krit) {
                  echo "<tr>
                      <td>" . (++$i) . "</td>
                      <th>A{$i}</th>
                      <td>{$nama}</td>";
                  foreach ($kriteria as $k) {
                    if (!isset($dmin[$i - 1])) $dmin[$i - 1] = 0;
                    $dmin[$i - 1] += pow($ymin[$k] - $y[$k][$i - 1], 2);
                  }
                  echo "<td>" . round(sqrt($dmin[$i - 1]), 4) . "</td>

                     </tr>\n";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
          <div class="col-sm-12 col-xl-6">
            <h3 class="mb-4">Nilai Preferensi(V<sub>i</sub>)</h3>
            <table class="table table-striped table-bordered table-hover" style="border-color: white;">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Alternatif</th>
                  <th>Nama</th>
                  <th>V<sub>i</sub></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                $V = array();
                $Y = array();
                $Z = array();
                $hasilakhir = array();


                foreach ($data as $nama => $krit) {
                  echo "<tr>
                            <td>" . (++$i) . "</td>
                            <th>A{$i}</th>
                            <td>{$nama}</td>";
                  foreach ($kriteria as $k) {
                    $V[$i - 1] = round(sqrt($dmin[$i - 1]), 4) / (round(sqrt($dmin[$i - 1]), 4) + round(sqrt($dplus[$i - 1]), 4));
                  }
                  echo "<td>{$V[$i - 1]}</td></tr>\n";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
          <div class="col-sm-12 col-xl-6">
            <h3 class="mb-4">Perankingan Preferensi Berdasarkan(V<sub>i</sub>)</h3>
            <table class="table table-striped table-bordered table-hover" style="border-color: white;">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Ranking</th>
                  <th>Nama</th>
                  <th>V<sub>i</sub></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $j = 0;
                $i = 0;
                $V = array();
                $Y = array();
                $Z = array();
                $hasilakhir = array();

                foreach ($data as $nama => $krit) {
                  foreach ($kriteria as $k) {
                    $V[$nama] = round(sqrt($dmin[$i]), 4) / (round(sqrt($dmin[$i]), 4) + round(sqrt($dplus[$i]), 4));
                  }
                  $i++;
                }

                // Urutkan array V berdasarkan nilai dalam urutan descending
                arsort($V);

                // Cetak tabel dengan urutan baru
                foreach ($V as $nama => $nilai) {
                  echo "<tr>
            <td>" . (++$j) . "</td>
            <th>Rank {$j}</th>
            <td>{$nama}</td>
            <td>{$nilai}</td></tr>\n";
                }
                ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>




      <!-- Table End -->


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