<?php
$conn = mysqli_connect("localhost", "root", "", "marhaban");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
