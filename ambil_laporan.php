<?php

include 'koneksi.php';

$sql = "SELECT * FROM laporan ORDER BY id DESC";
$result = $koneksi->query($sql);

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$koneksi->close();

?>