<?php
include "../functions.php";
cekAdminLogin();

$id = $_GET["id"];

$order = query("SELECT orders.*, products.*
          FROM orders
          JOIN products ON orders.product_id = products.id_product
          WHERE orders.id_order = '$id'
          ")[0];
$productId = $order['product_id'];
$features = query("SELECT * FROM `features` WHERE product_id = $productId");


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>infoPesanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <!-- css -->
  <link rel="stylesheet" href="css/produk.css" />
  <link rel="stylesheet" href="css/style.css" />
  <!-- icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css" />
</head>

<body>
  <!-- navbar -->
  <?php include 'navbar.php' ?>

  <section id="header-informasi" style="margin-top: 70px">
    <div class="container">
      <div class="row card shadow p-5 justify-content-center">
        <div class="col-md-11 text-center">
          <h3>Informasi Pesanan</h3>
        </div>
      </div>
    </div>
  </section>

  <section id="informasi">
    <div class="container">
      <div class="row card shadow p-4 mt-3">
        <div class="col-md-12">
          <h4 class="card-header">Informasi</h4>
          <div class="card-body">
            <div class="col-12">
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th class="col-3">Pemesan</th>
                    <th class="col-1"></th>
                    <th class="col-8"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Nama</td>
                    <td class="text-center">:</td>
                    <td><?= $order['name'] ?></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td class="text-center">:</td>
                    <td><?= $order['email'] ?></td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td class="text-center">:</td>
                    <td><?= $order['address'] ?></td>
                  </tr>
                  <tr>
                    <td>No Hp</td>
                    <td class="text-center">:</td>
                    <td><?= $order['phone'] ?></td>
                  </tr>
                  <tr>
                    <td>Umur</td>
                    <td class="text-center">:</td>
                    <td><?= $order['age'] ?></td>
                  </tr>
                  <tr>
                    <td>Jenis Kelamin</td>
                    <td class="text-center">:</td>
                    <td><?= $order['gender'] ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-12 mt-5">
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th class="col-3">Layanan</th>
                    <th class="col-1"></th>
                    <th class="col-8"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Lama Langganan / Bulan</td>
                    <td class="text-center">:</td>
                    <td><?= $order['month'] ?> Bulan</td>
                  </tr>
                  <tr>
                    <td>Harga / Bulan</td>
                    <td class="text-center">:</td>
                    <td>RP. <?= $order['month_price'] ?></td>
                  </tr>
                  <tr>
                    <td>Ptongan Harga / Bulan</td>
                    <td class="text-center">:</td>
                    <td>RP. <?= $order['month_price_cut'] ?></td>
                  </tr>
                  <tr>
                    <td>Total Harga</td>
                    <td class="text-center">:</td>
                    <td>Rp. <?= $order['total_price'] ?></td>
                  </tr>
                  <tr>
                    <td>Total Potongan Harga</td>
                    <td class="text-center">:</td>
                    <td>Rp. <?= $order['total_price_cut'] ?></td>
                  </tr>
                  <tr>
                    <td>fitur</td>
                    <td class="text-center">:</td>
                    <td>
                      <?php foreach ($features as $index => $feature) : ?>
                        <?= $feature['body'] ?> <br>
                      <?php endforeach ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td class="text-center">:</td>
                    <td>
                      <?php if ($order['status'] == "Confirmed") : ?>
                        <div class="col-6"><span class="badge text-bg-success text-white">Success</span></div>
                      <?php elseif ($order['status'] == "Canceled") : ?>
                        <div class="col-6"><span class="badge text-bg-danger text-white">Failed</span></div>
                      <?php else : ?>
                        <div class="col-6"><span class="badge text-bg-warning text-white">Pending</span></div>
                      <?php endif ?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div>
            <a href="order.php">
              <button type="button" class="btn" style="--bs-btn-padding-y: 0.25rem; --bs-btn-padding-x: 0.5rem; --bs-btn-font-size: 0.75rem">Back</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>