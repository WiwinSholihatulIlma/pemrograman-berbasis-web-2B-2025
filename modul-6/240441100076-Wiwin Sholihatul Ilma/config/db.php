<?php
// config/db.php

$host = 'localhost';         
$user = 'root';              
$pass = '';                  
$dbname = 'db_karyawan'; 

$conn = new mysqli($host, $user, $pass, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>