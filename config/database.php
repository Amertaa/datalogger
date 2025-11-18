<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "datalogger";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Gagal: " . mysqli_connect_error());
}
