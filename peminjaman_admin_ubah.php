<?php
include("koneksi.php");
// session_start();

$query = mysqli_query($koneksi, "SELECT * FROM buku");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BookVerse</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>

<h1 class="mt-4">Peminjaman Buku</h1>
<a href="../css/styles.css"></a>
<div class="card">
<br>
<div class="row">
    <div class="col-md-12">
        <form method="post" >
            <?php
            $id = $_GET['id'];
                if(isset($_POST['submit'])) {
                    
                    $id_user = $_SESSION['user']['id_user'];
                    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
                    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
                    $status_peminjaman = $_POST['status_peminjaman'];
                    $query = mysqli_query($koneksi, "UPDATE peminjaman set  tanggal_peminjaman='$tanggal_peminjaman', tanggal_pengembalian='$tanggal_pengembalian', status_peminjaman='$status_peminjaman' WHERE id_peminjaman=$id");

                    if($query){
                        echo '<script>alert("Ubah Berhasil"); location.href="index.php?page=peminjaman_admin"; </script>';
                    }else{
                        echo '<script>alert("Ubah Gagal");</script>';
                    }
                }
                $query = mysqli_query($koneksi, "SELECT*FROM peminjaman where id_peminjaman=$id");
                $data = mysqli_fetch_array($query);
            ?>
            <div class="row mb-3">
                <div class="col-md-4 ms-4">Tanggal Peminjaman</div>
                <div class="col-md-7"> <!-- Mengubah ukuran kolom menjadi 6 -->
                    <input type="" id="tanggal_peminjaman" class="form-control" value="<?php echo date('Y-m-d');?>" name="tanggal_peminjaman">
                </div>
            </div>    
            <div class="row mb-3">
    <div class="col-md-4 ms-4">Tanggal Pengembalian</div>
    <div class="col-md-7"> <!-- Mengubah ukuran kolom menjadi 6 -->
        <input type="date" id="tanggal_pengembalian" class="form-control" name="tanggal_pengembalian">
    </div>
</div>

<script>
    // Mendapatkan tanggal hari ini
    var today = new Date();

    // Mendapatkan tanggal 7 hari ke depan
    var sevenDaysLater = new Date(today.getTime() + 7 * 24 * 60 * 60 * 1000); // Menambahkan 7 hari dalam milidetik

    // Format tanggal untuk input HTML
    var todayFormatted = today.toISOString().split('T')[0];
    var sevenDaysLaterFormatted = sevenDaysLater.toISOString().split('T')[0];

    // Set nilai minimal dan maksimal untuk input tipe tanggal
    document.getElementById("tanggal_pengembalian").setAttribute("min", todayFormatted);
    document.getElementById("tanggal_pengembalian").setAttribute("max", sevenDaysLaterFormatted);
</script>

            <div class="row mb-3">
                <div class="col-md-4 ms-4">Status Peminjaman</div>
                <div class="col-md-7">
                    <select name="status_peminjaman" class="form-control">
                        <option value="dipinjam" <?php if($data['status_peminjaman'] == 'dipinjam') echo 'selected';?>>Di Pinjam </option>
                        <option value="dikembalikan"<?php if($data['status_peminjaman'] == 'dikembalikan') echo 'selected';?>>Di Kembalikan</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8 mb-3" style="margin-left: 35.5%;">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
                    <button type="submit" class="btn btn-secondary">Reset</button>
                    <a href="?page=peminjaman_admin_ubah" class="btn btn-danger">Kembali</a>
                </div>
            </div>  
        </form>
    </div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
