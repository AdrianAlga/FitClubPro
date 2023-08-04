<?php
include "functions.php";
cekUserLogin();

$products = query("SELECT * FROM products");
$features = query("SELECT * FROM features");

if (isset($_POST["checkout"])) {
  // Ambil data dari form
  $id = sprintf("%006d", rand(0, 999999));
  $product_id = htmlspecialchars($_POST["product_id"]);
  $user_id = htmlspecialchars($_POST["user_id"]);
  $name = htmlspecialchars($_POST["name"]);
  $email = htmlspecialchars($_POST["email"]);
  $address = htmlspecialchars($_POST["address"]);
  $phone = htmlspecialchars($_POST["phone"]);
  $age = htmlspecialchars($_POST["age"]);
  $gender = htmlspecialchars($_POST["gender"]);
  $order_date = new DateTime();
  $order_date = $order_date->format("Y-m-d");

  // Lakukan proses insert data ke database
  $query =  "INSERT INTO `orders` VALUES (
            '$id', 
            '$name',
            '$email',
            '$address',
            '$phone',
            '$age',
            '$gender',
            '$user_id',
            '$product_id',
            'Pending',
            '$order_date',
            ''
            )";
  $result = mysqli_query($conn, $query);

  if ($result) {
    // Redirect ke halaman sukses atau ke halaman lain yang Anda inginkan
    header("Location: order.php");
    exit;
  } else {
    // Jika proses insert gagal, tampilkan pesan error
    $error_message = "Gagal melakukan proses pemesanan. Silahkan coba lagi.";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Membersip</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />

  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <!-- Navbar -->
  <?php include 'navbar.php' ?>

  <!-- end navbar -->

  <!-- halaman1 -->
  <section id="halaman1">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-md-6">
          <h1>MEMBERSIP</h1>
          <p>
            "Selamat datang di klub kebugaran kami! Bergabunglah dengan program membersip kami dan raih tubuh sehat dan bugar yang Anda impikan. Dengan menjadi anggota GYM, Anda akan mendapatkan akses ke fasilitas lengkap kami, termasuk
            beragam alat olahraga modern, kelas kebugaran yang dipandu oleh instruktur ahli, dan dukungan penuh untuk mencapai tujuan kebugaran Anda. Nikmati pengalaman kebugaran yang menyenangkan dan komunitas yang mendukung, serta
            jadwalkan sesi latihan Anda dengan fleksibilitas. Bergabunglah dengan kami hari ini dan mulailah perjalanan menuju hidup sehat dan aktif!"
          </p>
        </div>
        <div class="col-md-6">
          <img src="images/GYM.jpg" alt="img" class="img-fluid rounded-5" />
        </div>
      </div>
    </div>
  </section>
  <!-- end halaman1 -->

  <!-- halaman2 -->
  <section id="halaman2">
    <div class="container py-5">
      <div class="row">
        <h1 class="fw-bold">NgeGym Ga Pake Mahal</h1>
        <p>Nikmati gym paling terjangkau di Indonesia dan capai tujuan kebugaran Anda bersama kami.</p>
      </div>
      <div class="row">
        <?php foreach ($products as $index => $product) : ?>
          <div class="col-2 mb-2">
            <div class="card">
              <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#checkout-modal<?= $product['id_product'] ?>">
                <div class="container h-100">
                  <div class="row">
                    <div class="col-12">
                      <span class="txt1"><?= $product['month']; ?></span>
                      <span class="txt2">Bulan</span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <span>Rp.</span>
                      <span class="fw-bold"><?= $product['month_price']; ?></span>
                      <span class="txt3">/bulan</span>
                    </div>
                    <div class="col-12">
                      <span class="txt3">Rp.</span>
                      <span class="txt3"><del><?= $product['month_price_cut']; ?></del></span>
                      <span class="txt3">/bulan</span>
                    </div>
                    <div class="col-12 py-3">
                      <div class="border-bottom"></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="container p-0">
                        <?php foreach ($features as $index => $feature) : ?>
                          <?php if ($feature['product_id'] == $product['id_product']) : ?>
                            <div class="row">
                              <div class="col-1">
                                <p class="fs-6"><i class="bi bi-check2-circle text-success"></i></p>
                              </div>
                              <div class="col-10">
                                <p class="txt3"><?= $feature['body'] ?></p>
                              </div>
                            </div>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                  <div class="row pb-2">
                    <div class="col-12">
                      <span class="txt3">Total Harga :</span>
                      <div class="txt4">
                        <span>Rp.</span>
                        <span><?= $product['total_price']; ?></span>
                      </div>
                      <div>
                        <p class="txt3">
                          <del>
                            <span>Rp.</span>
                            <span><?= $product['total_price_cut']; ?></span>
                          </del>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </button>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Modal checkout-->
    <?php foreach ($products as $index => $product) : ?>
      <form action="" method="post">
        <input type="hidden" name="product_id" value="<?= $product['id_product'] ?>">
        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
        <div class="modal fade" id="checkout-modal<?= $product['id_product'] ?>" tabindex="-1" aria-labelledby="checkout-modal<?= $product['id_product'] ?>Label" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <div class="col-2"></div>
                <div class="col-8 text-center">
                  <h1 class="modal-title fs-5" id="checkout-modal<?= $product['id_product'] ?>Label">Berlangganan</h1>
                </div>
                <div class="col-2 text-end">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label for="name" class="form-label">Masukkan Nama</label>
                  <input type="text" class="form-control" id="name" name="name" required />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Masukkan Email</label>
                  <input type="email" class="form-control" id="email" name="email" required />
                </div>
                <div class="mb-3">
                  <label for="address" class="form-label">Masukkan Alamat</label>
                  <input type="text" class="form-control" id="address" name="address" required />
                </div>
                <div class="mb-3">
                  <label for="phone" class="form-label">Masukkan NoHp</label>
                  <input type="number" class="form-control" id="phone" name="phone" required />
                </div>
                <div class="mb-3">
                  <div class="container">
                    <div class="row">
                      <div class="col-6">
                        <label for="age" class="form-label">Masukkan Umur</label>
                        <input type="number" class="form-control" id="age" name="age" required />
                      </div>
                      <div class="col-6">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select name="gender" class="form-select" aria-label="Default select example">
                          <option value="Laki-Laki">Laki-Laki</option>
                          <option value="Perempuan">Perempuan</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" name="checkout" class="btn btn-primary">Kirim</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    <?php endforeach; ?>
    <!-- end modal -->
  </section>
  <!-- end halaman2 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>