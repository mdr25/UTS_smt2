<?php
  require "session.php";
  require "../koneksi.php";

  $id = $_GET['d'];

  $query = mysqli_query($con, "SELECT a.*, b.nama AS nama_produk FROM pesanan a JOIN produk b ON a.produk_id=b.id");
  $data = mysqli_fetch_array($query);

  $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE id!='$data[produk_id]'");

?>

<head>
  <title>Detail Pesanan</title>
</head>

<body>
  <?php require "navbar.php"; ?>

  <div class="container mt-3">
    <div class="col-12 col-md-6">
      <h2>Detail Produk</h2>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="produk">Produk</label>
          <select name="produk" id="produk" class="form-control" required>
            <option value="<?= $data['produk_id'] ?>"><?= $data['nama_produk'] ?></option>
          </select>
        </div>
        <div class="mb-3">
          <label for="nama">Kontak</label>
          <input type="text" name="nama_pemesan" id="nama_pemesan" value="<?= $data['nama_pemesan'] ?>" class="form-control mb-2"placeholder="Nama Lengkap" autocomplete="off" required>
          <input type="number" name="no_hp" id="no_hp" class="form-control mb-2" value="<?= $data['no_hp'] ?>" placeholder="NomorTelepon" required>
          <input type="email" name="email" id="email" class="form-control" value="<?= $data['email'] ?>" placeholder="Email" required>
        </div>
        <div class="mb-3">
          <label for="detail">Alamat</label>
          <textarea name="alamat_pemesan" id="alamat_pemesan" cols="30" rows="5" class="form-control">
            <?= $data['alamat_pemesan'] ?>
          </textarea>
        </div>
        <div class="mb-3">
          <label for="detail">Deskripsi</label>
          <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control">
            <?= $data['deskripsi'] ?>
          </textarea>
        </div>
        <div class="mb-3">
          <label for="tanggal">Tanggal Pemesanan</label>
          <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= $data['tanggal'] ?>">
        </div>
        <div>
          <label for="jumlah_pesanan">Jumlah Pesanan</label>
          <input type="number" name="jumlah_pesanan" id="jumlah_pesanan" class="form-control mb-2" value="<?= $data['jumlah_pesanan'] ?>" required>
        </div>
        <div class="my-3">
          <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
          <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
        </div>
        <!-- <div class="mt-3">
          <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
        </div> -->
      </form>
      
      <?php
        if(isset($_POST['editBtn'])) {
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
            $queryUpdate = mysqli_query($con, "UPDATE pesanan SET produk_id='$produk', tanggal='$date', nama_pemesan='$nama', no_hp='$no_hp', email='$email', alamat_pemesan='$alamat', jumlah_pesanan='$jumlah_pesanan', deskripsi='$deskripsi' WHERE id=$id");
            // Query Edit
            // $queryUpdate = mysqli_query($con, "INSERT INTO pesanan (produk_id, tanggal, nama_pemesan, no_hp, email, alamat_pemesan,jumlah_pesanan, deskripsi) VALUES ('$produk', '$date', '$nama', '$no_hp', '$email', '$alamat', '$jumlah_pesanan', '$deskripsi')");

            if($queryUpdate) {
      ?>
              <div class="alert alert-primary mt-3" role="alert">
                Data pesanan berhasil diupdate
              </div>
          
              <meta http-equiv="refresh" content="1; url=pesanan.php" />
      <?php
            }
            else {
              echo mysqli_error($con);
            }
          }
        }
        if(isset($_POST['deleteBtn'])) {
          $queryDelete = mysqli_query($con, "DELETE FROM pesanan WHERE id='$id'");

          if($queryDelete) {
      ?>
            <div class="alert alert-primary mt-3" role="alert">
              Data produk berhasil dihapus
            </div>
  
            <meta http-equiv="refresh" content="1; url=pesanan.php" />
      <?php
          }
        }
      ?>
    </div>
  </div>
</body>