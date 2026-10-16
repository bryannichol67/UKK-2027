<?php
session_start();
include "config/koneksi.php";

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Cek hak akses admin
if ($_SESSION['role'] != "admin") {
    echo "Akses ditolak!";
    exit;
}

// Mengambil data jenis pelanggaran
$data = mysqli_query(
    $koneksi,
    "SELECT * FROM t_pelanggaran ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Jenis Pelanggaran</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<div class="container-fluid">
    <div class="row">

        <?php include "layout/sidebar.php"; ?>

        <!-- KONTEN UTAMA -->
        <main class="col-md-9 col-lg-10 p-4">

            <h2>Kelola Jenis Pelanggaran</h2>
              <a href="dashboard.php">Kembali ke Dashboard</a>
           <br><br>

<a href="tambah_tahun_ajaran.php">+ Tambah Tahun Ajaran</a>
<br><br>

            <!-- Tabel data pelanggaran -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>ID Kategori</th>
                            <th>Kode</th>
                            <th>Nama Pelanggaran</th>
                            <th>Poin</th>
                            <th>Deskripsi</th>
                            <th>Status Aktif</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        if ($data && mysqli_num_rows($data) > 0) {
                            while ($pelanggaran = mysqli_fetch_assoc($data)) {
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>

                                <td>
                                    <?= htmlspecialchars($pelanggaran['pelanggaran_kategori_id'] ?? ''); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($pelanggaran['kode'] ?? ''); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($pelanggaran['nama'] ?? ''); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($pelanggaran['poin'] ?? ''); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($pelanggaran['deskripsi'] ?? ''); ?>
                                </td>

                                   <td>
            <?php
            if ($pelanggaran['status_aktif'] == 1) {
                echo "Aktif";
            } else {
                echo "Tidak Aktif";
            }
            ?>
        </td>

                                <td>
                                    <?= htmlspecialchars($pelanggaran['created_at'] ?? ''); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($pelanggaran['updated_at'] ?? ''); ?>
                                </td>
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
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="10" class="text-center">
                                    Belum ada data jenis pelanggaran.
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </main>
    </div>
</div>


</body>
</html>
