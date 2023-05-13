<?php
  session_start();
  if($_SESSION['login']==false){
    header('location: adminpanel/login.php');
  }
  require "koneksi.php";

  $nama = htmlspecialchars($_GET['nama']);
  $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama='$nama'");
  $produk = mysqli_fetch_array($queryProduk);
?>

<head>
  <title>LZ Store | Order</title>
</head>

<body>
  <?php require "navbar.php"; ?>
  <div class="container-fluid py-5">
    <div class="container">
      <div class="mb-5 col-12 col-md-6">
        <h3>Tambah Pesanan</h3>
        <label for="nama">Produk</label>
        <div class="card mb-2">
          <div class="d-flex align-items-center justify-content-center text-center">
            <div class="col-lg-6">
              <img src="image/<?= $produk['foto'] ?>" class="w-100 rounded-start" alt="">
            </div>
            <div class="col-lg-6 py-4">
              <h1 class="fs-5"><?= $produk['nama'] ?></h1>
              <p class="fs-5"><?= $produk['detail'] ?></p>
              <p class="text-harga m-0">Rp <?= $produk['harga'] ?></p>
            </div>
          </div>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <select name="produk" id="produk" class="form-control" required>
              <option value="<?= $produk['id'] ?>"><?= $produk['nama'] ?></option>
              <?php
                // while($data=mysqli_fetch_array($queryAll)) {
              ?>
                  <!-- <option value="<?= $data['id'] ?>"><?= $data['nama'] ?></option> -->
              <?php
                // }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="nama">Kontak</label>
            <input type="text" name="nama_pemesan" id="nama_pemesan" class="form-control mb-2" placeholder="Nama Lengkap" autocomplete="off" required>
            <input type="number" name="no_hp" id="no_hp" class="form-control mb-2" placeholder="Nomor Telepon" required>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
          </div>
          <div class="mb-3">
            <label for="detail">Alamat</label>
            <textarea name="alamat_pemesan" id="alamat_pemesan" cols="30" rows="5" class="form-control"></textarea>
          </div>
          <div class="mb-3">
            <label for="detail">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control"></textarea>
          </div>
          <div class="mb-3">
            <label for="tanggal">Tanggal Pemesanan</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control">
          </div>
          <div>
            <label for="jumlah_pesanan">Jumlah Pesanan</label>
            <input type="number" name="jumlah_pesanan" id="jumlah_pesanan" class="form-control mb-2" value="1" required>
          </div>
          <div class="mt-3">
            <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
          </div>
        </form>

        <?php
          if(isset($_POST['simpan'])) {
            $produk = htmlspecialchars($_POST['produk']);
            $nama = htmlspecialchars($_POST['nama_pemesan']);
            $no_hp = htmlspecialchars($_POST['no_hp']);
            $email = htmlspecialchars($_POST['email']);
            $alamat = htmlspecialchars($_POST['alamat_pemesan']);
            $deskripsi = htmlspecialchars($_POST['deskripsi']);
            $date = htmlspecialchars($_POST['tanggal']);
            $jumlah_pesanan = htmlspecialchars($_POST['jumlah_pesanan']);

            if($nama=='' || $no_hp=='' || $email=='') {
        ?>
              <div class="alert alert-warning mt-3" role="alert">
                Nama, Nomor Telepon dan Email wajib diisi
              </div>
        <?php
            }
            else {
              // Query Insert
              $queryTambah = mysqli_query($con, "INSERT INTO pesanan (produk_id, tanggal, nama_pemesan, no_hp, email, alamat_pemesan, jumlah_pesanan, deskripsi) VALUES ('$produk', '$date', '$nama', '$no_hp', '$email', '$alamat', '$jumlah_pesanan', '$deskripsi')");

              if($queryTambah) {
        ?>
                <div class="alert alert-primary mt-3" role="alert">
                  Produk berhasil ditambahkan
                </div>
          
                <meta http-equiv="refresh" content="1; url=adminpanel/pesanan.php" />
        <?php
              }
              else {
                echo mysqli_error($con);
              }
            }
          }
        ?>
      </div>
    </div>
  </div>

</body>