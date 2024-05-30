-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Bulan Mei 2024 pada 10.21
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simpeg`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cuti_pegawai`
--

CREATE TABLE `cuti_pegawai` (
  `id_cuti` int(100) NOT NULL,
  `id_pegawai` int(100) NOT NULL,
  `lama_cuti` varchar(100) NOT NULL,
  `tgl_awal` varchar(100) NOT NULL,
  `tgl_akhir` varchar(100) NOT NULL,
  `ket_cuti` text NOT NULL,
  `status_cuti` varchar(100) NOT NULL,
  `ket_batal` text,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tgl_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cuti_pegawai`
--

INSERT INTO `cuti_pegawai` (`id_cuti`, `id_pegawai`, `lama_cuti`, `tgl_awal`, `tgl_akhir`, `ket_cuti`, `status_cuti`, `ket_batal`, `tgl_input`, `tgl_status`) VALUES
(1, 5, '21', '2024-06-30', '2024-07-06', 'nikah bro', 'acc', 'ok', '2024-05-30 07:27:01', '30/05/2024');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen`
--

CREATE TABLE `dokumen` (
  `id_dokumen` int(100) NOT NULL,
  `id_pegawai` int(100) NOT NULL,
  `ket_dokumen` varchar(100) DEFAULT NULL,
  `file_dokumen` varchar(100) DEFAULT NULL,
  `jenis_dokumen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dokumen`
--

INSERT INTO `dokumen` (`id_dokumen`, `id_pegawai`, `ket_dokumen`, `file_dokumen`, `jenis_dokumen`) VALUES
(1, 5, 'Kepuasan Pasien', '1716563587_RUJUKAN WIJI.pdf', NULL),
(2, 5, 'ijasah', '1716563629_ijasah.jpg', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keluarga`
--

CREATE TABLE `keluarga` (
  `id_keluarga` int(100) NOT NULL,
  `id_pegawai` int(100) NOT NULL,
  `nama_keluarga` varchar(100) NOT NULL,
  `hubungan_keluarga` varchar(100) NOT NULL,
  `no_hpkeluarga` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keluarga`
--

INSERT INTO `keluarga` (`id_keluarga`, `id_pegawai`, `nama_keluarga`, `hubungan_keluarga`, `no_hpkeluarga`) VALUES
(1, 5, 'miswan', 'paman', '09877823525');

-- --------------------------------------------------------

--
-- Struktur dari tabel `map`
--

CREATE TABLE `map` (
  `id_map` int(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `map`
--

INSERT INTO `map` (`id_map`, `latitude`, `longitude`, `status`) VALUES
(1, '-5.343558', '104.963722', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(100) NOT NULL,
  `kode_pegawai` varchar(100) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `status_pegawai` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `no_hp` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `jenis_pegawai` varchar(100) NOT NULL,
  `jabatan_pegawai` varchar(100) NOT NULL,
  `mulai_kerja` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `kode_pegawai`, `nama_pegawai`, `status_pegawai`, `nik`, `no_hp`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `alamat`, `gambar`, `email`, `password`, `jenis_pegawai`, `jabatan_pegawai`, `mulai_kerja`) VALUES
(5, '10201032', 'MARDIYANTO, M.T.I', 'TETAP', '1820706109100034', '082373971991', 'Gunung Sugih ', '2024-05-16', 'Laki-Laki', 'jalan johar perumahan perdana village no. a40\r\npodomoro', '6650ae4a83ab2.jpg', 'mardybest@gmail.com', '625972dff6c098eedb27df8640957291', 'Dosen dan Kariawan', 'Teknisi Laboratorium', '2010-05-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensi_datang`
--

CREATE TABLE `presensi_datang` (
  `id_presensi_datang` int(100) NOT NULL,
  `gambar_datang` varchar(100) NOT NULL,
  `tanggal_absensi_datang` date NOT NULL,
  `jam_absensi_datang` varchar(100) NOT NULL,
  `id_pegawai` int(100) NOT NULL,
  `status_absensi_datang` varchar(100) NOT NULL,
  `status_absensi` varchar(100) DEFAULT NULL,
  `status_hadir` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `presensi_datang`
--

INSERT INTO `presensi_datang` (`id_presensi_datang`, `gambar_datang`, `tanggal_absensi_datang`, `jam_absensi_datang`, `id_pegawai`, `status_absensi_datang`, `status_absensi`, `status_hadir`, `latitude`, `longitude`) VALUES
(1, 'absen_5_1716963873.jpg', '2024-05-29', '13:24:33', 5, 'datang', 'pagi', 'hadir', '-3.407872', '104.251392'),
(2, 'absen_5_1717039019.jpg', '2024-05-30', '10:16:59', 5, 'datang', 'pagi', 'hadir', '-5.3641216', '105.2409856');

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensi_pulang`
--

CREATE TABLE `presensi_pulang` (
  `id_presensi_pulang` int(100) NOT NULL,
  `gambar_pulang` varchar(100) NOT NULL,
  `tanggal_absensi_pulang` date NOT NULL,
  `jam_absensi_pulang` varchar(100) NOT NULL,
  `id_pegawai` int(100) NOT NULL,
  `status_absensi_pulang` varchar(100) NOT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `presensi_pulang`
--

INSERT INTO `presensi_pulang` (`id_presensi_pulang`, `gambar_pulang`, `tanggal_absensi_pulang`, `jam_absensi_pulang`, `id_pegawai`, `status_absensi_pulang`, `latitude`, `longitude`) VALUES
(1, 'absen_5_1716963913.jpg', '2024-05-29', '13:25:13', 5, 'pulang', '-3.407872', '104.251392'),
(2, 'absen_5_1717055246.jpg', '2024-05-30', '14:47:26', 5, 'pulang', '-5.3641216', '105.2409856');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil`
--

CREATE TABLE `profil` (
  `id_profil` int(20) NOT NULL,
  `nama_app` varchar(100) NOT NULL,
  `tahun` varchar(250) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `alias` varchar(350) NOT NULL,
  `alamat` text NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `akabest` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `profil`
--

INSERT INTO `profil` (`id_profil`, `nama_app`, `tahun`, `nama`, `alias`, `alamat`, `isi`, `gambar`, `akabest`) VALUES
(1, 'SIMPEG', '2022/2023', 'SISTEM INFORMASI PEGAWAI IBN', 'IBN LAMPUNG', 'JL Wismarini No 09 Pringsewu Lampung', '', '26122022051024.jpg', 'mardybest@gmail.com'),
(2, 're', '', 'MARDIYANTO', '19081989578978975', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` int(100) NOT NULL,
  `id_pegawai` int(100) NOT NULL,
  `jenis_riwayat` varchar(100) NOT NULL,
  `ket_riwayat` text NOT NULL,
  `lainya` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `riwayat`
--

INSERT INTO `riwayat` (`id_riwayat`, `id_pegawai`, `jenis_riwayat`, `ket_riwayat`, `lainya`) VALUES
(8, 0, 'pendidikan', 'kjkjkl', NULL),
(9, 0, 'pekerjaan', 'fdgdfg', NULL),
(14, 5, 'pendidikan', 'jhkh\r\n', NULL),
(15, 5, 'penghargaan', 'dapae ok', NULL),
(16, 5, 'pekerjaan', 'buruh pakrik 2023', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `uraiankerja`
--

CREATE TABLE `uraiankerja` (
  `id_uraiankerja` int(100) NOT NULL,
  `id_pegawai` int(100) NOT NULL,
  `tgl_uraiankerja` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ket_uraiankerja` text NOT NULL,
  `foto_uraiankerja` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_foto`) VALUES
(1, 'Adminatun Jhony', 'admin', '21232f297a57a5a743894a0e4a801fc3', '482937136_avatar.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cuti_pegawai`
--
ALTER TABLE `cuti_pegawai`
  ADD PRIMARY KEY (`id_cuti`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id_dokumen`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `keluarga`
--
ALTER TABLE `keluarga`
  ADD PRIMARY KEY (`id_keluarga`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`id_map`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `presensi_datang`
--
ALTER TABLE `presensi_datang`
  ADD PRIMARY KEY (`id_presensi_datang`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `presensi_pulang`
--
ALTER TABLE `presensi_pulang`
  ADD PRIMARY KEY (`id_presensi_pulang`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indeks untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `uraiankerja`
--
ALTER TABLE `uraiankerja`
  ADD PRIMARY KEY (`id_uraiankerja`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cuti_pegawai`
--
ALTER TABLE `cuti_pegawai`
  MODIFY `id_cuti` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id_dokumen` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `keluarga`
--
ALTER TABLE `keluarga`
  MODIFY `id_keluarga` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `map`
--
ALTER TABLE `map`
  MODIFY `id_map` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `presensi_datang`
--
ALTER TABLE `presensi_datang`
  MODIFY `id_presensi_datang` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `presensi_pulang`
--
ALTER TABLE `presensi_pulang`
  MODIFY `id_presensi_pulang` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `profil`
--
ALTER TABLE `profil`
  MODIFY `id_profil` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `uraiankerja`
--
ALTER TABLE `uraiankerja`
  MODIFY `id_uraiankerja` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
