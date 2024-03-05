<?php
include("../koneksi.php");

$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$query = mysqli_query($koneksi, "SELECT buku.*, kategori.kategori 
FROM buku
INNER JOIN kategori ON buku.id_kategori = kategori.id_kategori WHERE buku.id_buku='$id'");
$buku = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset('/assets/image1.png')}}">
    <title>MoodReads</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

</head>

<body>
<nav style="background-color: #525CEB;height:60px">
    <div class="container-fluid d-flex" style="justify-content: space-between;">
      <div class="mt-3" style="font-size: 20px; font-weight:bold;">
        <a class="navbar-brand ms-5 text-white" href="user.php">
          MoodReads
        </a>
      </div>
      <div class="mt-3" style=" margin-right:30px; color:#fff; display:flex; justify-content:end; align-items:right; width:800px;">
        <a href="logout_user.php">
          <i class="bi bi-box-arrow-left" style="margin-right:10px;color:#fff;"></i>
        </a>
      </div>
    </div>
  </nav>

    <div class="d-flex">

        <div class="d-flex gap-5 justify-content-start">
            <div class="d-flex px-5" style="width: 400px; margin-top: 60px;">
                <div>
                    <img src="../assets/upload/<?php echo $buku['cover']; ?>" class="img-thumbnail" alt="...">
                    <div class="d-flex gap-2">
                        <div>
                            <a class="btn btn-primary mt-5" href="pinjamtambah.php?id=<?php echo $buku['id_buku']; ?>';">Pinjam Buku</a>
                        </div>
                        <div>
                            <a class="btn btn-primary mt-5" href="koleksi_tambah.php?id=<?php echo $buku['id_buku']; ?>">+Tambah Koleksi</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex flex-column flex-row">
            <div class="d-flex  flex-column detailbuku px-5 mt-5">
                <h3>Judul Buku</h3>
                <p><?php echo $buku['judul']; ?></p>
                <p><?php echo $buku['penulis']; ?></p>
                <p><?php echo $buku['kategori']; ?></p>
                <p><?php echo $buku['tahun_terbit']; ?></p>
                <h3>Deskripsi Buku</h3>
                <p style="width: 500px;"><?php echo $buku['deskripsi']; ?></p>
                <h4>Ulasan</h4>
                <form action="ulasan.php?id=<?php echo $buku['id_buku']; ?>" method="post">
                    <select name="rating" id="" class="form-control" style="width: 200px;">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <textarea name="deskripsi" id="" class="form-control" style="width: 500px;" cols="20" rows="5"></textarea>
                    <button type="submit" class="btn btn-primary mt-2 mb-2">Kirim</button>
                </form>
                
                <!-- <div class="container d-flex px-5" style="margin-top: 75px"></div> -->
                <div class="container">
                <?php
                if (isset($_GET['id'])) {
                $buku_id = $_GET['id'];
                $tampil_ulasan = mysqli_query($koneksi, "SELECT ulasan.id_ulasan, ulasan.ulasan, ulasan.rating, buku.judul, user.username
                FROM ulasan
                INNER JOIN buku ON ulasan.id_buku = buku.id_buku
                INNER JOIN user ON ulasan.id_user = user.id_user
                WHERE ulasan.id_buku = $buku_id");

        // Check if there are any rows fetched
        if (mysqli_num_rows($tampil_ulasan) > 0) {
            while ($ulasan = mysqli_fetch_array($tampil_ulasan)) {
            ?>
                <div class="card mb-3">
                    <div class="card-header">
                        <?php echo $ulasan['judul']; ?>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?php echo $ulasan['ulasan']; ?></p>
                        <p class="card-text"><small class="text-muted">Reviewed by: <?php echo $ulasan['username']; ?></small></p>
                        <p class="card-text"><small class="text-muted">Rating: <?php echo $ulasan['rating']; ?></small></p>
                    </div>
                </div>
            <?php
            }
        } else {
            echo "<p>No reviews found for this book.</p>";
        }
    } else {
        echo "<p>No book ID specified.</p>";
    }
    ?>
            </div>
        </div>
    </div>
    <div class="mt-5">

    </div>

</div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>