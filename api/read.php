<?php
include_once "../config/database.php";
header('Content-Type: application/json');

$query = "SELECT * FROM data_sensor ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
} else {
    echo json_encode(["error" => "No data found"]);
}

mysqli_close($conn);
