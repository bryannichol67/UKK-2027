
<?php

session_start();

include "config/koneksi.php";

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Cek admin
if ($_SESSION['role'] != "admin") {
    echo "Akses ditolak!";
    exit;
}

// Mengambil data kelas
$query = mysqli_query($koneksi, "SELECT * FROM t_kelas ORDER BY id DESC");

?>

<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Dashboard</title>
    <title>Kelola Kelas</title>
</head>


<body>
     <div class="container-fluid">
    <div class="row">
       <?php include "layout/sidebar.php";
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

<h2>Kelola Kelas</h2>

<a href="dashboard.php">Kembali ke Dashboard</a>
<br><br>

<a href="tambah_kelas.php">+ Tambah Kelas</a>
<br><br>

<table class="table table-bordered">
<thead class="table-dark">
    <tr>
        <th>No</th>
        <th>Nama Kelas</th>
        <th>Tingkat</th>
        <th>Jurusan</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Aksi</th>
    </tr>
</thead>

    <?php
    $no = 1;

    while ($kelas = mysqli_fetch_assoc($query)) {
    ?>

    <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $kelas['nama']; ?></td>
        <td><?php echo $kelas['tingkat']; ?></td>
        <td><?php echo $kelas['jurusan']; ?></td>

        <td>
            <?php
            if ($kelas['status_aktif'] == 1) {
                echo "Aktif";
            } else {
                echo "Tidak Aktif";
            }
            ?>
        </td>

        <td><?php echo $kelas['created_at']; ?></td>
        <td><?php echo $kelas['updated_at']; ?></td>

        <td>
            <a href="edit_kelas.php?id=<?php echo $kelas['id']; ?>">
                <button type="button" class="btn btn-warning">Edit</button>
            </a>
            |
            <a href="hapus_kelas.php?id=<?php echo $kelas['id']; ?>"
               onclick="return confirm('Yakin ingin menghapus kelas ini?')">
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

