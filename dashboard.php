<?php
// Memeriksa session login
include "includes/cek_session.php";

// Mengambil data pengguna
$nama = $_SESSION['nama'] ?? $_SESSION['nama_lengkap'] ?? 'Pengguna';
$email = $_SESSION['email'] ?? '-';
$role = $_SESSION['role'] ?? '-';
?>


<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Dashboard</title>
</head>

<body>


<div class="container-fluid">
    <div class="row">
          <?php 
       include "layout/sidebar.php";
       ?>
     
        <!-- KONTEN -->
        <main class="col-md-9 col-lg-10 p-4">
            <h2>Dashboard</h2>
            

    <!-- Menampilkan data pengguna -->
    <p>Selamat datang, <b><?php echo $nama; ?></b></p>
    <p>Email: <?php echo $email; ?></p>
    <p>Role: <?php echo $role; ?></p>
 
<div class="row">

    <!-- CARD DATA SISWA -->
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Data Siswa</h5>
                <h2>120</h2>
                <a href="data_siswa.php" class="btn btn-primary">Lihat Data</a>
            </div>
        </div>
    </div>

    <!-- CARD DATA GURU -->
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Data Guru</h5>
                <h2>25</h2>
                <a href="data_guru.php" class="btn btn-primary">Lihat Data</a>
            </div>
        </div>
    </div>

    <!-- CARD KELAS -->
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Kelas</h5>
                <h2>12</h2>
                <a href="data_kelas.php" class="btn btn-primary">Lihat Data</a>
            </div>
        </div>
    </div>

</div>
</body>
</html>


 

