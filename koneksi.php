<?php
// Start a new session or resume the existing session
session_start();

// Establish a connection to the MySQL database
$koneksi = mysqli_connect('localhost', 'root', '', 'rpl');

// Check if the connection was successful
if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
