<?php

include 'koneksi.php';

$data = file_get_contents("php://input");

parse_str($data, $hasil);

$nama_pelapor = $hasil['nama_pelapor'] ?? '';
$kelas = $hasil['kelas'] ?? '';
$fasilitas = $hasil['fasilitas'] ?? '';
$deskripsi = $hasil['deskripsi'] ?? '';

if ($nama_pelapor == '' || $kelas == '' || $fasilitas == '' || $deskripsi == '') {
    echo json_encode([
        "status" => "gagal",
        "pesan" => "Data belum lengkap"
    ]);
    exit;
}

$sql = "INSERT INTO laporan 
        (nama_pelapor, kelas, fasilitas, deskripsi)
        VALUES (?, ?, ?, ?)";

$stmt = $koneksi->prepare($sql);

$stmt->bind_param(
    "ssss",
    $nama_pelapor,
    $kelas,
    $fasilitas,
    $deskripsi
);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "berhasil",
        "pesan" => "Laporan berhasil disimpan"
    ]);
} else {
    echo json_encode([
        "status" => "gagal",
        "pesan" => "Laporan gagal disimpan"
    ]);
}

$stmt->close();
$koneksi->close();

?>