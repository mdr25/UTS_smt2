<?php
  require "session.php";
  require "../koneksi.php";

  $query = mysqli_query($con, "SELECT a.*, b.nama AS nama_produk FROM pesanan a JOIN produk b ON a.produk_id=b.id");
  $jumlahPesanan = mysqli_num_rows($query);

  
?>

<head>
  <title>Orders</title>
</head>

<body>
  <?php require "navbar.php"; ?>
  <div class="container mt-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../adminpanel/" class="decoration text-muted">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
       </ol>
    </nav>
  
    <div class="mb-5 col-12 col-md-6">
      <h3>Tambah Pesanan</h3>
      <a href="../produk.php" class="btn btn-primary mt-4">Order <i class="bi bi-bag-plus"></i></a>
    </div>
    
    <div>
      <h2>List Pesanan</h2>

      <div class="table-responsive mt-4">
        <table class="table" style="vertical-align: middle;">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal Pemesanan</th>
              <th>Nama Pemesan</th>
              <th>Alamat</th>
              <th>Nomor Telepon</th>
              <th>Email</th>
              <th>Jumlah Pesanan</th>
              <th>Produk</th>
              <th>Deskripsi</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              if($jumlahPesanan == 0) {
            ?>
                <tr>
                  <td colspan="10" class="text-center">Tidak ada pesanan</td>
                </tr>
            <?php
              }
              else {
                $number = 1;
                while($data=mysqli_fetch_array($query)) {
            ?>
                  <tr>
                    <td><?= $number ?></td>
                    <td><?= $data['tanggal'] ?></td>
                    <td><?= $data['nama_pemesan'] ?></td>
                    <td><?= $data['alamat_pemesan'] ?></td>
                    <td><?= $data['no_hp'] ?></td>
                    <td><?= $data['email'] ?></td>
                    <td><?= $data['jumlah_pesanan'] ?></td>
                    <td><?= $data['nama_produk'] ?></td>
                    <td><?= $data['deskripsi'] ?></td>
                    <td>
                      <a href="detail-pesanan.php?d=<?php echo $data['id']; ?>" class="btn btn-info"><i class="bi bi-search"></i></a>
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