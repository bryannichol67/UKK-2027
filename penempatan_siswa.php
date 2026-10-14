
<?php
include "config/koneksi.php";

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
" );
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Dashboard</title>
 <div class="container-fluid">
    <div class="row">
        <!-- SIDEBAR -->
        <div class="col-md-3 col-lg-2 bg-dark min-vh-100 p-3">
            <h4 class="text-white mb-4">
                My Website
            </h4>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item mb-2">
                    <a href="dashboard.php" class="nav-link text-white">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="kelola_siswa.php" class="nav-link text-white">
                        Data Siswa
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="kelola_guru.php" class="nav-link text-white">
                        Data Guru
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="kelola_kelas.php" class="nav-link text-white">
                        Kelas
                    </a>
                </li>
                 <li class="nav-item mb-2">
                    <a href="kelola_tahun_ajaran.php" class="nav-link text-white">
                        Tahun Ajaran
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="penempatan_siswa.php" class="nav-link active">
                        Penempatan Siswa
                    </a>
                <li class="nav-item mb-2">
                    <a href="kelola_wali_kelas.php" class="nav-link text-white">
                        Wali Kelas
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="kelola_kategori_pelanggaran.php" class="nav-link text-white">
                        Kategori Pelanggaran
                    </a>
                    <li class="nav-item mb-2">
                    <a href="kelola_jenis_pelanggaran.php" class="nav-link text-white">
                        Jenis Pelanggaran
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="laporan.php" class="nav-link text-white">
                        Laporan
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="about_me.php" class="nav-link text-white">
                        About Me
                    </a>
                </li>
                <hr class="text-secondary">
                <li class="nav-item">
                    <a href="logout.php" class="nav-link text-danger">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
        <!-- KONTEN -->
        <main class="col-md-9 col-lg-10 p-4">
          
<script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
<h2>Penempatan Siswa</h2>

<a href="dashboard.php">Kembali ke Dashboard</a>
<br><br>

<a href="tambah_penempatan_siswa.php">+ Tambah Penempatan Siswa</a>
<br><br>

<table class="table table-bordered">
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

    <?php
    $no = 1;

    while ($row = mysqli_fetch_assoc($data)) {
    ?>
    <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $row['nis']; ?></td>
        <td><?php echo $row['nama_siswa']; ?></td>
        <td><?php echo $row['tahun_ajaran']; ?></td>
        <td><?php echo $row['nama_kelas']; ?></td>
        <td><?php echo $row['tanggal_mulai']; ?></td>
        <td><?php echo $row['tanggal_selesai']; ?></td>
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
            <a href="edit_penempatan_siswa.php?id=<?php echo $row['id']; ?>">
            <button type="button" class="btn btn-warning">Edit</button>
            </a> |
            <a href="hapus_penempatan_siswa.php?id=<?php echo $row['id']; ?>"
               <button type="button" class="btn btn-danger">Hapus</button>
        </td>
    </tr>
    <?php
        $no++;
    }
    ?>
</table>

