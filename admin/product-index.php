<?php
include "../functions.php";
cekAdminLogin();

$products = query("SELECT * FROM products");

if (isset($_POST["hapus"])) {
  $id = $_POST["id"];
  $result = mysqli_query($conn, "DELETE FROM `products` WHERE id_product='$id'");
  if ($result) {
    header("Location: product-index.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Produk</title>
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
  <section id="headerProduk" style="margin-top: 70px">
    <div class="container-fluid card card-style shadow">
      <div class="row p-3">
        <div class="col-md-12">
          <h3>Membership</h3>
          <p>menambah, mengedit, atau menghapus layanan</p>
        </div>
        <div class="col-md-4">
          <a href="product-create.php"><button type="button" class="btn">Buat Layanan</button></a>
        </div>
      </div>
    </div>
  </section>

  <!-- alerts -->
  <div id="liveAlertPlaceholder"></div>

  <!-- End Alerts -->

  <section class="produk">
    <div class="container-fluid card card-style shadow my-3">
      <div class="row">
        <div class="col-md-12 p-4">
          <div class="table-responsive">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th class="col-md-0">No.</th>
                  <th class="col-md-4">Layanan</th>
                  <th class="col-md-4">Total Harga</th>
                  <th class="col-md-4">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($products as $index => $product) : ?>
                  <tr>
                    <th scope="row"><?= $index + 1 ?></th>
                    <td><?= $product['month']; ?> Bulan</td>
                    <td><?= $product['total_price'] ?></td>
                    <td>
                      <a href="product-show.php?idProduct=<?= $product['id_product'] ?>"><span class="badge text-bg-info">Informasi</span></a>
                      <a href="product-edit.php?idProduct=<?= $product['id_product'] ?>"><span class="badge text-bg-warning">Edit Produk</span></a>
                      <button class="border-0 p-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#delete-modal<?= $product['id_product'] ?>">
                        <span class="badge text-bg-danger">Delete</span>
                      </button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php foreach ($products as $index => $product) : ?>
      <!-- Modal delete-->
      <div class="modal fade" id="delete-modal<?= $product['id_product'] ?>" tabindex="-1" aria-labelledby="delete-modal<?= $product['id_product'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="delete-modal<?= $product['id_product'] ?>Label">Konfirmasi Hapus</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-white">Apakah anda ingin menghapus <?= $product['product_name'] ?>?</div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
              <form action="" method="post">
                <input type="hidden" name="id" value="<?= $product['id_product'] ?>">
                <button type="submit" name="hapus" class="btn btn-danger">Ya</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    <script src="js/alerts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>