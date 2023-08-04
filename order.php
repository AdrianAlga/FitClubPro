<?php
include "functions.php";
cekUserLogin();
$userId = $_SESSION["user_id"];
$orders = query("SELECT orders.*, products.*
          FROM orders
          JOIN products ON orders.product_id = products.id_product
          WHERE user_id='$userId'");
          
if (isset($_POST["hapus"])) {
  $id = $_POST["id"];
  $result = mysqli_query($conn, "DELETE FROM `orders` WHERE id_order='$id'");
  if ($result) {
    header("Location: order.php");
    exit;
  }
}

if (isset($_POST["pay"])) {
  $orderId = $_POST['id'];
  $pay_image = uploadGambar('pay_image');
  $query = "UPDATE orders SET pay_image = '$pay_image' WHERE id_order = '$orderId'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    header("Location: order.php");
    exit;
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>InfoPesanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />

  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <!-- navbar -->
  <?php include 'navbar.php' ?>

  <!-- end navbar -->

  <!-- halaman1 -->
  <section id="pesanan">
    <div class="container-fluid">
      <div class="row">
        <div class="col-8 pt-5">
          <h1 class="py-3 text-white">Informasi Pesanan</h1>
          <div>
            <div class="container">
              <?php foreach ($orders as $index => $order) : ?>
                <div class="row">
                  <div class="col-10 p-0">
                    <div class="dropdown mb-2">
                      <button class="btn rounded-end-0 btn-secondary dropdown-toggle w-100 text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="container">
                          <div class="row">
                            <div class="col-6">Status</div>
                            <?php if ($order['status'] == "Confirmed") : ?>
                              <div class="col-6 text-end"><span class="badge text-bg-success">Success</span></div>
                            <?php elseif ($order['status'] == "Canceled") : ?>
                              <div class="col-6 text-end"><span class="badge text-bg-danger">Failed</span></div>
                            <?php else : ?>
                              <div class="col-6 text-end"><span class="badge text-bg-warning">Pedding</span></div>
                            <?php endif ?>
                          </div>
                        </div>
                      </button>
                      <div class="dropdown-menu p-4 text-body-secondary w-100">
                        <div class="container">
                          <div class="row">
                            <div class="col-3">
                              <div class="container">
                                <div class="row">
                                  <div class="col-12">
                                    <img src="images/barcode.jpeg" alt="img" height="100px" />
                                  </div>
                                  <div class="col-12">
                                    <p>09-07-2023</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-9">
                              <table>
                                <thead>
                                  <tr>
                                    <th class="col-5">Nama</th>
                                    <th class="col-1">:</th>
                                    <th class="col-6"><?= $order['name'] ?></th>
                                  </tr>
                                  <tr>
                                    <th class="col-5">Email</th>
                                    <th class="col-1">:</th>
                                    <th class="col-6"><?= $order['email'] ?></th>
                                  </tr>
                                  <tr>
                                    <th class="col-5">Alamat</th>
                                    <th class="col-1">:</th>
                                    <th class="col-6"><?= $order['address'] ?></th>
                                  </tr>
                                  <tr>
                                    <th class="col-5">NoHp</th>
                                    <th class="col-1">:</th>
                                    <th class="col-6"><?= $order['phone'] ?></th>
                                  </tr>
                                  <tr>
                                    <th class="col-5">Umur</th>
                                    <th class="col-1">:</th>
                                    <th class="col-6"><?= $order['age'] ?></th>
                                  </tr>
                                  <tr>
                                    <th class="col-5">Jenis Kelamin</th>
                                    <th class="col-1">:</th>
                                    <th class="col-6"><?= $order['gender'] ?></th>
                                  </tr>
                                  <tr>
                                    <th class="col-5">Membaersip</th>
                                    <th class="col-1">:</th>
                                    <th class="col-6"><?= $order['month'] ?> Bulan</th>
                                  </tr>
                                  <tr>
                                    <th class="col-5">Total</th>
                                    <th class="col-1">:</th>
                                    <th class="col-6">Rp. <?= $order['total_price'] ?></th>
                                  </tr>
                                </thead>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-1 p-0">
                    <button class="btn rounded-0 border-start btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#send-modal-<?= $order['id_order'] ?>">
                      <i class="bi bi-send text-white"></i>
                    </button>
                  </div>
                  <div class="col-1 p-0">
                    <button class="btn rounded-start-0 border-start btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#delete-modal-<?= $order['id_order'] ?>">
                      <i class="bi bi-trash text-white"></i>
                    </button>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <div class="col-4 text-center">
          <img src="images/background2.png" alt="img" class="img-fluid" />
          <h1 class="fw-bold card">Fit Club Pro</h1>
        </div>
      </div>
    </div>
    <?php foreach ($orders as $index => $order) : ?>
      <!-- Modal hapus-->
      <div class="modal fade" id="delete-modal-<?= $order['id_order'] ?>" tabindex="-1" aria-labelledby="delete-modal-<?= $order['id_order'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="delete-modal-<?= $order['id_order'] ?>Label">Peringatan</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Apakah anda yakin ingin menghapusnya?</div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">tidak</button>
              <form action="" method="post">
                <input type="hidden" name="id" value="<?= $order['id_order'] ?>">
                <button type="submit" name="hapus" class="btn btn-danger w-100">Iya</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal bukti tranfer-->
      <div class="modal fade" id="send-modal-<?= $order['id_order'] ?>" tabindex="-1" aria-labelledby="send-modal-<?= $order['id_order'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="send-modal-<?= $order['id_order'] ?>Label">Payment Info</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?= $order['id_order']; ?>">
              <div class="modal-body">
                <div class="mb-3">
                  <?php if (!$order['pay_image']) : ?>
                    <label for="formFile" class="form-label">Kirim Bukti Pembayaran</label>
                    <input name="pay_image" class="form-control" type="file" id="formFile" />
                  <?php else : ?>
                    <h5 class="text-center">Anda Sudah Mengirim Bukti Pembayaran</h5>
                  <?php endif; ?>
                </div>
              </div>
              <div class="modal-footer">
                <?php if (!$order['pay_image']) : ?>
                  <button type="submit" name="pay" class="btn btn-primary w-25">kirim</button>
                <?php endif; ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </section>
  <!-- end halaman1 -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>