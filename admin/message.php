<?php
include "../functions.php";
cekAdminLogin();

$messages = query("SELECT * FROM messages");

if (isset($_POST["hapus"])) {
  $id = $_POST["id"];
  $result = mysqli_query($conn, "DELETE FROM `messages` WHERE id_message='$id'");
  if ($result) {
    header("Location: message.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pesan</title>
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
          <h3>Pesan</h3>
          <p>Informasi pesan/message dari user langganan Fit Club Pro</p>
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
                  <th class="col-md-4">Nama</th>
                  <th class="col-md-4">Email</th>
                  <th class="col-md-4">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($messages as $index => $message) : ?>
                  <tr>
                    <th scope="row"><?= $index + 1 ?></th>
                    <td><?= $message['name'] ?></td>
                    <td><?= $message['email'] ?></td>
                    <td>
                      <button class="border-0 p-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#message-detail-modal-<?= $message['id_message'] ?>">
                        <span class="badge text-bg-info">Informasi</span>
                      </button>
                      <button class="border-0 p-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#delete-modal-<?= $message['id_message'] ?>">
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
    <?php foreach ($messages as $index => $message) : ?>
      <!-- Modal -->
      <div class="modal fade" id="delete-modal-<?= $message['id_message'] ?>" tabindex="-1" aria-labelledby="delete-modal-<?= $message['id_message'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="delete-modal-<?= $message['id_message'] ?>Label">Peringatan</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-white">Apakah anda ingin menghapus pesan <?= $message['name'] ?>?</div>
            <div class="modal-footer">
              <button type="button" class="btn" data-bs-dismiss="modal">Tidak</button>
              <form action="" method="post">
                <input type="hidden" name="id" value="<?= $message['id_message'] ?>">
                <button type="submit" name="hapus" class="btn">Ya</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- pesan / message -->
      <div class="modal fade" id="message-detail-modal-<?= $message['id_message'] ?>" tabindex="-1" aria-labelledby="message-detail-modal-<?= $message['id_message'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="message-detail-modal-<?= $message['id_message'] ?>Label">Message</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-white">
              <div class="container">
                <div class="row">
                  <div class="col-12">
                    <table>
                      <thead>
                        <tr>
                          <th class="col-3">Informasi</th>
                          <th class="col-2"></th>
                          <th class="col-7"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Nama</td>
                          <td class="text-center">:</td>
                          <td><?= $message['name'] ?></td>
                        </tr>
                        <tr>
                          <td>Email</td>
                          <td class="text-center">:</td>
                          <td><?= $message['email'] ?></td>
                        </tr>
                        <tr>
                          <td>NoHp</td>
                          <td class="text-center">:</td>
                          <td><?= $message['phone'] ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-12 mt-3">
                    <table>
                      <thead>
                        <tr>
                          <th>Pesan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="txt-2">
                            <?= $message['message'] ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn" data-bs-dismiss="modal">close</button>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>