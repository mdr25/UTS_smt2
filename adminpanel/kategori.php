<?php
  require "session.php";
  require "../koneksi.php";

  $queryKategori = mysqli_query($con, "SELECT * FROM kategori_produk");
  $jumlahKategori = mysqli_num_rows($queryKategori);
?>

<head>
  <title>Kategori Produk</title>
</head>
<body>
  <?php
    require "navbar.php";
  ?>
  <div class="container mt-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../adminpanel/" class="decoration text-muted">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Kategori Produk</li>
      </ol>
    </nav>

    <div class="mb-5 col-12 col-md-6">
      <h3>Tambah Kategori</h3>

      <p>
        <button class="btn btn-primary  mt-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          Tambah<i class="bi bi-plus"></i>
        </button>
      </p>
      <div class="collapse" id="collapseExample">
        <div class="card card-body">
          <form action="" method="post">
            <div>
              <label for="kategori"></label>
              <input type="text" name="kategori" id="kategori" class="form-control" placeholder="Input nama kategori" autocomplete="off">
            </div>
            <div class="mt-3">
              <button class="btn btn-success" type="submit" name="simpan_kategori">Simpan</button>
            </div>
          </form>
        </div>
      </div>

      <?php
        if(isset($_POST['simpan_kategori'])) {
          $kategori = htmlspecialchars($_POST['kategori']);

          $queryExist = mysqli_query($con, "SELECT nama FROM kategori_produk WHERE nama = '$kategori'");
          $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

          if($jumlahDataKategoriBaru > 0) {
      ?>
            <div class="alert alert-warning mt-3" role="alert">
              Error! Kategori yang dimasukkan sudah ada
            </div>
      <?php
          }
          else {
            $querySimpan = mysqli_query($con, "INSERT INTO kategori_produk (nama) VALUES ('$kategori')");
            if($querySimpan) {
      ?>
              <div class="alert alert-primary mt-3" role="alert">
                Data kategori berhasil ditambahkan
              </div>

              <meta http-equiv="refresh" content="1.5; url=kategori.php" />
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
      <h2>List Kategori</h2>

      <div class="table-responsive mt-4">
        <table class="table" style="vertical-align: middle;">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              if($jumlahKategori == 0) {
            ?>
            <tr>
              <td colspan="3" class="text-center">Tidak ada data kategori</td>
            </tr>
            <?php
              }
              else {
                $number = 1;
                while($data = mysqli_fetch_array($queryKategori)) {
            ?>
            <tr>
              <td><?= $number ?></td>
              <td><?= $data['nama'] ?></td>
              <td>
                <a href="kategori-detail.php?d=<?php echo $data['id']; ?>" class="btn btn-info"><i class="bi bi-search"></i></a>
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