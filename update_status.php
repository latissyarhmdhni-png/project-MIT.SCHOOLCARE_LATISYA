<?php

include 'koneksi.php';

$id = $_POST['id'] ?? '';
$status = $_POST['status'] ?? '';

if ($id == '' || $status == '') {
    echo json_encode([
        "status" => "gagal",
        "pesan" => "Data tidak lengkap"
    ]);
    exit;
}

$sql = "UPDATE laporan SET status = ? WHERE id = ?";

$stmt = $koneksi->prepare($sql);
$stmt->bind_param("si", $status, $id);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "berhasil",
        "pesan" => "Status berhasil diperbarui"
    ]);
} else {
    echo json_encode([
        "status" => "gagal",
        "pesan" => "Status gagal diperbarui"
    ]);
}

$stmt->close();
$koneksi->close();

?>