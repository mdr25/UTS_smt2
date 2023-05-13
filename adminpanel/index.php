<?php
  require "session.php";
  require "../koneksi.php";

  $queryKategori = mysqli_query($con, "SELECT * FROM kategori_produk");
  $jumlahKategori = mysqli_num_rows($queryKategori);

  $queryProduk = mysqli_query($con, "SELECT * FROM produk");
  $jumlahProduk = mysqli_num_rows($queryProduk);

  $queryPesanan = mysqli_query($con, "SELECT * FROM pesanan");
  $jumlahPesanan = mysqli_num_rows($queryPesanan);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

  <title>Home</title>
</head>
<body>
  <?php
    require "navbar.php";
  ?>

  <div class="container mt-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
      </ol>
    </nav>
    <h2>Halo <?php echo $_SESSION['username'] ?></h2>

    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-4 col-md-6 mb-3">
          <div class="summary-kategori p-3">
            <div class="row">
              <div class="col-6">
                <i class="bi bi-list text-black-50 icon-lg"></i>
              </div>
              <div class="col-6 text-white">
                <h3 class="fs-2">Kategori</h3>
                <p class="fs-4"><?= $jumlahKategori ?> Kategori</p>
                <p><a href="kategori.php" class="text-white">Lihat Detail</a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
          <div class="summary-produk p-3">
            <div class="row">
              <div class="col-6">
                <i class="bi bi-box-seam-fill text-black-50 icon-lg"></i>
              </div>
              <div class="col-6 text-white">
                <h3 class="fs-2">Produk</h3>
                <p class="fs-4"><?= $jumlahProduk ?> Produk</p>
                <p><a href="kategori.php" class="text-white">Lihat Detail</a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
          <div class="summary-pesanan p-3">
            <div class="row">
              <div class="col-6">
                <i class="bi bi-inbox-fill text-black-50 icon-lg"></i>
              </div>
              <div class="col-6 text-white">
                <h3 class="fs-2">Pesanan</h3>
                <p class="fs-4"><?= $jumlahPesanan ?> Pesanan</p>
                <p><a href="pesanan.php" class="text-white">Lihat Detail</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>