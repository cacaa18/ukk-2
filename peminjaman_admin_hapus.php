<?php
require_once("koneksi.php");
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM peminjaman WHERE id_peminjaman=$id");
?>
<script>
    alert('Hapus Peminjaman Berhasil')
    location.href ="index.php?page=peminjaman_admin";
</script>