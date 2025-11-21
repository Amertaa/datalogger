<?php
header('Content-Type: application/json');

include_once "../config/database.php";

$page     = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$pageSize = isset($_GET['pageSize']) ? (int)$_GET['pageSize'] : 10;
$search   = isset($_GET['search']) ? trim($_GET['search']) : '';
$date     = isset($_GET['date']) ? trim($_GET['date']) : '';
$now       = time();


$offset = ($page - 1) * $pageSize;

// Build WHERE
$where = " WHERE 1 ";

if ($search !== '') {
    $s = $conn->real_escape_string($search);
    $where .= " AND (waktu LIKE '%$s%' OR nilai_sensor_status LIKE '%$s%') ";
}

if ($date !== '') {
    $d = $conn->real_escape_string($date);
    $where .= " AND DATE(waktu) = '$d' ";
}

// Count total
$sqlCount = "SELECT COUNT(*) AS total FROM data_sensor $where";
$resCount = $conn->query($sqlCount);
$total    = (int)$resCount->fetch_assoc()['total'];

$totalPages = $total > 0 ? ceil($total / $pageSize) : 1;

// Get data
$sql = "
    SELECT 
        nilai_sensor_cahaya AS cahaya,
        nilai_sensor_tegangan_ac AS tegangan_ac,
        nilai_sensor_arus_ac AS arus_ac,
        nilai_sensor_power_ac AS power_ac,
        nilai_sensor_energy AS energy,
        nilai_sensor_frequency AS frequency,
        nilai_sensor_powerfactor AS powerfactor,
        nilai_sensor_temperature AS temperature,
        nilai_sensor_humidity AS humidity,
        waktu
    FROM data_sensor
    $where
    ORDER BY waktu DESC
    LIMIT $offset, $pageSize
";

$res = $conn->query($sql);

$data = [];
while ($row = $res->fetch_assoc()) {
    $data[] = [
        "waktu"       => $row['waktu'],
        "V"           => (float)$row['tegangan_ac'],
        "I"           => (float)$row['arus_ac'],
        "P"           => (float)$row['power_ac'],
        "E"           => (float)$row['energy'],
        "lux"         => (float)$row['cahaya'],
        "t"           => (float)$row['temperature'],
        "h"           => (float)$row['humidity'],
        "f"           => (float)$row['frequency'],
        "pf"          => (float)$row['powerfactor'],
        "status"      => ($now - strtotime($row['waktu']) <= 120) ? "ONLINE" : "OFFLINE"
    ];
}

echo json_encode([
    "success"    => true,
    "data"       => $data,
    "page"       => $page,
    "totalPages" => $totalPages
], JSON_UNESCAPED_UNICODE);

$conn->close();
