<?php
include("koneksi.php");

// Periksa apakah tombol submit ditekan
if(isset($_POST['submit'])){
    // Pastikan variabel session dan koneksi database sudah tersedia
    if(isset($_SESSION['user']['id_user']) && $koneksi){
        // Bersihkan input sebelum menggunakan untuk mencegah SQL Injection
        $name = mysqli_real_escape_string($koneksi, $_POST['name']);
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $email = mysqli_real_escape_string($koneksi, $_POST['email']);
        $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
        
        // Query untuk menambahkan petugas baru
        $query = "INSERT INTO user (nama, username, email, alamat, level) VALUES ('$name', '$username', '$email', '$alamat', 'petugas')";
        $result = mysqli_query($koneksi, $query);

        if($result){
            echo '<script>alert("Tambah Petugas Berhasil.");</script>';
        }else{
            echo '<script>alert("Tambah Petugas Gagal.");</script>';
        }
    } else {
        echo '<script>alert("Tidak ada koneksi database atau session tidak tersedia.");</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Petugas</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h2 class="mt-4">Tambah Data Petugas</h2>
    <a class="btn btn-primary" href="index.php">Kembali</a>
    
    <!-- Form untuk menambah petugas -->
    <form action="" method="POST">
      <div class="form-group">
        <label for="name">Nama:</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="alamat">Alamat:</label>
        <input type="text" class="form-control" id="alamat" name="alamat" required>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
    </form>
    
    <br>

  </div>
</body>
</html>
