CREATE DATABASE IF NOT EXISTS perpustakaan;

USE perpustakaan;

CREATE TABLE IF NOT EXISTS anggota (
    id_anggota INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS buku (
    id_buku INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(150) NOT NULL,
    penulis VARCHAR(100) NOT NULL,
    kategori VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS peminjaman (
    id_peminjaman INT AUTO_INCREMENT PRIMARY KEY,
    id_anggota INT NOT NULL,
    id_buku INT NOT NULL,
    tanggal_pinjam DATE NOT NULL,
    status VARCHAR(30) NOT NULL,

    CONSTRAINT fk_peminjaman_anggota
        FOREIGN KEY (id_anggota)
        REFERENCES anggota(id_anggota)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_peminjaman_buku
        FOREIGN KEY (id_buku)
        REFERENCES buku(id_buku)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

INSERT INTO anggota (nama, email, no_hp) VALUES
('Julia Sinta', 'julia@gmail.com', '081234567801'),
('Andi Pratama', 'andi@gmail.com', '081234567802'),
('Siti Aulia', 'siti@gmail.com', '081234567803'),
('Budi Santoso', 'budi@gmail.com', '081234567804'),
('Rina Maharani', 'rina@gmail.com', '081234567805');

INSERT INTO buku (judul, penulis, kategori) VALUES
('Pemrograman Web Dasar', 'Andi Setiawan', 'Teknologi'),
('Belajar MySQL', 'Budi Raharjo', 'Database'),
('Algoritma dan Pemrograman', 'Rosa A.S.', 'Teknologi'),
('Dasar-Dasar Sistem Informasi', 'Kurniawan', 'Sistem Informasi'),
('Pengantar Teknologi Informasi', 'Sutanto', 'Teknologi');

INSERT INTO peminjaman
(id_anggota, id_buku, tanggal_pinjam, status) VALUES
(1, 1, '2026-10-01', 'Dipinjam'),
(1, 2, '2026-10-02', 'Dikembalikan'),
(2, 3, '2026-10-03', 'Dipinjam'),
(3, 4, '2026-10-04', 'Dipinjam'),
(4, 5, '2026-10-05', 'Dikembalikan'),
(5, 1, '2026-10-06', 'Dipinjam');