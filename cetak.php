<h2 align="center" >Laporan Peminjaman Buku</h2>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
<tr>
<th>No</th>
<th>User</th>
<th>Buku</th>   
<th>Tanggal Peminjaman</th>
<th>Tanggal Pengembalian</th>
<th>Status Peminjaman</th>
</tr>
<?php
include "koneksi.php";
$i = 1;
$query = mysqli_query($koneksi, "SELECT*FROM peminjaman LEFT JOIN   user on user.id_user = peminjaman.id_user LEFT JOIN buku on buku.id_buku = peminjaman.id_buku");
while($data = mysqli_fetch_array($query)){
?>
<tr>
<td><?php echo $i++; ?></td>
<td><?php echo $data['nama']; ?></td>
<td><?php echo $data['judul']; ?></td>
<td><?php echo $data['tanggal_peminjaman']; ?></td>
<td><?php echo $data['tanggal_pengembalian']; ?></td>
<td><?php echo $data['status_peminjaman']; ?></td>
<td>
<a href="?page=ulasan_ubah&&id=<?php echo $data['id_ulasan']; ?>" class="btn btn-info">Ubah</a>
<a onclick="return confirm('apakah anda yakin menghapus data ini??')" href="?page=ulasan_hapus&&id=<?php echo $data['id_ulasan']; ?>" class="btn btn-danger">Hapus</a>
</td>
</tr>
<?php
}
?>
</table>
<script>
    window.print();
    setTimeout(function(){
        window.close();
    }, 100);
</script>