<?php
include("../koneksi.php");
session_start();

// Pastikan ID buku ada dalam URL
if(isset($_GET['id'])) {
    $buku_id = mysqli_real_escape_string($koneksi, $_GET['id']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Tangkap data yang dikirimkan melalui formulir
        $rating = mysqli_real_escape_string($koneksi, $_POST['rating']);
        $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
        $id_user = $_SESSION['user']['id_user'];

        // Simpan ulasan ke database
        $query = mysqli_query($koneksi, "INSERT INTO ulasan (id_user, id_buku, rating, ulasan) VALUES ('$id_user', '$buku_id', '$rating', '$deskripsi')");

        if ($query) {
            echo '<script>alert("Ulasan berhasil ditambahkan"); window.location.href="detail_buku.php?id=' . $buku_id . '"; </script>';
        } else {
            echo '<script>alert("Gagal menambahkan ulasan");</script>';
        }
    }
} else {
    echo "<p>ID buku tidak valid.</p>";
}
?>
