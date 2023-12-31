<?php
include "functions.php";
cekUserLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />

  <!-- Link Css -->
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <!-- Navbar -->
  <?php include 'navbar.php' ?>

  <!-- end navbar -->

  <!-- Home page 1 -->
  <section id="page1">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12 text-white">
          <h1>Fit Club Pro</h1>
        </div>
      </div>
    </div>
  </section>
  <!-- end Home page 1 -->

  <!-- home page 2 -->
  <section id="page2">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-md-6">
          <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="4000">
                <img src="images/img1.jpg" class="d-block w-100 rounded-4" height="300px" alt="img" />
              </div>
              <div class="carousel-item" data-bs-interval="4000">
                <img src="images/img2.jpg" class="d-block w-100 rounded-4" height="300px" alt="img" />
              </div>
              <div class="carousel-item" data-bs-interval="4000">
                <img src="images/img3.jpg" class="d-block w-100 rounded-4" height="300px" alt="img" />
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <h2 class="pb-3">Fit Club Pro</h2>
          <p>
            Gym Fit Club Pro hadir untuk semua orang. Memiliki berbagai peralatan modern dan fasilitas yang lengkap. Anda juga dapat memilih untuk berlatih sendiri, dengan pelatih pribadi, atau dengan grup di kelas. Anda akan menemukan
            segalanya di sini untuk merasakan pengalaman fitness yang terbaik.
          </p>
        </div>
      </div>
    </div>
  </section>
  <!-- end home page 2 -->

  <!-- home page 3 -->
  <section id="page3">
    <div class="container h-100">
      <div class="row py-4">
        <div class="col-12 text-center position-relative">
          <h2 class="border-bottom border-end border-5 border-black">Fasilitas</h2>
        </div>
      </div>
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <div class="container">
            <div class="row mb-3">
              <div class="col-4">
                <img src="images/Icon-7.jpg" alt="icon" />
                <span>Ruang Tunggu</span>
              </div>
              <div class="col-4">
                <img src="images/Icon-6.jpg" alt="icon" />
                <span>SHOWER ROOM</span>
              </div>
              <div class="col-4">
                <img src="images/Icon-5.jpg" alt="icon" />
                <span>TOILET</span>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-4">
                <img src="images/Icon-4.jpg" alt="icon" />
                <span>Ruang Ganti</span>
              </div>
              <div class="col-4">
                <img src="images/Icon-3.jpg" alt="icon" />
                <span>LOCKER</span>
              </div>
              <div class="col-4">
                <img src="images/Icon-2.jpg" alt="icon" />
                <span>RIPSTICK</span>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-4">
                <img src="images/Icon-1.jpg" alt="icon" />
                <span>FREE WEIGHTS</span>
              </div>
              <div class="col-4">
                <img src="images/Icon.jpg" alt="icon" />
                <span>MATRAS</span>
              </div>
              <div class="col-4">
                <img src="images/charging.jpg" alt="icon" />
                <span>CHARGING</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end home page 3 -->

  <!-- home page 4 -->
  <section id="page4">
    <div class="container h-100">
      <div class="row justify-content-center h-100 align-items-center">
        <div class="col-10 text-center">
          <h2 class="py-4">Maps</h2>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253840.49131696904!2d106.6647012844609!3d-6.2297209277418535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1690455174612!5m2!1sid!2sid" class="rounded-5" width="100%" height="450" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </section>
  <!-- end home page 4 -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>