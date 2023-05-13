<?php
  require "koneksi.php";
  $queryProduk = mysqli_query($con, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 6");
?>

<head>
    <title>LZ Store | Home</title>
</head>

<body>
  <?php require 'navbar.php'; ?>

  <!-- Header -->
  <div class="container-fluid header d-flex align-items-center">
    <div class="container text-center text-white">
      <h1>LZ Store</h1>
      <h3>Mau Cari Apa?</h3>
      <div class="col-md-8 offset-md-2">
        <form action="produk.php" method="get">
          <div class="input-group input-group-lg my-4">
            <input type="text" class="form-control" placeholder="Nama Barang" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
            <button type="submit" class="btn secondary text-white">Cari</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Akhir Header -->

  <!-- Highlight Kategori -->
  <section id="highlight-kategori">
    <div class="container-fluid py-5">
      <div class="container">
        <h3 class="text-center">Kategori Terlaris</h3>
        <div class="row mt-3">
          <div class="col-md-4 mb-3">
            <a href="produk.php?kategori=Women">
              <div class="highlight-kategori kategori-women d-flex justify-content-center align-items-center">
                <h4 class="text-bg-light p-3 m-0">Women's</h4>
              </div>
            </a>
          </div>
          <div class="col-md-4 mb-3">
            <a href="produk.php?kategori=Accessories">
              <div class="highlight-kategori kategori-accessories d-flex justify-content-center align-items-center">
                <h4 class="text-bg-light p-3 m-0">Accessories's</h4>
              </div>
            </a>
          </div>
          <div class="col-md-4 mb-3">
            <a href="produk.php?kategori=Men">
              <div class="highlight-kategori kategori-men d-flex justify-content-center align-items-center">
                <h4 class="text-bg-light p-3 m-0">Men's</h4>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Akhir Highlight Kategori -->
  
  <!-- About Us -->
  <section id="about">
    <div class="container-fluid tertiary py-5">
      <div class="container text-center">
        <h3>About Us</h3>
        <p class="fs-5 mt-3">
          We are a company that specializes in selling the latest fashion and beauty products. Established in 2010, we always strive to provide an easy, secure, and enjoyable online shopping experience for our customers. We offer a variety of high-quality products from well-known and trusted brands, and provide friendly and responsive customer service. We are committed to continually improving our service quality and providing the best products for our loyal customers. Thank you for choosing our online store as your shopping destination!
        </p>
      </div>
    </div>
  </section>
  <!-- Akhir About Us -->

  <!-- Produk -->
  <section id="produk">
    <div class="container-fluid py-5">
      <div class="container text-center">
        <h3>Product</h3>
        <div class="row mt-3">
          <?php
            while($data = mysqli_fetch_array($queryProduk)) {
          ?>
          <div class="col-sm-6 col-md-4 mb-3">
            <div class="card h-100">
              <div class="image-box">
                <img src="image/<?= $data['foto'] ?>" class="card-img-top" alt="...">
              </div>
              <div class="card-body">
                <h5 class="card-title"><?= $data['nama'] ?></h5>
                <p class="card-text text-truncate"><?= $data['detail'] ?></p>
                <p class="card-text text-harga">Rp <?= $data['harga'] ?></p>
                <a href="produk-detail.php?nama=<?= $data['nama'] ?>" class="btn tertiary text-white">Details</a>
              </div>
            </div>
          </div>
          <?php
            }
          ?>
        </div>
        <a class="btn btn-outline-warning mt-3" href="produk.php">See More</a>
      </div>
    </div>
  </section>
  <!-- Akhir Produk -->

  <!-- Footer -->
  <section id="footer">
    <?php
    require 'footer.php';
    ?>
  </section>
  <!-- Akhir Footer -->
</body>