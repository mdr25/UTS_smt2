<?php
  require "session.php";
  require "../koneksi.php";

  $id = $_GET['d'];

  $query = mysqli_query($con, "SELECT * FROM kategori_produk WHERE id='$id'");
  $data = mysqli_fetch_array($query);
?>

<head>
  <title>Detail Kategori</title>
</head>

<body>
  <?php
    require "navbar.php";
  ?>
<div class="container mt-3">
  <div class="col-12 col-md-6">
    <h2>Detail Kategori</h2>
    <form action="" method="POST">
      <div>
        <label for="kategori">Kategori</label>
        <input type="text" name="kategori" id="kategori" value="<?= $data['nama'] ?>" class="form-control">
      </div>
      <div class="mt-3">
        <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
        <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
      </div>
    </form>

    <?php
      if(isset($_POST['editBtn'])) {
        $kategori = htmlspecialchars($_POST['kategori']);

        if($data['nama']==$kategori) {
    ?>
          <meta http-equiv="refresh" content="0; url=kategori.php" />
    <?php
        }
        else {
          $query = mysqli_query($con, "SELECT * FROM kategori_produk WHERE nama='$kategori'");
          $jumlahData = mysqli_num_rows($query);

          if($jumlahData > 0) {
    ?>
            <div class="alert alert-warning mt-3" role="alert">
              Error! Kategori yang dimasukkan sudah ada
            </div>
    <?php
          }
          else {
            $querySimpan = mysqli_query($con, "UPDATE kategori_produk SET nama='$kategori' WHERE id='$id'");
            if($querySimpan) {
    ?>
              <div class="alert alert-primary mt-3" role="alert">
                Data kategori berhasil diupdate
              </div>
        
              <meta http-equiv="refresh" content="1.5; url=kategori.php" />
    <?php
            }
            else {
              echo mysqli_error($con);
            }
          }
        }
      }

      if(isset($_POST['deleteBtn'])) {
        $queryCheck = mysqli_query($con, "SELECT * FROM produk WHERE kategori_produk_id='$id'");
        $dataCount = mysqli_num_rows($queryCheck);
        
        if($dataCount > 0) {
    ?>
          <div class="alert alert-warning mt-3" role="alert">
            Kategori tidak bisa dihapus karena sedang digunakan oleh sebuah produk
          </div>
    <?php
          die();
        }
        
        $queryDelete = mysqli_query($con, "DELETE FROM kategori_produk WHERE id='$id'");
        
        if($queryDelete) {
    ?>
          <div class="alert alert-primary mt-3" role="alert">
            Data kategori berhasil dihapus
          </div>

          <meta http-equiv="refresh" content="1.5; url=kategori.php" />
    <?php
        }
        else {
          echo mysqli_error($con);
        }
      }
    ?>
  </div>
</div>
</body>
