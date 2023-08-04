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

if (isset($_POST["login"])) {

  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

  if (mysqli_num_rows($result) === 1) {

    $row = mysqli_fetch_assoc($result);
    if ($password == $row["password"]) {
      if ($row["level"] == 1) {
        $_SESSION["loginAdmin"] = true;
        header("Location: admin/index.php");
        exit;
      } else {
        $_SESSION["loginUser"] = true;
        $_SESSION["user_id"] = $row["id_user"];
        header("Location: index.php");
        exit;
      }
    }
  }
  $error = true;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

  <!-- CSS -->
  <link rel="stylesheet" href="css/login.css">
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
                <p>Login</p>
                <?php if (isset($error)) : ?>
                  <p style="color: red; font-style: italic;" class="text-center">Username / Password Salah!</p>
                <?php endif ?>
                <form action="" method="post">
                  <div class="user-box">
                    <input required name="username" id="username" type="text" maxlength="30" />
                    <label for="username">Username</label>
                  </div>
                  <div class="user-box">
                    <input required id="myInput" name="password" type="password" />
                    <i class="far fa-eye text-white eye-icon" id="eyeIcon" onclick="togglePasswordVisibility()"></i>
                    <label for="myInput">Password</label>
                  </div>
                  <button type="submit" name="login">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Masuk
                  </button>
                </form>
                <div class="container pt-3">
                  <div class="row">
                    <div class="col-12">
                      <span class="text-white">Apakah anda belum mempunyai akun?</span>
                      <span class="ps-1"><a href="regist.php">Daftar sekarang</a></span>
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