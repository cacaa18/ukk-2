<?php
include("../koneksi.php");
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
        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
      </svg>
    </div>
  </div>
</nav>
    <!-- css     -->
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
</style>
<!-- content -->
<div class="mt-4 ms-5">
<h4 class="">Daftar buku yang dipinjam</h4>
<a  class="btn btn-primary" href="user.php">Kembali</a>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered=1"  id="dataTable" width="100%" cellspacing="0">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status Peminjaman</th>                
            </tr>
            <?php
            $i = 1;
                $query = mysqli_query($koneksi, "SELECT*FROM peminjaman LEFT JOIN user on user.id_user = peminjaman.id_user LEFT JOIN buku on buku.id_buku = peminjaman.id_buku WHERE peminjaman.id_user=" .$_SESSION['user']['id_user']);
                while($data = mysqli_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><img style="width: 100px;" src="../assets/upload/<?php echo $data['cover']; ?>"></td>
                            <td><?php echo $data['judul']; ?></td>
                            <td><?php echo $data['tanggal_peminjaman']; ?></td>
                            <td><?php echo $data['tanggal_pengembalian']; ?></td>
                            <td><?php echo $data['status_peminjaman']; ?></td>
                            <!-- <td>
                                <?php
                                if($data['status_peminjaman'] != 'dikembalikan'){
                                ?>
                            <a href="kembalikan_buku.php?id=<?php echo $data['id_peminjaman']; ?>" class="btn btn-info mb-1">Ubah</a>
                            <?php
                                }
                                ?>
                            </td> -->
                        </tr>
                    <?php
                }
            ?>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>