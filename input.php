<?php
// Menghubungkan ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgweb8";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil nilai yang diinputkan dari form dan mencegah SQL Injection
$kecamatan = mysqli_real_escape_string($conn, $_POST['kecamatan']);
$longitude = mysqli_real_escape_string($conn, $_POST['longitude']);
$latitude = mysqli_real_escape_string($conn, $_POST['latitude']);
$luas = mysqli_real_escape_string($conn, $_POST['luas']);
$jumlah_penduduk = mysqli_real_escape_string($conn, $_POST['jumlah_penduduk']);

// Query untuk memasukkan data ke tabel
$sql = "INSERT INTO penduduk (kecamatan, longitude, latitude, luas, jumlah_penduduk) 
        VALUES ('$kecamatan', $longitude, $latitude, $luas, $jumlah_penduduk)";

// Eksekusi query
if ($conn->query($sql) === TRUE) {
    echo "Data berhasil ditambahkan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
?>