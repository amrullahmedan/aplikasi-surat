-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 26, 2022 at 06:00 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `disposition`
--

CREATE TABLE `disposition` (
  `id` varchar(5) NOT NULL,
  `disposition_at` date NOT NULL,
  `reply_at` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `notification` varchar(255) NOT NULL,
  `mailid` varchar(5) NOT NULL,
  `userid` varchar(5) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'sudah'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disposition`
--

INSERT INTO `disposition` (`id`, `disposition_at`, `reply_at`, `description`, `notification`, `mailid`, `userid`, `status`) VALUES
('DS002', '2022-02-15', 'Kepala Sekolah', 'Oke  SMKN2 akan ikut', 'balas', 'SM003', 'US003', 'sudah'),
('DS003', '2022-02-16', 'Kepala Sekolah', 'okeeeee', 'balas', 'SM001', 'US003', 'sudah'),
('DS004', '2022-02-17', 'Kepala Sekolah', 'akan kami persipakan pak', 'balas', 'SM004', 'US003', 'sudah'),
('DS005', '2022-02-17', 'Kepala Sekolah', 'okelah', 'abaikan', 'SM005', 'US003', 'sudah'),
('DS006', '2022-02-19', 'Kepala Sekolah', 'Oke kami sambut pak kedatangannya', 'balas', 'SM013', 'US003', 'sudah'),
('DS007', '2022-02-20', 'Kepala Sekolah', 'siap teruss', 'abaikan', 'SM006', 'US003', 'sudah'),
('DS008', '2022-02-20', 'Kepala Sekolah', 'oke surat terima', 'balas', 'SM014', 'US003', 'sudah');

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `id` varchar(5) NOT NULL,
  `incoming_at` date NOT NULL,
  `mail_code` varchar(30) NOT NULL,
  `mail_date` date NOT NULL,
  `mail_from` varchar(70) NOT NULL,
  `mail_to` varchar(70) NOT NULL,
  `mail_subject` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `file_upload` varchar(255) NOT NULL,
  `mail_typeid` varchar(5) NOT NULL,
  `userid` varchar(5) NOT NULL,
  `disposisi` varchar(10) NOT NULL DEFAULT 'belum',
  `status` varchar(25) NOT NULL DEFAULT 'tidak'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id`, `incoming_at`, `mail_code`, `mail_date`, `mail_from`, `mail_to`, `mail_subject`, `description`, `file_upload`, `mail_typeid`, `userid`, `disposisi`, `status`) VALUES
('SM001', '2022-12-02', 'kec/btg/XII/01', '2022-12-01', 'kecamatan Bantar Gerbang', 'PT Pelindo', 'pembuatan  KTP', 'pembuatan KTP di SMK 2', 'BIODATA SISWA SMK NEGERI 2 Medan.docx', 'JS001', 'US002', 'sudah', 'arsip'),
('SM003', '2022-01-04', 'walkot/02/08/2022', '2022-01-03', 'Walikota Medan', 'PT Pelindo', 'Lomba Sekolah Bersih', 'Akan dilaksanakan Lomba Sekolah Bersih se Medan', 'FORM PENILAIAN.docx', 'JS002', 'US002', 'sudah', 'arsip'),
('SM004', '2022-01-18', 'srtpolsek/001/v01', '2022-01-16', 'Polsek Medan', 'PT Pelindo', 'Pembuatan SIM', 'Akan Dilaksanakan Pembuatan SIM Di Smkn2', 'Syarat dan Ketentuan Umum peserta.docx', 'JS004', 'US002', 'sudah', 'tidak'),
('SM005', '2022-01-27', 'sateki/02/2022', '2022-01-27', 'CV.Indo Sateki', 'BKK PT Pelindo', 'Penerimaan Siswa Prakerin', 'CV.indo sateki membutuhkan siswa magang di perusahaan', 'contoh soal A kelas XII.docx', 'JS005', 'US002', 'sudah', 'arsip'),
('SM006', '2022-02-05', 'nf/02/004/2022', '2022-02-04', 'PT.Nutrifood', 'BKK SMKN 2 Kota Medan', 'recruitment Pegawai', 'pt.nutrifood akan datang melakukan recruitment bagi siswa smkn2', 'contoh soal B kelas XII.docx', 'JS004', 'US002', 'sudah', 'tidak'),
('SM008', '2022-02-09', 'unj/01/002', '2022-02-09', 'Universitas Negeri Jakarta', 'PT Pelindo', 'beasiswa kuliah', 'beasiswa kuliah untuk murid smk 2 Medan', 'bab 2 a.docx', 'JS005', 'US002', 'belum', 'tidak'),
('SM009', '2022-01-10', 'SMK5/VI/2022', '2022-01-08', 'smkn 5 Medan', 'PT Pelindo', 'Lomba', 'Akan Ada Lomba Di SMK 5', 'bangunlah dunia.jpg', 'JS003', 'US002', 'belum', 'tidak'),
('SM010', '2022-01-29', 'Digbud/02/2022', '2022-01-28', 'Kemendigbud', 'PT Pelindo', 'sosialisasi', 'akan diadakan sosialisasi di smk 2', '15 - 1.jpg', 'JS005', 'US002', 'belum', 'tidak'),
('SM011', '2022-02-15', 'surat/24/01/2022', '2022-02-14', 'Pak hanuji', 'PT Pelindo', 'minta cuti', 'minta cuti 2  hari', 'fais.jpg', 'JS004', 'US002', 'belum', 'tidak'),
('SM012', '2022-02-17', 'kmp/05/17/2022', '2022-02-16', 'Kemenpora', 'PT Pelindo', 'PON Jabar', 'Smkn 2 Diundang untuk mengikuti Pon', 'FAS1 sementara2.jpg', 'JS003', 'US002', 'belum', 'tidak'),
('SM013', '2022-02-19', 'walkot/19/02', '2022-02-18', 'Walikota Medan', 'PT Pelindo', 'kunjungan dinas', 'walkot dan jajaranya akan berkunjung ke smk2', 'Makalah.doc', 'JS001', 'US004', 'sudah', 'arsip'),
('SM014', '2022-02-06', '423.6/048/smkn2/.2-BP3', '2022-02-06', 'PT. ASA', 'PT Pelindo', 'Acc assesor', 'accecor dari PT.asa bersedia', 'cover.doc', 'JS005', 'US002', 'sudah', 'tidak');

