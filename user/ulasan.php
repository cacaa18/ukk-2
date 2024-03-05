<?php
require_once("../koneksi.php");

if (isset($_SESSION['user'])&& $_SESSION['user']['level'] === 'peminjam'){
    $id_akun = $_SESSION['user']['id_user'];
    $id_buku = $_GET['id'];
    $ulasan = $_POST['deskripsi'];
    $rating = $_POST['rating'];
    
    $query = mysqli_query($koneksi, "INSERT INTO ulasan (id_user, id_buku, ulasan, rating) VALUES ('$id_akun', '$id_buku', '$ulasan', '$rating')");

    if ($query) {
        echo '<script>location.href="user.php";</script>';

    } else{
        echo "Gagal Menambahkan ulasan:" . mysqli_error($koneksi);
    }
} else{
    exit;
}
?>
