<?php
include "../functions.php";
cekAdminLogin();

$idProduct = $_GET["idProduct"];
$product = query("SELECT * FROM products WHERE id_product = $idProduct")[0];
$features = query("SELECT * FROM `features` WHERE product_id = $idProduct");

if (isset($_POST['addFeature'])) {
  $id = sprintf("%006d", rand(0, 999999));
  $body = htmlspecialchars($_POST['body']);

  $query =  "INSERT INTO `features` VALUES(
            '$id',
            '$idProduct',
            '$body'
            )";
  $result = mysqli_query($conn, $query);

  if ($result) {
    header("Location: product-show.php?idProduct=$idProduct");
    exit;
  }
}

if (isset($_POST['deleteFeature'])) {
  $id = $_POST['id'];
  $result = mysqli_query($conn, "DELETE FROM `features` WHERE id_feature='$id'");
  if ($result) {
    header("Location: product-show.php?idProduct=$idProduct");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>infoProduk</title>
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

  <section id="header-informasi" style="margin-top: 80px">
    <div class="container">
      <div class="row card shadow p-5 justify-content-center">
        <div class="col-md-12 text-center">
          <h3>Informasi Layanan</h3>
        </div>
      </div>
    </div>
  </section>

  <section id="informasi">
    <div class="container">
      <div class="row card shadow p-4 mt-3">
        <div class="col-md-12">
          <div class="card-header d-flex justify-content-between">
            <h4 class="text-white">Informasi</h4>
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addFeatureModal" style="--bs-btn-padding-y: 0.25rem; --bs-btn-padding-x: 0.5rem; --bs-btn-font-size: 0.75rem">
              Add Feature
            </button>
          </div>
          <div class="card-body">
            <div class="col-12">
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th class="col-3"></th>
                    <th class="col-1"></th>
                    <th class="col-8"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Nama</td>
                    <td class="text-center">:</td>
                    <td><?= $product['product_name'] ?></td>
                  </tr>
                  <tr>
                    <td>Lama Langganan / Bulan</td>
                    <td class="text-center">:</td>
                    <td><?= $product['month'] ?></td>
                  </tr>
                  <tr>
                    <td>Harga / Bulan</td>
                    <td class="text-center">:</td>
                    <td><?= $product['month_price'] ?> Bulan</td>
                  </tr>
                  <tr>
                    <td>Potongan Harga / Bulan</td>
                    <td class="text-center">:</td>
                    <td>Rp. <?= $product['month_price_cut'] ?></td>
                  </tr>
                  <tr>
                    <td>Total Harga</td>
                    <td class="text-center">:</td>
                    <td>Rp. <?= $product['total_price'] ?></td>
                  </tr>
                  <tr>
                    <td>Potongan Total Harga</td>
                    <td class="text-center">:</td>
                    <td>Rp. <?= $product['total_price_cut'] ?></td>
                  </tr>
                  <tr>
                    <td>fitur</td>
                    <td class="text-center">:</td>
                    <td>
                      <?php foreach ($features as $index => $feature) : ?>
                        <div class="">
                          <form action="" method="post" class="d-inline">
                            <input type="hidden" name="id" value="<?= $feature['id_feature'] ?>">
                            <button type="submit" name="deleteFeature" class="btn btn-danger btn-sm p-0 me-3 d-inline">
                              <i class="bi bi-trash"></i>
                            </button>
                          </form>
                          <p class="d-inline"> <?= $feature['body'] ?> </p>
                        </div>
                      <?php endforeach; ?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div>
            <a href="product-index.php">
              <button type="button" class="btn" style="--bs-btn-padding-y: 0.25rem; --bs-btn-padding-x: 0.5rem; --bs-btn-font-size: 0.75rem">
                Back
              </button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal -->
  <div class="modal fade" id="addFeatureModal" tabindex="-1" aria-labelledby="addFeatureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addFeatureModalLabel">Tambah Fitur</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-white">
          <form action="" method="post">
            <div class="mb-3">
              <label for="body" class="form-label">Fitur</label>
              <textarea autofocus class="form-control" name="body" id="body" rows="2" style="background: transparent; color: #FFF;"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="addFeature" class="btn">Tambah</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>