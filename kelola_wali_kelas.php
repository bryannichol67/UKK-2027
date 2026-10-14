
<?php
session_start();

include "config/koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['role'] != "admin") {
    echo "Akses ditolak!";
    exit;
}

$query = mysqli_query($koneksi, "
    SELECT t_wali_kelas.*, 
           t_tahun_ajaran.nama AS tahun_ajaran,
           t_kelas.nama AS nama_kelas,
           t_kelas.tingkat,
           t_kelas.jurusan,
           t_guru.nip,
           t_guru.nama AS nama_guru
    FROM t_wali_kelas
    LEFT JOIN t_tahun_ajaran ON t_wali_kelas.tahun_ajaran_id = t_tahun_ajaran.id
    LEFT JOIN t_kelas ON t_wali_kelas.kelas_id = t_kelas.id
    LEFT JOIN t_guru ON t_wali_kelas.guru_id = t_guru.id
    ORDER BY t_wali_kelas.id DESC
");
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
                    <a href="penempatan_siswa.php" class="nav-link text-white">
                        Penempatan Siswa
                    </a>
                <li class="nav-item mb-2">
                    <a href="kelola_wali_kelas.php" class="nav-link active">
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
         
            <script type="importmap">
{
  "imports": {
    "@floating-ui/dom": "https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.7.6/dist/floating-ui.dom.esm.min.js",
    "vanilla-calendar-pro": "https://cdn.jsdelivr.net/npm/vanilla-calendar-pro@3.4.0/index.mjs"
  }
}
</script>
<script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.min.js" integrity="sha384-BJf/nQgxZJU68GxBse97Vdlc8Rh+z9PzzXiS3/BjV+1nQPR7IKn+iJnD3DJvCMaU" crossorigin="anonymous"></script>

<h2>Kelola Wali Kelas</h2>

<a href="dashboard.php">Kembali ke Dashboard</a>
<br><br>

<a href="tambah_wali_kelas.php">+ Tambah Wali Kelas</a>
<br><br>

<table class="table table-bordered">

<tr>
    <th>No</th>
    <th>Tahun Ajaran</th>
    <th>Kelas</th>
    <th>NIP</th>
    <th>Nama Guru</th>
    <th>Tanggal Mulai</th>
    <th>Tanggal Selesai</th>
    <th>Status</th>
    <th>Created At</th>
    <th>Updated At</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;

while ($data = mysqli_fetch_assoc($query)) {
?>

<tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data['tahun_ajaran']; ?></td>
    <td>
        <?php echo $data['nama_kelas']; ?>
        <?php echo $data['tingkat']; ?>
        <?php echo $data['jurusan']; ?>
    </td>
    <td><?php echo $data['nip']; ?></td>
    <td><?php echo $data['nama_guru']; ?></td>
    <td><?php echo $data['tanggal_mulai']; ?></td>
    <td><?php echo $data['tanggal_selesai']; ?></td>

    <td>
        <?php
        if ($data['status_aktif'] == 1) {
            echo "Aktif";
        } else {
            echo "Tidak Aktif";
        }
        ?>
    </td>

    <td><?php echo $data['created_at']; ?></td>
    <td><?php echo $data['updated_at']; ?></td>

    <td>
        <a href="edit_wali_kelas.php?id=<?php echo $data['id']; ?>">
            <button type="button" class="btn btn-warning">Edit</button>
        </a>
        |
        <a href="hapus_wali_kelas.php?id=<?php echo $data['id']; ?>"
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

