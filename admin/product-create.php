<?php
include "../functions.php";
cekAdminLogin();

if (isset($_POST["tambah"])) {

  $id = sprintf("%006d", rand(0, 999999));
  $product_name = htmlspecialchars($_POST["product_name"]);
  $month = htmlspecialchars($_POST["month"]);
  $month_price = htmlspecialchars($_POST["month_price"]);
  $month_price_cut = htmlspecialchars($_POST["month_price_cut"]);
  $total_price = htmlspecialchars($_POST["total_price"]);
  $total_price_cut = htmlspecialchars($_POST["total_price_cut"]);

  $query =  "INSERT INTO `products` VALUES (
              '$id', 
              '$product_name',
              '$month',
              '$month_price',
              '$month_price_cut',
              '$total_price',
              '$total_price_cut'
              )";
  $result = mysqli_query($conn, $query);

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
  <title>Tambah Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <!-- css -->
  <link rel="stylesheet" href="css/tambahProduk.css" />
  <link rel="stylesheet" href="css/style.css" />
  <!-- icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css" />
</head>

<body>
  <!-- navbar -->
  <?php include 'navbar.php' ?>

  <section id="header-tambahProduk" style="margin-top: 70px">
    <div class="container-fluid card shadow-lg">
      <div class="row mt-3">
        <div class="col-2">
          <a href="product-index.php"><button type="button" class="btn"><i class="bi bi-arrow-left-circle"></i></button></a>
        </div>
        <div class="col-12 text-center">
          <h3>Tambah Membership</h3>
          <p>Tambahkan Layanan pada colom dibawah</p>
        </div>
      </div>
    </div>
  </section>

  <div id="section">
    <div class="container-fluid">
      <div class="row m-4 justify-content-center">
        <div class="col-md-6 mb-3">
          <div class="card">
            <div class="login-box">
              <form id="productForm" method="post">
                <h4 class="mb-4 text-center">Layanan</h4>
                <div class="user-box">
                  <input type="text" id="product_name" name="product_name" required />
                  <label for="product_name">Nama</label>
                </div>
                <div class="user-box">
                  <input type="number" min="0" id="month" name="month" required />
                  <label for="month">Masukkan Lama Langganan / Bulan</label>
                </div>
                <div class="user-box">
                  <input type="number" min="0" id="month_price" name="month_price" required />
                  <label for="month_price">Harga / Bulan</label>
                </div>
                <div class="user-box">
                  <input type="number" min="0" id="month_price_cut" name="month_price_cut" required />
                  <label for="month_price_cut">Potongan Harga / Bulan</label>
                </div>
                <div class="user-box">
                  <input type="number" min="0" id="total_price" name="total_price" required />
                  <label for="total_price">Total Harga</label>
                </div>
                <div class="user-box">
                  <input type="number" min="0" id="total_price_cut" name="total_price_cut" required />
                  <label for="total_price_cut">Potongan Total Harga</label>
                </div>
                <!-- <div class="mb-3">
                    <label for="fieldName" class="form-label">Fitur</label>
                    <textarea class="form-control" name="fieldName" id="fieldName" rows="2"></textarea>
                  </div> -->
                <div class="row text-center my-4">
                  <div class="col-md-12">
                    <div class="login-box">
                      <button type="submit" name="tambah" class="card">
                        Tambah
                        <span></span>
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>