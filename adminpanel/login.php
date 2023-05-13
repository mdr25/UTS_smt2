<?php
  session_start();
  require "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

  <style>
    .main {
      height: 100vh;
    }
    
    .login-box {
      width: 500px;
      height: 300px;
      border: solid 1px;
      box-sizing: border-box;
      border-radius: 10px;
    }
  </style>

  <title>Login</title>
</head>
<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
      <div class="login-box shadow p-5">
        <form action="" method="post">
          <div>
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username">
          </div>
          <div>
            <label for="username">Password</label>
            <input type="text" class="form-control" name="password" id="password">
          </div>
          <div>
            <button class="btn btn-success form-control mt-3" type="submit" name="loginbtn">Login</button>
          </div>
        </form>
      </div>
      <div class="mt-3">
        <?php
          if(isset($_POST['loginbtn'])){
              $username = htmlspecialchars($_POST['username']);
              $password = htmlspecialchars($_POST['password']);

              $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
              $countdata = mysqli_num_rows($query);
              $data = mysqli_fetch_array($query);

              if($countdata>0){
                if (password_verify($password, $data['password'])) {
                  $_SESSION['username'] = $data['username'];
                  $_SESSION['login'] = true;
                  header('location: ../adminpanel');
                }
                else {
                  ?>
                  <div class="alert alert-warning" role="alert">
                    Username atau Password salah!
                  </div>
                  <?php  
                }
              }
              else {
                ?>
                <div class="alert alert-warning" role="alert">
                  Username atau Password salah!
                </div>
                <?php
              }
          }
        ?>
      </div>
      <div>
        <p>
          <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Klik untuk melihat Username dan Password
          </button>
        </p>
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
            <p>Username : admin</p>
            <p>Password : 1234</p>
          </div>
        </div>
      </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>