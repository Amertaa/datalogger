<?php
header('Content-Type: application/json');

include_once "../config/database.php";

// Ambil 1 data terbaru dari tabel data_sensor
$sql = "SELECT 
            nilai_sensor_cahaya        AS cahaya,
            nilai_sensor_tegangan_ac   AS tegangan_ac,
            nilai_sensor_arus_ac       AS arus_ac,
            nilai_sensor_power_ac      AS power_ac,
            nilai_sensor_energy        AS energy,
            nilai_sensor_frequency     AS frequency,
            nilai_sensor_powerfactor   AS powerfactor,
            waktu
        FROM data_sensor
        ORDER BY waktu DESC
        LIMIT 1";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode([
        "success" => false,
        "message" => "Query gagal: " . mysqli_error($conn)
    ]);
    exit();
}

if (mysqli_num_rows($result) == 0) {
    echo json_encode([
        "success" => false,
        "message" => "Belum ada data"
    ]);
    exit();
}

$row = mysqli_fetch_assoc($result);

// Hitung status ONLINE / OFFLINE
date_default_timezone_set("Asia/Makassar"); // sesuaikan kalau perlu
$now       = time();
$last_time = strtotime($row['waktu']);
$diff      = $now - $last_time; // detik

// Wemos kirim ± setiap 1 menit → toleransi 3 menit
$status = ($diff <= 180) ? "ONLINE" : "OFFLINE";

// Karena kolom di DB bertipe CHAR, kita cast ke float
echo json_encode([
    "success"       => true,
    "cahaya"        => (float)$row['cahaya'],
    "tegangan_ac"   => (float)$row['tegangan_ac'],
    "arus_ac"       => (float)$row['arus_ac'],
    "power_ac"      => (float)$row['power_ac'],
    "energy"        => (float)$row['energy'],
    "frequency"     => (float)$row['frequency'],
    "powerfactor"   => (float)$row['powerfactor'],
    "waktu"         => $row['waktu'],
    "status"        => $status
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

mysqli_close($conn);
