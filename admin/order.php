<?php
include "../functions.php";
cekAdminLogin();

$orders = query("SELECT orders.*, products.*
          FROM orders
          JOIN products ON orders.product_id = products.id_product
          ");

if (isset($_POST["hapus"])) {
  $id = $_POST["id"];
  $result = mysqli_query($conn, "DELETE FROM `orders` WHERE id_order='$id'");
  if ($result) {
    header("Location: order.php");
    exit;
  }
}

if (isset($_POST["updateStatus"])) {
  if (isset($_POST["id"]) && isset($_POST["status"])) {
    $orderId = htmlspecialchars($_POST["id"]);
    $status = htmlspecialchars($_POST["status"]);

    $query = "UPDATE orders SET status = '$status' WHERE id_order = '$orderId'";
    $result = mysqli_query($conn, $query);
    if ($result) {
      header("Location: order.php");
      exit;
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pesanan</title>
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

  <!-- produk -->
  <section id="headerPesanan" style="margin-top: 70px">
    <div class="container-fluid card shadow">
      <div class="row p-3">
        <div class="col-md-12">
          <h3>Pesanan</h3>
          <p>Informasi Pesanan langganan Fit Club Pro</p>
        </div>
      </div>
    </div>
  </section>

  <!-- alerts -->
  <div id="liveAlertPlaceholder"></div>

  <!-- End Alerts -->

  <section class="produk">
    <div class="container-fluid card shadow my-3">
      <div class="row">
        <div class="col-md-12 p-4">
          <div class="table-responsive">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th class="col-md-0">No.</th>
                  <th class="col-md-4">Tanggal Pemesanan</th>
                  <th class="col-md-4">Nama Pemesan</th>
                  <th class="col-md-4">Action</th>
                  <th class="col-md-4">Comfirm</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($orders as $index => $order) : ?>
                  <tr>
                    <th scope="row"><?= $index + 1 ?></th>
                    <td><?= $order['month'] ?> Bulan</td>
                    <td><?= $order['name'] ?></td>
                    <td>
                      <a href="order-show.php?id=<?= $order['id_order'] ?>">
                        <span class="badge text-bg-info">Informasi</span>
                      </a>
                      <button class="border-0 p-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#delete-modal-<?= $order['id_order'] ?>">
                        <span class="badge text-bg-danger">Delete</span>
                      </button>
                    </td>
                    <td>
                      <div class="dropdown dropstart">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <?= $order['status'] ?>
                        </button>
                        <ul class="dropdown-menu p-0">
                          <li>
                            <a class="dropdown-item">
                              <form action="" method="post">
                                <input type="hidden" name="id" value="<?= $order['id_order'] ?>">
                                <input type="hidden" name="status" value="Confirmed" class="d-none">
                                <button type="submit" name="updateStatus" class="btn d-inline">
                                  Konfimasi
                                </button>
                              </form>
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item">
                              <form action="" method="post">
                                <input type="hidden" name="id" value="<?= $order['id_order'] ?>">
                                <input type="hidden" name="status" value="Canceled" class="d-none">
                                <button type="submit" name="updateStatus" class="btn d-inline">
                                  Tolak
                                </button>
                              </form>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php foreach ($orders as $index => $order) : ?>

      <!-- Modal -->
      <div class="modal fade" id="delete-modal-<?= $order['id_order'] ?>" tabindex="-1" aria-labelledby="delete-modal-<?= $order['id_order'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="delete-modal-<?= $order['id_order'] ?>Label">Peringatan</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-white">Apakah anda ingin menghapus order <?= $order['name'] ?>?</div>
            <div class="modal-footer">
              <button type="button" class="btn" data-bs-dismiss="modal">Tidak</button>
              <form action="" method="post">
                <input type="hidden" name="id" value="<?= $order['id_order'] ?>">
                <button type="submit" name="hapus" class="btn">Ya</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach ?>

  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>