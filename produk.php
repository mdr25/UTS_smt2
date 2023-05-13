<?php
  require "koneksi.php";

  $queryKategori = mysqli_query($con, "SELECT * FROM kategori_produk");

  // Product by Product Name/Keyword
  if(isset($_GET['keyword'])) {
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
  }
  // Product by Category
  elseif(isset($_GET['kategori'])) {
    $queryGetKategoriID = mysqli_query($con, "SELECT id FROM kategori_produk WHERE nama='$_GET[kategori]'");
    $kategoriID = mysqli_fetch_array($queryGetKategoriID);

    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE kategori_produk_id='$kategoriID[id]'");

  }
  // Product Default
  else {
    $queryProduk = mysqli_query($con, "SELECT * FROM produk");
  }

  $countData = mysqli_num_rows($queryProduk);
?>

<head>
  <title>LZ Store | Product</title>
</head>

<body>
  <?php require "navbar.php"; ?>

  <!-- Header -->
  <div class="container-fluid header2 d-flex align-items-center">
    <div class="container">
      <h1 class="text-white text-center">Product</h1>
    </div>
  </div>
  <!-- Akhir Header -->

  <!-- Main Content -->
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-3 mb-3">
        <h3 class="mb-3">Category</h3>
        <ul class="list-group">
          <?php while($kategori = mysqli_fetch_array($queryKategori)) { ?>
            <a href="produk.php?kategori=<?= $kategori['nama'] ?>">
              <li class="list-group-item"><?= $kategori['nama'] ?></li>
            </a>
          <?php } ?>
        </ul>
      </div>
      <div class="col-lg-9 mb-3">
        <h3 class="text-center mb-3">Product</h3>
        <div class="row">
          <?php
            if($countData < 1) {
          ?>
            <div class="card">
              <h4 class="text-center my-5">Oops, Produk yang anda cari tidak ditemukan</h4>
            </div>
          <?php
            }
          ?>
          <?php while($produk = mysqli_fetch_array($queryProduk)) { ?>
          <div class="col-md-4 mb-3">
            <div class="card h-100">
              <div class="image-box">
                <img src="image/<?= $produk['foto'] ?>" class="card-img-top" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title"><?= $produk['nama'] ?></h5>
                <p class="card-text text-truncate"><?= $produk['detail'] ?></p>
                <p class="card-text text-harga">Rp <?= $produk['harga'] ?></p>
                <a href="produk-detail.php?nama=<?= $produk['nama'] ?>" class="btn tertiary text-white">Details</a>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Main Content -->

  <!-- Footer -->
  <section id="footer">
    <?php
    require 'footer.php';
    ?>
  </section>
  <!-- Akhir Footer -->
</body>