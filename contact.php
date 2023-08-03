<?php
session_start();
include "functions.php";
cekUserLogin();

if (isset($_POST["contact"])) {
  $id = sprintf("%006d", rand(0, 999999));
  $name = htmlspecialchars($_POST["name"]);
  $email = htmlspecialchars($_POST["email"]);
  $phone = htmlspecialchars($_POST["phone"]);
  $message = htmlspecialchars($_POST["message"]);

  $query =  "INSERT INTO `messages` VALUES (
            '$id',
            '$name', 
            '$email',
            '$phone',
            '$message'
            )";
  $result = mysqli_query($conn, $query);

  if ($result) {
    header("Location: index.php");
    exit;
  }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />

  <!-- CSS -->
  <link rel="stylesheet" href="css/contact.css" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <!-- navbar -->
  <?php include 'navbar.php' ?>

  <!-- end navbar -->

  <!-- contact -->
  <section id="contact">
    <div class="container h-100 pt-5">
      <div class="row justify-content-center h-100 align-items-center">
        <div class="col-6 mt-5 py-3">
          <div class="login-box">
            <p>Contact</p>
            <form action="" method="post">
              <div class="user-box">
                <input required name="name" id="name" type="text" />
                <label for="name">Masukkan Nama</label>
              </div>
              <div class="user-box">
                <input required name="email" id="email" type="email" />
                <label for="email">Email</label>
              </div>
              <div class="user-box">
                <input required name="phone" id="phone" type="number" />
                <label for="phone">Nomor Telepon</label>
              </div>
              <div class="mb-3 text-white">
                <label for="message" class="form-label">Pesan</label>
                <textarea name="message" class="form-control bg-secondary text-white" id="message" rows="3"></textarea>
              </div>
              <button type="submit" name="contact" class="btn bg-transparent">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Kirim
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>