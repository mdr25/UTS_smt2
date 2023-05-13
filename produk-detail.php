<?php
  require "koneksi.php";

  $nama = htmlspecialchars($_GET['nama']);
  $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama='$nama'");
  $produk = mysqli_fetch_array($queryProduk);

  $queryProdukTerkait = mysqli_query($con, "SELECT * FROM produk WHERE kategori_produk_id='$produk[kategori_produk_id]' AND id!='$produk[id]' LIMIT 4");
?>

<head>
  <title>LZ Store | Product Details</title>
</head>

<body>
  <?php require 'navbar.php' ?>

  <div class="container-fluid py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 mb-3">
          <img src="image/<?= $produk['foto'] ?>" class="w-100" alt="">
        </div>
        <div class="col-lg-6 offset-lg-1 mb-3">
          <h1><?= $produk['nama'] ?></h1>
          <p class="fs-5"><?= $produk['detail'] ?></p>
          <p class="text-harga m-0">Rp <?= $produk['harga'] ?></p>
          <p class="fs-5">Status Ketersediaan : <strong><?= $produk['ketersediaan_stok'] ?></strong></p>
          <a href="pesanan.php?nama=<?= $produk['nama'] ?>" class="btn btn-warning">Order</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Related Products -->
  <div class="container-fluid py-5 secondary">
    <div class="container">
      <h2 class="text-center text-white mb-3">Produk Terkait</h2>
      <div class="row">
        <?php while($data = mysqli_fetch_array($queryProdukTerkait)) { ?>
        <div class="col-md-6 col-lg-3 mb-3">
          <a href="produk-detail.php?nama=<?= $data['nama'] ?>">
            <img src="image/<?= $data['foto'] ?>" class="img-fluid img-thumbnail img-produk-terkait" alt="">
          </a>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <!-- Akhir Related Products -->

  <!-- Footer -->
  <section id="footer">
    <?php
    require 'footer.php';
    ?>
  </section>
  <!-- Akhir Footer -->
</body>