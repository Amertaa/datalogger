<?php

use Dom\Mysql;

include_once "../config/database.php";

function respond($code, $message)
{
    http_response_code($code);
    echo $message;
    exit();
}

if (
    !isset($_GET['nilai_sensor_tegangan_ac']) ||
    !isset($_GET['nilai_sensor_cahaya']) ||
    !isset($_GET['nilai_sensor_arus_ac']) ||
    !isset($_GET['nilai_sensor_power_ac']) ||
    !isset($_GET['nilai_sensor_energy']) ||
    !isset($_GET['nilai_sensor_frequency']) ||
    !isset($_GET['nilai_sensor_powerfactor']) ||
    !isset($_GET['nilai_sensor_temperature']) ||
    !isset($_GET['nilai_sensor_humidity'])
) {
    respond(400, "Parameter Sensor Tidak Lengkap ");
}

if (!isset($_GET['device']) || !isset($_GET['uptime']) || !isset($_GET['sinyal'])) {
    respond(400, "Parameter Status Wemos Tidak Lengkap");
}

$nilai_sensor_tegangan_ac   = $_GET['nilai_sensor_tegangan_ac'];
$nilai_sensor_cahaya        = $_GET['nilai_sensor_cahaya'];
$nilai_sensor_arus_ac       = $_GET['nilai_sensor_arus_ac'];
$nilai_sensor_power_ac      = $_GET['nilai_sensor_power_ac'];
$nilai_sensor_energy        = $_GET['nilai_sensor_energy'];
$nilai_sensor_frequency     = $_GET['nilai_sensor_frequency'];
$nilai_sensor_powerfactor   = $_GET['nilai_sensor_powerfactor'];
$nilai_sensor_temperature   = $_GET['nilai_sensor_temperature'];
$nilai_sensor_humidity      = $_GET['nilai_sensor_humidity'];
$device = $_GET['device'];
$uptime = $_GET['uptime'];
$signal = $_GET['sinyal'];

// Query insert
$query = "INSERT INTO data_sensor (nilai_sensor_tegangan_ac, nilai_sensor_cahaya, nilai_sensor_arus_ac, nilai_sensor_power_ac, nilai_sensor_energy, nilai_sensor_frequency, nilai_sensor_powerfactor, nilai_sensor_temperature, nilai_sensor_humidity) VALUES ('$nilai_sensor_tegangan_ac', '$nilai_sensor_cahaya', '$nilai_sensor_arus_ac', '$nilai_sensor_power_ac', '$nilai_sensor_energy', '$nilai_sensor_frequency', '$nilai_sensor_powerfactor', '$nilai_sensor_temperature', '$nilai_sensor_humidity')";

$query1 = "INSERT INTO status_wemos (device, uptime, sinyal) 
VALUES ('$device', '$uptime', '$signal')";


if (!mysqli_query($conn, $query)) {
    respond(500, "Gagal Input Nilai Sensor: " . mysqli_error($conn));
}

if (!mysqli_query($conn, $query1)) {
    respond(500, "Gagal Input Status Wemos: " . mysqli_error($conn));
}

respond(201, "Data berhasil dimasukkan!");
echo "Heartbeat OK untuk $device | uptime=$uptime | signal=$signal";

mysqli_close($conn);
