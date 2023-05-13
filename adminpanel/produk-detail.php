<?php
  require "session.php";
  require "../koneksi.php";

  $id = $_GET['d'];

  $query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori_produk FROM produk a JOIN kategori_produk b ON a.kategori_produk_id=b.id WHERE a.id=$id");
  $data = mysqli_fetch_array($query);

  $queryKategori = mysqli_query($con, "SELECT * FROM kategori_produk WHERE id!='$data[kategori_produk_id]'");

  function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
?>

<head>
  <title>Detail Produk</title>
</head>

<body>
  <?php require "navbar.php"; ?>

  <div class="container mt-3">
    <div class="col-12 col-md-6">
      <h2>Detail Produk</h2>
      <form action="" method="POST" enctype="multipart/form-data">
        <div div class="mb-2">
          <label for="nama">Nama</label>
          <input type="text" name="nama" id="nama" value="<?= $data['nama'] ?>" class="form-control" placeholder="Input nama kategori" autocomplete="off" required>
        </div>
        <div class="mb-2">
          <label for="kategori">Kategori</label>
          <select name="kategori" id="kategori" class="form-control" required>
            <option value="<?= $data['kategori_produk_id'] ?>"><?= $data['nama_kategori_produk'] ?></option>
            <?php
              while($dataKategori=mysqli_fetch_array($queryKategori)) {
            ?>
                <option value="<?= $dataKategori['id'] ?>"><?= $dataKategori['nama'] ?></option>
            <?php
              }
            ?>
          </select>
        </div>
        <div class="mb-2">
          <label for="harga">Harga</label>
          <input type="number" name="harga" id="harga" value="<?= $data['harga'] ?>" class="form-control" required>
        </div>
        <div class="mb-2">
          <label for="currentFoto">Foto Produk saat ini</label>
          <br/>
          <img src="../image/<?= $data['foto'] ?>" alt="" width="300px">
        </div>
        <div class="mb-2">
          <label for="foto">Foto</label>
          <input type="file" name="foto" id="foto" class="form-control">
        </div>
        <div class="mb-2">
          <label for="detail">Detail</label>
          <textarea name="detail" id="detail" cols="30" rows="10" class="form-control">
            <?= $data['detail'] ?>
          </textarea>
        </div>
        <div>
          <label for="ketersediaan_stok">Stok</label>
          <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
            <option value="<?= $data['ketersediaan_stok'] ?>"><?= $data['ketersediaan_stok'] ?></option>
            <?php
              if($data['ketersediaan_stok']=='tersedia'){
            ?>
                <option value="habis">habis</option>
            <?php
              }
              else {
            ?>
                <option value="tersedia">tersedia</option>
            <?php    
              }
            ?>
          </select>
        </div>
        <div class="my-3">
          <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
          <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
        </div>
      </form>

      <?php
        if(isset($_POST['editBtn'])) {
          $nama = htmlspecialchars($_POST['nama']);
          $kategori = htmlspecialchars($_POST['kategori']);
          $harga = htmlspecialchars($_POST['harga']);
          $detail = htmlspecialchars($_POST['detail']);
          $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

          $target_dir = "../image/";
          $nama_file = basename($_FILES["foto"]["name"]);
          $target_file = $target_dir . $nama_file;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
          $image_size = $_FILES["foto"]["size"];
          $random_name = generateRandomString(20);
          $new_name = $random_name . "." . $imageFileType;

          if($nama == '' || $kategori == '' || $harga == '') {
      ?>
            <div class="alert alert-warning mt-3" role="alert">
              Nama, Kategori dan Harga wajib diisi
            </div>
      <?php
          }
          else {
            $queryUpdate = mysqli_query($con, "UPDATE produk SET kategori_produk_id='$kategori', nama='$nama', harga='$harga', detail='$detail', ketersediaan_stok='$ketersediaan_stok' WHERE id=$id");

            if($nama_file!='') {
              if($image_size > 4000000) {
      ?>
                <div class="alert alert-warning mt-3" role="alert">
                  File tidak boleh lebih dari 4 Mb
                </div>
      <?php
              }
              else {
                if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'gif') {
      ?>
                  <div class="alert alert-warning mt-3" role="alert">
                    File harus berekstensi jpg, png atau gif
                  </div>
      <?php
                }
                else {
                  move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);

                  $queryUpdate = mysqli_query($con, "UPDATE produk SET foto='$new_name' WHERE id='$id'");

                  if($queryUpdate) {
      ?>
                    <div class="alert alert-primary mt-3" role="alert">
                      Data produk berhasil diupdate
                    </div>

                    <meta http-equiv="refresh" content="1.5; url=produk.php" />
      <?php
                  }
                  else {
                    echo mysqli_error($con);
                  }
                }
              }
            }
          }
        }
        if(isset($_POST['deleteBtn'])) {
          $queryDelete = mysqli_query($con, "DELETE FROM produk WHERE id='$id'");

          if($queryDelete) {
      ?>
            <div class="alert alert-primary mt-3" role="alert">
              Data produk berhasil dihapus
            </div>
  
            <meta http-equiv="refresh" content="1.5; url=produk.php" />
      <?php
          }
        }
      ?>
    </div>
  </div>
</body>
