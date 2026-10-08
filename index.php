<?php

require_once __DIR__ . "/services/config.php";

/* =========================
   QUERY DATA ANGGOTA
========================= */

$sql_anggota = "SELECT * FROM anggota ORDER BY id_anggota ASC";
$result_anggota = $conn->query($sql_anggota);

if (!$result_anggota) {
    die("Query anggota gagal: " . $conn->error);
}

/* =========================
   QUERY DATA BUKU
========================= */

$sql_buku = "SELECT * FROM buku ORDER BY id_buku ASC";
$result_buku = $conn->query($sql_buku);

if (!$result_buku) {
    die("Query buku gagal: " . $conn->error);
}

/* =========================
   QUERY DATA PEMINJAMAN
========================= */

$sql_peminjaman = "SELECT
                    peminjaman.id_peminjaman,
                    anggota.nama AS nama_anggota,
                    anggota.email,
                    buku.judul AS judul_buku,
                    buku.penulis,
                    buku.kategori,
                    peminjaman.tanggal_pinjam,
                    peminjaman.status
                FROM peminjaman
                INNER JOIN anggota
                    ON peminjaman.id_anggota = anggota.id_anggota
                INNER JOIN buku
                    ON peminjaman.id_buku = buku.id_buku
                ORDER BY peminjaman.id_peminjaman DESC";

$result_peminjaman = $conn->query($sql_peminjaman);

if (!$result_peminjaman) {
    die("Query peminjaman gagal: " . $conn->error);
}

/* =========================
   TOTAL DATA
========================= */

$total_anggota = $conn->query(
    "SELECT COUNT(*) AS total FROM anggota"
)->fetch_assoc()['total'];

$total_buku = $conn->query(
    "SELECT COUNT(*) AS total FROM buku"
)->fetch_assoc()['total'];

