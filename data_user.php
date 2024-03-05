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
        <h2>Data User</h2>
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
                $query = "SELECT id_user, nama, username, email, alamat FROM user WHERE level = 'peminjam'";
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
