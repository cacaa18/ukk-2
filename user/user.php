<?php
include("../koneksi.php");
$queryCategory = mysqli_query($koneksi, "SELECT * FROM kategori");
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_kategori'])) {
  $id_kategori = $_GET['id_kategori'];
  $query = mysqli_query($koneksi, "SELECT buku.*, kategori.kategori
  FROM buku
  JOIN kategori ON buku.id_kategori = kategori.id_kategori WHERE buku.id_kategori='$id_kategori'");
} else {
  $query = mysqli_query($koneksi, "SELECT buku.*, kategori.kategori
  FROM buku
  JOIN kategori ON buku.id_kategori = kategori.id_kategori;");
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MoodReads</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
  <nav style="background-color: #525CEB;height:60px">
    <div class="container-fluid d-flex" style="justify-content: space-between;">
      <div class="mt-3" style="font-size: 20px; font-weight:bold;">
        <a class="navbar-brand ms-5 text-white" href="#">
          MoodReads
        </a>
      </div>
      <div class="mt-3" style="display:flex; justify-content:end; align-items:right;">
        <a href="logout_user.php">
          <i class="bi bi-box-arrow-left" style="margin-right:10px; color:#fff;"></i>
        </a>
      </div>
    </div>
  </nav>

  <div class="d-flex justify-content-evenly  mt-4 mb-5 align-items-center">
    <div class="Kategori">
      <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Kategori
      </button>
      <ul class="dropdown-menu">
        <?php while ($category = mysqli_fetch_assoc($queryCategory)) : ?>
          <li><a href="?id_kategori=<?= $category['id_kategori']; ?>" class="dropdown-item" type="button"><?= $category['kategori']; ?></a></li>
        <?php endwhile ?>
      </ul>
    </div>
    <a style="text-decoration: none; font-weight:bold; color: #4b4949" href="koleksi.php">Koleksi</a>
    <a style="text-decoration: none; font-weight:bold; color: #4b4949" href="pinjam.php">Peminjaman</a>
  </div>

  <!-- <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 d-flex bg-primary justify-content-center">
          <?php //while ($buku = mysqli_fetch_assoc($query)) : 
          ?>
            <div class="card col-lg-6 d-flex align-items-center">
              <div class="card-img ">
              <img src='../assets/upload/<?php //echo $buku['cover'] 
                                          ?>'class='img-thumbnail' width='200' alt='...'>
              </div>
                    <div class="card-body text-wrap d-flex flex-md-column gap-2">
                    <p class="mb-0 fs-4"><?php //echo $buku['judul'];
                                          ?></p>
                    <p class="mb-0 text-secondary"><?php //echo $buku['id_kategori'];
                                                    ?></p>
                    <p class="mb-0 text-secondary"><?php //echo $buku['penulis'];
                                                    ?></p>
                    <div>
                      <a style="text-decoration:none" href='bukudetail_user.php?id=<?php //echo $buku['id_buku']; 
                                                                                    ?>'>Lihat</a>
                    </div>
                    </div>
                  </div>
                    <?php //endwhile 
                    ?>

        </div>
      </div>
    </div> -->
  <div class="container">
    <div class="row">
      <?php while ($buku = mysqli_fetch_assoc($query)) : ?>
        <div class="col-lg-4 d-flex justify-content-center">
          <div class="card col-lg-8">
            <div class="card-img">
              <img style="width: 300px;" src='../assets/upload/<?php echo $buku['cover'] ?>' class='img-thumbnail' alt='...'>
            </div>
            <div class="card-body">
              <p class="mb-0 fs-4"><?php echo $buku['judul']; ?></p>
              <p class="mb-0 text-secondary"><?php echo $buku['kategori']; ?></p>
              <p class="mb-0 text-secondary"><?php echo $buku['penulis']; ?></p>
            </div>
            <div class="card-body">
              <a class="btn btn-primary" style="text-decoration:none" href='bukudetail_user.php?id=<?php echo $buku['id_buku']; ?>'>Lihat</a>
            </div>
          </div>
        </div>
      <?php endwhile ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>