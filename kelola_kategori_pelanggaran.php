<?php

// kelola_pelanggaran_kategori.php

include 'includes/cek_session.php';
include 'config/koneksi.php';

$sql = "SELECT * FROM t_pelanggaran_kategori ORDER BY id DESC";
$hasil = mysqli_query($koneksi, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Kategori Pelanggaran</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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


    <h2>Kelola Kategori Pelanggaran</h2>

    <p>
        <a href="dashboard.php">Kembali ke Dashboard</a> 
        <br><br>
        <a href="tambah_pelanggaran_kategori.php">
            +Tambah Kategori Pelanggaran
        </a>
    </p>

    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nama Kategori</th>
            <th>Deskripsi</th>
            <th>Status Aktif</th>
            <th>Dibuat</th>
            <th>Diubah</th>
            <th>Aksi</th>
        </tr>
</thead>

        <?php while ($row = mysqli_fetch_assoc($hasil)) { ?>
        <tr>
            <td>
                <?php echo $row['id']; ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row['nama']); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($row['deskripsi'] ?? ''); ?>
            </td>

            <td>
                <?php
                if ($row['status_aktif'] == 1) {
                    echo "Aktif";
                } else {
                    echo "Tidak Aktif";
                }
                ?>
            </td>

            <td>
                <?php echo $row['created_at']; ?>
            </td>

            <td>
                <?php echo $row['updated_at']; ?>
            </td>

            <td>
                <a href="edit_kategori_pelanggaran.php?id=<?php echo $row['id']; ?>"
                <button type="button" class="btn btn-warning">Edit</button>
                </a>
                
                <a href="hapus_kategori_pelanggaran.php?id=<?php echo $row['id']; ?>"
                   onclick="return confirm('Yakin ingin menghapus kategori pelanggaran ini?');">
                <button type="button" class="btn btn-danger">Hapus</button>
                </a>
            </td>
        </tr>
        <?php } ?>

    </table>

</body>
</html>