$total_peminjaman = $conn->query(
    "SELECT COUNT(*) AS total FROM peminjaman"
)->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Perpustakaan Digital</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- NAVBAR -->

    <nav class="navbar">

        <div class="container navbar-content">

            <div class="brand">

                <span class="brand-icon">📚</span>

                <div>
                    <h1>Perpustakaan</h1>
                    <p>Digital Library</p>
                </div>

            </div>

            <div class="nav-menu">

                <a href="#beranda">Beranda</a>

                <a href="#data">Data Perpustakaan</a>

            </div>

        </div>

    </nav>


    <!-- HERO -->

    <main id="beranda">

        <section class="hero">

            <div class="container hero-content">

                <div class="hero-text">

                    <p class="label">
                        SISTEM INFORMASI PERPUSTAKAAN
                    </p>

                    <h2>
                        Kelola Data Perpustakaan
                        <span>Dengan Mudah</span>
                    </h2>

                    <p class="hero-description">

                        Website sederhana berbasis PHP dan MySQL
                        untuk menampilkan data anggota, buku,
                        dan peminjaman secara dinamis.

                    </p>

                    <a href="#data" class="button">
                        Lihat Data
                    </a>

                </div>


                <div class="hero-card">

                    <div class="book-icon">📖</div>

                    <h3>Perpustakaan Digital</h3>

                    <p>
                        Sistem terhubung langsung dengan
                        database MySQL.
                    </p>

                </div>

            </div>

        </section>


        <!-- STATISTICS -->

        <section class="statistics">

            <div class="container stats-grid">

                <div class="stat-card">

                    <div class="stat-icon">👥</div>

                    <div>

                        <p>Total Anggota</p>

                        <h3>
                            <?= $total_anggota; ?>
                        </h3>

                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-icon">📚</div>

                    <div>

                        <p>Total Buku</p>

                        <h3>
                            <?= $total_buku; ?>
                        </h3>

                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-icon">📝</div>

                    <div>

                        <p>Total Peminjaman</p>

                        <h3>
                            <?= $total_peminjaman; ?>
                        </h3>

                    </div>

                </div>

            </div>

        </section>


        <!-- DATA -->

        <section class="data-section" id="data">

            <div class="container">

                <div class="section-heading">

                    <div>

                        <p class="label">
                            DATABASE
                        </p>

                        <h2>
                            Data Perpustakaan
                        </h2>

                    </div>

                    <p>
                        Data diambil langsung dari database
                        MySQL menggunakan PHP.
                    </p>

                </div>


                <!-- =========================
                     TABEL ANGGOTA
                ========================== -->

                <div class="table-card">

                    <div class="table-header">

                        <div>

                            <h3>
                                Data Anggota
                            </h3>

                            <p>
                                Daftar anggota perpustakaan.
                            </p>

                        </div>

                    </div>


                    <div class="table-wrapper">

                        <table>

                            <thead>

                                <tr>

                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. HP</th>

                                </tr>

                            </thead>


                            <tbody>

                                <?php if ($result_anggota->num_rows > 0): ?>

                                    <?php while ($row = $result_anggota->fetch_assoc()): ?>

                                        <tr>

                                            <td>
                                                <?= htmlspecialchars($row['id_anggota']); ?>
                                            </td>

                                            <td>
                                                <strong>
                                                    <?= htmlspecialchars($row['nama']); ?>
                                                </strong>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($row['email']); ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($row['no_hp']); ?>
                                            </td>

                                        </tr>

                                    <?php endwhile; ?>

                                <?php else: ?>

                                    <tr>

                                        <td colspan="4" class="empty">
                                            Belum ada data anggota.
                                        </td>

                                    </tr>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </div>


                <!-- =========================
                     TABEL BUKU
                ========================== -->

                <div class="table-card">

                    <div class="table-header">

                        <div>

                            <h3>
                                Data Buku
                            </h3>

                            <p>
                                Daftar buku yang tersedia di perpustakaan.
                            </p>

                        </div>

                    </div>


                    <div class="table-wrapper">

                        <table>

                            <thead>

                                <tr>

                                    <th>ID</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Kategori</th>

                                </tr>

                            </thead>


                            <tbody>

                                <?php if ($result_buku->num_rows > 0): ?>

                                    <?php while ($row = $result_buku->fetch_assoc()): ?>

                                        <tr>

                                            <td>
                                                <?= htmlspecialchars($row['id_buku']); ?>
                                            </td>

                                            <td>
                                                <strong>
                                                    <?= htmlspecialchars($row['judul']); ?>
                                                </strong>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($row['penulis']); ?>
                                            </td>

                                            <td>

                                                <span class="category">

                                                    <?= htmlspecialchars($row['kategori']); ?>

                                                </span>

                                            </td>

                                        </tr>

                                    <?php endwhile; ?>

                                <?php else: ?>

                                    <tr>

                                        <td colspan="4" class="empty">
                                            Belum ada data buku.
                                        </td>

                                    </tr>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </div>


                <!-- =========================
                     TABEL PEMINJAMAN
                ========================== -->

                <div class="table-card">

                    <div class="table-header">

                        <div>

                            <h3>
                                Data Peminjaman
                            </h3>

                            <p>
                                Informasi anggota, buku, dan status peminjaman.
                            </p>

                        </div>

                    </div>


                    <div class="table-wrapper">

                        <table>

                            <thead>

                                <tr>

                                    <th>ID</th>
                                    <th>Anggota</th>
                                    <th>Email</th>
                                    <th>Buku</th>
                                    <th>Penulis</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>

                                </tr>

                            </thead>


                            <tbody>

                                <?php if ($result_peminjaman->num_rows > 0): ?>

                                    <?php while ($row = $result_peminjaman->fetch_assoc()): ?>

                                        <tr>

                                            <td>
                                                <?= htmlspecialchars($row['id_peminjaman']); ?>
                                            </td>

                                            <td>

                                                <strong>
                                                    <?= htmlspecialchars($row['nama_anggota']); ?>
                                                </strong>

                                            </td>

                                            <td>
                                                <?= htmlspecialchars($row['email']); ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($row['judul_buku']); ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($row['penulis']); ?>
                                            </td>

                                            <td>

                                                <span class="category">

                                                    <?= htmlspecialchars($row['kategori']); ?>

                                                </span>

                                            </td>

                                            <td>
                                                <?= htmlspecialchars($row['tanggal_pinjam']); ?>
                                            </td>

                                            <td>

                                                <?php if ($row['status'] === 'Dipinjam'): ?>

                                                    <span class="status borrowed">
                                                        Dipinjam
                                                    </span>

                                                <?php else: ?>

                                                    <span class="status returned">
                                                        Dikembalikan
                                                    </span>

                                                <?php endif; ?>

                                            </td>

                                        </tr>

                                    <?php endwhile; ?>

                                <?php else: ?>

                                    <tr>

                                        <td colspan="8" class="empty">
                                            Belum ada data peminjaman.
                                        </td>

                                    </tr>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </section>

    </main>


    <!-- FOOTER -->

    <footer>

        <div class="container footer-content">

            <div>

                <h3>
                    📚 Perpustakaan Digital
                </h3>

                <p>
                    Website sederhana menggunakan PHP,
                    MySQL, HTML, dan CSS.
                </p>

            </div>

            <p>
                © 2026 Perpustakaan Digital
            </p>

        </div>

    </footer>

</body>

</html>