<?php
date_default_timezone_set('Asia/Makassar');

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="agrinergy_data_' . date('Ymd_His') . '.csv"');

include_once "../config/database.php";

// Buka output stream
$output = fopen('php://output', 'w');

// Tulis header kolom
fputcsv($output, [
    'No',
    'Waktu',
    'Tegangan (V)',
    'Arus (A)',
    'Daya (W)',
    'Energi (kWh)',
    'Cahaya (lux)',
    'Suhu (°C)',
    'Kelembapan (%)',
    'Frekuensi (Hz)',
    'Power Factor',
    'Status'
]);

// Ambil parameter filter (search & date) dari URL
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$date   = isset($_GET['date']) ? trim($_GET['date']) : '';

$where = " WHERE 1 ";

if ($search !== '') {
    $s = $conn->real_escape_string($search);
    // kalau mau, bisa ditambah ke kolom lain juga
    $where .= " AND (waktu LIKE '%$s%')";
}

if ($date !== '') {
    $d = $conn->real_escape_string($date); // format: YYYY-MM-DD
    $where .= " AND DATE(waktu) = '$d'";
}

// Query semua data yang cocok filter
$sql = "
    SELECT 
        nilai_sensor_cahaya        AS cahaya,
        nilai_sensor_tegangan_ac   AS tegangan_ac,
        nilai_sensor_arus_ac       AS arus_ac,
        nilai_sensor_power_ac      AS power_ac,
        nilai_sensor_energy        AS energy,
        nilai_sensor_frequency     AS frequency,
        nilai_sensor_powerfactor   AS powerfactor,
        nilai_sensor_temperature   AS temperature,
        nilai_sensor_humidity      AS humidity,
        waktu
    FROM data_sensor
    $where
    ORDER BY waktu DESC
";

$result = mysqli_query($conn, $sql);

if ($result) {
    $no  = 1;
    $now = time();

    while ($row = mysqli_fetch_assoc($result)) {

        // Hitung status ONLINE / OFFLINE (sama logika seperti API realtime)
        $last_time = strtotime($row['waktu']);
        $diff      = $now - $last_time;
        $status    = ($diff <= 120) ? 'ONLINE' : 'OFFLINE';

        fputcsv($output, [
            $no++,
            $row['waktu'],
            (float)$row['tegangan_ac'],
            (float)$row['arus_ac'],
            (float)$row['power_ac'],
            (float)$row['energy'],
            (float)$row['cahaya'],
            (float)$row['temperature'],
            (float)$row['humidity'],
            (float)$row['frequency'],
            (float)$row['powerfactor'],
            $status
        ]);
    }
}

fclose($output);
mysqli_close($conn);
exit;
