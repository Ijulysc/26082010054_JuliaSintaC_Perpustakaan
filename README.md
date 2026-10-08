# Perpustakaan Digital

Website sederhana berbasis PHP dan MySQL untuk menampilkan data perpustakaan secara dinamis.

Project ini dibuat untuk memenuhi penugasan pembuatan website sederhana yang terhubung dengan database MySQL menggunakan PHP.

## Teknologi

- PHP
- MySQL
- HTML
- CSS
- Laragon
- DBeaver
- GitHub

## Struktur Project

```text
perpustakaan/
│
├── services/
│   └── config.php
│
├── database/
│   └── schema.sql
│
├── index.php
├── style.css
└── README.md
```markdown
Deskripsi Project

Perpustakaan Digital merupakan website sederhana yang digunakan untuk menampilkan data anggota, buku, dan peminjaman buku.

Website terhubung dengan database MySQL menggunakan PHP. Data yang ditampilkan pada website berasal langsung dari database sehingga bersifat dinamis.

Database terdiri dari tiga tabel utama, yaitu:

anggota
buku
peminjaman

Tabel peminjaman digunakan sebagai tabel transaksi yang menghubungkan tabel anggota dan buku.

Entitas dan Atribut
1. Tabel Anggota

Tabel anggota merupakan tabel master yang digunakan untuk menyimpan data anggota perpustakaan.

Atribut:

Atribut	Tipe Data	Keterangan
id_anggota	INT	Primary Key
nama	VARCHAR(100)	Nama anggota
email	VARCHAR(100)	Email anggota
no_hp	VARCHAR(20)	Nomor HP anggota

Primary Key:

id_anggota

Jumlah data: 5 anggota.

2. Tabel Buku

Tabel buku merupakan tabel master yang digunakan untuk menyimpan data buku perpustakaan.

Atribut:

Atribut	Tipe Data	Keterangan
id_buku	INT	Primary Key
judul	VARCHAR(150)	Judul buku
penulis	VARCHAR(100)	Nama penulis
kategori	VARCHAR(50)	Kategori buku

Primary Key:

id_buku

Jumlah data: 5 buku.

3. Tabel Peminjaman

Tabel peminjaman merupakan tabel transaksi yang digunakan untuk menyimpan data peminjaman buku.

Atribut:

Atribut	Tipe Data	Keterangan
id_peminjaman	INT	Primary Key
id_anggota	INT	Foreign Key ke tabel anggota
id_buku	INT	Foreign Key ke tabel buku
tanggal_pinjam	DATE	Tanggal peminjaman
status	VARCHAR(30)	Status peminjaman

Primary Key:

id_peminjaman

Foreign Key:

id_anggota → anggota.id_anggota
id_buku → buku.id_buku

Jumlah data: 6 peminjaman.

Relasi Antar Tabel
1. Relasi Anggota dan Peminjaman

Satu anggota dapat melakukan banyak peminjaman.

Kardinalitas:

1 : N (One-to-Many)

anggota (1) ──────────< peminjaman (N)

Artinya satu anggota dapat memiliki banyak transaksi peminjaman, sedangkan satu transaksi peminjaman hanya dimiliki oleh satu anggota.

2. Relasi Buku dan Peminjaman

Satu buku dapat tercatat dalam banyak transaksi peminjaman.

Kardinalitas:

1 : N (One-to-Many)

buku (1) ──────────< peminjaman (N)

Artinya satu buku dapat muncul pada beberapa transaksi peminjaman, sedangkan satu transaksi peminjaman hanya mengacu pada satu buku.

Gambaran Relasi Database
┌─────────────────┐
│     anggota     │
├─────────────────┤
│ PK id_anggota   │
│ nama            │
│ email           │
│ no_hp           │
└────────┬────────┘
         │
         │ 1 : N
         ▼
┌─────────────────────┐
│     peminjaman      │
├─────────────────────┤
│ PK id_peminjaman    │
│ FK id_anggota       │
│ FK id_buku          │
│ tanggal_pinjam      │
│ status              │
└──────────┬──────────┘
           │
           │ N : 1
           ▼
┌─────────────────┐
│      buku       │
├─────────────────┤
│ PK id_buku      │
│ judul           │
│ penulis         │
│ kategori        │
└─────────────────┘
Database

Database yang digunakan dalam project ini bernama:

perpustakaan

Database terdiri dari tiga tabel:

anggota
buku
peminjaman

Tabel anggota dan buku merupakan tabel master, sedangkan tabel peminjaman merupakan tabel transaksi/relasi.

Setiap tabel memiliki Primary Key dan tabel peminjaman memiliki Foreign Key yang menghubungkan tabel anggota dan buku.

Data pada database terdiri dari:

5 data anggota
5 data buku
6 data peminjaman
Query Sample
1. SELECT

