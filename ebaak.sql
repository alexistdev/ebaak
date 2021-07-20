-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2021 at 01:04 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebaak`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `status`) VALUES
(1, 'admin', '$2y$10$zzbRx9kd/fgyr2YSmeSDKut49PiUvPOB4brdFKc5/K.RIPOeraJHS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_user`
--

CREATE TABLE `detail_user` (
  `id_detail` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_user`
--

INSERT INTO `detail_user` (`id_detail`, `id_user`, `id_jurusan`, `nama`, `email`) VALUES
(13, 15, NULL, 'Denny Prastiawan', 'denny@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `kode_jurusan` varchar(30) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_surat`
--

CREATE TABLE `riwayat_surat` (
  `id_riwayat` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_surat` varchar(128) DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `kode_surat` varchar(128) DEFAULT NULL,
  `status_riwayat` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `surat_aktif`
--

CREATE TABLE `surat_aktif` (
  `id_surataktif` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `alasan_aktif` varchar(128) NOT NULL,
  `kode_surat` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `surat_cuti`
--

CREATE TABLE `surat_cuti` (
  `id_suratcuti` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tahun_akademik` varchar(30) NOT NULL,
  `alasan_cuti` varchar(128) NOT NULL,
  `kode_surat` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan`
--

CREATE TABLE `surat_keterangan` (
  `id_suratketerangan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nik_ortu` varchar(50) NOT NULL,
  `nama_ortu` varchar(120) NOT NULL,
  `pekerjaan_ortu` varchar(120) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal` date NOT NULL,
  `keperluan` varchar(200) NOT NULL,
  `lampiran` varchar(100) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `kode_surat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `surat_kp`
--

CREATE TABLE `surat_kp` (
  `id_suratkp` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_instansi` varchar(128) NOT NULL,
  `ditujukan` varchar(128) NOT NULL,
  `alamat_instansi` text NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `keterangan` varchar(128) NOT NULL,
  `lampiran` varchar(128) NOT NULL,
  `kode_surat` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `surat_penelitian`
--

CREATE TABLE `surat_penelitian` (
  `id_penelitian` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ditujukan` varchar(128) NOT NULL,
  `nama_instansi` varchar(128) NOT NULL,
  `alamat_instansi` varchar(200) NOT NULL,
  `judul_penelitian` varchar(128) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `lampiran` varchar(100) DEFAULT NULL,
  `kode_surat` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `surat_pindah_kelas`
--

CREATE TABLE `surat_pindah_kelas` (
  `id_suratpindah` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kelas_sebelum` varchar(128) NOT NULL,
  `alasan_pindah` text NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `kode_surat` varchar(128) DEFAULT NULL,
  `lampiran` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `surat_pindah_prodi`
--

CREATE TABLE `surat_pindah_prodi` (
  `id_pindahprodi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_prodi` varchar(128) NOT NULL,
  `alasan_pindah` text NOT NULL,
  `kode_surat` varchar(128) DEFAULT NULL,
  `lampiran` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `surat_sidang`
--

CREATE TABLE `surat_sidang` (
  `id_suratsidang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `pembimbing` varchar(128) NOT NULL,
  `penguji1` varchar(128) NOT NULL,
  `penguji2` varchar(128) NOT NULL,
  `nidn_pembimbing` varchar(100) NOT NULL,
  `nomor_sk` varchar(100) NOT NULL,
  `tanggal_sk` date NOT NULL,
  `tanggal_acc` date NOT NULL,
  `jumlah_bimbingan` int(11) NOT NULL,
  `kode_surat` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `surat_tanda_lulus`
--

CREATE TABLE `surat_tanda_lulus` (
  `id_suratlulus` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `kode_surat` varchar(128) DEFAULT NULL,
  `lampiran` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `npm` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `npm`, `password`, `token`, `status`) VALUES
(15, '1711010006', 'd033e22ae348aeb5660fc2140aec35850c4da997', '0wcAK', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `detail_user`
--
ALTER TABLE `detail_user`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `riwayat_surat`
--
ALTER TABLE `riwayat_surat`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `riwayat_surat_user_id_user_fk` (`id_user`);

--
-- Indexes for table `surat_aktif`
--
ALTER TABLE `surat_aktif`
  ADD PRIMARY KEY (`id_surataktif`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `surat_cuti`
--
ALTER TABLE `surat_cuti`
  ADD PRIMARY KEY (`id_suratcuti`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `surat_keterangan`
--
ALTER TABLE `surat_keterangan`
  ADD PRIMARY KEY (`id_suratketerangan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `surat_kp`
--
ALTER TABLE `surat_kp`
  ADD PRIMARY KEY (`id_suratkp`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `surat_penelitian`
--
ALTER TABLE `surat_penelitian`
  ADD PRIMARY KEY (`id_penelitian`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `surat_pindah_kelas`
--
ALTER TABLE `surat_pindah_kelas`
  ADD PRIMARY KEY (`id_suratpindah`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `surat_pindah_prodi`
--
ALTER TABLE `surat_pindah_prodi`
  ADD PRIMARY KEY (`id_pindahprodi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `surat_sidang`
--
ALTER TABLE `surat_sidang`
  ADD PRIMARY KEY (`id_suratsidang`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `surat_tanda_lulus`
--
ALTER TABLE `surat_tanda_lulus`
  ADD PRIMARY KEY (`id_suratlulus`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_user`
--
ALTER TABLE `detail_user`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `riwayat_surat`
--
ALTER TABLE `riwayat_surat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `surat_aktif`
--
ALTER TABLE `surat_aktif`
  MODIFY `id_surataktif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `surat_cuti`
--
ALTER TABLE `surat_cuti`
  MODIFY `id_suratcuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `surat_keterangan`
--
ALTER TABLE `surat_keterangan`
  MODIFY `id_suratketerangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `surat_kp`
--
ALTER TABLE `surat_kp`
  MODIFY `id_suratkp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `surat_penelitian`
--
ALTER TABLE `surat_penelitian`
  MODIFY `id_penelitian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `surat_pindah_kelas`
--
ALTER TABLE `surat_pindah_kelas`
  MODIFY `id_suratpindah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `surat_pindah_prodi`
--
ALTER TABLE `surat_pindah_prodi`
  MODIFY `id_pindahprodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surat_sidang`
--
ALTER TABLE `surat_sidang`
  MODIFY `id_suratsidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `surat_tanda_lulus`
--
ALTER TABLE `surat_tanda_lulus`
  MODIFY `id_suratlulus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_user`
--
ALTER TABLE `detail_user`
  ADD CONSTRAINT `detail_user_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `detail_user_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `riwayat_surat`
--
ALTER TABLE `riwayat_surat`
  ADD CONSTRAINT `riwayat_surat_user_id_user_fk` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `surat_aktif`
--
ALTER TABLE `surat_aktif`
  ADD CONSTRAINT `surat_aktif_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `surat_cuti`
--
ALTER TABLE `surat_cuti`
  ADD CONSTRAINT `surat_cuti_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `surat_keterangan`
--
ALTER TABLE `surat_keterangan`
  ADD CONSTRAINT `surat_keterangan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `surat_kp`
--
ALTER TABLE `surat_kp`
  ADD CONSTRAINT `surat_kp_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `surat_penelitian`
--
ALTER TABLE `surat_penelitian`
  ADD CONSTRAINT `surat_penelitian_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `surat_pindah_kelas`
--
ALTER TABLE `surat_pindah_kelas`
  ADD CONSTRAINT `surat_pindah_kelas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `surat_pindah_prodi`
--
ALTER TABLE `surat_pindah_prodi`
  ADD CONSTRAINT `surat_pindah_prodi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `surat_sidang`
--
ALTER TABLE `surat_sidang`
  ADD CONSTRAINT `surat_sidang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `surat_tanda_lulus`
--
ALTER TABLE `surat_tanda_lulus`
  ADD CONSTRAINT `surat_tanda_lulus_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
