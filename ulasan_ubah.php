<h1 class="mt-4"> ulasan Buku</h1>
<div class="card bg-white">
    <div class="card-body">
    <div class="row">
<div class ="col_md_12">
  <form method="post">
          <?php
          $id = $_GET['id'];
              if(isset($_POST['submit'])){
                $id_buku = $_POST['buku_id'];
                $user_id = $_SESSION['user']['id_user'];
                $ulasan = $_POST['ulasan'];
                $rating = $_POST['rating'];
                $query = mysqli_query($koneksi, "UPDATE ulasan set id_buku='$id_buku', ulasan='$ulasan', rating='$rating' WHERE id_ulasan='$id'");

                if($query){
                  echo '<script>alert("Ubah Data Berhasil.");</script>';
                }else{
                  echo '<script>alert("Ubah Data Gagal.");</script>';
                }
              }
              $query = mysqli_query($koneksi, "SELECT*FROM ulasan WHERE id_ulasan=$id");
              $data = mysqli_fetch_array($query);
           ?>
      <div class="row mb-3">
        <div class="col-md-2">buku</div>
        <div class="col-md-8">
            <select name="buku_id" class="form-control col-md-8">
                <?php
                    $buk = mysqli_query($koneksi, "SELECT*FROM buku");
                    while($buku = mysqli_fetch_array($buk)) {
                       ?>
                       <option <?php if($data['id_buku'] == $buku['id_buku']) echo'selected' ;?> value="<?php echo $buku['id_buku']; ?>"><?php echo $buku['judul']; ?></option> 
                       <?php
                    }
                ?>
            </select>
        </div>
                  </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-2">ulasan</div>
          <div class="col-md-8">
            <textarea name="ulasan"  rows="5" class="form-control col-md-8"> <?php echo $data['ulasan']; ?></textarea>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-2">rating</div>
          <div class="col-md-8">
            <select name="rating" class="form-control col-md-8">
                <?php
                    for($i = 1; $i<=10; $i++){
                        ?>
                        <option <?php if($data['id_buku'] == $i) echo 'selected'; ?>><?= $i ; ?></option>
                        <?php
                    }
                ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
            <button type="reset" class="btn btn-secondary">reset</button>
            <a href="?page=ulasan" class="btn btn-danger">Kembali</a>
          </div>
        </div>
      </div>
  </form> 
    </div>
</div>