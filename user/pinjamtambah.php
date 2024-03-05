<?php
include("../koneksi.php");
$query = mysqli_query($koneksi, "SELECT * FROM buku");
$queryCategory = mysqli_query($koneksi, "SELECT * FROM kategori")
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
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
                <svg xmlns="http://www.w3.org/2000/svg" style="margin-right:10px; color:#fff" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                </svg>
            </div>
        </div>
    </nav>
    <h4 class="mt-4 ms-5">Peminjaman Buku</h4>
    <a href="../css/styles.css"></a>
    <div class="ms-5 card">
        <br>
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                    <?php
                    if (isset($_POST['submit'])) {
                        $id_buku = $_GET['id'];
                        $id_user = $_SESSION['user']['id_user'];
                        $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
                        $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
                        $status_peminjaman = $_POST['status_peminjaman'];
                        $query = mysqli_prepare($koneksi, "INSERT INTO peminjaman(id_buku, id_user, tanggal_peminjaman, tanggal_pengembalian, status_peminjaman) VALUES (?, ?, ?, ?, ?)");
                        mysqli_stmt_bind_param($query, "iisss", $id_buku, $id_user, $tanggal_peminjaman, $tanggal_pengembalian, $status_peminjaman);

                        if (mysqli_stmt_execute($query)) {
                            echo '<script>alert("Peminjaman Berhasil"); location.href="pinjam.php";</script>';
                        } else {
                            echo '<script>alert("Peminjaman Gagal");</script>';
                        }
                    }
                    ?>
                    <div class="row mb-3">
                        <div class="col-md-4 ms-4">Nama Buku</div>
                        <div class="col-md-7"> <!-- Mengubah ukuran kolom menjadi 6 -->
                            <?php
                            $id_buku = $_GET['id'];
                            $stmt = mysqli_prepare($koneksi, "SELECT * FROM buku WHERE id_buku = ?");
                            mysqli_stmt_bind_param($stmt, "i", $id_buku);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            while ($buku = mysqli_fetch_array($result)) {
                            ?>
                                <input type="text" class="form-control" name="judul" value="<?php echo $buku['judul']; ?>">
                            <?php
                            }
                            mysqli_close($koneksi); // close database connection
                            ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 ms-4">Tanggal Peminjaman</div>
                        <div class="col-md-7"> <!-- Mengubah ukuran kolom menjadi 6 -->
                            <input type="date" class="form-control" name="tanggal_peminjaman" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 ms-4">Status Peminjaman</div>
                        <div class="col-md-7">
                            <select name="status_peminjaman" class="form-control">
                                <option value="dipinjam">Di Pinjam</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8 mb-3" style="margin-left: 35.5%;">
                            <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
                            <button type="submit" class="btn btn-secondary">Reset</button>
                            <a href="user.php" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