Query SELECT digunakan untuk mengambil data dari tabel anggota.

SELECT * FROM anggota;
2. JOIN

Query JOIN digunakan untuk menggabungkan data dari tabel anggota, buku, dan peminjaman.

SELECT
    peminjaman.id_peminjaman,
    anggota.nama,
    buku.judul,
    peminjaman.tanggal_pinjam,
    peminjaman.status
FROM peminjaman
INNER JOIN anggota
    ON peminjaman.id_anggota = anggota.id_anggota
INNER JOIN buku
    ON peminjaman.id_buku = buku.id_buku;

Query tersebut digunakan untuk menampilkan nama anggota, judul buku, tanggal peminjaman, dan status peminjaman.

3. UPDATE

Query UPDATE digunakan untuk mengubah data anggota.

Contoh mengubah nomor HP anggota dengan id_anggota = 1:

UPDATE anggota
SET no_hp = '081234567899'
WHERE id_anggota = 1;
4. DELETE

Query DELETE digunakan untuk menghapus data anggota berdasarkan ID.

Contoh:

DELETE FROM anggota
WHERE id_anggota = 5;

Query UPDATE dan DELETE di atas merupakan contoh query dan tidak perlu dijalankan pada database utama.

Query pada Website

Website menggunakan query SELECT untuk mengambil data dari database.

Data peminjaman menggunakan INNER JOIN untuk menghubungkan tiga tabel:

anggota
buku
peminjaman

Data kemudian ditampilkan secara dinamis menggunakan PHP dengan perulangan while dan fetch_assoc().

Contoh:

while ($row = $result->fetch_assoc())

Dengan demikian, data yang ditampilkan pada website berasal langsung dari database dan bukan data yang ditulis secara manual pada HTML.

Fitur Website

Website memiliki beberapa fitur:

Menampilkan total anggota.
Menampilkan total buku.
Menampilkan total peminjaman.
Menampilkan data anggota.
Menampilkan data buku.
Menampilkan data peminjaman.
Menampilkan informasi anggota yang melakukan peminjaman.
Menampilkan informasi buku yang dipinjam.
Menampilkan penulis buku.
Menampilkan kategori buku.
Menampilkan tanggal peminjaman.
Menampilkan status peminjaman.
Data diambil secara dinamis dari database MySQL.
Menggunakan PHP dan MySQL untuk pengolahan data.
Ketentuan Visual dan Layout

Website menggunakan desain yang sederhana dan responsif dengan ketentuan:

Menggunakan warna brand biru/navy secara konsisten.
Navbar menggunakan warna brand.
Heading menggunakan warna yang konsisten.
Card menggunakan padding.
Card menggunakan border.
Card menggunakan box shadow.
Menggunakan display: flex.
Menggunakan CSS Grid.
Menggunakan media query untuk tampilan responsif.
Tabel dapat menyesuaikan tampilan pada layar kecil.
Website dapat digunakan pada perangkat desktop maupun mobile.
File Database

File database terdapat pada:

database/schema.sql

File tersebut berisi:

DROP DATABASE
CREATE DATABASE
CREATE TABLE
Primary Key
Foreign Key
INSERT INTO

Data yang dimasukkan terdiri dari:

5 data anggota
5 data buku
6 data peminjaman
Konfigurasi Database

Konfigurasi koneksi database terdapat pada:

services/config.php

Konfigurasi menggunakan:

$host = "localhost";
$username = "root";
$password = "";
$database = "perpustakaan";

Koneksi database menggunakan mysqli.

Cara Menjalankan Project
1. Jalankan Laragon

Buka aplikasi Laragon kemudian jalankan:

Apache
MySQL
2. Pastikan Database

Pastikan database:

perpustakaan

sudah tersedia pada MySQL.

Database dapat dibuat menggunakan file:

database/schema.sql
3. Letakkan Project

Simpan folder project pada:

D:\Laragon\laragon\www\perpustakaan
4. Jalankan Website

Buka browser kemudian akses:

http://localhost/perpustakaan/
GitHub

Project dapat diunggah ke GitHub menggunakan Git.

Contoh perintah:

git init
git add .
git commit -m "Initial project perpustakaan"
git branch -M main
git remote add origin URL_REPOSITORY_GITHUB
git push -u origin main
Kesimpulan

Perpustakaan Digital merupakan website sederhana berbasis PHP dan MySQL yang memiliki tiga tabel yang saling berelasi, yaitu anggota, buku, dan peminjaman.

Website dapat mengambil dan menampilkan data secara dinamis dari database menggunakan PHP, MySQL, query SELECT, JOIN, serta perulangan while dan fetch_assoc().

Project juga menerapkan desain responsif menggunakan CSS, Flexbox, Grid, padding, border, dan shadow.