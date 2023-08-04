<?php
include "functions.php";

session_start();
if (isset($_SESSION["loginAdmin"])) {
  header('Location: admin/index.php');
  exit;
}
if (isset($_SESSION["loginUser"])) {
  header('Location: index.php');
  exit;
}

if (isset($_POST["regis"])) {

  $id = sprintf("%006d", rand(0, 999999));
  $username = $_POST["username"];
  $password = $_POST["password"];
  $email = $_POST["email"];

  $query =  "INSERT INTO `users` VALUES (
            '$id',  
            '$username',  
            '$password',  
            '$email',
            '0'
            )";
  $result = mysqli_query($conn, $query);
  if ($result) {
    header("Location: login.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registrasi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

  <!-- CSS -->
  <link rel="stylesheet" href="css/login.css" />
</head>

<body>
  <section id="login">
    <div class="container-fluid h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <div class="row justify-content-center">
            <div class="col-md-9 text-center text-white">
              <h1>Fit Club Pro</h1>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-11 col-md-5">
              <div class="login-box">
                <p>Registrasi</p>
                <?php if (isset($error)) : ?>
                  <p style="color: red; font-style: italic;" class="text-center">Username / Password Salah!</p>
                <?php endif ?>
                <form action="" method="post">
                  <div class="user-box">
                    <input required id="username" name="username" type="text" maxlength="30" />
                    <label for="username">Username</label>
                  </div>
                  <div class="user-box">
                    <input required id="email" name="email" type="gmail" />
                    <label for="email">Email</label>
                  </div>
                  <div class="user-box">
                    <input required id="myInput" name="password" type="password" />
                    <i class="far fa-eye text-white eye-icon" id="eyeIcon" onclick="togglePasswordVisibility()"></i>
                    <label for="myInput">Password</label>
                  </div>
                  <button type="submit" name="regis">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Registrasi
                  </button>
                </form>
                <div class="container pt-3">
                  <div class="row">
                    <div class="col-12">
                      <span class="text-white">Sudah mempunyai akun?</span>
                      <span class="ps-1"><a href="login.php">Masuk sekarang</a></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="js/password.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>