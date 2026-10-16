<?php
session_start();
include "config/koneksi.php";

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Mengambil data laporan pelanggaran siswa
$data = mysqli_query($koneksi, "
    SELECT
        ps.id,
        s.nis,
        s.nama,
        pk.nama AS pelanggaran
    FROM t_pelanggaran_siswa ps
    JOIN t_siswa s ON ps.siswa_id = s.id
    JOIN t_pelanggaran_kategori pk ON ps.pelanggaran_id = pk.id
    ORDER BY ps.id DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Pelanggaran Siswa</title>

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

            <h2>Laporan Pelanggaran Siswa</h2>
            <p>Daftar laporan pelanggaran yang dilakukan siswa.</p>

            <!-- Tombol navigasi dan laporan -->
            <a href="dashboard.php" class="btn btn-secondary mb-3">
                Kembali ke Dashboard
            </a>

            <a href="cetak_laporan.php"
               target="_blank"
               class="btn btn-primary mb-3">
                Cetak Laporan
            </a>

            <a href="export_laporan.php"
               class="btn btn-success mb-3">
                Export Excel
            </a>

            <!-- Tabel laporan -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Pelanggaran</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        if ($data && mysqli_num_rows($data) > 0) {
                            while ($row = mysqli_fetch_assoc($data)) {
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row['nis'] ?? ''); ?></td>
                                <td><?= htmlspecialchars($row['nama'] ?? ''); ?></td>
                                <td><?= htmlspecialchars($row['pelanggaran'] ?? ''); ?></td>
                            </tr>
                        <?php
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="4" class="text-center">
                                    Belum ada data laporan pelanggaran.
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
