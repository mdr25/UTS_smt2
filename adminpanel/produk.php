<?php
  require "session.php";
  require "../koneksi.php";

  $query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori_produk FROM produk a JOIN kategori_produk b ON a.kategori_produk_id=b.id");
  $jumlahProduk = mysqli_num_rows($query);

  $queryKategori = mysqli_query($con, "SELECT * FROM kategori_produk");
  
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
  <title>Produk</title>
</head>

<body>
  <?php require "navbar.php"; ?>
  <div class="container mt-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../adminpanel/" class="decoration text-muted">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Produk</li>
      </ol>
    </nav>


    <div class="mb-5 col-12 col-md-6">
      <h3>Tambah Produk</h3>

      <p>
        <button class="btn btn-primary mt-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          Tambah<i class="bi bi-plus"></i>
        </button>
      </p>
      <div class="collapse" id="collapseExample">
        <div class="card card-body">
          <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-2">
              <label for="nama">Nama</label>
              <input type="text" name="nama" id="nama" class="form-control" placeholder="Tuliskan nama produk" autocomplete="off" required>
            </div>
            <div class="mb-2">
              <label for="kategori">Kategori</label>
              <select name="kategori" id="kategori" class="form-control" required>
                <option value="">Pilih Kategori</option>
                <?php
                  while($data=mysqli_fetch_array($queryKategori)) {
                ?>
                    <option value="<?= $data['id'] ?>"><?= $data['nama'] ?></option>
                <?php
                  }
                ?>
              </select>
            </div>
            <div class="mb-2">
              <label for="harga">Harga</label>
              <input type="number" name="harga" id="harga" class="form-control" required>
            </div>
            <div class="mb-2">
              <label for="foto">Foto</label>
              <input type="file" name="foto" id="foto" class="form-control">
            </div>
            <div class="mb-2">
              <label for="detail">Detail</label>
              <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div>
              <label for="ketersediaan_stok">Stok</label>
              <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                <option value="tersedia">Tersedia</option>
                <option value="habis">Habis</option>
              </select>
            </div>
            <div class="mt-3">
              <button class="btn btn-success" type="submit" name="simpan">Simpan</button>
            </div>
          </form>
        </div>
      </div>

      

      <?php
        if(isset($_POST['simpan'])) {
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

          if($nama=='' || $kategori=='' || $harga=='') {
      ?>
            <div class="alert alert-warning mt-3" role="alert">
              Nama, Kategori dan Harga wajib diisi
            </div>
      <?php
          }
          else {
            if($nama_file!='') {
              if($image_size > 2000000) {
      ?>
                <div class="alert alert-warning mt-3" role="alert">
                  File tidak boleh lebih dari 2 Mb
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
                }
              }
            }

            // Query Insert
            $queryTambah = mysqli_query($con, "INSERT INTO produk (kategori_produk_id, nama, harga, foto, detail, ketersediaan_stok) VALUES ('$kategori', '$nama', '$harga', '$new_name', '$detail', '$ketersediaan_stok')");

            if($queryTambah) {
      ?>
              <div class="alert alert-primary mt-3" role="alert">
                Produk berhasil ditambahkan
              </div>

              <meta http-equiv="refresh" content="1.5; url=produk.php" />
      <?php
            }
            else {
              echo mysqli_error($con);
            }
          }
        }
      ?>
    </div>

    <div>
      <h2>List Produk</h2>

      <div class="table-responsive mt-4">
        <table class="table" style="vertical-align: middle;">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Kategori</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              if($jumlahProduk==0) {
            ?>
                <tr>
                  <td colspan="6" class="text-center">Tidak ada data produk</td>
                </tr>
            <?php
              }
              else {
                $number = 1;
                while($data=mysqli_fetch_array($query)) {
            ?>
                  <tr>
                    <td><?= $number ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['nama_kategori_produk'] ?></td>
                    <td><?= $data['harga'] ?></td>
                    <td><?= $data['ketersediaan_stok'] ?></td>
                    <td>
                      <a href="produk-detail.php?d=<?php echo $data['id']; ?>" class="btn btn-info"><i class="bi bi-search"></i></a>
                    </td>
                  </tr>
            <?php
                $number++;
                }
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>