
<?php

session_start();

include "config/koneksi.php";

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Hanya admin
if ($_SESSION['role'] != "admin") {
    echo "Akses ditolak!";
    exit;
}

// Mengambil data penempatan siswa
$data = mysqli_query($koneksi, "
    SELECT 
        t_ks.id,
        t_s.nis,
        t_s.nama AS nama_siswa,
        ta.nama AS tahun_ajaran,
        t_k.nama AS nama_kelas,
        t_ks.tanggal_mulai,
        t_ks.tanggal_selesai,
        t_ks.status_aktif
    FROM t_kelas_siswa t_ks
    JOIN t_siswa t_s ON t_ks.siswa_id = t_s.id
    JOIN t_tahun_ajaran ta ON t_ks.tahun_ajaran_id = ta.id
    JOIN t_kelas t_k ON t_ks.kelas_id = t_k.id
    ORDER BY t_ks.id DESC
");

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Penempatan Siswa</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <?php
        include "layout/sidebar.php";
        ?>

        <!-- KONTEN -->
        <main class="col-md-9 col-lg-10 p-4">

            <h2>Penempatan Siswa</h2>

          <a href="dashboard.php">Kembali ke Dashboard</a>
<br><br>

<a href="tambah_tahun_ajaran.php">+ Tambah Tahun Ajaran</a>

            <br><br>

            <!-- TABEL PENEMPATAN SISWA -->
            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Tahun Ajaran</th>
                            <th>Kelas</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php
                    $no = 1;

                    if ($data && mysqli_num_rows($data) > 0) {
                        while ($row = mysqli_fetch_assoc($data)) {
                    ?>

                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row['nis']; ?></td>
                            <td><?php echo $row['nama_siswa']; ?></td>
                            <td><?php echo $row['tahun_ajaran']; ?></td>
                            <td><?php echo $row['nama_kelas']; ?></td>
                            <td><?php echo $row['tanggal_mulai']; ?></td>
                            <td>
                                <?php
                                echo $row['tanggal_selesai']
                                    ? $row['tanggal_selesai']
                                    : '-';
                                ?>
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
                    } else {
                    ?>

                        <tr>
                            <td colspan="9" class="text-center">
                                Belum ada data penempatan siswa.
                            </td>
                        </tr>

                    <?php
                    }
                    ?>

                    </tbody>

                </table>

            </div>

        </main>

    </div>
</div>



</body>
</html>
