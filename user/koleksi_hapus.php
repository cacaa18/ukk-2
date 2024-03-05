<?php
include("../koneksi.php")
?>
<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM koleksi WHERE id_koleksi=$id");
?>
<script>
    alert('Hapus Koleksi Berhasil')
    location.href ="koleksi.php";
</script>