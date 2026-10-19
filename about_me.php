
<?php
session_start();
include "config/koneksi.php";

// Data diri
$nama = "Moza Dina Nabillah";
$kelas = "XII RPL 1";
$sekolah = "SMK Muhammadiyah Tasikmalaya";
$jurusan = "Rekayasa Perangkat Lunak";
$hobi = "Mendengarkan musik, membaca novel, menyanyi";
$cita_cita = "POLWAN";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Saya</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <?php include "layout/sidebar.php"; ?>

        <!-- KONTEN -->
        <main class="col-md-9 col-lg-10 p-4">

            <!-- HEADER -->
            <div class="p-4 rounded-4 text-white shadow mb-4"
                 style="background: linear-gradient(135deg, #6f42c1, #d63384);">
                <h2 class="fw-bold">💜 Tentang Saya</h2>
                <p class="mb-0">Kenali saya, hobi, dan cita-cita saya.</p>
            </div>

            <!-- PROFIL -->
            <div class="card border-0 shadow-sm rounded-4 text-center mb-4">
                <div class="card-body p-4">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width: 100px; height: 100px; font-size: 45px;">
                        M
                    </div>

                    <h3 class="fw-bold"><?= $nama; ?></h3>
                    <p class="text-secondary"><?= $kelas; ?> | <?= $jurusan; ?></p>

                    <span class="badge bg-primary">Pelajar</span>

                    <p class="mt-3 mb-0">
                        "Terus belajar, berani bermimpi, dan jangan menyerah."
                    </p>
                </div>
            </div>

            <!-- INFORMASI DIRI -->
            <h4 class="fw-bold mb-3">🌷 Informasi Diri</h4>

            <div class="row g-3 mb-4">

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body">
                            <h5>👤 Nama Lengkap</h5>
                            <p class="text-secondary mb-0"><?= $nama; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body">
                            <h5>🎓 Kelas</h5>
                            <p class="text-secondary mb-0"><?= $kelas; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body">
                            <h5>🏫 Sekolah</h5>
                            <p class="text-secondary mb-0"><?= $sekolah; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body">
                            <h5>💻 Jurusan</h5>
                            <p class="text-secondary mb-0"><?= $jurusan; ?></p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- HOBI DAN CITA-CITA -->
            <div class="row g-3 mb-4">

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body">
                            <h4 class="fw-bold">🎧 Hobi Saya</h4>
                            <p class="text-secondary mb-0"><?= $hobi; ?>.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body">
                            <h4 class="fw-bold">👮‍♀️ Cita-Cita</h4>
                            <p class="text-secondary">
                                Saya bercita-cita menjadi
                                <strong class="text-primary"><?= $cita_cita; ?></strong>.
                            </p>
                            <p class="mb-0">
                                Saya ingin menjadi pribadi yang disiplin,
                                bertanggung jawab, dan membanggakan keluarga.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- CERITA SAYA -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold">💖 Cerita Tentang Saya</h4>

                    <p class="text-secondary">
                        Halo! Saya Moza Dina Nabillah, siswi kelas XII RPL
                        di SMK Muhammadiyah Tasikmalaya. Saya senang belajar
                        teknologi, membuat website, dan mencoba hal baru.
                    </p>

                    <p class="text-secondary mb-0">
                        Saya ingin terus belajar, meningkatkan kemampuan,
                        dan berusaha meraih cita-cita menjadi POLWAN.
                    </p>
                </div>
            </div>

            <!-- TOMBOL KEMBALI -->
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <p class="text-secondary mb-0">Terima kasih sudah berkunjung! 💜</p>

                <a href="dashboard.php" class="btn btn-primary rounded-pill px-4">
                    ← Kembali ke Dashboard
                </a>
            </div>

            <!-- FOOTER -->
            <footer class="text-center text-secondary border-top mt-4 pt-3">
                &copy; 2026 <?= $nama; ?> | XII RPL 1 💜
            </footer>

        </main>
    </div>
</div>

</body>
</html>
