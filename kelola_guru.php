<?php
session_start();

include "config/koneksi.php";

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Cek role
if ($_SESSION['role'] != "admin") {
    echo "Akses ditolak!";
    exit;
}

// Mengambil data guru
$query = mysqli_query($koneksi, "SELECT * FROM t_guru ORDER BY id DESC");

?>

<!DOCTYPE html>
<html>
<head>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Kelola Guru</title>
</head>

<body>
    <div class="container-fluid">
    <div class="row">
       <?php 
       include "layout/sidebar.php";
       ?>
        <!-- KONTEN -->
        <main class="col-md-9 col-lg-10 p-4">
    

     <script type="importmap">
{
  "imports": {
    "@floating-ui/dom": "https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.7.6/dist/floating-ui.dom.esm.min.js",
    "vanilla-calendar-pro": "https://cdn.jsdelivr.net/npm/vanilla-calendar-pro@3.4.0/index.mjs"
  }
}
</script>
<script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.min.js" integrity="sha384-BJf/nQgxZJU68GxBse97Vdlc8Rh+z9PzzXiS3/BjV+1nQPR7IKn+iJnD3DJvCMaU" crossorigin="anonymous"></script>

<h2>Kelola Guru</h2>

<a href="dashboard.php">Kembali ke Dashboard</a>
<br><br>

<a href="tambah_guru.php">+ Tambah Guru</a>

<br><br>

<table class="table table-bordered">
<thead class="table-dark">
    <tr>
        <th>No</th>
        <th>NIP</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Aksi</th>
    </tr>
    </thead>

    <?php
    $no = 1;

    while ($guru = mysqli_fetch_assoc($query)) {
    ?>

    <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $guru['nip']; ?></td>
        <td><?php echo $guru['nama']; ?></td>
        <td><?php echo $guru['email']; ?></td>
        <td><?php echo $guru['status_aktif']; ?></td>
        <td><?php echo $guru['created_at']; ?></td>
        <td><?php echo $guru['updated_at']; ?></td>

        <td>
            <a href="edit_guru.php?id=<?php echo $guru['id']; ?>">
                <button type="button" class="btn btn-warning">Edit</button>
            </a>
            |
            <a href="hapus_guru.php?id=<?php echo $guru['id']; ?>"
               onclick="return confirm('Yakin ingin menghapus?')">
                <button type="button" class="btn btn-danger">Hapus</button>
            </a>
        </td>
    </tr>

    <?php
        $no++;
    }
    ?>

</table>

</body>
</html>

