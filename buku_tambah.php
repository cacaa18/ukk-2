<h1 class="mt-4">Buku</h1>
<div class="card bg-white">
    <div class="card-body">
    <div class="row">
<div class ="col_md_12">
  <form method="post" enctype="multipart/form-data">
          <?php
              if(isset($_POST['submit'])){
                $id_kategori = $_POST['id_kategori'];
                $judul = $_POST['judul'];
                $penulis = $_POST['penulis'];
                $fileBuku = $_FILES['coverBuku'];
                $penerbit = $_POST['penerbit'];
                $tahun_terbit = $_POST['tahun_terbit'];
                $deskripsi = $_POST['deskripsi'];

                $fileType = explode("image/", $fileBuku["type"]);

                $fileName = rand(100_000, 999_999).'.'.$fileType[1];
                move_uploaded_file($fileBuku['tmp_name'], './assets/upload/'.$fileName);

                $query = mysqli_query($koneksi, "INSERT  INTO buku(id_kategori,Judul,Penulis, cover,Penerbit,tahun_terbit,Deskripsi)values ('$id_kategori','$judul','$penulis', '$fileName', '$penerbit','$tahun_terbit','$deskripsi')");

                if($query){
                  echo '<script>alert("Tambah Buku Berhasil.");</script>';
                }else{
                  echo '<script>alert("Tambah Buku Gagal.");</script>';
                }
              }
           ?>
    <div class="row mb-3">
        <div class="col-md-4">Kategori</div>
        <div class="col-md8">
            <select name="id_kategori" class="from control">
                <?php
                    $kat = mysqli_query($koneksi, "SELECT*FROM kategori");
                    while($kategori = mysqli_fetch_array($kat)) {
                       ?>
                       <option value="<?php echo $kategori['id_kategori']; ?>"><?php echo $kategori['kategori']; ?></option> 
                       <?php
                    }
                ?>
            </select>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">Judul</div>
        <div class="col-md8"><input type="text" class="form-control" name="judul"></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">Penulis</div>
        <div class="col-md8"><input type="text" class="form-control" name="penulis"></div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4">Cover Buku</div>
      <div class="col-md8"><input type="file" class="form-control" name="coverBuku"></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">Penerbit</div>
        <div class="col-md8"><input type="text" class="form-control" name="penerbit"></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">Tahun Terbit</div>
        <div class="col-md8"><input type="number" class="form-control" name="tahun_terbit"></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">Deskripsi</div>
        <div class="col-md8">
            <textarea class="width:50px" name="deskripsi"  rows="5" class="rom-control"></textarea>
    </div>
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-8">
                 <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
                 <button type="reset" class="btn btn-secondary">reset</button>
                 <a href="?page=buku" class="btn btn-danger">Kembali</a>
      </div>
    </div>
  </form> 
    </div>
</div>