-- --------------------------------------------------------

--
-- Table structure for table `mail_out`
--

CREATE TABLE `mail_out` (
  `id` varchar(5) NOT NULL,
  `mail_code` varchar(75) NOT NULL,
  `mail_date` date NOT NULL,
  `mail_to` varchar(75) NOT NULL,
  `mail_subject` varchar(75) NOT NULL,
  `description` varchar(255) NOT NULL,
  `file_upload` varchar(255) NOT NULL,
  `mail_typeid` varchar(5) NOT NULL,
  `userid` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail_out`
--

INSERT INTO `mail_out` (`id`, `mail_code`, `mail_date`, `mail_to`, `mail_subject`, `description`, `file_upload`, `mail_typeid`, `userid`) VALUES
('SK001', 'surat/30/01/2022', '2022-12-26', 'smkn 1 Medan', 'sparing futsal', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit', 'PPK - BAB 1.docx', 'JS003', 'US002'),
('SK002', 'SMKN215/02/2022', '2022-12-26', 'Walikota Medan', 'Surat Balasan', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit', 'Tidak Ada', 'JS004', 'US003'),
('SK003', 'SMKN215/02/2022', '2022-02-15', 'kecamatan Bantar Gerbang', 'Surat Balasan', 'okeeeee', 'Tidak Ada', 'JS001', 'US003'),
('SK004', 'smk2/17/2022', '2022-02-17', 'kelurahan Bantar gerbang', 'KTP pelajar smkn2', 'menanyakan lama jadinya KTP', 'Karakteristik (PLH).doc', 'JS005', 'US002'),
('SK005', 'SMKN217/02/2022', '2022-02-17', 'Polsek Medan', 'Surat Balasan', 'akan kami persipakan pak', 'Tidak Ada', 'JS005', 'US003'),
('SK006', 'SMKN219/02/2022', '2022-02-19', 'Walikota Medan', 'Surat Balasan', 'Oke kami sambut pak kedatangannya', 'Tidak Ada', 'JS005', 'US003'),
('SK007', 'SMKN220/02/2022', '2022-02-20', 'PT. ASA', 'Surat Balasan', 'oke surat terima', 'Tidak Ada', 'JS005', 'US003');

-- --------------------------------------------------------

--
-- Table structure for table `mail_type`
--

CREATE TABLE `mail_type` (
  `id` varchar(5) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail_type`
--

INSERT INTO `mail_type` (`id`, `type`) VALUES
('JS001', 'Dinas'),
('JS002', 'Tugas'),
('JS003', 'Undangan'),
('JS004', 'Permohonan'),
('JS005', 'Resmi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `fullname`, `level`, `jabatan`, `picture`) VALUES
('US001', 'admin', '123456', 'Amrullah', 'admin', 'Programmer IT', 'unggul-removebg.png'),
('US002', 'jidan', '123456', 'Jidan ente kadang-kadang', 'operator', 'Staff TU', 'jdn.PNG'),
('US003', 'admin2', '123456', 'admin ke-2', 'pimpinan', 'Kepala Sekolah', 'tukul.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposition`
--
ALTER TABLE `disposition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_out`
--
ALTER TABLE `mail_out`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_type`
--
ALTER TABLE `mail_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
