<!-- <?php
// session_start(); // Mulai sesi

// Periksa apakah pengguna saat ini adalah petugas
if(isset($_SESSION['user']) && $_SESSION['user']['level'] == 'petugas') {
  // Redirect atau tampilkan pesan kesalahan
  // header("Location: petugas.php"); // Ubah index.php sesuai halaman beranda Anda
  // exit();
}
?> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Table</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Data Petugas</h2>
        <div>
        <?php
        if(isset($_SESSION['user']) && $_SESSION['user']['level'] == 'admin') {
        ?>
          <a class="btn btn-primary mt-3 mb-3" href="petugas_tambah.php">+ Tambah Petugas</a>
          <?php
        }
        ?>
      
        <!-- <a class="btn btn-primary mt-3 mb-3" href="petugas_tambah.php">+ Tambah Petugas</a> -->
    </div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Periksa koneksi
                if (mysqli_connect_errno()) {
                    echo "Koneksi database gagal: " . mysqli_connect_error();
                    exit();
                }

                // Query untuk mengambil data user
                $query = "SELECT id_user, nama, username, email, alamat FROM user WHERE level = 'petugas'";
                $result = mysqli_query($koneksi, $query);

                // Tampilkan data user dalam table
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id_user'] . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['alamat'] . "</td>";

                    echo "</tr>";
                }

                // Bebaskan hasil query
                mysqli_free_result($result);

                // Tutup koneksi database
                mysqli_close($koneksi);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
