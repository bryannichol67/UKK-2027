<?php
session_start();
include "config/koneksi.php";

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$pesan = "";

// Ambil data pilihan dari database
$tahun = mysqli_query($koneksi, "SELECT * FROM t_tahun_ajaran ORDER BY id DESC");
$siswa = mysqli_query($koneksi, "SELECT * FROM t_siswa ORDER BY nama ASC");
$kelas = mysqli_query($koneksi, "SELECT * FROM t_kelas ORDER BY nama ASC");
$pelanggaran = mysqli_query($koneksi, "SELECT * FROM t_pelanggaran WHERE status_aktif = 1 ORDER BY nama ASC");
$guru = mysqli_query($koneksi, "SELECT * FROM t_guru ORDER BY nama ASC");

// Proses simpan data
if (isset($_POST['simpan'])) {
    $tahun_ajaran_id = $_POST['tahun_ajaran_id'];
    $siswa_id = $_POST['siswa_id'];
    $kelas_id = $_POST['kelas_id'];
    $pelanggaran_id = $_POST['pelanggaran_id'];
    $guru_id = $_POST['guru_id'];
    $tanggal = $_POST['tanggal'];
    $keterangan = trim($_POST['keterangan']);
    $tindakan = trim($_POST['tindakan']);
    $status = $_POST['status'];

    // Ambil nama siswa
    $qSiswa = mysqli_query($koneksi, "SELECT nama FROM t_siswa WHERE id='$siswa_id'");
    $dSiswa = mysqli_fetch_assoc($qSiswa);

    // Ambil nama kelas
    $qKelas = mysqli_query($koneksi, "SELECT nama FROM t_kelas WHERE id='$kelas_id'");
    $dKelas = mysqli_fetch_assoc($qKelas);

    // Ambil nama pelanggaran dan poin
    $qPelanggaran = mysqli_query($koneksi, "SELECT nama, poin, pelanggaran_kategori_id FROM t_pelanggaran WHERE id='$pelanggaran_id'");
    $dPelanggaran = mysqli_fetch_assoc($qPelanggaran);

    // Ambil nama guru
    $qGuru = mysqli_query($koneksi, "SELECT nama FROM t_guru WHERE id='$guru_id'");
    $dGuru = mysqli_fetch_assoc($qGuru);

    if ($dSiswa && $dKelas && $dPelanggaran && $dGuru) {
        $nama_siswa = $dSiswa['nama'];
        $nama_kelas = $dKelas['nama'];
        $nama_pelanggaran = $dPelanggaran['nama'];
        $poin = $dPelanggaran['poin'];
        $kategori_id = $dPelanggaran['pelanggaran_kategori_id'];
        $nama_guru = $dGuru['nama'];

        // Simpan data pelanggaran
        $stmt = mysqli_prepare($koneksi, "
            INSERT INTO t_pelanggaran_siswa
            (
                tahun_ajaran_id, siswa_id, nama_siswa,
                kelas_id, nama_kelas, pelanggaran_id,
                nama_pelanggaran, pelanggaran_kategori_id,
                guru_id, nama_guru, tanggal, keterangan,
                poin, tindakan, status
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

      mysqli_stmt_bind_param(
    $stmt,
    "iisisisiisssiss",
    $tahun_ajaran_id,
    $siswa_id,
    $nama_siswa,
    $kelas_id,
    $nama_kelas,
    $pelanggaran_id,
    $nama_pelanggaran,
    $kategori_id,
    $guru_id,
    $nama_guru,
    $tanggal,
    $keterangan,
    $poin,
    $tindakan,
    $status
);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: catat_pelanggaran.php?berhasil=1");
            exit;
        } else {
            $pesan = "Gagal menyimpan data pelanggaran.";
        }
    } else {
        $pesan = "Data siswa, kelas, pelanggaran, atau guru tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catat Pelanggaran</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body>
<div class="container-fluid">
    <div class="row">

        <?php include "layout/sidebar.php"; ?>

        <main class="col-md-9 col-lg-10 p-4">

            <h2>Catat Pelanggaran Siswa</h2>
            <p>Form untuk mencatat pelanggaran siswa.</p>

            <a href="dashboard.php" class="btn btn-secondary mb-3">
                Kembali ke Dashboard
            </a>

            <?php if (isset($_GET['berhasil'])) { ?>
                <div class="alert alert-success">
                    Data pelanggaran berhasil disimpan.
                </div>
            <?php } ?>

            <?php if ($pesan != "") { ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($pesan); ?>
                </div>
            <?php } ?>

            <div class="card shadow-sm">
                <div class="card-body">

                    <form method="POST">

                        <div class="mb-3">
                            <label class="form-label">Tahun Ajaran</label>
                            <select name="tahun_ajaran_id" class="form-select" required>
                                <option value="">-- Pilih Tahun Ajaran --</option>
                                <?php while ($row = mysqli_fetch_assoc($tahun)) { ?>
                                    <option value="<?= $row['id']; ?>">
                                        <?= htmlspecialchars($row['nama']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Siswa</label>
                            <select name="siswa_id" class="form-select" required>
                                <option value="">-- Pilih Siswa --</option>
                                <?php while ($row = mysqli_fetch_assoc($siswa)) { ?>
                                    <option value="<?= $row['id']; ?>">
                                        <?= htmlspecialchars($row['nis'] . " - " . $row['nama']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <select name="kelas_id" class="form-select" required>
                                <option value="">-- Pilih Kelas --</option>
                                <?php while ($row = mysqli_fetch_assoc($kelas)) { ?>
                                    <option value="<?= $row['id']; ?>">
                                        <?= htmlspecialchars($row['nama']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Pelanggaran</label>
                            <select name="pelanggaran_id" class="form-select" required>
                                <option value="">-- Pilih Pelanggaran --</option>
                                <?php while ($row = mysqli_fetch_assoc($pelanggaran)) { ?>
                                    <option value="<?= $row['id']; ?>">
                                        <?= htmlspecialchars($row['nama']); ?>
                                        (<?= $row['poin']; ?> poin)
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Guru Pencatat</label>
                            <select name="guru_id" class="form-select" required>
                                <option value="">-- Pilih Guru --</option>
                                <?php while ($row = mysqli_fetch_assoc($guru)) { ?>
                                    <option value="<?= $row['id']; ?>">
                                        <?= htmlspecialchars($row['nama']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Pelanggaran</label>
                            <input type="date" name="tanggal"
                                   class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control"
                                      rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tindakan / Sanksi</label>
                            <textarea name="tindakan" class="form-control"
                                      rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="Diproses">Diproses</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>

                        <button type="submit" name="simpan"
                                class="btn btn-primary">
                            Simpan Pelanggaran
                        </button>

                    </form>
                </div>
            </div>

        </main>
    </div>
</div>

</body>
</html>