/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 5.6.21 : Database - cis_production
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/*Table structure for table `absn_absensi` */

DROP TABLE IF EXISTS `absn_absensi`;

CREATE TABLE `absn_absensi` (
  `absensi_id` int(11) NOT NULL AUTO_INCREMENT,
  `sesi_kuliah_id` int(11) NOT NULL,
  `dim_id` int(11) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`absensi_id`),
  KEY `FK_absn_absensi_sesi_kuliah_idx` (`sesi_kuliah_id`),
  KEY `FK_absn_absensi_dim` (`dim_id`),
  CONSTRAINT `FK_absn_absensi_dim` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_absn_absensi_sesi_kuliah` FOREIGN KEY (`sesi_kuliah_id`) REFERENCES `absn_sesi_kuliah` (`sesi_kuliah_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=153180 DEFAULT CHARSET=latin1;

/*Table structure for table `absn_kelas_absensi` */

DROP TABLE IF EXISTS `absn_kelas_absensi`;

CREATE TABLE `absn_kelas_absensi` (
  `kelas_absensi_id` int(11) NOT NULL AUTO_INCREMENT,
  `penugasan_pengajaran_id` int(11) NOT NULL,
  `dim_id` int(11) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kelas_absensi_id`),
  KEY `fk_absn_kelas_absensi_penugasan_pengajaran` (`penugasan_pengajaran_id`),
  KEY `fk_absn_kelas_absensi_dim` (`dim_id`),
  CONSTRAINT `fk_absn_kelas_absensi_dim` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_absn_kelas_absensi_penugasan_pengajaran` FOREIGN KEY (`penugasan_pengajaran_id`) REFERENCES `adak_penugasan_pengajaran` (`penugasan_pengajaran_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31218 DEFAULT CHARSET=latin1;

/*Table structure for table `absn_sesi_kuliah` */

DROP TABLE IF EXISTS `absn_sesi_kuliah`;

CREATE TABLE `absn_sesi_kuliah` (
  `sesi_kuliah_id` int(11) NOT NULL AUTO_INCREMENT,
  `penugasan_pengajaran_id` int(11) NOT NULL,
  `lokasi_id` int(11) NOT NULL,
  `sesi` char(1) NOT NULL,
  `jenis` tinyint(1) DEFAULT '0',
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_akhir` datetime DEFAULT NULL,
  `catatan` text,
  `jumlah_dim_krs` int(5) DEFAULT '0',
  `jumlah_dim_hadir` int(5) DEFAULT '0',
  `periode` tinyint(1) DEFAULT '1',
  `penutup_periode` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`sesi_kuliah_id`),
  KEY `FK_absn_sesi_kuliah_lokasi_idx` (`lokasi_id`),
  KEY `FK_absn_sesi_kuliah_penugasan_pengajaran` (`penugasan_pengajaran_id`),
  KEY `fk_absn_sesi_kuliah` (`penutup_periode`),
  CONSTRAINT `FK_absn_sesi_kuliah_lokasi` FOREIGN KEY (`lokasi_id`) REFERENCES `mref_r_lokasi` (`lokasi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_absn_sesi_kuliah_penugasan_pengajaran` FOREIGN KEY (`penugasan_pengajaran_id`) REFERENCES `adak_penugasan_pengajaran` (`penugasan_pengajaran_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_absn_sesi_kuliah` FOREIGN KEY (`penutup_periode`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3525 DEFAULT CHARSET=latin1;

/*Table structure for table `adak_kelas` */

DROP TABLE IF EXISTS `adak_kelas`;

CREATE TABLE `adak_kelas` (
  `kelas_id` int(11) NOT NULL AUTO_INCREMENT,
  `ta` int(4) NOT NULL DEFAULT '0',
  `nama` varchar(20) NOT NULL DEFAULT '',
  `ket` text,
  `dosen_wali_id` int(11) DEFAULT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kelas_id`),
  KEY `FK_adak_kelas_wali` (`dosen_wali_id`),
  KEY `gk_adak_kelas_inst_prodi` (`prodi_id`),
  CONSTRAINT `FK_adak_kelas_wali` FOREIGN KEY (`dosen_wali_id`) REFERENCES `hrdx_dosen` (`dosen_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `gk_adak_kelas_inst_prodi` FOREIGN KEY (`prodi_id`) REFERENCES `inst_prodi` (`ref_kbk_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=latin1;

/*Table structure for table `adak_mahasiswa_assistant` */

DROP TABLE IF EXISTS `adak_mahasiswa_assistant`;

CREATE TABLE `adak_mahasiswa_assistant` (
  `mahasiswa_assistant_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengajaran_id` int(11) DEFAULT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `is_fulltime` tinyint(1) DEFAULT '1',
  `start_date` date DEFAULT '0000-00-00',
  `end_date` date DEFAULT '0000-00-00',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`mahasiswa_assistant_id`),
  KEY `FK_adak_mahasiswa_assistant_pengajaran` (`pengajaran_id`),
  KEY `FK_adak_mahasiswa_assistant_dim` (`dim_id`),
  CONSTRAINT `FK_adak_mahasiswa_assistant_dim` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_adak_mahasiswa_assistant_pengajaran` FOREIGN KEY (`pengajaran_id`) REFERENCES `adak_pengajaran` (`pengajaran_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `adak_pengajaran` */

DROP TABLE IF EXISTS `adak_pengajaran`;

CREATE TABLE `adak_pengajaran` (
  `pengajaran_id` int(11) NOT NULL AUTO_INCREMENT,
  `kuliah_id` int(11) DEFAULT NULL,
  `ta` int(11) DEFAULT NULL,
  `sem_ta` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pengajaran_id`),
  KEY `FK_adak_pengajaran_kuliah` (`kuliah_id`),
  CONSTRAINT `FK_adak_pengajaran_kuliah` FOREIGN KEY (`kuliah_id`) REFERENCES `krkm_kuliah` (`kuliah_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1363 DEFAULT CHARSET=latin1;

/*Table structure for table `adak_penugasan_pengajaran` */

DROP TABLE IF EXISTS `adak_penugasan_pengajaran`;

CREATE TABLE `adak_penugasan_pengajaran` (
  `penugasan_pengajaran_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengajaran_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `role_pengajar_id` int(11) NOT NULL,
  `is_fulltime` tinyint(1) DEFAULT '1',
  `start_date` date DEFAULT '0000-00-00',
  `end_date` date DEFAULT '0000-00-00',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`penugasan_pengajaran_id`),
  KEY `FK_prkl_pengajaran_role_pengajar` (`role_pengajar_id`),
  KEY `FK_adak_penugasan_pengajaran_pegawai` (`pegawai_id`),
  KEY `FK_adak_penugasan_pengajaran` (`pengajaran_id`),
  CONSTRAINT `FK_adak_penugasan_pengajaran` FOREIGN KEY (`pengajaran_id`) REFERENCES `adak_pengajaran` (`pengajaran_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_adak_penugasan_pengajaran_pegawai` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_prkl_pengajaran_role_pengajar` FOREIGN KEY (`role_pengajar_id`) REFERENCES `mref_r_role_pengajar` (`role_pengajar_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2724 DEFAULT CHARSET=latin1;

/*Table structure for table `adak_registrasi` */

DROP TABLE IF EXISTS `adak_registrasi`;

CREATE TABLE `adak_registrasi` (
  `registrasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(8) NOT NULL DEFAULT '',
  `status_akhir_registrasi` varchar(50) DEFAULT 'Aktif',
  `ta` varchar(30) NOT NULL DEFAULT '0',
  `sem_ta` int(11) NOT NULL DEFAULT '0',
  `sem` smallint(6) NOT NULL DEFAULT '0',
  `tgl_daftar` date DEFAULT NULL,
  `keuangan` double DEFAULT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `id` varchar(20) DEFAULT NULL,
  `nr` float DEFAULT NULL,
  `koa_approval` int(11) NOT NULL DEFAULT '0',
  `koa_approval_bp` int(11) NOT NULL DEFAULT '0',
  `kelas_id` int(11) DEFAULT NULL,
  `dosen_wali_id` int(11) DEFAULT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`registrasi_id`),
  KEY `fk_t_registrasi_t_kelas1_idx` (`kelas_id`),
  KEY `fk_t_registrasi_t_profile1_idx` (`dosen_wali_id`),
  KEY `fk_t_registrasi_t_dim1_idx` (`dim_id`),
  CONSTRAINT `FK_adak_registrasi_dosen_wali` FOREIGN KEY (`dosen_wali_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_prkl_registrasi_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `adak_kelas` (`kelas_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_t_registrasi_t_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18174 DEFAULT CHARSET=latin1;

/*Table structure for table `arsp_arsip` */

DROP TABLE IF EXISTS `arsp_arsip`;

CREATE TABLE `arsp_arsip` (
  `arsip_id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) DEFAULT NULL,
  `desc` text,
  `user_id` int(11) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`arsip_id`),
  KEY `FK_arsip_user` (`user_id`),
  CONSTRAINT `FK_arsip_user` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `arsp_arsip_file` */

DROP TABLE IF EXISTS `arsp_arsip_file`;

CREATE TABLE `arsp_arsip_file` (
  `arsip_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_file` varchar(100) DEFAULT NULL,
  `kode_file` varchar(50) DEFAULT NULL,
  `desc` text,
  `arsip_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`arsip_file_id`),
  KEY `FK_arsip_file` (`arsip_id`),
  CONSTRAINT `FK_arsip_file` FOREIGN KEY (`arsip_id`) REFERENCES `arsp_arsip` (`arsip_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `artk_post` */

DROP TABLE IF EXISTS `artk_post`;

CREATE TABLE `artk_post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `body` text,
  `user_id` int(11) DEFAULT NULL,
  `category` varchar(150) DEFAULT NULL,
  `in_category` varchar(50) DEFAULT 'home',
  `public_status` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `FK_artk_post_user` (`user_id`),
  CONSTRAINT `FK_artk_post_user` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Table structure for table `artk_post_attachment` */

DROP TABLE IF EXISTS `artk_post_attachment`;

CREATE TABLE `artk_post_attachment` (
  `post_attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `id_file` varchar(100) DEFAULT NULL,
  `nama_file` varchar(150) DEFAULT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`post_attachment_id`),
  KEY `FK_artk_post_attachment` (`post_id`),
  CONSTRAINT `FK_artk_post_attachment` FOREIGN KEY (`post_id`) REFERENCES `artk_post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Table structure for table `askm_asrama` */

DROP TABLE IF EXISTS `askm_asrama`;

CREATE TABLE `askm_asrama` (
  `asrama_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `lokasi` varchar(45) NOT NULL,
  `desc` text,
  `kapasitas` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`asrama_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Table structure for table `askm_bentuk_pelanggaran` */

DROP TABLE IF EXISTS `askm_bentuk_pelanggaran`;

CREATE TABLE `askm_bentuk_pelanggaran` (
  `bentuk_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`bentuk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Table structure for table `askm_dim_kamar` */

DROP TABLE IF EXISTS `askm_dim_kamar`;

CREATE TABLE `askm_dim_kamar` (
  `dim_kamar_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_dim_kamar` tinyint(1) DEFAULT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `kamar_id` int(11) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`dim_kamar_id`),
  KEY `askm_dim_kamar_ibfk_2` (`kamar_id`),
  KEY `askm_dim_kamar_ibfk_3` (`dim_id`),
  CONSTRAINT `askm_dim_kamar_ibfk_2` FOREIGN KEY (`kamar_id`) REFERENCES `askm_kamar` (`kamar_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `askm_dim_kamar_ibfk_3` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48193 DEFAULT CHARSET=latin1;

/*Table structure for table `askm_dim_pelanggaran` */

DROP TABLE IF EXISTS `askm_dim_pelanggaran`;

CREATE TABLE `askm_dim_pelanggaran` (
  `pelanggaran_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_pelanggaran` tinyint(1) DEFAULT '0',
  `pembinaan_id` int(11) NOT NULL,
  `penilaian_id` int(11) NOT NULL,
  `poin_id` int(11) NOT NULL,
  `desc_pembinaan` text,
  `desc_pelanggaran` text,
  `tanggal` date NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`pelanggaran_id`),
  KEY `pembinaan_id` (`pembinaan_id`),
  KEY `penilaian_id` (`penilaian_id`),
  KEY `poin_id` (`poin_id`),
  CONSTRAINT `askm_dim_pelanggaran_ibfk_1` FOREIGN KEY (`pembinaan_id`) REFERENCES `askm_pembinaan` (`pembinaan_id`),
  CONSTRAINT `askm_dim_pelanggaran_ibfk_2` FOREIGN KEY (`penilaian_id`) REFERENCES `askm_dim_penilaian` (`penilaian_id`),
  CONSTRAINT `askm_dim_pelanggaran_ibfk_3` FOREIGN KEY (`poin_id`) REFERENCES `askm_poin_pelanggaran` (`poin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2773 DEFAULT CHARSET=latin1;

/*Table structure for table `askm_dim_penilaian` */

DROP TABLE IF EXISTS `askm_dim_penilaian`;

CREATE TABLE `askm_dim_penilaian` (
  `penilaian_id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` text,
  `ta` int(4) DEFAULT NULL,
  `sem_ta` int(1) DEFAULT NULL,
  `akumulasi_skor` int(11) DEFAULT '0',
  `dim_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`penilaian_id`),
  KEY `dim_id` (`dim_id`),
  CONSTRAINT `askm_dim_penilaian_ibfk_1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9614 DEFAULT CHARSET=latin1;

/*Table structure for table `askm_izin_bermalam` */

DROP TABLE IF EXISTS `askm_izin_bermalam`;

CREATE TABLE `askm_izin_bermalam` (
  `izin_bermalam_id` int(11) NOT NULL AUTO_INCREMENT,
  `rencana_berangkat` datetime NOT NULL,
  `rencana_kembali` datetime NOT NULL,
  `realisasi_berangkat` datetime DEFAULT NULL,
  `realisasi_kembali` datetime DEFAULT NULL,
  `desc` text NOT NULL,
  `tujuan` varchar(45) NOT NULL,
  `dim_id` int(11) NOT NULL,
  `keasramaan_id` int(11) DEFAULT NULL,
  `status_request_id` int(11) DEFAULT '1',
  `lokasi_log_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`izin_bermalam_id`),
  KEY `fk_askm_izin_bermalam_dimx_dim1_idx` (`dim_id`),
  KEY `fk_askm_izin_bermalam_askm_keasramaan1_idx` (`keasramaan_id`),
  KEY `fk_askm_izin_bermalam_askm_r_status_request1_idx` (`status_request_id`),
  KEY `fk_askm_izin_bermalam_lokasi_log` (`lokasi_log_id`),
  CONSTRAINT `askm_izin_bermalam_ibfk_1` FOREIGN KEY (`keasramaan_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_askm_izin_bermalam_askm_r_status_request1` FOREIGN KEY (`status_request_id`) REFERENCES `askm_r_status_request` (`status_request_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_askm_izin_bermalam_dimx_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_askm_izin_bermalam_lokasi_log` FOREIGN KEY (`lokasi_log_id`) REFERENCES `ubux_r_lokasi_log` (`lokasi_log_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11192 DEFAULT CHARSET=latin1;

/*Table structure for table `askm_izin_keluar` */

DROP TABLE IF EXISTS `askm_izin_keluar`;

CREATE TABLE `askm_izin_keluar` (
  `izin_keluar_id` int(11) NOT NULL AUTO_INCREMENT,
  `rencana_berangkat` datetime NOT NULL,
  `rencana_kembali` datetime NOT NULL,
  `realisasi_berangkat` datetime DEFAULT NULL,
  `realisasi_kembali` datetime DEFAULT NULL,
  `desc` text NOT NULL,
  `dim_id` int(11) NOT NULL,
  `dosen_wali_id` int(11) DEFAULT NULL,
  `baak_id` int(11) DEFAULT NULL,
  `keasramaan_id` int(11) DEFAULT NULL,
  `status_request_baak` int(11) DEFAULT '1',
  `status_request_keasramaan` int(11) DEFAULT '1',
  `status_request_dosen_wali` int(11) DEFAULT '1',
  `lokasi_log_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`izin_keluar_id`),
  KEY `fk_askm_izin_keluar_dimx_dim1_idx` (`dim_id`),
  KEY `fk_askm_izin_keluar_hrdx_dosen1_idx` (`dosen_wali_id`),
  KEY `fk_askm_izin_keluar_hrdx_staf1_idx` (`baak_id`),
  KEY `fk_askm_izin_keluar_askm_r_status_request1_idx` (`status_request_dosen_wali`),
  KEY `fk_askm_izin_keluar_askm_keasramaan1_idx` (`keasramaan_id`),
  KEY `status_request_keasramaan` (`status_request_keasramaan`),
  KEY `status_request_baak` (`status_request_baak`),
  KEY `fk_askm_izin_keluar_lokasi_log` (`lokasi_log_id`),
  CONSTRAINT `askm_izin_keluar_ibfk_1` FOREIGN KEY (`status_request_keasramaan`) REFERENCES `askm_r_status_request` (`status_request_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `askm_izin_keluar_ibfk_2` FOREIGN KEY (`status_request_baak`) REFERENCES `askm_r_status_request` (`status_request_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `askm_izin_keluar_ibfk_3` FOREIGN KEY (`dosen_wali_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `askm_izin_keluar_ibfk_4` FOREIGN KEY (`keasramaan_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `askm_izin_keluar_ibfk_5` FOREIGN KEY (`baak_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_askm_izin_keluar_askm_r_status_request1` FOREIGN KEY (`status_request_dosen_wali`) REFERENCES `askm_r_status_request` (`status_request_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_askm_izin_keluar_dimx_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_askm_izin_keluar_lokasi_log` FOREIGN KEY (`lokasi_log_id`) REFERENCES `ubux_r_lokasi_log` (`lokasi_log_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2151 DEFAULT CHARSET=latin1;

/*Table structure for table `askm_izin_kolaboratif` */

DROP TABLE IF EXISTS `askm_izin_kolaboratif`;

CREATE TABLE `askm_izin_kolaboratif` (
  `izin_kolaboratif_id` int(11) NOT NULL AUTO_INCREMENT,
  `rencana_mulai` date NOT NULL,
  `rencana_berakhir` date NOT NULL,
  `batas_waktu` time NOT NULL,
  `desc` text NOT NULL,
  `dim_id` int(11) NOT NULL,
  `status_request_id` int(11) DEFAULT '1',
  `baak_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`izin_kolaboratif_id`),
  KEY `fk_askm_izin_tambahan_jam_kolaboratif_dimx_dim1_idx` (`dim_id`),
  KEY `fk_askm_izin_tambahan_jam_kolaboratif_askm_r_status_request_idx` (`status_request_id`),
  KEY `fk_askm_izin_tambahan_jam_kolaboratif_hrdx_staf1_idx` (`baak_id`),
  CONSTRAINT `askm_izin_kolaboratif_ibfk_1` FOREIGN KEY (`baak_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_askm_izin_tambahan_jam_kolaboratif_askm_r_status_request1` FOREIGN KEY (`status_request_id`) REFERENCES `askm_r_status_request` (`status_request_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_askm_izin_tambahan_jam_kolaboratif_dimx_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

/*Table structure for table `askm_izin_ruangan` */

DROP TABLE IF EXISTS `askm_izin_ruangan`;

CREATE TABLE `askm_izin_ruangan` (
  `izin_ruangan_id` int(11) NOT NULL AUTO_INCREMENT,
  `rencana_mulai` datetime NOT NULL,
  `rencana_berakhir` datetime NOT NULL,
  `desc` text NOT NULL,
  `dim_id` int(11) NOT NULL,
  `baak_id` int(11) DEFAULT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `status_request_id` int(11) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`izin_ruangan_id`),
  KEY `fk_askm_izin_penggunaan_ruangan_dimx_dim1_idx` (`dim_id`),
  KEY `fk_askm_izin_penggunaan_ruangan_hrdx_staf1_idx` (`baak_id`),
  KEY `fk_askm_izin_penggunaan_ruangan_askm_r_status_request1_idx` (`status_request_id`),
  KEY `lokasi_id` (`lokasi_id`),
  CONSTRAINT `askm_izin_ruangan_ibfk_1` FOREIGN KEY (`lokasi_id`) REFERENCES `mref_r_lokasi` (`lokasi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `askm_izin_ruangan_ibfk_2` FOREIGN KEY (`baak_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_askm_izin_penggunaan_ruangan_askm_r_status_request1` FOREIGN KEY (`status_request_id`) REFERENCES `askm_r_status_request` (`status_request_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_askm_izin_penggunaan_ruangan_dimx_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

/*Table structure for table `askm_kamar` */

DROP TABLE IF EXISTS `askm_kamar`;

CREATE TABLE `askm_kamar` (
  `kamar_id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_kamar` varchar(45) DEFAULT NULL,
  `asrama_id` int(11) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kamar_id`),
  KEY `fk_askm_kamar_askm_asrama1_idx` (`asrama_id`),
  CONSTRAINT `fk_askm_kamar_askm_asrama1` FOREIGN KEY (`asrama_id`) REFERENCES `askm_asrama` (`asrama_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8531 DEFAULT CHARSET=latin1;

/*Table structure for table `askm_keasramaan` */

DROP TABLE IF EXISTS `askm_keasramaan`;

CREATE TABLE `askm_keasramaan` (
  `keasramaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `asrama_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `no_hp` varchar(32) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`keasramaan_id`),
  KEY `fk_askm_keasramaan_hrdx_pegawai1_idx` (`pegawai_id`),
  KEY `askm_keasramaan_pegawai_ibfk_2` (`asrama_id`),
  CONSTRAINT `askm_keasramaan_ibfk_1` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `askm_keasramaan_ibfk_2` FOREIGN KEY (`asrama_id`) REFERENCES `askm_asrama` (`asrama_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

/*Table structure for table `askm_log_mahasiswa` */

DROP TABLE IF EXISTS `askm_log_mahasiswa`;

CREATE TABLE `askm_log_mahasiswa` (
  `log_mahasiswa_id` int(11) NOT NULL AUTO_INCREMENT,
  `dim_id` int(11) NOT NULL,
  `tanggal_keluar` datetime DEFAULT NULL,
  `tanggal_masuk` datetime DEFAULT NULL,
  `lokasi_log_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`log_mahasiswa_id`),
  KEY `fk_dim_log_mahasiswa` (`dim_id`),
  KEY `fk_lokasi_log_log_mahasiswa` (`lokasi_log_id`),
  CONSTRAINT `fk_dim_log_mahasiswa` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_lokasi_log_log_mahasiswa` FOREIGN KEY (`lokasi_log_id`) REFERENCES `ubux_r_lokasi_log` (`lokasi_log_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=173428 DEFAULT CHARSET=latin1;

/*Table structure for table `askm_pedoman` */

DROP TABLE IF EXISTS `askm_pedoman`;

CREATE TABLE `askm_pedoman` (
  `pedoman_id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) DEFAULT NULL,
  `isi` longtext,
  `jenis_izin` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`pedoman_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `askm_pembinaan` */

DROP TABLE IF EXISTS `askm_pembinaan`;

CREATE TABLE `askm_pembinaan` (
  `pembinaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`pembinaan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Table structure for table `askm_poin_kebaikan` */

DROP TABLE IF EXISTS `askm_poin_kebaikan`;

CREATE TABLE `askm_poin_kebaikan` (
  `kebaikan_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `desc` longtext,
  `penilaian_id` int(11) DEFAULT NULL,
  `pelanggaran_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kebaikan_id`),
  KEY `pelanggaran_id` (`pelanggaran_id`),
  KEY `penilaian_id` (`penilaian_id`),
  CONSTRAINT `askm_poin_kebaikan_ibfk_1` FOREIGN KEY (`pelanggaran_id`) REFERENCES `askm_dim_pelanggaran` (`pelanggaran_id`),
  CONSTRAINT `askm_poin_kebaikan_ibfk_2` FOREIGN KEY (`penilaian_id`) REFERENCES `askm_dim_penilaian` (`penilaian_id`)
) ENGINE=InnoDB AUTO_INCREMENT=318 DEFAULT CHARSET=latin1;

/*Table structure for table `askm_poin_pelanggaran` */

DROP TABLE IF EXISTS `askm_poin_pelanggaran`;

CREATE TABLE `askm_poin_pelanggaran` (
  `poin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `poin` int(11) DEFAULT NULL,
  `desc` text,
  `bentuk_id` int(11) DEFAULT NULL,
  `tingkat_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`poin_id`),
  KEY `tingkat_id` (`tingkat_id`),
  KEY `bentuk_id` (`bentuk_id`),
  CONSTRAINT `askm_poin_pelanggaran_ibfk_1` FOREIGN KEY (`tingkat_id`) REFERENCES `askm_tingkat_pelanggaran` (`tingkat_id`),
  CONSTRAINT `askm_poin_pelanggaran_ibfk_2` FOREIGN KEY (`bentuk_id`) REFERENCES `askm_bentuk_pelanggaran` (`bentuk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=latin1;

/*Table structure for table `askm_r_status_request` */

DROP TABLE IF EXISTS `askm_r_status_request`;

CREATE TABLE `askm_r_status_request` (
  `status_request_id` int(11) NOT NULL,
  `status_request` varchar(45) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`status_request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `askm_tingkat_pelanggaran` */

DROP TABLE IF EXISTS `askm_tingkat_pelanggaran`;

CREATE TABLE `askm_tingkat_pelanggaran` (
  `tingkat_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`tingkat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `baak_dim_has_surat_lomba` */

DROP TABLE IF EXISTS `baak_dim_has_surat_lomba`;

CREATE TABLE `baak_dim_has_surat_lomba` (
  `dim_has_surat_lomba_id` int(11) NOT NULL AUTO_INCREMENT,
  `dim_id` int(11) DEFAULT NULL,
  `surat_lomba_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`dim_has_surat_lomba_id`),
  KEY `FK_baak_dim_has_surat_lomba` (`surat_lomba_id`),
  KEY `FK_baak_dim_has_surat_lomba2` (`dim_id`),
  CONSTRAINT `FK_baak_dim_has_surat_lomba` FOREIGN KEY (`surat_lomba_id`) REFERENCES `baak_surat_lomba` (`surat_lomba_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_baak_dim_has_surat_lomba2` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Table structure for table `baak_dim_has_surat_magang` */

DROP TABLE IF EXISTS `baak_dim_has_surat_magang`;

CREATE TABLE `baak_dim_has_surat_magang` (
  `dim_has_surat_magang_id` int(11) NOT NULL AUTO_INCREMENT,
  `dim_id` int(11) DEFAULT NULL,
  `surat_magang_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`dim_has_surat_magang_id`),
  KEY `FK_baak_dim_has_surat_magang` (`surat_magang_id`),
  KEY `FK_baak_dim_has_surat_magang2` (`dim_id`),
  CONSTRAINT `FK_baak_dim_has_surat_magang` FOREIGN KEY (`surat_magang_id`) REFERENCES `baak_surat_magang` (`surat_magang_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_baak_dim_has_surat_magang2` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;

/*Table structure for table `baak_dim_has_surat_pengantar_proyek` */

DROP TABLE IF EXISTS `baak_dim_has_surat_pengantar_proyek`;

CREATE TABLE `baak_dim_has_surat_pengantar_proyek` (
  `dim_has_surat_pengantar_proyek_id` int(11) NOT NULL AUTO_INCREMENT,
  `surat_pengantar_proyek_id` int(11) DEFAULT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`dim_has_surat_pengantar_proyek_id`),
  KEY `FK_baak_dim_has_surat_pengantar_proyek2` (`dim_id`),
  KEY `FK_baak_dim_has_surat_pengantar_proyek` (`surat_pengantar_proyek_id`),
  CONSTRAINT `FK_baak_dim_has_surat_pengantar_proyek` FOREIGN KEY (`surat_pengantar_proyek_id`) REFERENCES `baak_surat_pengantar_proyek` (`surat_pengantar_proyek_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_baak_dim_has_surat_pengantar_proyek2` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=205 DEFAULT CHARSET=latin1;

/*Table structure for table `baak_format_nomor_surat` */

DROP TABLE IF EXISTS `baak_format_nomor_surat`;

CREATE TABLE `baak_format_nomor_surat` (
  `format_nomor_surat_id` int(11) NOT NULL AUTO_INCREMENT,
  `format_nomor` varchar(32) DEFAULT NULL,
  `desc` text,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`format_nomor_surat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `baak_kaos_del` */

DROP TABLE IF EXISTS `baak_kaos_del`;

CREATE TABLE `baak_kaos_del` (
  `kaos_del_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_ukuran` varchar(5) DEFAULT NULL,
  `ukuran` varchar(32) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kaos_del_id`),
  KEY `FK_baak_kaos_del` (`pegawai_id`),
  CONSTRAINT `FK_baak_kaos_del` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Table structure for table `baak_kartu_tanda_mahasiswa` */

DROP TABLE IF EXISTS `baak_kartu_tanda_mahasiswa`;

CREATE TABLE `baak_kartu_tanda_mahasiswa` (
  `kartu_tanda_mahasiswa_id` int(11) NOT NULL AUTO_INCREMENT,
  `alasan` text,
  `pemohon_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `status_pengajuan_id` int(11) DEFAULT '1',
  `alasan_penolakan` text,
  `waktu_pengambilan` datetime DEFAULT NULL,
  PRIMARY KEY (`kartu_tanda_mahasiswa_id`),
  KEY `FK_baak_ktm_pengaju` (`pemohon_id`),
  KEY `FK_baak_kartu_tanda_mahasiswa` (`status_pengajuan_id`),
  KEY `FK_baak_kartu_tanda_mahasiswap` (`pegawai_id`),
  CONSTRAINT `FK_baak_kartu_tanda_mahasiswa` FOREIGN KEY (`status_pengajuan_id`) REFERENCES `baak_r_status_pengajuan` (`status_pengajuan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_baak_kartu_tanda_mahasiswa2` FOREIGN KEY (`pemohon_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_baak_kartu_tanda_mahasiswa3` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=latin1;

/*Table structure for table `baak_kop_surat` */

DROP TABLE IF EXISTS `baak_kop_surat`;

CREATE TABLE `baak_kop_surat` (
  `kop_surat_id` int(11) NOT NULL AUTO_INCREMENT,
  `kop_surat` text NOT NULL,
  `desc` text NOT NULL,
  `nama_institut` varchar(32) DEFAULT NULL,
  `alamat` text,
  `nomor_telepon` varchar(32) DEFAULT NULL,
  `nomor_fax` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `alamat_web` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kop_surat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Table structure for table `baak_r_nomor_surat_terakhir` */

DROP TABLE IF EXISTS `baak_r_nomor_surat_terakhir`;

CREATE TABLE `baak_r_nomor_surat_terakhir` (
  `nomor_surat_terakhir_id` int(11) NOT NULL AUTO_INCREMENT,
  `format_nomor_surat_id` int(11) DEFAULT NULL,
  `nomor_surat` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`nomor_surat_terakhir_id`),
  KEY `fk_nomor_surat_terakhir_format_nomor_surat` (`format_nomor_surat_id`),
  CONSTRAINT `fk_nomor_surat_terakhir_format_nomor_surat` FOREIGN KEY (`format_nomor_surat_id`) REFERENCES `baak_format_nomor_surat` (`format_nomor_surat_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `baak_r_status_pengajuan` */

DROP TABLE IF EXISTS `baak_r_status_pengajuan`;

CREATE TABLE `baak_r_status_pengajuan` (
  `status_pengajuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`status_pengajuan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Table structure for table `baak_surat_lomba` */

DROP TABLE IF EXISTS `baak_surat_lomba`;

CREATE TABLE `baak_surat_lomba` (
  `surat_lomba_id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_surat` varchar(45) DEFAULT NULL,
  `nomor_surat_lengkap` varchar(100) DEFAULT NULL,
  `perihal` text,
  `alamat_tujuan` text,
  `banyak_lampiran` varchar(45) DEFAULT NULL,
  `salam_pembuka` text,
  `tanggal_surat` date DEFAULT NULL,
  `nama_lomba` varchar(45) DEFAULT NULL,
  `pemohon_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `status_pengajuan_id` int(11) DEFAULT '1',
  `alasan_penolakan` text,
  `waktu_pengambilan` datetime DEFAULT NULL,
  `penandatangan` int(11) DEFAULT NULL,
  `kop_surat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`surat_lomba_id`),
  KEY `FK_baak_surat_lomba_pengaju` (`pemohon_id`),
  KEY `FK_baak_surat_lomba2` (`status_pengajuan_id`),
  KEY `FK_baak_surat_lombap` (`pegawai_id`),
  KEY `kop_surat_id` (`kop_surat_id`),
  CONSTRAINT `FK_baak_surat_lomba` FOREIGN KEY (`status_pengajuan_id`) REFERENCES `baak_r_status_pengajuan` (`status_pengajuan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_baak_surat_lomba2` FOREIGN KEY (`pemohon_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_baak_surat_lomba3` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `baak_surat_lomba_ibfk_1` FOREIGN KEY (`kop_surat_id`) REFERENCES `baak_kop_surat` (`kop_surat_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Table structure for table `baak_surat_magang` */

DROP TABLE IF EXISTS `baak_surat_magang`;

CREATE TABLE `baak_surat_magang` (
  `surat_magang_id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_surat` int(11) DEFAULT NULL,
  `nomor_surat_lengkap` varchar(45) DEFAULT NULL,
  `perihal_surat` varchar(100) DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `nama_perusahaan` varchar(45) NOT NULL,
  `alamat_perusahaan` text NOT NULL,
  `waktu_awal_magang` date NOT NULL,
  `waktu_akhir_magang` date NOT NULL,
  `pemohon_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `status_pengajuan_id` int(11) DEFAULT '1',
  `alasan_penolakan` text,
  `waktu_pengambilan` datetime DEFAULT NULL,
  `penandatangan` int(11) DEFAULT NULL,
  `kop_surat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`surat_magang_id`),
  KEY `FK_baak_surat_magang_pengaju` (`pemohon_id`),
  KEY `FK_baak_surat_magang` (`status_pengajuan_id`),
  KEY `FK_baak_surat_magangp` (`pegawai_id`),
  KEY `kop_surat_id` (`kop_surat_id`),
  CONSTRAINT `FK_baak_surat_magang` FOREIGN KEY (`status_pengajuan_id`) REFERENCES `baak_r_status_pengajuan` (`status_pengajuan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_baak_surat_magang2` FOREIGN KEY (`pemohon_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_baak_surat_magang3` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `baak_surat_magang_ibfk_1` FOREIGN KEY (`kop_surat_id`) REFERENCES `baak_kop_surat` (`kop_surat_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

/*Table structure for table `baak_surat_mahasiswa_aktif` */

DROP TABLE IF EXISTS `baak_surat_mahasiswa_aktif`;

CREATE TABLE `baak_surat_mahasiswa_aktif` (
  `surat_mahasiswa_aktif_id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_surat` int(11) DEFAULT NULL,
  `nomor_surat_lengkap` varchar(45) DEFAULT NULL,
  `tujuan` text,
  `tanggal_surat` date DEFAULT NULL,
  `pemohon_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `status_pengajuan_id` int(11) DEFAULT '1',
  `alasan_penolakan` text,
  `waktu_pengambilan` datetime DEFAULT NULL,
  `penandatangan` int(11) DEFAULT NULL,
  `kop_surat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`surat_mahasiswa_aktif_id`),
  KEY `FK_baak_surat_mahasiswa_aktif_pengaju` (`pemohon_id`),
  KEY `FK_baak_surat_mahasiswa_aktif2` (`status_pengajuan_id`),
  KEY `FK_baak_surat_mahasiswa_aktifp` (`pegawai_id`),
  KEY `kop_surat_id` (`kop_surat_id`),
  CONSTRAINT `FK_baak_surat_mahasiswa_aktif` FOREIGN KEY (`status_pengajuan_id`) REFERENCES `baak_r_status_pengajuan` (`status_pengajuan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_baak_surat_mahasiswa_aktif2` FOREIGN KEY (`pemohon_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_baak_surat_mahasiswa_aktif3` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `baak_surat_mahasiswa_aktif_ibfk_1` FOREIGN KEY (`kop_surat_id`) REFERENCES `baak_kop_surat` (`kop_surat_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=508 DEFAULT CHARSET=latin1;

/*Table structure for table `baak_surat_pengantar_proyek` */

DROP TABLE IF EXISTS `baak_surat_pengantar_proyek`;

CREATE TABLE `baak_surat_pengantar_proyek` (
  `surat_pengantar_proyek_id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_surat` int(11) DEFAULT NULL,
  `nomor_surat_lengkap` varchar(45) DEFAULT NULL,
  `perihal_surat` text,
  `alamat_tujuan` text,
  `banyak_lampiran` varchar(45) DEFAULT NULL,
  `kuliah_id` int(11) DEFAULT NULL,
  `salam_pembuka` text,
  `tanggal_surat` date DEFAULT NULL,
  `pemohon_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `status_pengajuan_id` int(11) DEFAULT '1',
  `alasan_penolakan` text,
  `waktu_pengambilan` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `penandatangan` int(11) DEFAULT NULL,
  `kop_surat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`surat_pengantar_proyek_id`),
  KEY `FK_baak_surat_pengantar_proyek` (`pemohon_id`),
  KEY `FK_baak_surat_pengantar_proyek2` (`pegawai_id`),
  KEY `FK_baak_surat_pengantar_proyek3` (`status_pengajuan_id`),
  KEY `FK_baak_surat_pengantar_proyek4` (`kuliah_id`),
  KEY `kop_surat_id` (`kop_surat_id`),
  CONSTRAINT `FK_baak_surat_pengantar_proyek` FOREIGN KEY (`status_pengajuan_id`) REFERENCES `baak_r_status_pengajuan` (`status_pengajuan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_baak_surat_pengantar_proyek2` FOREIGN KEY (`pemohon_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_baak_surat_pengantar_proyek3` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `baak_surat_pengantar_proyek_ibfk_1` FOREIGN KEY (`kop_surat_id`) REFERENCES `baak_kop_surat` (`kop_surat_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;

/*Table structure for table `cist_atasan_cuti_nontahunan` */

DROP TABLE IF EXISTS `cist_atasan_cuti_nontahunan`;

CREATE TABLE `cist_atasan_cuti_nontahunan` (
  `atasan_cuti_nontahunan_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_cuti_nontahunan_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`atasan_cuti_nontahunan_id`),
  KEY `FK_cist_atasan_cuti_nontahunan` (`permohonan_cuti_nontahunan_id`),
  CONSTRAINT `FK_cist_atasan_cuti_nontahunan` FOREIGN KEY (`permohonan_cuti_nontahunan_id`) REFERENCES `cist_permohonan_cuti_nontahunan` (`permohonan_cuti_nontahunan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Table structure for table `cist_atasan_cuti_tahunan` */

DROP TABLE IF EXISTS `cist_atasan_cuti_tahunan`;

CREATE TABLE `cist_atasan_cuti_tahunan` (
  `atasan_cuti_tahunan_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_cuti_tahunan_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`atasan_cuti_tahunan_id`),
  KEY `FK_cist_atasan_cuti_tahunan` (`permohonan_cuti_tahunan_id`),
  CONSTRAINT `FK_cist_atasan_cuti_tahunan` FOREIGN KEY (`permohonan_cuti_tahunan_id`) REFERENCES `cist_permohonan_cuti_tahunan` (`permohonan_cuti_tahunan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Table structure for table `cist_atasan_izin` */

DROP TABLE IF EXISTS `cist_atasan_izin`;

CREATE TABLE `cist_atasan_izin` (
  `atasan_izin_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_izin_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`atasan_izin_id`),
  KEY `FK_cist_atasan_izin` (`permohonan_izin_id`),
  CONSTRAINT `FK_cist_atasan_izin` FOREIGN KEY (`permohonan_izin_id`) REFERENCES `cist_permohonan_izin` (`permohonan_izin_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Table structure for table `cist_atasan_surat_tugas` */

DROP TABLE IF EXISTS `cist_atasan_surat_tugas`;

CREATE TABLE `cist_atasan_surat_tugas` (
  `atasan_surat_tugas_id` int(11) NOT NULL AUTO_INCREMENT,
  `surat_tugas_id` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `perequest` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`atasan_surat_tugas_id`),
  KEY `FK_cist_atasan_surat_tugas` (`surat_tugas_id`),
  KEY `FK_cist_atasan_surat_tugas_2` (`perequest`),
  CONSTRAINT `FK_cist_atasan_surat_tugas` FOREIGN KEY (`surat_tugas_id`) REFERENCES `cist_surat_tugas` (`surat_tugas_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

/*Table structure for table `cist_golongan_kuota_cuti` */

DROP TABLE IF EXISTS `cist_golongan_kuota_cuti`;

CREATE TABLE `cist_golongan_kuota_cuti` (
  `golongan_kuota_cuti_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_golongan` varchar(100) DEFAULT NULL,
  `min_tahun_kerja` int(11) DEFAULT NULL,
  `max_tahun_kerja` int(11) DEFAULT NULL,
  `kuota` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`golongan_kuota_cuti_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `cist_kategori_cuti_nontahunan` */

DROP TABLE IF EXISTS `cist_kategori_cuti_nontahunan`;

CREATE TABLE `cist_kategori_cuti_nontahunan` (
  `kategori_cuti_nontahunan_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `lama_pelaksanaan` int(6) DEFAULT NULL,
  `satuan` int(1) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kategori_cuti_nontahunan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Table structure for table `cist_kategori_izin` */

DROP TABLE IF EXISTS `cist_kategori_izin`;

CREATE TABLE `cist_kategori_izin` (
  `kategori_izin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kategori_izin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Table structure for table `cist_laporan_surat_tugas` */

DROP TABLE IF EXISTS `cist_laporan_surat_tugas`;

CREATE TABLE `cist_laporan_surat_tugas` (
  `laporan_surat_tugas_id` int(11) NOT NULL AUTO_INCREMENT,
  `surat_tugas_id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `nama_file` varchar(200) DEFAULT NULL,
  `lokasi_file` varchar(100) DEFAULT NULL,
  `tanggal_submit` date DEFAULT NULL,
  `batas_submit` datetime NOT NULL,
  `kode_laporan` varchar(100) DEFAULT NULL,
  `review_laporan` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`laporan_surat_tugas_id`),
  KEY `fk_cist_laporan_surat_tugas_cist_surat_tugas1_idx` (`surat_tugas_id`),
  KEY `FK_status_laporan_surat_tugas` (`status_id`),
  CONSTRAINT `FK_cist_laporan_surat_tugas` FOREIGN KEY (`surat_tugas_id`) REFERENCES `cist_surat_tugas` (`surat_tugas_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_status_laporan_surat_tugas` FOREIGN KEY (`status_id`) REFERENCES `cist_r_status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Table structure for table `cist_permohonan_cuti_nontahunan` */

DROP TABLE IF EXISTS `cist_permohonan_cuti_nontahunan`;

CREATE TABLE `cist_permohonan_cuti_nontahunan` (
  `permohonan_cuti_nontahunan_id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `alasan_cuti` text,
  `lama_cuti` int(6) DEFAULT NULL,
  `kategori_id` int(11) NOT NULL,
  `pengalihan_tugas` tinytext,
  `status_cuti_nontahunan_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`permohonan_cuti_nontahunan_id`),
  KEY `FK_cist_permohonan_cuti_pegawai` (`pegawai_id`),
  KEY `FK_cist_permohonan_cuti_nontahunan` (`kategori_id`),
  KEY `cist_permohonan_cuti_nontahunan_ibfk_1` (`status_cuti_nontahunan_id`),
  CONSTRAINT `FK_cist_permohonan_cuti_nontahunan12` FOREIGN KEY (`kategori_id`) REFERENCES `cist_kategori_cuti_nontahunan` (`kategori_cuti_nontahunan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cist_permohonan_cuti_pegawai12` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`),
  CONSTRAINT `cist_permohonan_cuti_nontahunan_ibfk_12` FOREIGN KEY (`status_cuti_nontahunan_id`) REFERENCES `cist_status_cuti_nontahunan` (`status_cuti_nontahunan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Table structure for table `cist_permohonan_cuti_tahunan` */

DROP TABLE IF EXISTS `cist_permohonan_cuti_tahunan`;

CREATE TABLE `cist_permohonan_cuti_tahunan` (
  `permohonan_cuti_tahunan_id` int(11) NOT NULL AUTO_INCREMENT,
  `waktu_pelaksanaan` varchar(500) NOT NULL,
  `alasan_cuti` text,
  `lama_cuti` int(6) DEFAULT NULL,
  `pengalihan_tugas` text,
  `status_izin_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`permohonan_cuti_tahunan_id`),
  KEY `FK_cist_permohonan_cuti_tahunan` (`pegawai_id`),
  KEY `cist_permohonan_cuti_tahunan_ibfk_1` (`status_izin_id`),
  CONSTRAINT `FK_cist_permohonan_cuti_tahunan` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`),
  CONSTRAINT `cist_permohonan_cuti_tahunan_ibfk_1` FOREIGN KEY (`status_izin_id`) REFERENCES `cist_status_cuti_tahunan` (`status_cuti_tahunan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

/*Table structure for table `cist_permohonan_izin` */

DROP TABLE IF EXISTS `cist_permohonan_izin`;

CREATE TABLE `cist_permohonan_izin` (
  `permohonan_izin_id` int(11) NOT NULL AUTO_INCREMENT,
  `waktu_pelaksanaan` varchar(500) NOT NULL,
  `alasan_izin` text,
  `pengalihan_tugas` text,
  `kategori_id` int(11) NOT NULL,
  `lama_izin` int(6) NOT NULL,
  `file_surat` text,
  `kode_file_surat` varchar(200) DEFAULT NULL,
  `status_izin_id` int(11) DEFAULT NULL,
  `atasan_id` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`permohonan_izin_id`),
  KEY `FK_cist_permohonan_izin` (`pegawai_id`),
  KEY `FK_atasan_izin` (`atasan_id`),
  KEY `FK_cist_kategori_izin` (`kategori_id`),
  KEY `status_izin_id` (`status_izin_id`),
  CONSTRAINT `FK_cist_permohonan_izin` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`),
  CONSTRAINT `cist_permohonan_izin_ibfk_1` FOREIGN KEY (`status_izin_id`) REFERENCES `cist_status_izin` (`status_izin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Table structure for table `cist_r_jenis_surat` */

DROP TABLE IF EXISTS `cist_r_jenis_surat`;

CREATE TABLE `cist_r_jenis_surat` (
  `jenis_surat_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_surat` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`jenis_surat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `cist_r_jumlah_libur` */

DROP TABLE IF EXISTS `cist_r_jumlah_libur`;

CREATE TABLE `cist_r_jumlah_libur` (
  `jumlah_libur_id` int(11) NOT NULL AUTO_INCREMENT,
  `jumlah` int(3) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL,
  `deleted_by` varchar(32) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`jumlah_libur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `cist_r_kuota_cuti_tahunan` */

DROP TABLE IF EXISTS `cist_r_kuota_cuti_tahunan`;

CREATE TABLE `cist_r_kuota_cuti_tahunan` (
  `kuota_cuti_tahunan_id` int(11) NOT NULL AUTO_INCREMENT,
  `pegawai_id` int(11) NOT NULL,
  `kuota` int(6) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kuota_cuti_tahunan_id`),
  KEY `FK_cist_kuota_cuti_tahunan` (`pegawai_id`),
  CONSTRAINT `FK_cist_kuota_cuti_tahunan` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Table structure for table `cist_r_status` */

DROP TABLE IF EXISTS `cist_r_status`;

CREATE TABLE `cist_r_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Table structure for table `cist_r_waktu_generate_kuota_cuti` */

DROP TABLE IF EXISTS `cist_r_waktu_generate_kuota_cuti`;

CREATE TABLE `cist_r_waktu_generate_kuota_cuti` (
  `waktu_generate_kuota_cuti_id` int(11) NOT NULL AUTO_INCREMENT,
  `waktu_generate_terakhir` datetime NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL,
  `deleted_by` varchar(32) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`waktu_generate_kuota_cuti_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `cist_status_cuti_nontahunan` */

DROP TABLE IF EXISTS `cist_status_cuti_nontahunan`;

CREATE TABLE `cist_status_cuti_nontahunan` (
  `status_cuti_nontahunan_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_cuti_nontahunan_id` int(11) NOT NULL,
  `status_by_hrd` int(11) DEFAULT '1',
  `status_by_atasan` int(11) DEFAULT '1',
  `status_by_wr2` int(11) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`status_cuti_nontahunan_id`),
  KEY `FK_cist_r_status_cuti_nontahunan` (`permohonan_cuti_nontahunan_id`),
  KEY `status_by_hrd` (`status_by_hrd`),
  KEY `status_by_atasan` (`status_by_atasan`),
  KEY `status_by_wr2` (`status_by_wr2`),
  CONSTRAINT `cist_status_cuti_nontahunan_ibfk_1` FOREIGN KEY (`status_by_hrd`) REFERENCES `cist_r_status` (`status_id`),
  CONSTRAINT `cist_status_cuti_nontahunan_ibfk_2` FOREIGN KEY (`status_by_atasan`) REFERENCES `cist_r_status` (`status_id`),
  CONSTRAINT `cist_status_cuti_nontahunan_ibfk_3` FOREIGN KEY (`status_by_wr2`) REFERENCES `cist_r_status` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Table structure for table `cist_status_cuti_tahunan` */

DROP TABLE IF EXISTS `cist_status_cuti_tahunan`;

CREATE TABLE `cist_status_cuti_tahunan` (
  `status_cuti_tahunan_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_cuti_tahunan_id` int(11) NOT NULL,
  `status_by_hrd` int(11) DEFAULT '1',
  `status_by_atasan` int(11) DEFAULT '1',
  `status_by_wr2` int(11) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`status_cuti_tahunan_id`),
  KEY `FK_cist_r_status_cuti_tahunan` (`permohonan_cuti_tahunan_id`),
  KEY `status_by_hrd` (`status_by_hrd`),
  KEY `status_by_atasan` (`status_by_atasan`),
  KEY `status_by_wr2` (`status_by_wr2`),
  CONSTRAINT `cist_status_cuti_tahunan_ibfk_1` FOREIGN KEY (`status_by_hrd`) REFERENCES `cist_r_status` (`status_id`),
  CONSTRAINT `cist_status_cuti_tahunan_ibfk_2` FOREIGN KEY (`status_by_atasan`) REFERENCES `cist_r_status` (`status_id`),
  CONSTRAINT `cist_status_cuti_tahunan_ibfk_3` FOREIGN KEY (`status_by_wr2`) REFERENCES `cist_r_status` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Table structure for table `cist_status_izin` */

DROP TABLE IF EXISTS `cist_status_izin`;

CREATE TABLE `cist_status_izin` (
  `status_izin_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_izin_id` int(11) DEFAULT NULL,
  `status_by_atasan` int(11) DEFAULT '1',
  `status_by_wr2` int(11) DEFAULT '1',
  `status_by_hrd` int(11) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`status_izin_id`),
  KEY `status_by_atasan` (`status_by_atasan`),
  KEY `status_by_wr2` (`status_by_wr2`),
  KEY `status_by_hrd` (`status_by_hrd`),
  KEY `permohonan_izin_id` (`permohonan_izin_id`),
  CONSTRAINT `cist_status_izin_ibfk_1` FOREIGN KEY (`status_by_atasan`) REFERENCES `cist_r_status` (`status_id`),
  CONSTRAINT `cist_status_izin_ibfk_2` FOREIGN KEY (`status_by_wr2`) REFERENCES `cist_r_status` (`status_id`),
  CONSTRAINT `cist_status_izin_ibfk_3` FOREIGN KEY (`status_by_hrd`) REFERENCES `cist_r_status` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Table structure for table `cist_surat_tugas` */

DROP TABLE IF EXISTS `cist_surat_tugas`;

CREATE TABLE `cist_surat_tugas` (
  `surat_tugas_id` int(11) NOT NULL AUTO_INCREMENT,
  `perequest` int(11) NOT NULL,
  `no_surat` varchar(45) DEFAULT NULL,
  `tempat` varchar(100) DEFAULT NULL,
  `tanggal_berangkat` datetime DEFAULT NULL,
  `tanggal_kembali` datetime DEFAULT NULL,
  `tanggal_mulai` datetime DEFAULT NULL,
  `tanggal_selesai` datetime DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `agenda` varchar(100) DEFAULT NULL,
  `pengalihan_tugas` text,
  `review_surat` text,
  `transportasi` text,
  `desc_surat_tugas` text,
  `catatan` text,
  `jenis_surat_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `status_sppd` tinyint(1) DEFAULT '0',
  `penandatangan` int(11) DEFAULT NULL,
  `penyetuju` int(11) DEFAULT NULL,
  `nama_kegiatan` varchar(100) DEFAULT NULL,
  `kembali_bekerja` datetime DEFAULT NULL,
  `realisasi_berangkat` date DEFAULT NULL,
  `realisasi_kembali` date DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`surat_tugas_id`),
  KEY `fk_cist_surat_tugas_cist_pegawai1_idx` (`perequest`),
  KEY `FK_cist_status` (`status_id`),
  KEY `FK_jenis_surat` (`jenis_surat_id`),
  CONSTRAINT `FK_cist_status` FOREIGN KEY (`status_id`) REFERENCES `cist_r_status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cist_surat_tugas_perequest` FOREIGN KEY (`perequest`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_jenis_surat` FOREIGN KEY (`jenis_surat_id`) REFERENCES `cist_r_jenis_surat` (`jenis_surat_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;

/*Table structure for table `cist_surat_tugas_assignee` */

DROP TABLE IF EXISTS `cist_surat_tugas_assignee`;

CREATE TABLE `cist_surat_tugas_assignee` (
  `surat_tugas_assignee_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(11) DEFAULT NULL,
  `surat_tugas_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`surat_tugas_assignee_id`),
  KEY `FK_cist_surat_tugas_assignee` (`id_pegawai`),
  KEY `FK_surat` (`surat_tugas_id`),
  CONSTRAINT `FK_cist_surat_tugas_assignee` FOREIGN KEY (`id_pegawai`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_surat` FOREIGN KEY (`surat_tugas_id`) REFERENCES `cist_surat_tugas` (`surat_tugas_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=latin1;

/*Table structure for table `cist_surat_tugas_file` */

DROP TABLE IF EXISTS `cist_surat_tugas_file`;

CREATE TABLE `cist_surat_tugas_file` (
  `surat_tugas_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_file` varchar(100) DEFAULT NULL,
  `lokasi_file` varchar(100) DEFAULT NULL,
  `surat_tugas_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` date DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `kode_file` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`surat_tugas_file_id`),
  KEY `FK_cist_surat_tugas_file` (`surat_tugas_id`),
  CONSTRAINT `FK_cist_surat_tugas_file` FOREIGN KEY (`surat_tugas_id`) REFERENCES `cist_surat_tugas` (`surat_tugas_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

/*Table structure for table `cist_waktu_cuti_tahunan` */

DROP TABLE IF EXISTS `cist_waktu_cuti_tahunan`;

CREATE TABLE `cist_waktu_cuti_tahunan` (
  `waktu_cuti_tahunan_id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_cuti_tahunan_id` int(11) DEFAULT NULL,
  `durasi` date DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`waktu_cuti_tahunan_id`),
  KEY `FK_cist_waktu_cuti_tahunan` (`permohonan_cuti_tahunan_id`),
  CONSTRAINT `FK_cist_waktu_cuti_tahunan` FOREIGN KEY (`permohonan_cuti_tahunan_id`) REFERENCES `cist_permohonan_cuti_tahunan` (`permohonan_cuti_tahunan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Table structure for table `dimx_alumni` */

DROP TABLE IF EXISTS `dimx_alumni`;

CREATE TABLE `dimx_alumni` (
  `alumni_id` int(11) NOT NULL AUTO_INCREMENT,
  `ta` int(11) NOT NULL DEFAULT '0',
  `sem` int(11) NOT NULL DEFAULT '0',
  `nim` varchar(8) NOT NULL DEFAULT '',
  `status` varchar(50) NOT NULL DEFAULT '',
  `tanggal_lulus` date DEFAULT NULL,
  `sks_lulus` int(11) DEFAULT NULL,
  `ipk_lulus` float DEFAULT NULL,
  `no_sk_yudisium` varchar(30) DEFAULT NULL,
  `tanggal_sk` date DEFAULT NULL,
  `no_ijazah` varchar(40) DEFAULT NULL,
  `no_transkrip` varchar(255) NOT NULL DEFAULT '',
  `predikat_lulus` varchar(100) NOT NULL DEFAULT '',
  `judul_ta` text NOT NULL,
  `pembimbing1` varchar(20) DEFAULT NULL,
  `pembimbing2` varchar(20) DEFAULT NULL,
  `dosen_id_1` int(11) DEFAULT NULL,
  `dosen_id_2` int(11) DEFAULT NULL,
  `dim_id` int(11) NOT NULL,
  `n_toefl` int(11) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`alumni_id`),
  KEY `fk_t_alumni_t_dim1_idx` (`dim_id`),
  KEY `FK_dimx_alumni_dosen_1` (`dosen_id_1`),
  KEY `FK_dimx_alumni_dosen_2` (`dosen_id_2`),
  CONSTRAINT `FK_dimx_alumni_dosen_1` FOREIGN KEY (`dosen_id_1`) REFERENCES `hrdx_dosen` (`dosen_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_alumni_dosen_2` FOREIGN KEY (`dosen_id_2`) REFERENCES `hrdx_dosen` (`dosen_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_t_alumni_t_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1412 DEFAULT CHARSET=latin1;

/*Table structure for table `dimx_alumni_data` */

DROP TABLE IF EXISTS `dimx_alumni_data`;

CREATE TABLE `dimx_alumni_data` (
  `alumni_data_id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(8) NOT NULL DEFAULT '',
  `alamat` varchar(100) NOT NULL DEFAULT '',
  `kota` varchar(255) DEFAULT NULL,
  `propinsi` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  `hp` varchar(20) NOT NULL DEFAULT '',
  `telepon` varchar(20) DEFAULT NULL,
  `alumni_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`alumni_data_id`),
  UNIQUE KEY `NIM_UNIQUE` (`nim`),
  KEY `fk_t_alumni_data_t_alumni1_idx` (`alumni_id`),
  CONSTRAINT `fk_t_alumni_data_t_alumni1` FOREIGN KEY (`alumni_id`) REFERENCES `dimx_alumni` (`alumni_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=latin1;

/*Table structure for table `dimx_alumni_pekerjaan` */

DROP TABLE IF EXISTS `dimx_alumni_pekerjaan`;

CREATE TABLE `dimx_alumni_pekerjaan` (
  `alumni_pekerjaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(8) NOT NULL DEFAULT '',
  `tgl_start` date NOT NULL,
  `tgl_end` date DEFAULT NULL,
  `nama_perusahaan` varchar(200) NOT NULL DEFAULT '',
  `alamat_perusahaan` varchar(255) DEFAULT NULL,
  `bidang_perusahaan` varchar(255) DEFAULT NULL,
  `bidang_pekerjaan` varchar(100) NOT NULL DEFAULT '',
  `gaji` varchar(100) DEFAULT NULL,
  `alumni_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`alumni_pekerjaan_id`),
  KEY `fk_t_ALUMNI_PEKERJAAN_t_ALUMNI_DATA_idx` (`alumni_id`),
  CONSTRAINT `FK_dimx_alumni_pekerjaan` FOREIGN KEY (`alumni_id`) REFERENCES `dimx_alumni` (`alumni_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=latin1;

/*Table structure for table `dimx_dim` */

DROP TABLE IF EXISTS `dimx_dim`;

CREATE TABLE `dimx_dim` (
  `dim_id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(8) NOT NULL DEFAULT '',
  `no_usm` varchar(15) NOT NULL DEFAULT '',
  `jalur` varchar(20) DEFAULT NULL,
  `user_name` varchar(10) DEFAULT NULL,
  `kbk_id` varchar(20) DEFAULT NULL,
  `ref_kbk_id` int(11) DEFAULT NULL,
  `kpt_prodi` varchar(10) DEFAULT NULL,
  `id_kur` int(4) NOT NULL DEFAULT '0',
  `tahun_kurikulum_id` int(11) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `gol_darah` char(2) DEFAULT NULL,
  `golongan_darah_id` int(11) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `jenis_kelamin_id` int(11) DEFAULT NULL,
  `agama` varchar(30) DEFAULT NULL,
  `agama_id` int(11) DEFAULT NULL,
  `alamat` text,
  `kabupaten` varchar(50) DEFAULT NULL,
  `kode_pos` varchar(5) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `hp2` varchar(50) DEFAULT NULL,
  `no_ijazah_sma` varchar(100) DEFAULT NULL,
  `nama_sma` varchar(50) DEFAULT NULL,
  `asal_sekolah_id` int(11) DEFAULT NULL,
  `alamat_sma` text,
  `kabupaten_sma` varchar(100) DEFAULT NULL,
  `telepon_sma` varchar(50) DEFAULT NULL,
  `kodepos_sma` varchar(8) DEFAULT NULL,
  `thn_masuk` int(11) DEFAULT NULL,
  `status_akhir` varchar(50) DEFAULT 'Aktif',
  `nama_ayah` varchar(50) DEFAULT NULL,
  `nama_ibu` varchar(50) DEFAULT NULL,
  `no_hp_ayah` varchar(50) DEFAULT NULL,
  `no_hp_ibu` varchar(50) DEFAULT NULL,
  `alamat_orangtua` text,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `pekerjaan_ayah_id` int(11) DEFAULT NULL,
  `keterangan_pekerjaan_ayah` text,
  `penghasilan_ayah` varchar(50) DEFAULT NULL,
  `penghasilan_ayah_id` int(11) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `pekerjaan_ibu_id` int(11) DEFAULT NULL,
  `keterangan_pekerjaan_ibu` text,
  `penghasilan_ibu` varchar(50) DEFAULT NULL,
  `penghasilan_ibu_id` int(11) DEFAULT NULL,
  `nama_wali` varchar(50) DEFAULT NULL,
  `pekerjaan_wali` varchar(50) DEFAULT NULL,
  `pekerjaan_wali_id` int(11) DEFAULT NULL,
  `keterangan_pekerjaan_wali` text,
  `penghasilan_wali` varchar(50) DEFAULT NULL,
  `penghasilan_wali_id` int(11) DEFAULT NULL,
  `alamat_wali` text,
  `telepon_wali` varchar(20) DEFAULT NULL,
  `no_hp_wali` varchar(50) DEFAULT NULL,
  `pendapatan` varchar(50) DEFAULT NULL,
  `ipk` float DEFAULT '0',
  `anak_ke` tinyint(4) DEFAULT NULL,
  `dari_jlh_anak` tinyint(4) DEFAULT NULL,
  `jumlah_tanggungan` tinyint(4) DEFAULT NULL,
  `nilai_usm` float DEFAULT NULL,
  `score_iq` tinyint(4) DEFAULT NULL,
  `rekomendasi_psikotest` varchar(4) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `kode_foto` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`dim_id`),
  UNIQUE KEY `NIM_UNIQUE` (`nim`),
  KEY `NIM` (`nim`),
  KEY `FK_dimx_dim_thn_krkm` (`tahun_kurikulum_id`),
  KEY `FK_dimx_dim_user` (`user_id`),
  KEY `FK_dimx_dim_ref_kbk` (`ref_kbk_id`),
  KEY `FK_dimx_dim_asal_sekolah` (`asal_sekolah_id`),
  KEY `FK_dimx_dim_golongan_darah` (`golongan_darah_id`),
  KEY `FK_dimx_dim_jenis_kelamin` (`jenis_kelamin_id`),
  KEY `FK_dimx_dim_agama` (`agama_id`),
  KEY `FK_dimx_dim_pekerjaan_ayah` (`pekerjaan_ayah_id`),
  KEY `FK_dimx_dim_penghasilan_ayah` (`penghasilan_ayah_id`),
  KEY `FK_dimx_dim_pekerjaan_ibu` (`pekerjaan_ibu_id`),
  KEY `FK_dimx_dim_penghasilan_ibu` (`penghasilan_ibu_id`),
  KEY `FK_dimx_dim_pekerjaan_wali` (`pekerjaan_wali_id`),
  KEY `FK_dimx_dim_penghasilan_wali_id` (`penghasilan_wali_id`),
  CONSTRAINT `FK_dimx_dim_agama` FOREIGN KEY (`agama_id`) REFERENCES `mref_r_agama` (`agama_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_asal_sekolah` FOREIGN KEY (`asal_sekolah_id`) REFERENCES `mref_r_asal_sekolah` (`asal_sekolah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_golongan_darah` FOREIGN KEY (`golongan_darah_id`) REFERENCES `mref_r_golongan_darah` (`golongan_darah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_jenis_kelamin` FOREIGN KEY (`jenis_kelamin_id`) REFERENCES `mref_r_jenis_kelamin` (`jenis_kelamin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_pekerjaan_ayah` FOREIGN KEY (`pekerjaan_ayah_id`) REFERENCES `mref_r_pekerjaan` (`pekerjaan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_pekerjaan_ibu` FOREIGN KEY (`pekerjaan_ibu_id`) REFERENCES `mref_r_pekerjaan` (`pekerjaan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_pekerjaan_wali` FOREIGN KEY (`pekerjaan_wali_id`) REFERENCES `mref_r_pekerjaan` (`pekerjaan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_penghasilan_ayah` FOREIGN KEY (`penghasilan_ayah_id`) REFERENCES `mref_r_penghasilan` (`penghasilan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_penghasilan_ibu` FOREIGN KEY (`penghasilan_ibu_id`) REFERENCES `mref_r_penghasilan` (`penghasilan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_penghasilan_wali_id` FOREIGN KEY (`penghasilan_wali_id`) REFERENCES `mref_r_penghasilan` (`penghasilan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_ref_kbk` FOREIGN KEY (`ref_kbk_id`) REFERENCES `inst_prodi` (`ref_kbk_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_thn_krkm` FOREIGN KEY (`tahun_kurikulum_id`) REFERENCES `krkm_r_tahun_kurikulum` (`tahun_kurikulum_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dimx_dim_user` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3083 DEFAULT CHARSET=latin1;

/*Table structure for table `dimx_dim_pmb` */

DROP TABLE IF EXISTS `dimx_dim_pmb`;

CREATE TABLE `dimx_dim_pmb` (
  `dim_pmb_id` int(11) NOT NULL AUTO_INCREMENT,
  `no_umpid` varchar(9) NOT NULL DEFAULT '',
  `tahun_ujian` int(11) NOT NULL DEFAULT '2004',
  `nim` varchar(8) DEFAULT NULL,
  `user_name` varchar(7) DEFAULT NULL,
  `kbk_id` varchar(20) DEFAULT 'N/A',
  `nama` varchar(50) NOT NULL DEFAULT '',
  `tgl_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `gol_darah` char(2) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `agama` varchar(30) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kabupaten` varchar(50) DEFAULT NULL,
  `kode_pos` varchar(5) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `nama_sma` varchar(50) DEFAULT NULL,
  `no_ijazah_sma` varchar(100) DEFAULT NULL,
  `alamat_sma` varchar(100) DEFAULT NULL,
  `kabupaten_sma` varchar(100) DEFAULT NULL,
  `kodepos_sma` varchar(8) DEFAULT NULL,
  `telepon_sma` varchar(50) DEFAULT NULL,
  `thn_masuk` int(11) DEFAULT NULL,
  `status_akhir` char(1) DEFAULT NULL,
  `nama_ayah` varchar(50) DEFAULT NULL,
  `nama_ibu` varchar(50) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `nama_wali` varchar(50) DEFAULT NULL,
  `pekerjaan_wali` varchar(50) DEFAULT NULL,
  `alamat_wali` varchar(200) DEFAULT NULL,
  `telepon_wali` varchar(20) DEFAULT NULL,
  `pendapatan` varchar(50) DEFAULT NULL,
  `ipk` float DEFAULT NULL,
  `foto` longblob,
  `tgl_daftar_s` date DEFAULT NULL,
  `tgl_daftar_e` date DEFAULT NULL,
  `status_daftar` varchar(10) DEFAULT NULL,
  `n_pembangunan` int(11) DEFAULT NULL,
  `jumlah_pembangunan` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`dim_pmb_id`),
  KEY `fk_t_dim_pmb_t_dim1_idx` (`dim_id`),
  CONSTRAINT `fk_t_dim_pmb_t_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

/*Table structure for table `dimx_dim_pmb_daftar` */

DROP TABLE IF EXISTS `dimx_dim_pmb_daftar`;

CREATE TABLE `dimx_dim_pmb_daftar` (
  `dim_pmb_daftar_id` int(11) NOT NULL AUTO_INCREMENT,
  `no_umpid` varchar(9) NOT NULL DEFAULT '',
  `nim` varchar(8) DEFAULT NULL,
  `tgl_daftar` datetime DEFAULT NULL,
  `biaya_bayar` double DEFAULT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`dim_pmb_daftar_id`),
  UNIQUE KEY `no_umpid_UNIQUE` (`no_umpid`),
  KEY `fk_t_dim_pmb_daftar_t_dim1_idx` (`dim_id`),
  CONSTRAINT `fk_t_dim_pmb_daftar_t_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

/*Table structure for table `dimx_dim_trnon_lulus` */

DROP TABLE IF EXISTS `dimx_dim_trnon_lulus`;

CREATE TABLE `dimx_dim_trnon_lulus` (
  `dim_trnon_lulus_id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(8) NOT NULL DEFAULT '',
  `sem_ta` tinyint(4) NOT NULL DEFAULT '0',
  `ta` int(11) NOT NULL DEFAULT '0',
  `status_akhir` varchar(50) NOT NULL DEFAULT 'Mengundurkan Diri',
  `periode_start` date DEFAULT NULL,
  `periode_end` date DEFAULT NULL,
  `no_sk` varchar(255) DEFAULT NULL,
  `tanggal_sk` date DEFAULT NULL,
  `keterangan` text,
  `dim_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`dim_trnon_lulus_id`),
  KEY `fk_t_dim_trnon_lulus_t_dim1_idx` (`dim_id`),
  CONSTRAINT `fk_t_dim_trnon_lulus_t_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=350 DEFAULT CHARSET=latin1;

/*Table structure for table `dimx_dim_update` */

DROP TABLE IF EXISTS `dimx_dim_update`;

CREATE TABLE `dimx_dim_update` (
  `dim_id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(8) DEFAULT NULL,
  `no_usm` varchar(15) DEFAULT NULL,
  `jalur` varchar(20) DEFAULT NULL,
  `user_name` varchar(10) DEFAULT NULL,
  `kbk_id` varchar(20) DEFAULT NULL,
  `ref_kbk_id` int(11) DEFAULT NULL,
  `kpt_prodi` varchar(10) DEFAULT NULL,
  `id_kur` int(4) DEFAULT '0',
  `tahun_kurikulum_id` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `gol_darah` char(2) DEFAULT NULL,
  `golongan_darah_id` int(11) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `jenis_kelamin_id` int(11) DEFAULT NULL,
  `agama` varchar(30) DEFAULT NULL,
  `agama_id` int(11) DEFAULT NULL,
  `alamat` text,
  `kabupaten` varchar(50) DEFAULT NULL,
  `kode_pos` varchar(5) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `hp2` varchar(50) DEFAULT NULL,
  `no_ijazah_sma` varchar(100) DEFAULT NULL,
  `nama_sma` varchar(50) DEFAULT NULL,
  `asal_sekolah_id` int(11) DEFAULT NULL,
  `alamat_sma` text,
  `kabupaten_sma` varchar(100) DEFAULT NULL,
  `telepon_sma` varchar(50) DEFAULT NULL,
  `kodepos_sma` varchar(8) DEFAULT NULL,
  `thn_masuk` int(11) DEFAULT NULL,
  `status_akhir` varchar(50) DEFAULT NULL,
  `nama_ayah` varchar(50) DEFAULT NULL,
  `nama_ibu` varchar(50) DEFAULT NULL,
  `no_hp_ayah` varchar(50) DEFAULT NULL,
  `no_hp_ibu` varchar(50) DEFAULT NULL,
  `alamat_orangtua` text,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `pekerjaan_ayah_id` int(11) DEFAULT NULL,
  `keterangan_pekerjaan_ayah` text,
  `penghasilan_ayah` varchar(50) DEFAULT NULL,
  `penghasilan_ayah_id` int(11) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `pekerjaan_ibu_id` int(11) DEFAULT NULL,
  `keterangan_pekerjaan_ibu` text,
  `penghasilan_ibu` varchar(50) DEFAULT NULL,
  `penghasilan_ibu_id` int(11) DEFAULT NULL,
  `nama_wali` varchar(50) DEFAULT NULL,
  `pekerjaan_wali` varchar(50) DEFAULT NULL,
  `pekerjaan_wali_id` int(11) DEFAULT NULL,
  `keterangan_pekerjaan_wali` text,
  `penghasilan_wali` varchar(50) DEFAULT NULL,
  `penghasilan_wali_id` int(11) DEFAULT NULL,
  `alamat_wali` text,
  `telepon_wali` varchar(20) DEFAULT NULL,
  `no_hp_wali` varchar(50) DEFAULT NULL,
  `pendapatan` varchar(50) DEFAULT NULL,
  `ipk` float DEFAULT '0',
  `anak_ke` tinyint(4) DEFAULT NULL,
  `dari_jlh_anak` tinyint(4) DEFAULT NULL,
  `jumlah_tanggungan` tinyint(4) DEFAULT NULL,
  `nilai_usm` float DEFAULT NULL,
  `score_iq` tinyint(4) DEFAULT NULL,
  `rekomendasi_psikotest` varchar(4) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `kode_foto` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`dim_id`),
  UNIQUE KEY `NIM_UNIQUE` (`nim`),
  KEY `NIM` (`nim`),
  KEY `FK_dimx_dim_thn_krkm` (`tahun_kurikulum_id`),
  KEY `FK_dimx_dim_user` (`user_id`),
  KEY `FK_dimx_dim_ref_kbk` (`ref_kbk_id`),
  KEY `FK_dimx_dim_asal_sekolah` (`asal_sekolah_id`),
  KEY `FK_dimx_dim_golongan_darah` (`golongan_darah_id`),
  KEY `FK_dimx_dim_jenis_kelamin` (`jenis_kelamin_id`),
  KEY `FK_dimx_dim_agama` (`agama_id`),
  KEY `FK_dimx_dim_pekerjaan_ayah` (`pekerjaan_ayah_id`),
  KEY `FK_dimx_dim_penghasilan_ayah` (`penghasilan_ayah_id`),
  KEY `FK_dimx_dim_pekerjaan_ibu` (`pekerjaan_ibu_id`),
  KEY `FK_dimx_dim_penghasilan_ibu` (`penghasilan_ibu_id`),
  KEY `FK_dimx_dim_pekerjaan_wali` (`pekerjaan_wali_id`),
  KEY `FK_dimx_dim_penghasilan_wali_id` (`penghasilan_wali_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3083 DEFAULT CHARSET=latin1;

/*Table structure for table `dimx_histori_prodi` */

DROP TABLE IF EXISTS `dimx_histori_prodi`;

CREATE TABLE `dimx_histori_prodi` (
  `histori_prodi_id` int(11) NOT NULL AUTO_INCREMENT,
  `dim_id` int(11) DEFAULT NULL,
  `nim_old` varchar(8) DEFAULT NULL,
  `ref_kbk_id_old` int(11) DEFAULT NULL,
  `username_old` varchar(20) DEFAULT NULL,
  `email_old` varchar(30) DEFAULT NULL,
  `tahun_pindah` varchar(4) NOT NULL,
  `sem_ta_pindah` int(11) NOT NULL,
  `tgl_pindah` date NOT NULL,
  `nim_new` varchar(8) NOT NULL,
  `ref_kbk_id_new` int(11) NOT NULL,
  `username_new` varchar(20) NOT NULL,
  `email_new` varchar(30) NOT NULL,
  `kelas_new` int(11) DEFAULT NULL,
  `wali_new` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`histori_prodi_id`),
  KEY `FK_dimx_histori_prodi` (`dim_id`),
  CONSTRAINT `FK_dimx_histori_prodi` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Table structure for table `hrdx_dosen` */

DROP TABLE IF EXISTS `hrdx_dosen`;

CREATE TABLE `hrdx_dosen` (
  `dosen_id` int(11) NOT NULL AUTO_INCREMENT,
  `pegawai_id` int(11) DEFAULT NULL,
  `nidn` varchar(10) DEFAULT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `golongan_kepangkatan_id` int(11) DEFAULT NULL,
  `jabatan_akademik_id` int(11) DEFAULT NULL,
  `status_ikatan_kerja_dosen_id` int(11) DEFAULT NULL,
  `gbk_1` int(11) DEFAULT NULL,
  `gbk_2` int(11) DEFAULT NULL,
  `aktif_start` date DEFAULT '0000-00-00',
  `aktif_end` date DEFAULT '0000-00-00',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `temp_id_old` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`dosen_id`),
  KEY `FK_hrdx_dosen` (`golongan_kepangkatan_id`),
  KEY `FK_hrdx_dosen_jab` (`jabatan_akademik_id`),
  KEY `FK_hrdx_dosen_stts` (`status_ikatan_kerja_dosen_id`),
  KEY `FK_hrdx_dosen_gbk` (`gbk_1`),
  KEY `FK_hrdx_dosen_pegawai` (`pegawai_id`),
  KEY `FK_hrdx_dosen_gbk2` (`gbk_2`),
  KEY `FK_hrdx_dosen_prodi` (`prodi_id`),
  CONSTRAINT `FK_hrdx_dosen` FOREIGN KEY (`golongan_kepangkatan_id`) REFERENCES `mref_r_golongan_kepangkatan` (`golongan_kepangkatan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_dosen_gbk` FOREIGN KEY (`gbk_1`) REFERENCES `mref_r_gbk` (`gbk_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_dosen_gbk2` FOREIGN KEY (`gbk_2`) REFERENCES `mref_r_gbk` (`gbk_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_dosen_jab` FOREIGN KEY (`jabatan_akademik_id`) REFERENCES `mref_r_jabatan_akademik` (`jabatan_akademik_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_dosen_pegawai` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_dosen_prodi` FOREIGN KEY (`prodi_id`) REFERENCES `inst_prodi` (`ref_kbk_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_dosen_stts` FOREIGN KEY (`status_ikatan_kerja_dosen_id`) REFERENCES `mref_r_status_ikatan_kerja_dosen` (`status_ikatan_kerja_dosen_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=latin1;

/*Table structure for table `hrdx_pegawai` */

DROP TABLE IF EXISTS `hrdx_pegawai`;

CREATE TABLE `hrdx_pegawai` (
  `pegawai_id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_old_id` varchar(20) DEFAULT NULL,
  `nama` varchar(135) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `nip` varchar(45) DEFAULT NULL,
  `kpt_no` varchar(10) DEFAULT NULL,
  `kbk_id` varchar(20) DEFAULT NULL,
  `ref_kbk_id` int(11) DEFAULT NULL,
  `alias` varchar(9) DEFAULT NULL,
  `posisi` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(60) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama_id` int(11) DEFAULT NULL,
  `jenis_kelamin_id` int(11) DEFAULT NULL,
  `golongan_darah_id` int(11) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `telepon` varchar(45) DEFAULT NULL,
  `alamat` blob,
  `alamat_libur` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(150) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `kabupaten_id` int(11) DEFAULT NULL,
  `kode_pos` varchar(15) DEFAULT NULL,
  `no_ktp` varchar(255) DEFAULT NULL,
  `email` text,
  `ext_num` char(3) DEFAULT NULL,
  `study_area_1` varchar(50) DEFAULT NULL,
  `study_area_2` varchar(50) DEFAULT NULL,
  `jabatan` char(1) DEFAULT NULL,
  `jabatan_akademik_id` int(11) DEFAULT NULL,
  `gbk_1` int(11) DEFAULT NULL,
  `gbk_2` int(11) DEFAULT NULL,
  `status_ikatan_kerja_pegawai_id` int(11) DEFAULT NULL,
  `status_akhir` char(1) DEFAULT NULL,
  `status_aktif_pegawai_id` int(11) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT '0000-00-00',
  `tanggal_keluar` date DEFAULT '0000-00-00',
  `nama_bapak` varchar(50) DEFAULT NULL,
  `nama_ibu` varchar(50) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `status_marital_id` int(11) DEFAULT NULL,
  `nama_p` varchar(50) DEFAULT NULL,
  `tgl_lahir_p` date DEFAULT NULL,
  `tmp_lahir_p` varchar(50) DEFAULT NULL,
  `pekerjaan_ortu` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pegawai_id`),
  KEY `FK_hrdx_pegawai_JK` (`jenis_kelamin_id`),
  KEY `FK_hrdx_pegawai_agama` (`agama_id`),
  KEY `FK_hrdx_pegawai_golda` (`golongan_darah_id`),
  KEY `FK_hrdx_pegawai_kab` (`kabupaten_id`),
  KEY `FK_hrdx_pegawai_sts_aktf` (`status_aktif_pegawai_id`),
  KEY `FK_hrdx_pegawai_sts_iktn` (`status_ikatan_kerja_pegawai_id`),
  KEY `FK_hrdx_pegawai_sts_martl` (`status_marital_id`),
  KEY `FK_hrdx_pegawai_user` (`user_id`),
  KEY `FK_hrdx_pegawai_jabatan_akademik` (`jabatan_akademik_id`),
  KEY `FK_hrdx_pegawai_kbk` (`ref_kbk_id`),
  CONSTRAINT `FK_hrdx_pegawai_JK` FOREIGN KEY (`jenis_kelamin_id`) REFERENCES `mref_r_jenis_kelamin` (`jenis_kelamin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_pegawai_agama` FOREIGN KEY (`agama_id`) REFERENCES `mref_r_agama` (`agama_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_pegawai_golda` FOREIGN KEY (`golongan_darah_id`) REFERENCES `mref_r_golongan_darah` (`golongan_darah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_pegawai_jabatan_akademik` FOREIGN KEY (`jabatan_akademik_id`) REFERENCES `mref_r_jabatan_akademik` (`jabatan_akademik_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_pegawai_kab` FOREIGN KEY (`kabupaten_id`) REFERENCES `mref_r_kabupaten` (`kabupaten_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_pegawai_kbk` FOREIGN KEY (`ref_kbk_id`) REFERENCES `inst_prodi` (`ref_kbk_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_pegawai_sts_aktf` FOREIGN KEY (`status_aktif_pegawai_id`) REFERENCES `mref_r_status_aktif_pegawai` (`status_aktif_pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_pegawai_sts_iktn` FOREIGN KEY (`status_ikatan_kerja_pegawai_id`) REFERENCES `mref_r_status_ikatan_kerja_pegawai` (`status_ikatan_kerja_pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_pegawai_sts_martl` FOREIGN KEY (`status_marital_id`) REFERENCES `mref_r_status_marital` (`status_marital_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_pegawai_user` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=384 DEFAULT CHARSET=latin1;

/*Table structure for table `hrdx_pendidikan` */

DROP TABLE IF EXISTS `hrdx_pendidikan`;

CREATE TABLE `hrdx_pendidikan` (
  `pendidikan_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(20) NOT NULL DEFAULT '',
  `no` int(11) NOT NULL,
  `jenjang` varchar(40) DEFAULT NULL,
  `gelar` varchar(10) DEFAULT NULL,
  `universitas` varchar(100) DEFAULT NULL,
  `progdi` varchar(200) DEFAULT NULL,
  `bidang` varchar(200) DEFAULT NULL,
  `thn_masuk` date DEFAULT NULL,
  `thn_lulus` date DEFAULT NULL,
  `judul_ta` varchar(255) DEFAULT NULL,
  `ipk` float DEFAULT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`pendidikan_id`),
  KEY `fk_t_pendidikan_t_profile1_idx` (`profile_id`),
  CONSTRAINT `fk_t_pendidikan_t_profile1` FOREIGN KEY (`profile_id`) REFERENCES `hrdx_profile` (`profile_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=latin1;

/*Table structure for table `hrdx_pengajar` */

DROP TABLE IF EXISTS `hrdx_pengajar`;

CREATE TABLE `hrdx_pengajar` (
  `pengajar_id` int(11) NOT NULL AUTO_INCREMENT,
  `ta` int(4) NOT NULL DEFAULT '0',
  `id_kur` int(4) NOT NULL DEFAULT '0',
  `kode_mk` varchar(11) NOT NULL,
  `id` varchar(20) NOT NULL,
  `role` char(1) NOT NULL DEFAULT '',
  `kurikulum_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`pengajar_id`),
  KEY `fk_t_pengajar_t_kurikulum1_idx` (`kurikulum_id`),
  KEY `FK_hrdx_pengajar` (`pegawai_id`),
  CONSTRAINT `FK_hrdx_pengajar_pegawai` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_t_pengajar_t_kurikulum1` FOREIGN KEY (`kurikulum_id`) REFERENCES `krkm_kuliah` (`kuliah_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1770 DEFAULT CHARSET=latin1;

/*Table structure for table `hrdx_profile` */

DROP TABLE IF EXISTS `hrdx_profile`;

CREATE TABLE `hrdx_profile` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(20) NOT NULL DEFAULT '',
  `nip` varchar(20) NOT NULL DEFAULT '',
  `kpt_no` varchar(10) NOT NULL DEFAULT '',
  `user_name` varchar(20) DEFAULT NULL,
  `nama` varchar(50) NOT NULL DEFAULT '',
  `posisi` varchar(100) DEFAULT NULL,
  `alias` varchar(5) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `jenis_kelamin` char(1) NOT NULL DEFAULT '',
  `gol_darah` char(2) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `tgl_keluar` date NOT NULL,
  `agama` varchar(30) DEFAULT NULL,
  `kbk_id` varchar(20) DEFAULT NULL,
  `ext_num` char(3) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat_libur` varchar(100) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `kode_pos` varchar(5) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `ktp` varchar(255) DEFAULT NULL,
  `pendidikan` varchar(255) DEFAULT NULL,
  `jabatan` varchar(20) NOT NULL DEFAULT '',
  `pendidikan_tertinggi` varchar(20) NOT NULL DEFAULT 'S1',
  `study_area1` varchar(50) NOT NULL DEFAULT '',
  `study_area2` varchar(50) NOT NULL DEFAULT '',
  `status` char(1) NOT NULL DEFAULT 'S',
  `nama_bapak` varchar(50) DEFAULT NULL,
  `nama_ibu` varchar(50) DEFAULT NULL,
  `pekerjaan_ortu` varchar(100) DEFAULT NULL,
  `nama_p` varchar(50) DEFAULT NULL,
  `tmp_lahir_p` varchar(50) DEFAULT NULL,
  `tgl_lahir_p` date NOT NULL,
  `ket` text NOT NULL,
  `status_akhir` varchar(5) NOT NULL DEFAULT 'A',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`profile_id`),
  KEY `ID` (`profile_id`),
  KEY `NAMA` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=latin1;

/*Table structure for table `hrdx_r_staf_role` */

DROP TABLE IF EXISTS `hrdx_r_staf_role`;

CREATE TABLE `hrdx_r_staf_role` (
  `staf_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`staf_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Table structure for table `hrdx_riwayat_pendidikan` */

DROP TABLE IF EXISTS `hrdx_riwayat_pendidikan`;

CREATE TABLE `hrdx_riwayat_pendidikan` (
  `riwayat_pendidikan_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenjang_id` int(11) DEFAULT NULL,
  `universitas` varchar(100) DEFAULT NULL,
  `jurusan` varchar(200) DEFAULT NULL,
  `thn_mulai` varchar(50) DEFAULT NULL,
  `thn_selesai` varchar(50) DEFAULT NULL,
  `ipk` varchar(15) DEFAULT NULL,
  `gelar` varchar(15) DEFAULT NULL,
  `judul_ta` varchar(255) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `jenjang` varchar(40) DEFAULT NULL,
  `id_old` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`riwayat_pendidikan_id`),
  KEY `fk_t_pendidikan_t_profile1_idx` (`profile_id`),
  KEY `FK_hrdx_riwayat_pendidikan_new_pegawai` (`pegawai_id`),
  KEY `FK_hrdx_riwayat_pendidikan_new_jenjang` (`jenjang_id`),
  CONSTRAINT `FK_hrdx_riwayat_pendidikan_new_jenjang` FOREIGN KEY (`jenjang_id`) REFERENCES `mref_r_jenjang` (`jenjang_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_riwayat_pendidikan_new_pegawai` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=362 DEFAULT CHARSET=latin1;

/*Table structure for table `hrdx_riwayat_pendidikan_old` */

DROP TABLE IF EXISTS `hrdx_riwayat_pendidikan_old`;

CREATE TABLE `hrdx_riwayat_pendidikan_old` (
  `riwayat_pendidikan_id` int(11) DEFAULT NULL,
  `jenjang_id` int(11) DEFAULT NULL,
  `universitas` varchar(180) DEFAULT NULL,
  `jurusan` varchar(150) DEFAULT NULL,
  `thn_mulai` varchar(150) DEFAULT NULL,
  `thn_selesai` varchar(150) DEFAULT NULL,
  `ipk` varchar(15) DEFAULT NULL,
  `gelar` varchar(15) DEFAULT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `staf_id` int(11) DEFAULT NULL,
  `judul_ta` blob,
  `website` varchar(765) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(96) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(96) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(96) DEFAULT NULL,
  KEY `FK_hrdx_riwayat_pendidikan_dosen` (`dosen_id`),
  KEY `FK_hrdx_riwayat_pendidikan_staf` (`staf_id`),
  KEY `FK_hrdx_riwayat_pendidikan_jenjang` (`jenjang_id`),
  CONSTRAINT `FK_hrdx_riwayat_pendidikan_dosen` FOREIGN KEY (`dosen_id`) REFERENCES `hrdx_dosen` (`dosen_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_riwayat_pendidikan_jenjang` FOREIGN KEY (`jenjang_id`) REFERENCES `mref_r_jenjang` (`jenjang_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_riwayat_pendidikan_staf` FOREIGN KEY (`staf_id`) REFERENCES `hrdx_staf` (`staf_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `hrdx_staf` */

DROP TABLE IF EXISTS `hrdx_staf`;

CREATE TABLE `hrdx_staf` (
  `staf_id` int(11) NOT NULL AUTO_INCREMENT,
  `pegawai_id` int(11) DEFAULT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `staf_role_id` int(11) DEFAULT NULL,
  `aktif_start` date DEFAULT '0000-00-00',
  `aktif_end` date DEFAULT '0000-00-00',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `temp_id_old` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`staf_id`),
  KEY `FK_hrdx_staf_pegawai` (`pegawai_id`),
  KEY `FK_hrdx_staf_prodi` (`prodi_id`),
  KEY `FK_hrdx_staf_role` (`staf_role_id`),
  CONSTRAINT `FK_hrdx_staf_pegawai` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_staf_prodi` FOREIGN KEY (`prodi_id`) REFERENCES `inst_prodi` (`ref_kbk_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hrdx_staf_role` FOREIGN KEY (`staf_role_id`) REFERENCES `hrdx_r_staf_role` (`staf_role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=latin1;

/*Table structure for table `inst_fakultas` */

DROP TABLE IF EXISTS `inst_fakultas`;

CREATE TABLE `inst_fakultas` (
  `fakultas_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`fakultas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `inst_instansi` */

DROP TABLE IF EXISTS `inst_instansi`;

CREATE TABLE `inst_instansi` (
  `instansi_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `inisial` varchar(45) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varbinary(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`instansi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `inst_pejabat` */

DROP TABLE IF EXISTS `inst_pejabat`;

CREATE TABLE `inst_pejabat` (
  `pejabat_id` int(11) NOT NULL AUTO_INCREMENT,
  `pegawai_id` int(11) DEFAULT NULL,
  `struktur_jabatan_id` int(11) DEFAULT NULL,
  `awal_masa_kerja` date DEFAULT NULL,
  `akhir_masa_kerja` date DEFAULT NULL,
  `no_sk` varchar(45) DEFAULT NULL,
  `file_sk` text,
  `kode_file` varchar(200) DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varbinary(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`pejabat_id`),
  KEY `FK_pejabat_struktur_jabatan_idx` (`struktur_jabatan_id`),
  KEY `FK_inst_pejabat_pegawai` (`pegawai_id`),
  CONSTRAINT `FK_inst_pejabat_pegawai` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_pejabat_struktur_jabatan` FOREIGN KEY (`struktur_jabatan_id`) REFERENCES `inst_struktur_jabatan` (`struktur_jabatan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=357 DEFAULT CHARSET=latin1;

/*Table structure for table `inst_prodi` */

DROP TABLE IF EXISTS `inst_prodi`;

CREATE TABLE `inst_prodi` (
  `ref_kbk_id` int(11) NOT NULL AUTO_INCREMENT,
  `kbk_id` varchar(20) DEFAULT NULL,
  `kpt_id` varchar(10) DEFAULT NULL,
  `jenjang_id` int(11) DEFAULT NULL,
  `kbk_ind` varchar(100) DEFAULT NULL,
  `singkatan_prodi` varchar(50) DEFAULT NULL,
  `kbk_ing` varchar(100) DEFAULT NULL,
  `nama_kopertis_ind` varchar(255) DEFAULT NULL,
  `nama_kopertis_ing` varchar(255) DEFAULT NULL,
  `short_desc_ind` varchar(255) DEFAULT NULL,
  `short_desc_ing` varchar(255) DEFAULT NULL,
  `desc_ind` text,
  `desc_ing` text,
  `status` tinyint(1) DEFAULT '1',
  `is_jenjang_all` tinyint(1) DEFAULT '1',
  `is_public` tinyint(1) DEFAULT '1',
  `is_hidden` tinyint(1) DEFAULT '0',
  `fakultas_id` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ref_kbk_id`),
  UNIQUE KEY `KBK_ID_UNIQUE` (`kbk_id`),
  KEY `FK_krkm_r_kbk` (`jenjang_id`),
  KEY `fk_inst_fakultas_inst_prodi` (`fakultas_id`),
  CONSTRAINT `FK_krkm_r_kbk` FOREIGN KEY (`jenjang_id`) REFERENCES `inst_r_jenjang` (`jenjang_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_inst_fakultas_inst_prodi` FOREIGN KEY (`fakultas_id`) REFERENCES `inst_fakultas` (`fakultas_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Table structure for table `inst_r_jenjang` */

DROP TABLE IF EXISTS `inst_r_jenjang`;

CREATE TABLE `inst_r_jenjang` (
  `jenjang_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(15) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`jenjang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `inst_struktur_jabatan` */

DROP TABLE IF EXISTS `inst_struktur_jabatan`;

CREATE TABLE `inst_struktur_jabatan` (
  `struktur_jabatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `instansi_id` int(11) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `inisial` varchar(45) DEFAULT NULL,
  `is_multi_tenant` tinyint(1) DEFAULT '0',
  `mata_anggaran` tinyint(1) DEFAULT '0',
  `laporan` tinyint(1) DEFAULT '0',
  `unit_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varbinary(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`struktur_jabatan_id`),
  KEY `FK_struktur_jabatan_instansi_idx` (`instansi_id`),
  KEY `FK_struktur_jabatan_struktur_jabatan_idx` (`parent`),
  KEY `FK_struktur_jabatan_unit_idx` (`unit_id`),
  CONSTRAINT `FK_struktur_jabatan_instansi` FOREIGN KEY (`instansi_id`) REFERENCES `inst_instansi` (`instansi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_struktur_jabatan_struktur_jabatan` FOREIGN KEY (`parent`) REFERENCES `inst_struktur_jabatan` (`struktur_jabatan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_struktur_jabatan_unit` FOREIGN KEY (`unit_id`) REFERENCES `inst_unit` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=latin1;

/*Table structure for table `inst_unit` */

DROP TABLE IF EXISTS `inst_unit`;

CREATE TABLE `inst_unit` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `instansi_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `inisial` varchar(45) DEFAULT NULL,
  `desc` text,
  `kepala` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varbinary(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`unit_id`),
  KEY `FK_unit_struktur_jabatan_idx` (`kepala`),
  KEY `FK_unit_instansi_idx` (`instansi_id`),
  CONSTRAINT `FK_unit_instansi` FOREIGN KEY (`instansi_id`) REFERENCES `inst_instansi` (`instansi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_unit_struktur_jabatan` FOREIGN KEY (`kepala`) REFERENCES `inst_struktur_jabatan` (`struktur_jabatan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

/*Table structure for table `invt_arsip_vendor` */

DROP TABLE IF EXISTS `invt_arsip_vendor`;

CREATE TABLE `invt_arsip_vendor` (
  `arsip_vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) DEFAULT NULL,
  `judul_arsip` varchar(150) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`arsip_vendor_id`),
  KEY `FK_invt_arsip_vendor` (`vendor_id`),
  CONSTRAINT `FK_invt_arsip_vendor` FOREIGN KEY (`vendor_id`) REFERENCES `invt_r_vendor` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_barang` */

DROP TABLE IF EXISTS `invt_barang`;

CREATE TABLE `invt_barang` (
  `barang_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(200) DEFAULT NULL,
  `serial_number` varchar(100) DEFAULT NULL,
  `jenis_barang_id` int(11) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT '0',
  `supplier` varchar(150) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `harga_per_barang` decimal(10,0) DEFAULT NULL,
  `total_harga` decimal(10,0) DEFAULT '0',
  `tanggal_masuk` date DEFAULT NULL,
  `satuan_id` int(11) DEFAULT NULL,
  `desc` text,
  `kapasitas` varchar(50) DEFAULT NULL,
  `nama_file` varchar(200) DEFAULT NULL,
  `kode_file` varchar(200) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`barang_id`),
  KEY `FK_invt_barang` (`jenis_barang_id`),
  KEY `FK_invt_barang_kategori` (`kategori_id`),
  KEY `FK_invt_barang_satuan` (`satuan_id`),
  KEY `FK_invt_barang_unit` (`unit_id`),
  KEY `FK_invt_barang_brand` (`brand_id`),
  KEY `FK_invt_barang_vendor` (`vendor_id`),
  CONSTRAINT `FK_invt_barang` FOREIGN KEY (`jenis_barang_id`) REFERENCES `invt_r_jenis_barang` (`jenis_barang_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_invt_barang_brand` FOREIGN KEY (`brand_id`) REFERENCES `invt_r_brand` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_invt_barang_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `invt_r_kategori` (`kategori_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_invt_barang_satuan` FOREIGN KEY (`satuan_id`) REFERENCES `invt_r_satuan` (`satuan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_invt_barang_unit` FOREIGN KEY (`unit_id`) REFERENCES `invt_r_unit` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_invt_barang_vendor` FOREIGN KEY (`vendor_id`) REFERENCES `invt_r_vendor` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_detail_peminjaman_barang` */

DROP TABLE IF EXISTS `invt_detail_peminjaman_barang`;

CREATE TABLE `invt_detail_peminjaman_barang` (
  `detail_peminjaman_barang_id` int(11) NOT NULL AUTO_INCREMENT,
  `peminjaman_barang_id` int(11) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `jumlah_rusak` int(11) DEFAULT '0',
  PRIMARY KEY (`detail_peminjaman_barang_id`),
  KEY `FK_invt_detail_peminjaman_barang` (`peminjaman_barang_id`),
  KEY `FK_invt_detail_peminjaman_barang_barang` (`barang_id`),
  CONSTRAINT `FK_invt_detail_peminjaman_barang` FOREIGN KEY (`peminjaman_barang_id`) REFERENCES `invt_peminjaman_barang` (`peminjaman_barang_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_invt_detail_peminjaman_barang_barang` FOREIGN KEY (`barang_id`) REFERENCES `invt_barang` (`barang_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_file_vendor` */

DROP TABLE IF EXISTS `invt_file_vendor`;

CREATE TABLE `invt_file_vendor` (
  `file_vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `arsip_vendor_id` int(11) DEFAULT NULL,
  `nama_file` varchar(250) DEFAULT NULL,
  `kode_file` varchar(250) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`file_vendor_id`),
  KEY `FK_invt_file_vendor` (`arsip_vendor_id`),
  CONSTRAINT `FK_invt_file_vendor` FOREIGN KEY (`arsip_vendor_id`) REFERENCES `invt_arsip_vendor` (`arsip_vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_keterangan_pengeluaran` */

DROP TABLE IF EXISTS `invt_keterangan_pengeluaran`;

CREATE TABLE `invt_keterangan_pengeluaran` (
  `keterangan_pengeluaran_id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_keluar` date NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `keterangan` text NOT NULL,
  `total_barang_keluar` int(11) DEFAULT '0',
  `oleh` int(11) DEFAULT NULL,
  `lokasi_distribusi` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`keterangan_pengeluaran_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_pelaporan_barang_rusak` */

DROP TABLE IF EXISTS `invt_pelaporan_barang_rusak`;

CREATE TABLE `invt_pelaporan_barang_rusak` (
  `pelaporan_barang_rusak` int(11) NOT NULL AUTO_INCREMENT,
  `barang_id` int(11) DEFAULT NULL,
  `kode_barang` varchar(150) DEFAULT NULL,
  `pelapor` int(11) DEFAULT NULL,
  `jumlah_rusak` int(11) DEFAULT '0',
  `tgl_lapor` date DEFAULT NULL,
  `deskripsi` text,
  `nama_file` varchar(200) DEFAULT NULL,
  `status_perbaikan` tinyint(1) DEFAULT '0',
  `tgl_perbaikan` date DEFAULT NULL,
  `kode_file` varchar(200) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`pelaporan_barang_rusak`),
  KEY `FK_invt_barang_rusak` (`barang_id`),
  KEY `FK_invt_barang_rusak_pelapor` (`pelapor`),
  KEY `FK_invt_pelaporan_barang_rusak_unit` (`unit_id`),
  CONSTRAINT `FK_invt_barang_rusak` FOREIGN KEY (`barang_id`) REFERENCES `invt_barang` (`barang_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_invt_barang_rusak_pelapor` FOREIGN KEY (`pelapor`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_invt_pelaporan_barang_rusak_unit` FOREIGN KEY (`unit_id`) REFERENCES `invt_r_unit` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_pemindahan_barang` */

DROP TABLE IF EXISTS `invt_pemindahan_barang`;

CREATE TABLE `invt_pemindahan_barang` (
  `pemindahan_barang_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengeluaran_barang_id` int(11) DEFAULT NULL,
  `lokasi_awal_id` int(11) DEFAULT NULL,
  `kode_inventori_awal` varchar(50) DEFAULT NULL,
  `lokasi_akhir_id` int(11) DEFAULT NULL,
  `kode_inventori` varchar(50) DEFAULT NULL,
  `tanggal_pindah` date DEFAULT NULL,
  `oleh` int(11) DEFAULT NULL,
  `status_transaksi` varchar(50) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`pemindahan_barang_id`),
  KEY `FK_invt_pemindahan_barang` (`pengeluaran_barang_id`),
  CONSTRAINT `FK_invt_pemindahan_barang` FOREIGN KEY (`pengeluaran_barang_id`) REFERENCES `invt_pengeluaran_barang` (`pengeluaran_barang_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_peminjaman_barang` */

DROP TABLE IF EXISTS `invt_peminjaman_barang`;

CREATE TABLE `invt_peminjaman_barang` (
  `peminjaman_barang_id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_pinjam` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `oleh` int(11) DEFAULT NULL,
  `deskripsi` text,
  `unit_id` int(11) DEFAULT NULL,
  `status_approval` int(1) DEFAULT '0' COMMENT '0: belum; 1:sudah; 2:reject',
  `approved_by` int(11) DEFAULT NULL,
  `status_kembali` tinyint(1) DEFAULT '0',
  `tgl_realisasi_kembali` date DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`peminjaman_barang_id`),
  KEY `FK_invt_peminjaman_approved_by` (`approved_by`),
  KEY `FK_invt_peminjaman_oleh` (`oleh`),
  KEY `FK_invt_peminjaman_barang_unit` (`unit_id`),
  KEY `FK_invt_peminjaman_barang_status_approval` (`status_approval`),
  CONSTRAINT `FK_invt_peminjaman_approved_by` FOREIGN KEY (`approved_by`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_invt_peminjaman_barang_unit` FOREIGN KEY (`unit_id`) REFERENCES `invt_r_unit` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_invt_peminjaman_oleh` FOREIGN KEY (`oleh`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_pengeluaran_barang` */

DROP TABLE IF EXISTS `invt_pengeluaran_barang`;

CREATE TABLE `invt_pengeluaran_barang` (
  `pengeluaran_barang_id` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan_pengeluaran_id` int(11) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `kode_inventori` varchar(120) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT '0',
  `lokasi_id` int(11) DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `status_akhir` varchar(50) DEFAULT 'DISTRIBUSI' COMMENT '0:distribusi, 1:pindah, 2: pinjam, 3: rusak, 4: musnah',
  `is_has_pic` tinyint(1) DEFAULT '0' COMMENT '0: no, 1: yes',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varbinary(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`pengeluaran_barang_id`),
  KEY `FK_invt_detail_pengeluaran_barang_barang` (`barang_id`),
  KEY `FK_invt_pengeluaran_barang` (`lokasi_id`),
  KEY `FK_invt_pengeluaran_barang_STATUS` (`status_akhir`),
  KEY `FK_invt_pengeluaran_barang_keterangan` (`keterangan_pengeluaran_id`),
  CONSTRAINT `FK_invt_detail_pengeluaran_barang_barang` FOREIGN KEY (`barang_id`) REFERENCES `invt_barang` (`barang_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_invt_pengeluaran_barang` FOREIGN KEY (`lokasi_id`) REFERENCES `invt_r_lokasi` (`lokasi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_invt_pengeluaran_barang_STATUS` FOREIGN KEY (`status_akhir`) REFERENCES `invt_r_status` (`nama`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_invt_pengeluaran_barang_keterangan` FOREIGN KEY (`keterangan_pengeluaran_id`) REFERENCES `invt_keterangan_pengeluaran` (`keterangan_pengeluaran_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_pic_barang` */

DROP TABLE IF EXISTS `invt_pic_barang`;

CREATE TABLE `invt_pic_barang` (
  `pic_barang_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengeluaran_barang_id` int(11) DEFAULT NULL COMMENT 'id distribusi barang',
  `pegawai_id` int(11) DEFAULT NULL COMMENT 'pegawai PIC barang',
  `tgl_assign` date DEFAULT NULL,
  `keterangan` text,
  `is_unassign` tinyint(1) DEFAULT '0',
  `tgl_unassign` date DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pic_barang_id`),
  KEY `FK_invt_pic_barang` (`pengeluaran_barang_id`),
  KEY `FK_invt_pic_barang_pegawai` (`pegawai_id`),
  CONSTRAINT `FK_invt_pic_barang` FOREIGN KEY (`pengeluaran_barang_id`) REFERENCES `invt_pengeluaran_barang` (`pengeluaran_barang_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_invt_pic_barang_pegawai` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_pic_barang_file` */

DROP TABLE IF EXISTS `invt_pic_barang_file`;

CREATE TABLE `invt_pic_barang_file` (
  `pic_barang_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_file` varchar(250) DEFAULT NULL,
  `kode_file` varchar(250) DEFAULT NULL,
  `pic_barang_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pic_barang_file_id`),
  KEY `FK_invt_pic_barang_file` (`pic_barang_id`),
  CONSTRAINT `FK_invt_pic_barang_file` FOREIGN KEY (`pic_barang_id`) REFERENCES `invt_pic_barang` (`pic_barang_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_r_brand` */

DROP TABLE IF EXISTS `invt_r_brand`;

CREATE TABLE `invt_r_brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_r_jenis_barang` */

DROP TABLE IF EXISTS `invt_r_jenis_barang`;

CREATE TABLE `invt_r_jenis_barang` (
  `jenis_barang_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`jenis_barang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_r_kategori` */

DROP TABLE IF EXISTS `invt_r_kategori`;

CREATE TABLE `invt_r_kategori` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_r_lokasi` */

DROP TABLE IF EXISTS `invt_r_lokasi`;

CREATE TABLE `invt_r_lokasi` (
  `lokasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `nama_lokasi` varchar(50) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`lokasi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_r_satuan` */

DROP TABLE IF EXISTS `invt_r_satuan`;

CREATE TABLE `invt_r_satuan` (
  `satuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`satuan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_r_status` */

DROP TABLE IF EXISTS `invt_r_status`;

CREATE TABLE `invt_r_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`status_id`),
  UNIQUE KEY `status_unique` (`nama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_r_unit` */

DROP TABLE IF EXISTS `invt_r_unit`;

CREATE TABLE `invt_r_unit` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_r_vendor` */

DROP TABLE IF EXISTS `invt_r_vendor`;

CREATE TABLE `invt_r_vendor` (
  `vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` varchar(150) NOT NULL,
  `link` varchar(250) DEFAULT NULL,
  `contact_person` varchar(200) DEFAULT NULL,
  `telp_contact_person` varchar(15) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_summary_jumlah` */

DROP TABLE IF EXISTS `invt_summary_jumlah`;

CREATE TABLE `invt_summary_jumlah` (
  `summary_jumlah_id` int(11) NOT NULL AUTO_INCREMENT,
  `barang_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `total_jumlah` int(11) DEFAULT NULL,
  `jumlah_distribusi` int(11) DEFAULT '0',
  `jumlah_gudang` int(11) DEFAULT '0',
  `jumlah_rusak` int(11) DEFAULT '0',
  `jumlah_pinjam` int(11) DEFAULT '0',
  `jumlah_musnah` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`summary_jumlah_id`),
  KEY `FK_invt_summary_jumlah` (`barang_id`),
  CONSTRAINT `FK_invt_summary_jumlah` FOREIGN KEY (`barang_id`) REFERENCES `invt_barang` (`barang_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `invt_unit_charged` */

DROP TABLE IF EXISTS `invt_unit_charged`;

CREATE TABLE `invt_unit_charged` (
  `unit_charged_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`unit_charged_id`),
  KEY `FK_invt_unit_user_unit` (`unit_id`),
  KEY `FK_invt_unit_user_user` (`user_id`),
  CONSTRAINT `FK_invt_unit_user_unit` FOREIGN KEY (`unit_id`) REFERENCES `invt_r_unit` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_invt_unit_user_user` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `jdwl_jadwal` */

DROP TABLE IF EXISTS `jdwl_jadwal`;

CREATE TABLE `jdwl_jadwal` (
  `jadwal_id` int(11) NOT NULL AUTO_INCREMENT,
  `ta` int(11) DEFAULT '0',
  `sem_ta` int(11) DEFAULT '0',
  `kuliah_id` int(11) NOT NULL,
  `type` tinyint(1) DEFAULT '1',
  `kelas_id` int(11) NOT NULL,
  `hari_id` int(11) NOT NULL,
  `lokasi_id` int(11) NOT NULL,
  `successor` int(11) DEFAULT NULL,
  `predecessor` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`jadwal_id`),
  KEY `successor_constraint` (`successor`),
  KEY `predeccessor_constraint` (`predecessor`),
  KEY `kuliah_id_constraint` (`kuliah_id`),
  KEY `kelas_id_constraint` (`kelas_id`),
  KEY `lokasi_id_constraint` (`lokasi_id`),
  CONSTRAINT `kelas_id_constraint` FOREIGN KEY (`kelas_id`) REFERENCES `adak_kelas` (`kelas_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kuliah_id_constraint` FOREIGN KEY (`kuliah_id`) REFERENCES `krkm_kuliah` (`kuliah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lokasi_id_constraint` FOREIGN KEY (`lokasi_id`) REFERENCES `mref_r_lokasi` (`lokasi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `predeccessor_constraint` FOREIGN KEY (`predecessor`) REFERENCES `jdwl_jadwal` (`jadwal_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `successor_constraint` FOREIGN KEY (`successor`) REFERENCES `jdwl_jadwal` (`jadwal_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1075 DEFAULT CHARSET=latin1;

/*Table structure for table `jdwl_jadwal_sesi` */

DROP TABLE IF EXISTS `jdwl_jadwal_sesi`;

CREATE TABLE `jdwl_jadwal_sesi` (
  `jadwal_sesi_id` int(11) NOT NULL AUTO_INCREMENT,
  `jadwal_id` int(11) DEFAULT NULL,
  `sesi_id` int(11) DEFAULT NULL,
  `sesi_order` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`jadwal_sesi_id`),
  KEY `sesi_id_constraint` (`sesi_id`),
  KEY `jadwal_id_constraint` (`jadwal_id`),
  CONSTRAINT `jadwal_id_constraint` FOREIGN KEY (`jadwal_id`) REFERENCES `jdwl_jadwal` (`jadwal_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sesi_id_constraint` FOREIGN KEY (`sesi_id`) REFERENCES `jdwl_r_sesi` (`sesi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1308 DEFAULT CHARSET=latin1;

/*Table structure for table `jdwl_r_sesi` */

DROP TABLE IF EXISTS `jdwl_r_sesi`;

CREATE TABLE `jdwl_r_sesi` (
  `sesi_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) DEFAULT NULL,
  `start` time DEFAULT NULL,
  `end` time DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`sesi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Table structure for table `kmhs_detail_kasus` */

DROP TABLE IF EXISTS `kmhs_detail_kasus`;

CREATE TABLE `kmhs_detail_kasus` (
  `detail_kasus_id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(8) NOT NULL DEFAULT '',
  `dim_id` int(11) NOT NULL,
  `tgl_kasus` date NOT NULL,
  `jenis_kasus` varchar(20) NOT NULL DEFAULT '',
  `deskripsi` text,
  `no_form` varchar(20) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`detail_kasus_id`),
  KEY `fk_t_detail_kasus_t_dim1_idx` (`dim_id`),
  CONSTRAINT `fk_t_detail_kasus_t_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `kmhs_master_kasus` */

DROP TABLE IF EXISTS `kmhs_master_kasus`;

CREATE TABLE `kmhs_master_kasus` (
  `master_kasus` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(8) NOT NULL DEFAULT '',
  `no_sp1` varchar(50) NOT NULL DEFAULT '',
  `tgl_sp1` date NOT NULL,
  `uraian_sp1` text,
  `no_sp2` varchar(50) DEFAULT NULL,
  `tgl_sp2` date DEFAULT NULL,
  `uraian_sp2` text,
  `no_sk` varchar(50) DEFAULT NULL,
  `tgl_sk` date DEFAULT NULL,
  `uraian_sk` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `dim_id` int(11) NOT NULL,
  PRIMARY KEY (`master_kasus`),
  UNIQUE KEY `NIM_UNIQUE` (`nim`),
  KEY `fk_t_master_kasus_t_dim1_idx` (`dim_id`),
  CONSTRAINT `fk_t_master_kasus_t_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `kmhs_nilai_perilaku` */

DROP TABLE IF EXISTS `kmhs_nilai_perilaku`;

CREATE TABLE `kmhs_nilai_perilaku` (
  `nilai_perilaku_id` int(11) NOT NULL AUTO_INCREMENT,
  `ta` varchar(30) NOT NULL,
  `sem_ta` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `nim` varchar(8) NOT NULL,
  `kriteria` varchar(4) NOT NULL,
  `nilai` int(11) DEFAULT NULL,
  `kriteria_nilai_perilaku_id` int(11) DEFAULT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`nilai_perilaku_id`),
  KEY `KRITERIA` (`kriteria`),
  KEY `NIM` (`nim`),
  KEY `fk_t_nilai_perilaku_t_kriteria_nilai_perilaku1_idx` (`kriteria_nilai_perilaku_id`),
  KEY `fk_t_nilai_perilaku_t_dim1_idx` (`dim_id`),
  CONSTRAINT `fk_t_nilai_perilaku_t_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_t_nilai_perilaku_t_kriteria_nilai_perilaku1` FOREIGN KEY (`kriteria_nilai_perilaku_id`) REFERENCES `kmhs_r_kriteria_nilai_perilaku` (`kriteria_nilai_perilaku_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17383 DEFAULT CHARSET=latin1;

/*Table structure for table `kmhs_nilai_perilaku_arsip` */

DROP TABLE IF EXISTS `kmhs_nilai_perilaku_arsip`;

CREATE TABLE `kmhs_nilai_perilaku_arsip` (
  `nilai_perilaku_arsip_id` int(11) NOT NULL AUTO_INCREMENT,
  `ta` varchar(30) NOT NULL,
  `sem_ta` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `nim` varchar(8) NOT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `kriteria` varchar(4) NOT NULL,
  `kriteria_nilai_perilaku_id` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`nilai_perilaku_arsip_id`),
  KEY `KRITERIA` (`kriteria`),
  KEY `NIM` (`nim`),
  KEY `fk_t_nilai_perilaku_arsip_t_kriteria_nilai_perilaku1_idx` (`kriteria_nilai_perilaku_id`),
  KEY `fk_t_nilai_perilaku_arsip_t_dim1_idx` (`dim_id`),
  CONSTRAINT `fk_t_nilai_perilaku_arsip_t_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_t_nilai_perilaku_arsip_t_kriteria_nilai_perilaku1` FOREIGN KEY (`kriteria_nilai_perilaku_id`) REFERENCES `kmhs_r_kriteria_nilai_perilaku` (`kriteria_nilai_perilaku_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `kmhs_nilai_perilaku_as` */

DROP TABLE IF EXISTS `kmhs_nilai_perilaku_as`;

CREATE TABLE `kmhs_nilai_perilaku_as` (
  `nilai_perilaku_as_id` int(11) NOT NULL AUTO_INCREMENT,
  `ta` varchar(30) NOT NULL,
  `sem_ta` int(11) NOT NULL,
  `nim` varchar(8) NOT NULL,
  `k1` varchar(11) DEFAULT NULL COMMENT 'Kebersihan Kamar TIdur/Tempat Tidur',
  `k2` varchar(11) DEFAULT NULL COMMENT 'Kerapian Kamar/Tempat Tidur',
  `k3` varchar(11) DEFAULT NULL COMMENT 'Kerapian Almari',
  `k4` varchar(11) DEFAULT NULL COMMENT 'Ketepatan Waktu Keluar/Masuk Kampus',
  `k5` varchar(11) DEFAULT NULL COMMENT 'Ketepatan Waktu Hadir Kuliah',
  `K6` varchar(11) DEFAULT NULL COMMENT 'Kehadiran Saat Makan Pagi',
  `k7` varchar(11) DEFAULT NULL COMMENT 'Kehadiran Saat Makan Siang',
  `k8` varchar(11) DEFAULT NULL COMMENT 'Kehadiran Saat Makan Malam',
  `k9` varchar(11) DEFAULT NULL COMMENT 'Kedisiplinan',
  `k10` varchar(11) DEFAULT NULL COMMENT 'Ketertiban',
  `k11` varchar(11) DEFAULT NULL COMMENT 'Intens Pemanggilan Karena Bermasalah',
  `k12` varchar(11) DEFAULT NULL COMMENT 'Perilaku/Sikap',
  `na` varchar(11) DEFAULT NULL,
  `grade` varchar(2) DEFAULT NULL,
  `catatan` text,
  `dim_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`nilai_perilaku_as_id`),
  KEY `fk_t_nilai_perilaku_as_t_dim1_idx` (`dim_id`),
  CONSTRAINT `fk_t_nilai_perilaku_as_t_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=301 DEFAULT CHARSET=latin1 COMMENT='Nilai perilaku akhir semester';

/*Table structure for table `kmhs_nilai_perilaku_summary` */

DROP TABLE IF EXISTS `kmhs_nilai_perilaku_summary`;

CREATE TABLE `kmhs_nilai_perilaku_summary` (
  `nilai_perilaku_summary_id` int(11) NOT NULL AUTO_INCREMENT,
  `ta` varchar(30) NOT NULL,
  `sem_ta` int(11) NOT NULL,
  `nim` varchar(8) NOT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `na` int(11) DEFAULT NULL,
  `grade` varchar(2) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`nilai_perilaku_summary_id`),
  KEY `fk_t_nilai_perilaku_summary_t_dim1_idx` (`dim_id`),
  CONSTRAINT `fk_t_nilai_perilaku_summary_t_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `kmhs_nilai_perilaku_ts` */

DROP TABLE IF EXISTS `kmhs_nilai_perilaku_ts`;

CREATE TABLE `kmhs_nilai_perilaku_ts` (
  `nilai_perilaku_ts` int(11) NOT NULL AUTO_INCREMENT,
  `ta` varchar(30) NOT NULL,
  `sem_ta` int(11) NOT NULL,
  `nim` varchar(8) NOT NULL,
  `k1` varchar(11) DEFAULT NULL COMMENT 'Kebersihan',
  `k2` varchar(11) DEFAULT NULL COMMENT 'Kerapian Kamar',
  `k3` varchar(11) DEFAULT NULL COMMENT 'Kerapian Almari',
  `k4` varchar(11) DEFAULT NULL COMMENT 'Ketepatan Waktu Keluar/Masuk Kampus',
  `k5` varchar(11) DEFAULT NULL COMMENT 'Kejujuran',
  `k6` varchar(11) DEFAULT NULL COMMENT 'Kehadiran saat makan pagi',
  `k7` varchar(11) DEFAULT NULL COMMENT 'Kehadiran saat makan siang',
  `k8` varchar(11) DEFAULT NULL COMMENT 'Kehadiran saat makan malam',
  `k9` varchar(11) DEFAULT NULL COMMENT 'Kedisiplinan',
  `k10` varchar(11) DEFAULT NULL COMMENT 'Ketertiban',
  `k11` varchar(11) DEFAULT NULL COMMENT 'Intens',
  `k12` varchar(11) DEFAULT NULL COMMENT 'Perilaku/Sikap',
  `na` int(11) DEFAULT NULL,
  `grade` varchar(2) DEFAULT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`nilai_perilaku_ts`),
  KEY `fk_t_nilai_perilaku_ts_t_dim1_idx` (`dim_id`),
  CONSTRAINT `fk_t_nilai_perilaku_ts_t_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=792 DEFAULT CHARSET=latin1 COMMENT='Nilai perilaku tengah semester';

/*Table structure for table `kmhs_r_kasus` */

DROP TABLE IF EXISTS `kmhs_r_kasus`;

CREATE TABLE `kmhs_r_kasus` (
  `ref_kasus_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kasus` varchar(20) NOT NULL DEFAULT '',
  `deskripsi` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`ref_kasus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `kmhs_r_kriteria_nilai_perilaku` */

DROP TABLE IF EXISTS `kmhs_r_kriteria_nilai_perilaku`;

CREATE TABLE `kmhs_r_kriteria_nilai_perilaku` (
  `kriteria_nilai_perilaku_id` int(11) NOT NULL AUTO_INCREMENT,
  `kriteria` varchar(4) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kriteria_nilai_perilaku_id`),
  UNIQUE KEY `KRITERIA_UNIQUE` (`kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Table structure for table `kolb_buku` */

DROP TABLE IF EXISTS `kolb_buku`;

CREATE TABLE `kolb_buku` (
  `buku_id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` text NOT NULL,
  `subjudul` text,
  `desc` text,
  `pegawai_id` int(11) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`buku_id`),
  KEY `fk_buku_pegawai` (`pegawai_id`),
  CONSTRAINT `fk_buku_pegawai` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Table structure for table `kolb_komponen` */

DROP TABLE IF EXISTS `kolb_komponen`;

CREATE TABLE `kolb_komponen` (
  `komponen_id` int(11) NOT NULL AUTO_INCREMENT,
  `buku_id` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `indeks` varchar(50) DEFAULT NULL,
  `judul` text,
  `konten` varchar(100) DEFAULT NULL,
  `konten_file` varchar(100) DEFAULT NULL,
  `desc` text,
  `order` int(11) DEFAULT '0',
  `status_id` int(11) DEFAULT '1',
  `pegawai_id` int(11) DEFAULT NULL,
  `review` text,
  `dinilai` tinyint(1) DEFAULT '0',
  `nilai_assesor` float DEFAULT '0',
  `progress_konten` float DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`komponen_id`),
  KEY `fk_komponen_buku` (`buku_id`),
  KEY `fk_komponen_komponen` (`parent`),
  KEY `fk_komponen_status` (`status_id`),
  KEY `fk_komponen_pegawai` (`pegawai_id`),
  CONSTRAINT `fk_komponen_buku` FOREIGN KEY (`buku_id`) REFERENCES `kolb_buku` (`buku_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_komponen_komponen` FOREIGN KEY (`parent`) REFERENCES `kolb_komponen` (`komponen_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_komponen_pegawai` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_komponen_status` FOREIGN KEY (`status_id`) REFERENCES `kolb_r_status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=890 DEFAULT CHARSET=latin1;

/*Table structure for table `kolb_lampiran` */

DROP TABLE IF EXISTS `kolb_lampiran`;

CREATE TABLE `kolb_lampiran` (
  `lampiran_id` int(11) NOT NULL AUTO_INCREMENT,
  `komponen_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `kode_file` varchar(100) DEFAULT NULL,
  `desc` text,
  `kategori_lampiran_id` int(11) DEFAULT NULL,
  `published` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`lampiran_id`),
  KEY `fk_lampiran_komponen` (`komponen_id`),
  KEY `fk_lampiran_kategori_lampiran` (`kategori_lampiran_id`),
  CONSTRAINT `fk_lampiran_kategori_lampiran` FOREIGN KEY (`kategori_lampiran_id`) REFERENCES `kolb_r_kategori_lampiran` (`kategori_lampiran_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_lampiran_komponen` FOREIGN KEY (`komponen_id`) REFERENCES `kolb_komponen` (`komponen_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2631 DEFAULT CHARSET=latin1;

/*Table structure for table `kolb_penilai` */

DROP TABLE IF EXISTS `kolb_penilai`;

CREATE TABLE `kolb_penilai` (
  `penilai_id` int(11) NOT NULL AUTO_INCREMENT,
  `komponen_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`penilai_id`),
  KEY `kolb_penilai_komponen_fk_2` (`komponen_id`),
  KEY `kolb_penilai_pegawai_fk_3` (`pegawai_id`),
  CONSTRAINT `kolb_penilai_komponen_fk_2` FOREIGN KEY (`komponen_id`) REFERENCES `kolb_komponen` (`komponen_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kolb_penilai_pegawai_fk_3` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=883 DEFAULT CHARSET=latin1;

/*Table structure for table `kolb_penulis` */

DROP TABLE IF EXISTS `kolb_penulis`;

CREATE TABLE `kolb_penulis` (
  `penulis_id` int(11) NOT NULL AUTO_INCREMENT,
  `komponen_id` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`penulis_id`),
  KEY `fk_penulis_komponen` (`komponen_id`),
  KEY `fk_penulis_pegawai` (`pegawai_id`),
  CONSTRAINT `fk_penulis_komponen` FOREIGN KEY (`komponen_id`) REFERENCES `kolb_komponen` (`komponen_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_penulis_pegawai` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2557 DEFAULT CHARSET=latin1;

/*Table structure for table `kolb_r_kategori_lampiran` */

DROP TABLE IF EXISTS `kolb_r_kategori_lampiran`;

CREATE TABLE `kolb_r_kategori_lampiran` (
  `kategori_lampiran_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kategori_lampiran_id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;

/*Table structure for table `kolb_r_status` */

DROP TABLE IF EXISTS `kolb_r_status`;

CREATE TABLE `kolb_r_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `krkm_course_group` */

DROP TABLE IF EXISTS `krkm_course_group`;

CREATE TABLE `krkm_course_group` (
  `course_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(20) NOT NULL DEFAULT '',
  `eng` varchar(255) NOT NULL DEFAULT '',
  `ina` varchar(255) DEFAULT NULL,
  `kpt_kode` varchar(10) NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`course_group_id`),
  UNIQUE KEY `ID_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `krkm_kuliah` */

DROP TABLE IF EXISTS `krkm_kuliah`;

CREATE TABLE `krkm_kuliah` (
  `kuliah_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kur` int(4) NOT NULL DEFAULT '2001',
  `kode_mk` varchar(11) NOT NULL,
  `nama_kul_ind` varchar(255) DEFAULT NULL,
  `nama_kul_ing` varchar(255) DEFAULT NULL,
  `short_name` varchar(20) DEFAULT NULL,
  `kbk_id` varchar(20) DEFAULT '0',
  `course_group` varchar(20) DEFAULT NULL,
  `sks` smallint(6) DEFAULT NULL,
  `sem` smallint(6) DEFAULT NULL,
  `urut_dlm_sem` smallint(6) DEFAULT NULL,
  `sifat` smallint(6) DEFAULT NULL,
  `meetings` varchar(100) DEFAULT NULL,
  `tipe` varchar(25) DEFAULT NULL,
  `level` varchar(15) DEFAULT NULL,
  `key_topics_ind` text,
  `key_topics_ing` text,
  `objektif_ind` text,
  `objektif_ing` text,
  `lab_hour` tinyint(4) DEFAULT NULL,
  `tutorial_hour` tinyint(4) DEFAULT NULL,
  `course_hour` tinyint(4) DEFAULT NULL,
  `course_hour_in_week` tinyint(4) DEFAULT NULL,
  `lab_hour_in_week` tinyint(4) DEFAULT NULL,
  `number_week` tinyint(4) DEFAULT NULL,
  `other_activity` varchar(50) DEFAULT '..............',
  `other_activity_hour` tinyint(4) DEFAULT NULL,
  `knowledge` tinyint(4) DEFAULT NULL,
  `skill` tinyint(4) DEFAULT NULL,
  `attitude` tinyint(4) DEFAULT NULL,
  `uts` tinyint(4) DEFAULT NULL,
  `uas` tinyint(4) DEFAULT NULL,
  `tugas` tinyint(4) DEFAULT NULL,
  `quiz` tinyint(4) DEFAULT NULL,
  `whiteboard` char(1) DEFAULT NULL,
  `lcd` char(1) DEFAULT NULL,
  `courseware` char(1) DEFAULT NULL,
  `lab` char(1) DEFAULT NULL,
  `elearning` char(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `prerequisites` text,
  `course_description` text,
  `course_objectives` text,
  `learning_outcomes` text,
  `course_format` text,
  `grading_procedure` text,
  `course_content` text,
  `ref_kbk_id` int(11) DEFAULT NULL,
  `course_group_id` int(11) DEFAULT NULL,
  `tahun_kurikulum_id` int(11) DEFAULT NULL,
  `web_page` varchar(150) DEFAULT NULL,
  `ekstrakurikuler` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kuliah_id`),
  KEY `KODE_MK_2` (`kode_mk`),
  KEY `NAMA_KUL_IND` (`nama_kul_ind`),
  KEY `NAMA_KUL_ING` (`nama_kul_ing`),
  KEY `fk_t_kurikulum_t_ref_kbk2_idx` (`ref_kbk_id`),
  KEY `FK_krkm_kurikulum` (`tahun_kurikulum_id`),
  KEY `FK_krkm_kurikulum_cg` (`course_group_id`),
  CONSTRAINT `FK_krkm_kurikulum` FOREIGN KEY (`tahun_kurikulum_id`) REFERENCES `krkm_r_tahun_kurikulum` (`tahun_kurikulum_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_krkm_kurikulum_cg` FOREIGN KEY (`course_group_id`) REFERENCES `krkm_course_group` (`course_group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_t_kurikulum_t_ref_kbk2` FOREIGN KEY (`ref_kbk_id`) REFERENCES `inst_prodi` (`ref_kbk_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=750 DEFAULT CHARSET=latin1;

/*Table structure for table `krkm_kuliah_prodi` */

DROP TABLE IF EXISTS `krkm_kuliah_prodi`;

CREATE TABLE `krkm_kuliah_prodi` (
  `krkm_kuliah_prodi_id` int(11) NOT NULL AUTO_INCREMENT,
  `kuliah_id` int(11) DEFAULT NULL,
  `ref_kbk_id` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`krkm_kuliah_prodi_id`),
  KEY `FK_krkm_kuliah_prodi` (`kuliah_id`),
  KEY `FK_krkm_kuliah_prodi_ref_kbk` (`ref_kbk_id`),
  CONSTRAINT `FK_krkm_kuliah_prodi` FOREIGN KEY (`kuliah_id`) REFERENCES `krkm_kuliah` (`kuliah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_krkm_kuliah_prodi_ref_kbk` FOREIGN KEY (`ref_kbk_id`) REFERENCES `inst_prodi` (`ref_kbk_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1218 DEFAULT CHARSET=latin1;

/*Table structure for table `krkm_kurikulum_prodi` */

DROP TABLE IF EXISTS `krkm_kurikulum_prodi`;

CREATE TABLE `krkm_kurikulum_prodi` (
  `kurikulum_prodi_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kur` int(4) NOT NULL DEFAULT '2012',
  `kode_mk` varchar(11) NOT NULL,
  `kbk_id` varchar(255) NOT NULL DEFAULT '',
  `kurikulum_id` int(11) DEFAULT NULL,
  `ref_kbk_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kurikulum_prodi_id`),
  KEY `fk_t_kurikulum_prodi_t_kurikulum1_idx` (`kurikulum_id`),
  KEY `fk_t_kurikulum_prodi_t_ref_kbk1_idx` (`ref_kbk_id`),
  CONSTRAINT `fk_t_kurikulum_prodi_t_kurikulum1` FOREIGN KEY (`kurikulum_id`) REFERENCES `krkm_kuliah` (`kuliah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_t_kurikulum_prodi_t_ref_kbk1` FOREIGN KEY (`ref_kbk_id`) REFERENCES `inst_prodi` (`ref_kbk_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=489 DEFAULT CHARSET=latin1;

/*Table structure for table `krkm_prerequisite_courses` */

DROP TABLE IF EXISTS `krkm_prerequisite_courses`;

CREATE TABLE `krkm_prerequisite_courses` (
  `prerequisite_courses_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kur` int(4) DEFAULT '0',
  `kode_mk` varchar(11) DEFAULT NULL,
  `kuliah_id` int(11) DEFAULT NULL,
  `id_kur_pre` int(4) DEFAULT '0',
  `kode_mk_pre` varchar(10) DEFAULT NULL,
  `kuliah_pre_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`prerequisite_courses_id`),
  KEY `FK_krkm_prerequisite_courses_kuri` (`kuliah_id`),
  KEY `FK_krkm_prerequisite_courses_kuri_pre` (`kuliah_pre_id`),
  CONSTRAINT `FK_krkm_prerequisite_courses_kuri` FOREIGN KEY (`kuliah_id`) REFERENCES `krkm_kuliah` (`kuliah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_krkm_prerequisite_courses_kuri_pre` FOREIGN KEY (`kuliah_pre_id`) REFERENCES `krkm_kuliah` (`kuliah_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=757 DEFAULT CHARSET=latin1;

/*Table structure for table `krkm_r_tahun_kurikulum` */

DROP TABLE IF EXISTS `krkm_r_tahun_kurikulum`;

CREATE TABLE `krkm_r_tahun_kurikulum` (
  `tahun_kurikulum_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`tahun_kurikulum_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `krkm_sifat_kuliah` */

DROP TABLE IF EXISTS `krkm_sifat_kuliah`;

CREATE TABLE `krkm_sifat_kuliah` (
  `sifat_kuliah_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sifat_kuliah_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `labx_alat` */

DROP TABLE IF EXISTS `labx_alat`;

CREATE TABLE `labx_alat` (
  `alat_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_alat` varchar(50) DEFAULT NULL,
  `lab_id` int(11) DEFAULT NULL,
  `lemari_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `stok_alat` bigint(20) DEFAULT NULL,
  `stok_available` bigint(20) DEFAULT NULL,
  `stok_min` bigint(20) DEFAULT NULL,
  `stok_inventori` bigint(20) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`alat_id`),
  KEY `fk_lab` (`lab_id`),
  KEY `fk_lemari` (`lemari_id`),
  CONSTRAINT `fk_lab` FOREIGN KEY (`lab_id`) REFERENCES `labx_lab` (`lab_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_lemari` FOREIGN KEY (`lemari_id`) REFERENCES `labx_lemari` (`lemari_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=622 DEFAULT CHARSET=latin1;

/*Table structure for table `labx_alat_rusak` */

DROP TABLE IF EXISTS `labx_alat_rusak`;

CREATE TABLE `labx_alat_rusak` (
  `alat_rusak_id` int(11) NOT NULL AUTO_INCREMENT,
  `alat_id` int(11) NOT NULL,
  `peminjaman_id` int(11) DEFAULT NULL,
  `jumlah` double NOT NULL,
  `status_alat_rusak` int(11) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`alat_rusak_id`),
  KEY `fk_alat_id_rusak` (`alat_id`),
  KEY `fk_peminjaman_id_rusak` (`peminjaman_id`),
  CONSTRAINT `fk_alat_id_rusak` FOREIGN KEY (`alat_id`) REFERENCES `labx_alat` (`alat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_peminjaman_id_rusak` FOREIGN KEY (`peminjaman_id`) REFERENCES `labx_peminjaman` (`peminjaman_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `labx_bahan` */

DROP TABLE IF EXISTS `labx_bahan`;

CREATE TABLE `labx_bahan` (
  `bahan_id` int(11) NOT NULL AUTO_INCREMENT,
  `lab_id` int(11) DEFAULT NULL,
  `lemari_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `rumus_molekul` varchar(50) DEFAULT NULL,
  `nama_lain` varchar(50) DEFAULT NULL,
  `berat_molekul` varchar(30) DEFAULT NULL,
  `stok_bahan` double DEFAULT NULL,
  `stok_min` double DEFAULT NULL,
  `stok_inventori` bigint(20) DEFAULT NULL,
  `satuan_id` int(11) DEFAULT NULL,
  `desc` varchar(250) DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `harga` decimal(19,4) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`bahan_id`),
  KEY `fk_lab_bahan` (`lab_id`),
  KEY `fk_lemari_bahan` (`lemari_id`),
  KEY `fk_satuan` (`satuan_id`),
  CONSTRAINT `fk_lab_bahan` FOREIGN KEY (`lab_id`) REFERENCES `labx_lab` (`lab_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_lemari_bahan` FOREIGN KEY (`lemari_id`) REFERENCES `labx_lemari` (`lemari_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_satuan` FOREIGN KEY (`satuan_id`) REFERENCES `labx_satuan` (`satuan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=915 DEFAULT CHARSET=latin1;

/*Table structure for table `labx_item_pemesanan` */

DROP TABLE IF EXISTS `labx_item_pemesanan`;

CREATE TABLE `labx_item_pemesanan` (
  `item_pemesanan_id` int(11) NOT NULL AUTO_INCREMENT,
  `pemesanan_id` int(11) DEFAULT NULL,
  `bahan_id` int(11) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `review` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`item_pemesanan_id`),
  KEY `fk_bahan_oesan` (`bahan_id`),
  KEY `fk_pemesanan_bahan` (`pemesanan_id`),
  KEY `fk_item_pemesanan_status` (`status_id`),
  CONSTRAINT `fk_bahan_oesan` FOREIGN KEY (`bahan_id`) REFERENCES `labx_bahan` (`bahan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_item_pemesanan_status` FOREIGN KEY (`status_id`) REFERENCES `labx_r_status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pemesanan_bahan` FOREIGN KEY (`pemesanan_id`) REFERENCES `labx_pemesanan` (`pemesanan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Table structure for table `labx_item_peminjaman` */

DROP TABLE IF EXISTS `labx_item_peminjaman`;

CREATE TABLE `labx_item_peminjaman` (
  `item_peminjaman_id` int(11) NOT NULL AUTO_INCREMENT,
  `peminjaman_id` int(11) DEFAULT NULL,
  `alat_id` int(11) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `review` varchar(100) DEFAULT NULL,
  `tanggal_pengembalian` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`item_peminjaman_id`),
  KEY `fk_item_alat` (`alat_id`),
  KEY `fk_item_peminjaman` (`peminjaman_id`),
  KEY `fk_item_peminjaman_status` (`status_id`),
  CONSTRAINT `fk_item_alat` FOREIGN KEY (`alat_id`) REFERENCES `labx_alat` (`alat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_item_peminjaman` FOREIGN KEY (`peminjaman_id`) REFERENCES `labx_peminjaman` (`peminjaman_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_item_peminjaman_status` FOREIGN KEY (`status_id`) REFERENCES `labx_r_status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=408 DEFAULT CHARSET=latin1;

/*Table structure for table `labx_lab` */

DROP TABLE IF EXISTS `labx_lab`;

CREATE TABLE `labx_lab` (
  `lab_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_lab` varchar(15) NOT NULL,
  `name` varchar(30) NOT NULL,
  `desc` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`lab_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Table structure for table `labx_lemari` */

DROP TABLE IF EXISTS `labx_lemari`;

CREATE TABLE `labx_lemari` (
  `lemari_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_lemari` varchar(30) NOT NULL,
  `desc` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`lemari_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

/*Table structure for table `labx_pemesanan` */

DROP TABLE IF EXISTS `labx_pemesanan`;

CREATE TABLE `labx_pemesanan` (
  `pemesanan_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `tujuan_id` int(11) NOT NULL,
  `kuliah_id` int(11) DEFAULT NULL,
  `desc` varchar(100) DEFAULT NULL,
  `tanggal_pemesanan` datetime DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`pemesanan_id`),
  KEY `fk_pemesan_bahan2` (`user_id`),
  KEY `fk_status2` (`status_id`),
  KEY `fk_kuliah2` (`kuliah_id`),
  KEY `fk_tujuan2` (`tujuan_id`),
  KEY `fk_dim_pemesanan2` (`dim_id`),
  KEY `fk_pegawai_pemesanan2` (`pegawai_id`),
  CONSTRAINT `fk_dim_pemesanan2` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_kuliah3` FOREIGN KEY (`kuliah_id`) REFERENCES `krkm_kuliah` (`kuliah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pegawai_pemesanan3` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pemesan3` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pemesan_bahan3` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_status3` FOREIGN KEY (`status_id`) REFERENCES `labx_r_status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tujuan3` FOREIGN KEY (`tujuan_id`) REFERENCES `labx_r_tujuan` (`tujuan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

/*Table structure for table `labx_peminjaman` */

DROP TABLE IF EXISTS `labx_peminjaman`;

CREATE TABLE `labx_peminjaman` (
  `peminjaman_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `tujuan_id` int(11) NOT NULL,
  `kuliah_id` int(11) DEFAULT NULL,
  `realisasi_peminjaman` datetime DEFAULT NULL,
  `tanggal_pengembalian` datetime DEFAULT NULL,
  `realisasi_pengembalian` datetime DEFAULT NULL,
  `denda` decimal(19,4) DEFAULT NULL,
  `desc` varchar(100) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`peminjaman_id`),
  KEY `fk_peminjam_alat` (`user_id`),
  KEY `fk_status_peminjaman` (`status_id`),
  KEY `fk_tujuan_peminjaman` (`tujuan_id`),
  KEY `fk_kuliah` (`kuliah_id`),
  KEY `fk_dim_peminjaman` (`dim_id`),
  KEY `fk_pegawai_peminjaman` (`pegawai_id`),
  CONSTRAINT `fk_dim_peminjaman` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_kuliah` FOREIGN KEY (`kuliah_id`) REFERENCES `krkm_kuliah` (`kuliah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pegawai_peminjaman` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_peminjam_alat` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_status_peminjaman` FOREIGN KEY (`status_id`) REFERENCES `labx_r_status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tujuan_peminjaman` FOREIGN KEY (`tujuan_id`) REFERENCES `labx_r_tujuan` (`tujuan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=latin1;

/*Table structure for table `labx_penambahan_stok_alat` */

DROP TABLE IF EXISTS `labx_penambahan_stok_alat`;

CREATE TABLE `labx_penambahan_stok_alat` (
  `penambahan_stok_alat_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `alat_id` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_penambahan` datetime DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`penambahan_stok_alat_id`),
  KEY `alatfk3` (`alat_id`),
  KEY `statusfk3` (`status_id`),
  KEY `userfk3` (`user_id`),
  KEY `fk_pegawai3` (`pegawai_id`),
  CONSTRAINT `alatfk23` FOREIGN KEY (`alat_id`) REFERENCES `labx_alat` (`alat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pegawai4` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `statusfk4` FOREIGN KEY (`status_id`) REFERENCES `labx_r_status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `userfk4` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Table structure for table `labx_penambahan_stok_bahan` */

DROP TABLE IF EXISTS `labx_penambahan_stok_bahan`;

CREATE TABLE `labx_penambahan_stok_bahan` (
  `penambahan_stok_bahan_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `bahan_id` int(11) DEFAULT NULL,
  `jumlah` double NOT NULL,
  `tanggal_penambahan` datetime DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`penambahan_stok_bahan_id`),
  KEY `userfkbahan4` (`user_id`),
  KEY `bahanfk24` (`bahan_id`),
  KEY `statusfk4` (`status_id`),
  KEY `fk_pegawai24` (`pegawai_id`),
  CONSTRAINT `bahanfk25` FOREIGN KEY (`bahan_id`) REFERENCES `labx_bahan` (`bahan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pegawai25` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `statusfk25` FOREIGN KEY (`status_id`) REFERENCES `labx_r_status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `userfk25` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Table structure for table `labx_r_status` */

DROP TABLE IF EXISTS `labx_r_status`;

CREATE TABLE `labx_r_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Table structure for table `labx_r_tujuan` */

DROP TABLE IF EXISTS `labx_r_tujuan`;

CREATE TABLE `labx_r_tujuan` (
  `tujuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `desc` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`tujuan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Table structure for table `labx_satuan` */

DROP TABLE IF EXISTS `labx_satuan`;

CREATE TABLE `labx_satuan` (
  `satuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`satuan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_penelitian` */

DROP TABLE IF EXISTS `lppm_penelitian`;

CREATE TABLE `lppm_penelitian` (
  `penelitian_id` int(11) NOT NULL AUTO_INCREMENT,
  `judul_penelitian` varchar(500) DEFAULT NULL,
  `tahun` varchar(10) DEFAULT NULL,
  `biaya` varchar(50) DEFAULT NULL,
  `sumber_dana` varchar(100) DEFAULT NULL,
  `skema` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`penelitian_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_penelitian_dosen` */

DROP TABLE IF EXISTS `lppm_penelitian_dosen`;

CREATE TABLE `lppm_penelitian_dosen` (
  `penelitian_dosen_id` int(11) NOT NULL AUTO_INCREMENT,
  `penelitian_id` int(11) DEFAULT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`penelitian_dosen_id`),
  KEY `dosen_id` (`dosen_id`),
  KEY `lppm_penelitian_dosen_ibfk_3` (`penelitian_id`),
  CONSTRAINT `lppm_penelitian_dosen_ibfk_2` FOREIGN KEY (`dosen_id`) REFERENCES `hrdx_dosen` (`dosen_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lppm_penelitian_dosen_ibfk_3` FOREIGN KEY (`penelitian_id`) REFERENCES `lppm_penelitian` (`penelitian_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_r_karyailmiah` */

DROP TABLE IF EXISTS `lppm_r_karyailmiah`;

CREATE TABLE `lppm_r_karyailmiah` (
  `karyailmiah_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(20) NOT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`karyailmiah_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_r_subkaryailmiah` */

DROP TABLE IF EXISTS `lppm_r_subkaryailmiah`;

CREATE TABLE `lppm_r_subkaryailmiah` (
  `subkaryailmiah_id` int(11) NOT NULL AUTO_INCREMENT,
  `karyailmiah_id` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`subkaryailmiah_id`),
  KEY `FK_lppm_r_subkaryailmiah` (`karyailmiah_id`),
  CONSTRAINT `FK_lppm_r_subkaryailmiah` FOREIGN KEY (`karyailmiah_id`) REFERENCES `lppm_r_karyailmiah` (`karyailmiah_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_t_author_publikasi` */

DROP TABLE IF EXISTS `lppm_t_author_publikasi`;

CREATE TABLE `lppm_t_author_publikasi` (
  `author_publikasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `publikasi_id` int(11) DEFAULT NULL,
  `nama_author` varchar(255) DEFAULT NULL,
  `institusi` varchar(100) DEFAULT '255',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`author_publikasi_id`),
  KEY `FK_lppm_t_author_publikasi` (`publikasi_id`),
  CONSTRAINT `FK_lppm_t_author_publikasi` FOREIGN KEY (`publikasi_id`) REFERENCES `lppm_t_publikasi` (`publikasi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=255 DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_t_ketua_gbk` */

DROP TABLE IF EXISTS `lppm_t_ketua_gbk`;

CREATE TABLE `lppm_t_ketua_gbk` (
  `ketuagbk_id` int(11) NOT NULL AUTO_INCREMENT,
  `gbk_id` int(11) NOT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`ketuagbk_id`),
  KEY `FK_lppm_t_ketua_gbk_dosen` (`dosen_id`),
  KEY `FK_lppm_t_ketua_gbk_gbk` (`gbk_id`),
  CONSTRAINT `FK_lppm_t_ketua_gbk_dosen` FOREIGN KEY (`dosen_id`) REFERENCES `hrdx_dosen` (`dosen_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_lppm_t_ketua_gbk_gbk` FOREIGN KEY (`gbk_id`) REFERENCES `mref_r_gbk` (`gbk_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_t_logreview` */

DROP TABLE IF EXISTS `lppm_t_logreview`;

CREATE TABLE `lppm_t_logreview` (
  `logreview_id` int(11) NOT NULL AUTO_INCREMENT,
  `publikasi_id` int(11) NOT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `catatanperbaikanreview` text,
  `review` int(1) DEFAULT '0',
  `status` int(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`logreview_id`),
  KEY `FK_lppm_t_logreview_pegawai` (`pegawai_id`),
  KEY `FK_lppm_t_logreview_publikasi` (`publikasi_id`),
  CONSTRAINT `FK_lppm_t_logreview_pegawai` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_lppm_t_logreview_publikasi` FOREIGN KEY (`publikasi_id`) REFERENCES `lppm_t_publikasi` (`publikasi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=280 DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_t_publikasi` */

DROP TABLE IF EXISTS `lppm_t_publikasi`;

CREATE TABLE `lppm_t_publikasi` (
  `publikasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `pegawai_id` int(11) DEFAULT NULL,
  `subkaryailmiah_id` int(11) DEFAULT NULL,
  `konferensi` varchar(50) DEFAULT NULL,
  `review` int(11) DEFAULT '0',
  `gbk_id` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `abstrak` text,
  `deadline` date DEFAULT NULL,
  `tanggal_publish` date DEFAULT NULL,
  `keterangan` varchar(1000) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `reward` int(11) DEFAULT '0',
  `approved_ketuagbk` int(11) DEFAULT '0',
  `website` varchar(50) DEFAULT NULL,
  `path_uploaddokumen` varchar(255) DEFAULT NULL,
  `kode_file` varchar(50) DEFAULT NULL,
  `is_published` tinyint(1) DEFAULT '0',
  `pesan` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`publikasi_id`),
  KEY `FK_lppm_t_publikasi_pegawai` (`pegawai_id`),
  KEY `FK_lppm_t_publikasi_sub_karya_ilmiah` (`subkaryailmiah_id`),
  KEY `FK_lppm_t_publikasi_gbk` (`gbk_id`),
  CONSTRAINT `FK_lppm_t_publikasi_gbk` FOREIGN KEY (`gbk_id`) REFERENCES `mref_r_gbk` (`gbk_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_lppm_t_publikasi_pegawai` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_lppm_t_publikasi_sub_karya_ilmiah` FOREIGN KEY (`subkaryailmiah_id`) REFERENCES `lppm_r_subkaryailmiah` (`subkaryailmiah_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_t_registrasi_file` */

DROP TABLE IF EXISTS `lppm_t_registrasi_file`;

CREATE TABLE `lppm_t_registrasi_file` (
  `registrasifile_id` int(11) NOT NULL AUTO_INCREMENT,
  `registrasipublikasi_id` int(11) DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `kode_file` varchar(255) DEFAULT NULL,
  `index_file` int(11) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`registrasifile_id`),
  KEY `FK_lppm_t_registrasi_file` (`registrasipublikasi_id`),
  CONSTRAINT `FK_lppm_t_registrasi_file` FOREIGN KEY (`registrasipublikasi_id`) REFERENCES `lppm_t_registrasipublikasi` (`registrasipublikasi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_t_registrasi_jurnal` */

DROP TABLE IF EXISTS `lppm_t_registrasi_jurnal`;

CREATE TABLE `lppm_t_registrasi_jurnal` (
  `registrasi_jurnal_id` int(11) NOT NULL AUTO_INCREMENT,
  `publikasi_id` int(11) DEFAULT NULL,
  `biaya_registrasi` decimal(11,0) DEFAULT NULL,
  `status_approved` int(11) DEFAULT NULL,
  `keterangan_approved` text,
  `catatan` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`registrasi_jurnal_id`),
  KEY `FK_lppm_t_registrasi_jurnal` (`publikasi_id`),
  CONSTRAINT `FK_lppm_t_registrasi_jurnal` FOREIGN KEY (`publikasi_id`) REFERENCES `lppm_t_publikasi` (`publikasi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_t_registrasi_jurnal_file` */

DROP TABLE IF EXISTS `lppm_t_registrasi_jurnal_file`;

CREATE TABLE `lppm_t_registrasi_jurnal_file` (
  `registrasi_jurnal_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `registrasi_jurnal_id` int(11) DEFAULT NULL,
  `nama_file` varchar(200) DEFAULT NULL,
  `kode_file` varchar(200) DEFAULT NULL,
  `index_file` int(11) DEFAULT NULL,
  `keterangan` text,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`registrasi_jurnal_file_id`),
  KEY `FK_lppm_t_registrasi_jurnal_file` (`registrasi_jurnal_id`),
  CONSTRAINT `FK_lppm_t_registrasi_jurnal_file` FOREIGN KEY (`registrasi_jurnal_id`) REFERENCES `lppm_t_registrasi_jurnal` (`registrasi_jurnal_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_t_registrasi_prosiding` */

DROP TABLE IF EXISTS `lppm_t_registrasi_prosiding`;

CREATE TABLE `lppm_t_registrasi_prosiding` (
  `registrasi_prosiding_id` int(11) NOT NULL AUTO_INCREMENT,
  `publikasi_id` int(11) DEFAULT NULL,
  `waktu_mulai` date DEFAULT NULL,
  `waktu_selesai` date DEFAULT NULL,
  `rute_transport_udara` varchar(255) DEFAULT NULL,
  `rute_transport_laut` varchar(255) DEFAULT NULL,
  `rute_transport_darat` varchar(255) DEFAULT NULL,
  `status_approved` int(11) DEFAULT NULL,
  `keterangan_approved` text,
  `catatan` text,
  `biaya_pendaftaran` decimal(11,0) DEFAULT NULL,
  `biaya_transport_darat` decimal(11,0) DEFAULT NULL,
  `biaya_transport_laut` decimal(11,0) DEFAULT NULL,
  `biaya_transport_udara` decimal(11,0) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`registrasi_prosiding_id`),
  KEY `FK_lppm_t_registrasi_prosiding` (`publikasi_id`),
  CONSTRAINT `FK_lppm_t_registrasi_prosiding` FOREIGN KEY (`publikasi_id`) REFERENCES `lppm_t_publikasi` (`publikasi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_t_registrasi_prosiding_file` */

DROP TABLE IF EXISTS `lppm_t_registrasi_prosiding_file`;

CREATE TABLE `lppm_t_registrasi_prosiding_file` (
  `registrasi_prosiding_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `registrasi_prosiding_id` int(11) DEFAULT NULL,
  `nama_file` varchar(200) DEFAULT NULL,
  `kode_file` varchar(200) DEFAULT NULL,
  `index_file` int(11) DEFAULT NULL,
  `keterangan` text,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`registrasi_prosiding_file_id`),
  KEY `FK_lppm_t_registrasi_prosiding_file` (`registrasi_prosiding_id`),
  CONSTRAINT `FK_lppm_t_registrasi_prosiding_file` FOREIGN KEY (`registrasi_prosiding_id`) REFERENCES `lppm_t_registrasi_prosiding` (`registrasi_prosiding_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_t_registrasipublikasi` */

DROP TABLE IF EXISTS `lppm_t_registrasipublikasi`;

CREATE TABLE `lppm_t_registrasipublikasi` (
  `registrasipublikasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `publikasi_id` int(11) NOT NULL,
  `biaya_pendaftaran` decimal(11,0) DEFAULT NULL,
  `biaya_transport` decimal(11,0) DEFAULT NULL,
  `keterangan_transport` varchar(255) DEFAULT NULL,
  `biaya_transport2` decimal(11,0) DEFAULT NULL,
  `keterangan_transport2` varchar(255) DEFAULT NULL,
  `biaya_penginapan` decimal(11,0) DEFAULT NULL,
  `tanggal_berangkat` date DEFAULT NULL,
  `tanggal_pulang` date DEFAULT NULL,
  `status_approved` int(11) DEFAULT '0',
  `keterangan_approved` varchar(255) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`registrasipublikasi_id`),
  KEY `FK_lppm_t_registrasipublikasi_publikasi` (`publikasi_id`),
  CONSTRAINT `FK_lppm_t_registrasipublikasi_publikasi` FOREIGN KEY (`publikasi_id`) REFERENCES `lppm_t_publikasi` (`publikasi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_t_review_file` */

DROP TABLE IF EXISTS `lppm_t_review_file`;

CREATE TABLE `lppm_t_review_file` (
  `reviewfile_id` int(11) NOT NULL AUTO_INCREMENT,
  `logreview_id` int(11) DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `kode_file` varchar(255) DEFAULT NULL,
  `index_file` int(11) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`reviewfile_id`),
  KEY `FK_lppm_t_review_file_log_review` (`logreview_id`),
  CONSTRAINT `FK_lppm_t_review_file_log_review` FOREIGN KEY (`logreview_id`) REFERENCES `lppm_t_logreview` (`logreview_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_t_reward_file` */

DROP TABLE IF EXISTS `lppm_t_reward_file`;

CREATE TABLE `lppm_t_reward_file` (
  `rewardfile_id` int(11) NOT NULL AUTO_INCREMENT,
  `rewardpublikasi_id` int(11) DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `kode_file` varchar(255) DEFAULT NULL,
  `index_file` int(11) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`rewardfile_id`),
  KEY `FK_lppm_t_reward_file` (`rewardpublikasi_id`),
  CONSTRAINT `FK_lppm_t_reward_file` FOREIGN KEY (`rewardpublikasi_id`) REFERENCES `lppm_t_rewardpublikasi` (`rewardpublikasi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_t_reward_jurnal` */

DROP TABLE IF EXISTS `lppm_t_reward_jurnal`;

CREATE TABLE `lppm_t_reward_jurnal` (
  `reward_jurnal_id` int(11) NOT NULL AUTO_INCREMENT,
  `publikasi_id` int(11) DEFAULT NULL,
  `issn` varchar(50) DEFAULT NULL,
  `volume` varchar(50) DEFAULT NULL,
  `nomor` varchar(50) DEFAULT NULL,
  `halaman_awal` int(11) DEFAULT NULL,
  `halaman_akhir` int(11) DEFAULT NULL,
  `status_reward` int(11) DEFAULT NULL,
  `keterangan_reward` text,
  `jumlah` decimal(11,0) DEFAULT NULL,
  `catatan` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`reward_jurnal_id`),
  KEY `FK_lppm_t_reward_jurnal` (`publikasi_id`),
  CONSTRAINT `FK_lppm_t_reward_jurnal` FOREIGN KEY (`publikasi_id`) REFERENCES `lppm_t_publikasi` (`publikasi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_t_reward_jurnal_file` */

DROP TABLE IF EXISTS `lppm_t_reward_jurnal_file`;

CREATE TABLE `lppm_t_reward_jurnal_file` (
  `reward_jurnal_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `reward_jurnal_id` int(11) DEFAULT NULL,
  `nama_file` varchar(200) DEFAULT NULL,
  `kode_file` varchar(200) DEFAULT NULL,
  `index_file` int(11) DEFAULT NULL,
  `keterangan` text,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`reward_jurnal_file_id`),
  KEY `FK_lppm_t_reward_jurnal_file` (`reward_jurnal_id`),
  CONSTRAINT `FK_lppm_t_reward_jurnal_file` FOREIGN KEY (`reward_jurnal_id`) REFERENCES `lppm_t_reward_jurnal` (`reward_jurnal_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_t_reward_prosiding` */

DROP TABLE IF EXISTS `lppm_t_reward_prosiding`;

CREATE TABLE `lppm_t_reward_prosiding` (
  `reward_prosiding_id` int(11) NOT NULL AUTO_INCREMENT,
  `publikasi_id` int(11) DEFAULT NULL,
  `institusi_penyelenggara` varchar(150) DEFAULT NULL,
  `tempat_pelaksanaan` varchar(200) DEFAULT NULL,
  `status_reward` int(11) DEFAULT NULL,
  `keterangan_reward` text,
  `catatan` text,
  `jumlah` decimal(11,0) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`reward_prosiding_id`),
  KEY `FK_lppm_t_reward_prosiding` (`publikasi_id`),
  CONSTRAINT `FK_lppm_t_reward_prosiding` FOREIGN KEY (`publikasi_id`) REFERENCES `lppm_t_publikasi` (`publikasi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_t_reward_prosiding_file` */

DROP TABLE IF EXISTS `lppm_t_reward_prosiding_file`;

CREATE TABLE `lppm_t_reward_prosiding_file` (
  `reward_prosiding_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `reward_prosiding_id` int(11) DEFAULT NULL,
  `nama_file` varchar(200) DEFAULT NULL,
  `kode_file` varchar(200) DEFAULT NULL,
  `index_file` int(11) DEFAULT NULL,
  `keterangan` text,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`reward_prosiding_file_id`),
  KEY `FK_lppm_t_reward_prosiding_file` (`reward_prosiding_id`),
  CONSTRAINT `FK_lppm_t_reward_prosiding_file` FOREIGN KEY (`reward_prosiding_id`) REFERENCES `lppm_t_reward_prosiding` (`reward_prosiding_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Table structure for table `lppm_t_rewardpublikasi` */

DROP TABLE IF EXISTS `lppm_t_rewardpublikasi`;

CREATE TABLE `lppm_t_rewardpublikasi` (
  `rewardpublikasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `publikasi_id` int(11) NOT NULL,
  `status_reward` int(11) DEFAULT NULL,
  `keterangan_reward` varchar(255) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `jumlah` decimal(10,0) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`rewardpublikasi_id`),
  KEY `FK_lppm_t_rewardpublikasi` (`publikasi_id`),
  CONSTRAINT `FK_lppm_t_rewardpublikasi` FOREIGN KEY (`publikasi_id`) REFERENCES `lppm_t_publikasi` (`publikasi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `mref_r_agama` */

DROP TABLE IF EXISTS `mref_r_agama`;

CREATE TABLE `mref_r_agama` (
  `agama_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) NOT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`agama_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_asal_sekolah` */

DROP TABLE IF EXISTS `mref_r_asal_sekolah`;

CREATE TABLE `mref_r_asal_sekolah` (
  `asal_sekolah_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) NOT NULL,
  `alamat` text,
  `provinsi_id` int(11) DEFAULT NULL,
  `kabupaten_id` int(11) DEFAULT NULL,
  `kodepos` varchar(8) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`asal_sekolah_id`),
  KEY `FK_mref_r_asal_sekolah` (`kabupaten_id`),
  KEY `FK_mref_r_asal_sekolah_provinsi` (`provinsi_id`),
  CONSTRAINT `FK_mref_r_asal_sekolah` FOREIGN KEY (`kabupaten_id`) REFERENCES `mref_r_kabupaten` (`kabupaten_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_mref_r_asal_sekolah_provinsi` FOREIGN KEY (`provinsi_id`) REFERENCES `mref_r_provinsi` (`provinsi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=399 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_bidang_pekerjaan` */

DROP TABLE IF EXISTS `mref_r_bidang_pekerjaan`;

CREATE TABLE `mref_r_bidang_pekerjaan` (
  `bidang_pekerjaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`bidang_pekerjaan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_bidang_perusahaan` */

DROP TABLE IF EXISTS `mref_r_bidang_perusahaan`;

CREATE TABLE `mref_r_bidang_perusahaan` (
  `bidang_perusahaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`bidang_perusahaan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_gbk` */

DROP TABLE IF EXISTS `mref_r_gbk`;

CREATE TABLE `mref_r_gbk` (
  `gbk_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) NOT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`gbk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_gelombang_pmb` */

DROP TABLE IF EXISTS `mref_r_gelombang_pmb`;

CREATE TABLE `mref_r_gelombang_pmb` (
  `gelombang_pmb_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `deskripsi` varchar(150) DEFAULT NULL,
  `lokasi` varchar(25) DEFAULT NULL,
  `tanggal_awal` datetime DEFAULT NULL,
  `tanggal_akhir` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`gelombang_pmb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_golongan_darah` */

DROP TABLE IF EXISTS `mref_r_golongan_darah`;

CREATE TABLE `mref_r_golongan_darah` (
  `golongan_darah_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`golongan_darah_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_golongan_kepangkatan` */

DROP TABLE IF EXISTS `mref_r_golongan_kepangkatan`;

CREATE TABLE `mref_r_golongan_kepangkatan` (
  `golongan_kepangkatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) NOT NULL,
  `desc` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`golongan_kepangkatan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_jabatan_akademik` */

DROP TABLE IF EXISTS `mref_r_jabatan_akademik`;

CREATE TABLE `mref_r_jabatan_akademik` (
  `jabatan_akademik_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) NOT NULL,
  `desc` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`jabatan_akademik_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_jenis_kelamin` */

DROP TABLE IF EXISTS `mref_r_jenis_kelamin`;

CREATE TABLE `mref_r_jenis_kelamin` (
  `jenis_kelamin_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`jenis_kelamin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_jenjang` */

DROP TABLE IF EXISTS `mref_r_jenjang`;

CREATE TABLE `mref_r_jenjang` (
  `jenjang_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`jenjang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_kabupaten` */

DROP TABLE IF EXISTS `mref_r_kabupaten`;

CREATE TABLE `mref_r_kabupaten` (
  `kabupaten_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kabupaten_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_lokasi` */

DROP TABLE IF EXISTS `mref_r_lokasi`;

CREATE TABLE `mref_r_lokasi` (
  `lokasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`lokasi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_pekerjaan` */

DROP TABLE IF EXISTS `mref_r_pekerjaan`;

CREATE TABLE `mref_r_pekerjaan` (
  `pekerjaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pekerjaan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_pendidikan` */

DROP TABLE IF EXISTS `mref_r_pendidikan`;

CREATE TABLE `mref_r_pendidikan` (
  `pendidikan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pendidikan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_pengali_nilai` */

DROP TABLE IF EXISTS `mref_r_pengali_nilai`;

CREATE TABLE `mref_r_pengali_nilai` (
  `pengali_nilai_id` int(11) NOT NULL AUTO_INCREMENT,
  `nilai` varchar(3) DEFAULT NULL,
  `pengali` float DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`pengali_nilai_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_penghasilan` */

DROP TABLE IF EXISTS `mref_r_penghasilan`;

CREATE TABLE `mref_r_penghasilan` (
  `penghasilan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`penghasilan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_predikat_lulus` */

DROP TABLE IF EXISTS `mref_r_predikat_lulus`;

CREATE TABLE `mref_r_predikat_lulus` (
  `predikat_lulus_id` int(11) NOT NULL AUTO_INCREMENT,
  `ipk_minimum` double DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`predikat_lulus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_provinsi` */

DROP TABLE IF EXISTS `mref_r_provinsi`;

CREATE TABLE `mref_r_provinsi` (
  `provinsi_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(128) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `cerated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`provinsi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10000 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_role_pengajar` */

DROP TABLE IF EXISTS `mref_r_role_pengajar`;

CREATE TABLE `mref_r_role_pengajar` (
  `role_pengajar_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) NOT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`role_pengajar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_sem_ta` */

DROP TABLE IF EXISTS `mref_r_sem_ta`;

CREATE TABLE `mref_r_sem_ta` (
  `sem_ta_id` int(11) NOT NULL AUTO_INCREMENT,
  `sem_ta` int(11) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`sem_ta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_sifat_kurikulum` */

DROP TABLE IF EXISTS `mref_r_sifat_kurikulum`;

CREATE TABLE `mref_r_sifat_kurikulum` (
  `sifat_kurikulum_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sifat_kurikulum_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_status_aktif_mahasiswa` */

DROP TABLE IF EXISTS `mref_r_status_aktif_mahasiswa`;

CREATE TABLE `mref_r_status_aktif_mahasiswa` (
  `status_aktif_mahasiswa_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) NOT NULL,
  `desc` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`status_aktif_mahasiswa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_status_aktif_pegawai` */

DROP TABLE IF EXISTS `mref_r_status_aktif_pegawai`;

CREATE TABLE `mref_r_status_aktif_pegawai` (
  `status_aktif_pegawai_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) NOT NULL,
  `desc` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`status_aktif_pegawai_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_status_ikatan_kerja_dosen` */

DROP TABLE IF EXISTS `mref_r_status_ikatan_kerja_dosen`;

CREATE TABLE `mref_r_status_ikatan_kerja_dosen` (
  `status_ikatan_kerja_dosen_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) NOT NULL,
  `desc` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`status_ikatan_kerja_dosen_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_status_ikatan_kerja_pegawai` */

DROP TABLE IF EXISTS `mref_r_status_ikatan_kerja_pegawai`;

CREATE TABLE `mref_r_status_ikatan_kerja_pegawai` (
  `status_ikatan_kerja_pegawai_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) NOT NULL,
  `desc` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`status_ikatan_kerja_pegawai_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_status_marital` */

DROP TABLE IF EXISTS `mref_r_status_marital`;

CREATE TABLE `mref_r_status_marital` (
  `status_marital_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`status_marital_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Table structure for table `mref_r_ta` */

DROP TABLE IF EXISTS `mref_r_ta`;

CREATE TABLE `mref_r_ta` (
  `ta_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` int(5) NOT NULL,
  `desc` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`ta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Table structure for table `nlai_ext_mhs` */

DROP TABLE IF EXISTS `nlai_ext_mhs`;

CREATE TABLE `nlai_ext_mhs` (
  `ext_mhs_id` int(11) NOT NULL AUTO_INCREMENT,
  `dim_id` int(11) DEFAULT NULL,
  `tgl_test` date DEFAULT NULL,
  `ta` varchar(5) DEFAULT NULL,
  `sem_ta` int(11) DEFAULT '1',
  `ext_id` int(11) DEFAULT NULL,
  `score` varchar(32) DEFAULT NULL,
  `keterangan` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`ext_mhs_id`),
  KEY `FK_nlai_ext_mhs` (`ext_id`),
  KEY `FK_nlai_ext_mhs_dim` (`dim_id`),
  CONSTRAINT `FK_nlai_ext_mhs` FOREIGN KEY (`ext_id`) REFERENCES `nlai_r_ext` (`ext_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_nlai_ext_mhs_dim` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=648 DEFAULT CHARSET=latin1;

/*Table structure for table `nlai_file_nilai` */

DROP TABLE IF EXISTS `nlai_file_nilai`;

CREATE TABLE `nlai_file_nilai` (
  `file_nilai_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_file` text,
  `kode_file` varchar(100) DEFAULT NULL,
  `ket` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`file_nilai_id`)
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=latin1;

/*Table structure for table `nlai_komponen_tambahan` */

DROP TABLE IF EXISTS `nlai_komponen_tambahan`;

CREATE TABLE `nlai_komponen_tambahan` (
  `komponen_tambahan_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kur` varchar(4) DEFAULT NULL,
  `kode_mk` varchar(11) DEFAULT NULL,
  `ta` varchar(4) DEFAULT NULL,
  `sem_ta` int(11) DEFAULT NULL,
  `nilai_tambahan_1` float DEFAULT NULL,
  `nilai_tambahan_2` float DEFAULT NULL,
  `nilai_tambahan_3` float DEFAULT NULL,
  `nilai_tambahan_4` float DEFAULT NULL,
  `nilai_tambahan_5` float DEFAULT NULL,
  `nm_tambahan_1` varchar(45) DEFAULT 'Nilai Tambahan 1',
  `nm_tambahan_2` varchar(45) DEFAULT 'Nilai Tambahan 2',
  `nm_tambahan_3` varchar(45) DEFAULT 'Nilai Tambahan 3',
  `nm_tambahan_4` varchar(45) DEFAULT 'Nilai Tambahan 4',
  `nm_tambahan_5` varchar(45) DEFAULT 'Nilai Tambahan 5',
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`komponen_tambahan_id`),
  KEY `FK_nlai_komponen_tambahan_syllabus` (`kurikulum_syllabus_id`),
  CONSTRAINT `FK_nlai_komponen_tambahan_syllabus` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1192 DEFAULT CHARSET=latin1;

/*Table structure for table `nlai_komposisi_nilai` */

DROP TABLE IF EXISTS `nlai_komposisi_nilai`;

CREATE TABLE `nlai_komposisi_nilai` (
  `komposisi_nilai_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kur` int(4) DEFAULT '0',
  `kode_mk` varchar(11) DEFAULT NULL,
  `ta` varchar(30) DEFAULT '0',
  `sem_ta` int(11) DEFAULT NULL,
  `nilai_praktikum` float DEFAULT NULL,
  `nilai_quis` float DEFAULT NULL,
  `nilai_uts` float DEFAULT NULL,
  `nilai_uas` float DEFAULT NULL,
  `nilai_tugas` float DEFAULT NULL,
  `nm_praktikum` varchar(20) NOT NULL DEFAULT 'Nilai Praktikum',
  `nm_quis` varchar(20) NOT NULL DEFAULT 'Nilai Quis',
  `nm_uts` varchar(20) NOT NULL DEFAULT 'Nilai UTS',
  `nm_uas` varchar(20) NOT NULL DEFAULT 'Nilai UAS',
  `nm_tugas` varchar(20) NOT NULL DEFAULT 'Nilai Tugas',
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`komposisi_nilai_id`),
  KEY `fk_t_komposisi_nilai_t_kurikulum1_idx` (`kurikulum_syllabus_id`),
  CONSTRAINT `FK_nlai_komposisi_nilai_syllabus` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1907 DEFAULT CHARSET=latin1;

/*Table structure for table `nlai_komposisi_nilai_uts_uas` */

DROP TABLE IF EXISTS `nlai_komposisi_nilai_uts_uas`;

CREATE TABLE `nlai_komposisi_nilai_uts_uas` (
  `komposisi_nilai_uts_uas_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kur` int(4) DEFAULT NULL,
  `kode_mk` varchar(11) DEFAULT NULL,
  `ta` varchar(4) DEFAULT NULL,
  `sem_ta` int(11) DEFAULT NULL,
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `nilai_uts_teori` float DEFAULT NULL,
  `nilai_uts_praktikum` float DEFAULT NULL,
  `nilai_uas_teori` float DEFAULT NULL,
  `nilai_uas_praktikum` float DEFAULT NULL,
  `nm_uts_teori` varchar(50) DEFAULT 'UTS_TEORI',
  `nm_uts_praktikum` varchar(50) DEFAULT 'UTS_PRAKTIKUM',
  `nm_uas_teori` varchar(50) DEFAULT 'UAS_TEORI',
  `nm_uas_praktikum` varchar(50) DEFAULT 'UAS_PRAKTIKUM',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`komposisi_nilai_uts_uas_id`),
  KEY `FK_nlai_komposisi_nilai_uts_uas` (`kurikulum_syllabus_id`),
  CONSTRAINT `FK_nlai_komposisi_nilai_uts_uas` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2517 DEFAULT CHARSET=latin1;

/*Table structure for table `nlai_nilai` */

DROP TABLE IF EXISTS `nlai_nilai`;

CREATE TABLE `nlai_nilai` (
  `nilai_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kur` int(4) NOT NULL DEFAULT '0',
  `kode_mk` varchar(11) NOT NULL,
  `ta` varchar(30) NOT NULL DEFAULT '0',
  `sem_ta` int(11) DEFAULT NULL,
  `nim` varchar(8) NOT NULL DEFAULT '',
  `komponen_ke` int(1) DEFAULT '0',
  `na` float DEFAULT '0',
  `nilai` char(3) DEFAULT NULL,
  `na_remedial` float DEFAULT NULL,
  `nilai_remedial` char(3) DEFAULT NULL,
  `kelas` varchar(5) DEFAULT NULL,
  `sks` int(11) NOT NULL COMMENT 'Jumlah SKS',
  `sem` int(11) DEFAULT NULL COMMENT 'Semseter Kurikulum',
  `wali_approval` varchar(100) DEFAULT NULL,
  `dir_approval` varchar(100) DEFAULT NULL,
  `dosen_approval` varchar(100) DEFAULT NULL,
  `keterangan` text,
  `dim_id` int(11) DEFAULT NULL,
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `ispublish` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`nilai_id`),
  KEY `NIM` (`nim`),
  KEY `fk_t_nilai_t_dim1_idx` (`dim_id`),
  KEY `fk_t_nilai_t_kurikulum1_idx` (`kurikulum_syllabus_id`),
  CONSTRAINT `FK_nlai_nilai` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_t_nilai_t_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=98471 DEFAULT CHARSET=latin1;

/*Table structure for table `nlai_nilai_komponen_tambahan` */

DROP TABLE IF EXISTS `nlai_nilai_komponen_tambahan`;

CREATE TABLE `nlai_nilai_komponen_tambahan` (
  `nilai_komponen_tambahan_id` int(11) NOT NULL AUTO_INCREMENT,
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `id_kur` varchar(4) DEFAULT NULL,
  `kode_mk` varchar(50) DEFAULT NULL,
  `ta` int(11) DEFAULT NULL,
  `sem_ta` int(1) DEFAULT NULL,
  `komponen_ke` int(11) DEFAULT NULL,
  `komponen` varchar(45) DEFAULT NULL,
  `nim` varchar(10) DEFAULT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`nilai_komponen_tambahan_id`),
  KEY `FK_nlai_nilai_komponen_tambahan_syllabus` (`kurikulum_syllabus_id`),
  KEY `FK_nlai_nilai_komponen_tambahan-dim` (`dim_id`),
  CONSTRAINT `FK_nlai_nilai_komponen_tambahan-dim` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_nlai_nilai_komponen_tambahan_syllabus` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=71943 DEFAULT CHARSET=latin1;

/*Table structure for table `nlai_nilai_praktikum` */

DROP TABLE IF EXISTS `nlai_nilai_praktikum`;

CREATE TABLE `nlai_nilai_praktikum` (
  `nilai_praktikum_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kur` int(4) NOT NULL DEFAULT '0',
  `kode_mk` varchar(11) NOT NULL,
  `ta` varchar(4) NOT NULL DEFAULT '0',
  `sem_ta` int(11) DEFAULT NULL,
  `nim` varchar(8) NOT NULL DEFAULT '',
  `komponen` varchar(30) DEFAULT NULL,
  `dosen_approval` varchar(100) DEFAULT NULL,
  `komponen_ke` smallint(6) DEFAULT NULL,
  `nilai` float NOT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`nilai_praktikum_id`),
  KEY `fk_t_nilai_praktikum_t_dim1_idx` (`dim_id`),
  KEY `fk_t_nilai_praktikum_t_kurikulum1_idx` (`kurikulum_syllabus_id`),
  CONSTRAINT `FK_nlai_nilai_praktikum_syllabus` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_t_nilai_praktikum_t_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58149 DEFAULT CHARSET=latin1;

/*Table structure for table `nlai_nilai_quis` */

DROP TABLE IF EXISTS `nlai_nilai_quis`;

CREATE TABLE `nlai_nilai_quis` (
  `nilai_quis_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kur` int(4) NOT NULL DEFAULT '0',
  `kode_mk` varchar(11) NOT NULL,
  `ta` varchar(30) NOT NULL DEFAULT '0',
  `sem_ta` int(11) DEFAULT NULL,
  `nim` varchar(8) NOT NULL DEFAULT '',
  `komponen` varchar(30) DEFAULT NULL,
  `dosen_approval` varchar(100) DEFAULT NULL,
  `komponen_ke` smallint(6) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`nilai_quis_id`),
  KEY `fk_t_nilai_quis_t_dim1_idx` (`dim_id`),
  KEY `fk_t_nilai_quis_t_kurikulum1_idx` (`kurikulum_syllabus_id`),
  CONSTRAINT `FK_nlai_nilai_quis_syllabus` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_t_nilai_quis_t_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=116769 DEFAULT CHARSET=latin1;

/*Table structure for table `nlai_nilai_tugas` */

DROP TABLE IF EXISTS `nlai_nilai_tugas`;

CREATE TABLE `nlai_nilai_tugas` (
  `nilai_tugas_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kur` int(4) NOT NULL DEFAULT '0',
  `kode_mk` varchar(11) NOT NULL,
  `ta` varchar(30) NOT NULL DEFAULT '0',
  `sem_ta` int(11) DEFAULT NULL,
  `nim` varchar(8) NOT NULL DEFAULT '',
  `komponen` varchar(30) DEFAULT NULL,
  `dosen_approval` varchar(100) DEFAULT NULL,
  `komponen_ke` smallint(6) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`nilai_tugas_id`),
  KEY `fk_t_nilai_tugas_t_dim1_idx` (`dim_id`),
  KEY `fk_t_nilai_tugas_t_kurikulum1_idx` (`kurikulum_syllabus_id`),
  CONSTRAINT `FK_nlai_nilai_tugas_syllabus` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_t_nilai_tugas_t_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=125166 DEFAULT CHARSET=latin1;

/*Table structure for table `nlai_nilai_uas` */

DROP TABLE IF EXISTS `nlai_nilai_uas`;

CREATE TABLE `nlai_nilai_uas` (
  `nilai_uas_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kur` int(4) NOT NULL DEFAULT '0',
  `kode_mk` varchar(11) NOT NULL,
  `ta` varchar(30) NOT NULL DEFAULT '0',
  `sem_ta` int(11) DEFAULT NULL,
  `nim` varchar(8) NOT NULL DEFAULT '',
  `komponen` varchar(30) DEFAULT NULL,
  `dosen_approval` varchar(100) DEFAULT NULL,
  `komponen_ke` smallint(6) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `ispublish` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`nilai_uas_id`),
  KEY `fk_t_nilai_uas_t_dim1_idx` (`dim_id`),
  KEY `fk_t_nilai_uas_t_kurikulum1_idx` (`kurikulum_syllabus_id`),
  CONSTRAINT `FK_nlai_nilai_uas_syllabus` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_t_nilai_uas_t_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=84356 DEFAULT CHARSET=latin1;

/*Table structure for table `nlai_nilai_uts` */

DROP TABLE IF EXISTS `nlai_nilai_uts`;

CREATE TABLE `nlai_nilai_uts` (
  `nilai_uts_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kur` int(4) NOT NULL DEFAULT '0',
  `kode_mk` varchar(11) NOT NULL,
  `ta` varchar(30) NOT NULL DEFAULT '0',
  `sem_ta` int(11) DEFAULT NULL,
  `nim` varchar(8) NOT NULL DEFAULT '',
  `komponen` varchar(30) DEFAULT NULL,
  `dosen_approval` varchar(100) DEFAULT NULL,
  `komponen_ke` smallint(6) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `ispublish` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`nilai_uts_id`),
  KEY `fk_t_nilai_uts_t_dim1_idx` (`dim_id`),
  KEY `fk_t_nilai_uts_t_kurikulum1_idx` (`kurikulum_syllabus_id`),
  CONSTRAINT `FK_nlai_nilai_uts_syllabus` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_t_nilai_uts_t_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=92066 DEFAULT CHARSET=latin1;

/*Table structure for table `nlai_r_ext` */

DROP TABLE IF EXISTS `nlai_r_ext`;

CREATE TABLE `nlai_r_ext` (
  `ext_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) NOT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`ext_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `nlai_rentang_nilai` */

DROP TABLE IF EXISTS `nlai_rentang_nilai`;

CREATE TABLE `nlai_rentang_nilai` (
  `rentang_nilai_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kur` int(4) NOT NULL DEFAULT '0',
  `kode_mk` varchar(11) NOT NULL,
  `ta` varchar(30) NOT NULL DEFAULT '0',
  `sem_ta` int(11) DEFAULT NULL,
  `a` float DEFAULT NULL,
  `ab` varchar(8) DEFAULT NULL,
  `b` float DEFAULT NULL,
  `bc` varchar(8) DEFAULT NULL,
  `c` float DEFAULT NULL,
  `d` float DEFAULT NULL,
  `e` float DEFAULT NULL,
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`rentang_nilai_id`),
  KEY `fk_t_rentang_nilai_t_kurikulum1_idx` (`kurikulum_syllabus_id`),
  CONSTRAINT `FK_nlai_rentang_nilai_syllabus` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1884 DEFAULT CHARSET=latin1;

/*Table structure for table `nlai_uas_detail` */

DROP TABLE IF EXISTS `nlai_uas_detail`;

CREATE TABLE `nlai_uas_detail` (
  `uas_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kur` int(4) DEFAULT NULL,
  `kode_mk` varchar(11) DEFAULT NULL,
  `ta` varchar(30) DEFAULT NULL,
  `sem_ta` int(11) DEFAULT NULL,
  `nim` varchar(8) DEFAULT NULL,
  `komponen` varchar(30) DEFAULT NULL,
  `komponen_ke` int(11) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `komposisi_nilai_uts_uas_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`uas_detail_id`),
  KEY `FK_nlai_uas_detail` (`kurikulum_syllabus_id`),
  KEY `FK_nlai_uas_detail_komposisi` (`komposisi_nilai_uts_uas_id`),
  KEY `FK_nlai_uas_detail_dim` (`dim_id`),
  CONSTRAINT `FK_nlai_uas_detail` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_nlai_uas_detail_dim` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_nlai_uas_detail_komposisi` FOREIGN KEY (`komposisi_nilai_uts_uas_id`) REFERENCES `nlai_komposisi_nilai_uts_uas` (`komposisi_nilai_uts_uas_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=105012 DEFAULT CHARSET=latin1;

/*Table structure for table `nlai_uts_detail` */

DROP TABLE IF EXISTS `nlai_uts_detail`;

CREATE TABLE `nlai_uts_detail` (
  `uts_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kur` int(4) DEFAULT NULL,
  `kode_mk` varchar(11) DEFAULT NULL,
  `ta` varchar(30) DEFAULT NULL,
  `sem_ta` int(11) DEFAULT NULL,
  `nim` varchar(8) DEFAULT NULL,
  `komponen` varchar(30) DEFAULT NULL,
  `komponen_ke` int(11) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `komposisi_nilai_uts_uas_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`uts_detail_id`),
  KEY `FK_nlai_uts_detail` (`kurikulum_syllabus_id`),
  KEY `FK_nlai_uts_detail_komposisi` (`komposisi_nilai_uts_uas_id`),
  KEY `FK_nlai_uts_detail_dim` (`dim_id`),
  CONSTRAINT `FK_nlai_uts_detail` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_nlai_uts_detail_dim` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_nlai_uts_detail_komposisi` FOREIGN KEY (`komposisi_nilai_uts_uas_id`) REFERENCES `nlai_komposisi_nilai_uts_uas` (`komposisi_nilai_uts_uas_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=100230 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_berita_acara_daftar_hadir` */

DROP TABLE IF EXISTS `prkl_berita_acara_daftar_hadir`;

CREATE TABLE `prkl_berita_acara_daftar_hadir` (
  `berita_acara_daftar_hadir_id` int(11) NOT NULL AUTO_INCREMENT,
  `week` smallint(6) NOT NULL DEFAULT '0',
  `session` smallint(6) NOT NULL DEFAULT '0',
  `ta` int(4) NOT NULL DEFAULT '2002',
  `id_kur` int(4) NOT NULL DEFAULT '2002',
  `kurikulum_id` int(11) DEFAULT NULL,
  `kode_mk` varchar(11) NOT NULL,
  `nim` varchar(8) NOT NULL DEFAULT '',
  `dim_id` int(11) DEFAULT NULL,
  `status` varchar(7) DEFAULT 'H',
  `keterangan` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`berita_acara_daftar_hadir_id`),
  KEY `fk_t_berita_acara_daftar_hadir_t_kurikulum1_idx` (`kurikulum_id`),
  KEY `fk_t_berita_acara_daftar_hadir_t_dim1_idx` (`dim_id`),
  CONSTRAINT `fk_t_berita_acara_daftar_hadir_t_dim1` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_t_berita_acara_daftar_hadir_t_kurikulum1` FOREIGN KEY (`kurikulum_id`) REFERENCES `krkm_kuliah` (`kuliah_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_berita_acara_kuliah` */

DROP TABLE IF EXISTS `prkl_berita_acara_kuliah`;

CREATE TABLE `prkl_berita_acara_kuliah` (
  `berita_acara_kuliah_id` int(11) NOT NULL AUTO_INCREMENT,
  `week` smallint(6) NOT NULL DEFAULT '0',
  `session` smallint(6) NOT NULL DEFAULT '0',
  `ta` int(4) NOT NULL DEFAULT '2002',
  `id_kur` int(4) NOT NULL DEFAULT '2002',
  `kode_mk` varchar(11) NOT NULL,
  `kurikulum_id` int(11) DEFAULT NULL,
  `kelas` varchar(100) NOT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `topik` text,
  `ruangan` varchar(100) DEFAULT NULL,
  `aktifitas` varchar(15) DEFAULT NULL,
  `pic` varchar(20) DEFAULT NULL,
  `metode` text,
  `alat_bantu` text,
  `catatan` text,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`berita_acara_kuliah_id`),
  KEY `fk_t_berita_acara_kuliah_t_kurikulum1_idx` (`kurikulum_id`),
  KEY `fk_t_berita_acara_kuliah_t_kelas1_idx` (`kelas_id`),
  CONSTRAINT `FK_t_berita_acara_kuliah` FOREIGN KEY (`kelas_id`) REFERENCES `adak_kelas` (`kelas_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_t_berita_acara_kuliah_t_kurikulum1` FOREIGN KEY (`kurikulum_id`) REFERENCES `krkm_kuliah` (`kuliah_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_course_unit` */

DROP TABLE IF EXISTS `prkl_course_unit`;

CREATE TABLE `prkl_course_unit` (
  `course_unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `week` smallint(6) NOT NULL DEFAULT '0',
  `session` smallint(6) NOT NULL DEFAULT '0',
  `status` char(1) NOT NULL DEFAULT '',
  `ta` int(4) DEFAULT '2002',
  `id_kur` int(4) DEFAULT '2002',
  `kode_mk` varchar(11) DEFAULT NULL,
  `topik` varchar(255) DEFAULT NULL,
  `sub_topik` text,
  `objektif` text,
  `aktifitas` varchar(15) DEFAULT NULL,
  `pic` varchar(20) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `metode` text,
  `alat_bantu` text,
  `ket` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `day` varchar(10) DEFAULT NULL,
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`course_unit_id`),
  KEY `WEEK` (`week`),
  KEY `SESSION` (`session`),
  KEY `TOPIK` (`topik`),
  KEY `fk_t_course_unit_t_kurikulum1_idx` (`kurikulum_syllabus_id`),
  KEY `FK_prkl_course_unit_pic` (`pegawai_id`),
  CONSTRAINT `FK_prkl_course_unit_kurikulum_syllabus` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_prkl_course_unit_pic` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41510 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_course_unit_material` */

DROP TABLE IF EXISTS `prkl_course_unit_material`;

CREATE TABLE `prkl_course_unit_material` (
  `course_unit_material_id` int(11) NOT NULL AUTO_INCREMENT,
  `week` smallint(6) NOT NULL DEFAULT '0',
  `session` smallint(6) NOT NULL DEFAULT '0',
  `status` char(1) NOT NULL DEFAULT '',
  `ta` int(4) NOT NULL DEFAULT '2002',
  `id_kur` int(4) NOT NULL DEFAULT '2002',
  `kode_mk` varchar(11) NOT NULL,
  `id_material` varchar(255) NOT NULL DEFAULT '',
  `kurikulum_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`course_unit_material_id`),
  KEY `fk_t_course_unit_material_t_kurikulum1_idx` (`kurikulum_id`),
  KEY `fk_t_course_unit_material_t_material1_idx` (`material_id`),
  CONSTRAINT `fk_t_course_unit_material_t_kurikulum1` FOREIGN KEY (`kurikulum_id`) REFERENCES `krkm_kuliah` (`kuliah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_t_course_unit_material_t_material1` FOREIGN KEY (`material_id`) REFERENCES `prkl_material` (`material_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7094 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_file` */

DROP TABLE IF EXISTS `prkl_file`;

CREATE TABLE `prkl_file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(10) NOT NULL DEFAULT '0',
  `ta` int(4) NOT NULL DEFAULT '2002',
  `id_kur` int(4) NOT NULL DEFAULT '2002',
  `kode_mk` varchar(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL DEFAULT '',
  `owner` varchar(30) NOT NULL DEFAULT '',
  `ket` varchar(255) DEFAULT NULL,
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `no_group_file` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`file_id`),
  KEY `fk_t_file_t_kurikulum1_idx` (`kurikulum_syllabus_id`),
  CONSTRAINT `FK_prkl_file_kuri_syllabus` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_file_materi` */

DROP TABLE IF EXISTS `prkl_file_materi`;

CREATE TABLE `prkl_file_materi` (
  `file_materi_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_file` text NOT NULL,
  `kode_file` varchar(50) DEFAULT NULL,
  `ket` text NOT NULL,
  `materi_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`file_materi_id`),
  KEY `FK_prkl_file_materi` (`materi_id`),
  CONSTRAINT `FK_prkl_file_materi` FOREIGN KEY (`materi_id`) REFERENCES `prkl_materi` (`materi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29136 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_file_praktikum` */

DROP TABLE IF EXISTS `prkl_file_praktikum`;

CREATE TABLE `prkl_file_praktikum` (
  `file_praktikum_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_file` text NOT NULL,
  `kode_file` varchar(50) DEFAULT NULL,
  `ket` text NOT NULL,
  `praktikum_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`file_praktikum_id`),
  KEY `FK_prkl_file_praktikum` (`praktikum_id`),
  CONSTRAINT `FK_prkl_file_praktikum` FOREIGN KEY (`praktikum_id`) REFERENCES `prkl_praktikum` (`praktikum_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16924 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_file_syllabus` */

DROP TABLE IF EXISTS `prkl_file_syllabus`;

CREATE TABLE `prkl_file_syllabus` (
  `file_syllabus_id` int(11) NOT NULL AUTO_INCREMENT,
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `nama_file` varchar(200) DEFAULT NULL,
  `ket` text,
  `kode_file` varchar(200) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`file_syllabus_id`),
  KEY `FK_prkl_file_syllabus` (`kurikulum_syllabus_id`),
  CONSTRAINT `FK_prkl_file_syllabus` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_group_kuliah` */

DROP TABLE IF EXISTS `prkl_group_kuliah`;

CREATE TABLE `prkl_group_kuliah` (
  `group_kuliah_id` int(11) NOT NULL AUTO_INCREMENT,
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`group_kuliah_id`),
  KEY `FK_prkl_group_kuliah_syllabus` (`kurikulum_syllabus_id`),
  CONSTRAINT `FK_prkl_group_kuliah_syllabus` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_info_ta` */

DROP TABLE IF EXISTS `prkl_info_ta`;

CREATE TABLE `prkl_info_ta` (
  `info_ta_id` int(11) NOT NULL AUTO_INCREMENT,
  `dim_id` int(11) NOT NULL,
  `judul_ta` text NOT NULL,
  `pembimbing_1` int(11) NOT NULL,
  `pembimbing_2` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`info_ta_id`),
  KEY `FK_prkl_info_ta_dim` (`dim_id`),
  KEY `FK_prkl_info_ta_pembimbing1` (`pembimbing_1`),
  KEY `FK_prkl_info_ta_pembimbing2` (`pembimbing_2`),
  CONSTRAINT `FK_prkl_info_ta_dim` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_prkl_info_ta_pembimbing1` FOREIGN KEY (`pembimbing_1`) REFERENCES `hrdx_dosen` (`dosen_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_prkl_info_ta_pembimbing2` FOREIGN KEY (`pembimbing_2`) REFERENCES `hrdx_dosen` (`dosen_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=628 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_jadwal` */

DROP TABLE IF EXISTS `prkl_jadwal`;

CREATE TABLE `prkl_jadwal` (
  `jadwal_id` int(11) NOT NULL AUTO_INCREMENT,
  `week` smallint(6) NOT NULL DEFAULT '0',
  `tanggal` date NOT NULL,
  `session` smallint(6) NOT NULL DEFAULT '0',
  `ta` int(4) NOT NULL DEFAULT '2002',
  `id_kur` int(4) NOT NULL DEFAULT '2002',
  `kode_mk` varchar(11) NOT NULL,
  `kelas` varchar(20) NOT NULL DEFAULT '',
  `ruangan` varchar(20) DEFAULT NULL,
  `topik` varchar(255) DEFAULT NULL,
  `sub_topik` text,
  `objektif` text,
  `aktifitas` varchar(15) DEFAULT NULL,
  `pic` varchar(20) NOT NULL DEFAULT '',
  `metode` text,
  `alat_bantu` text,
  `ket` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `createad_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`jadwal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_krs_detail` */

DROP TABLE IF EXISTS `prkl_krs_detail`;

CREATE TABLE `prkl_krs_detail` (
  `krs_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `krs_mhs_id` int(11) DEFAULT NULL,
  `kuliah_id` int(11) DEFAULT NULL,
  `pengajaran_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`krs_detail_id`),
  KEY `FK_prkl_krs_detail` (`krs_mhs_id`),
  KEY `FK_prkl_krs_detail_kuliah` (`kuliah_id`),
  KEY `FK_prkl_krs_detail_pengajaran` (`pengajaran_id`),
  CONSTRAINT `FK_prkl_krs_detail` FOREIGN KEY (`krs_mhs_id`) REFERENCES `prkl_krs_mhs` (`krs_mhs_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_prkl_krs_detail_kuliah` FOREIGN KEY (`kuliah_id`) REFERENCES `krkm_kuliah` (`kuliah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_prkl_krs_detail_pengajaran` FOREIGN KEY (`pengajaran_id`) REFERENCES `adak_pengajaran` (`pengajaran_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69085 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_krs_khusus` */

DROP TABLE IF EXISTS `prkl_krs_khusus`;

CREATE TABLE `prkl_krs_khusus` (
  `krs_khusus_id` int(11) NOT NULL AUTO_INCREMENT,
  `ta` int(11) DEFAULT NULL,
  `sem_ta` int(11) DEFAULT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`krs_khusus_id`),
  KEY `fk_prkl_krs_khusus_dimx_dim` (`dim_id`),
  CONSTRAINT `fk_prkl_krs_khusus_dimx_dim` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_krs_mhs` */

DROP TABLE IF EXISTS `prkl_krs_mhs`;

CREATE TABLE `prkl_krs_mhs` (
  `krs_mhs_id` int(11) NOT NULL AUTO_INCREMENT,
  `dim_id` int(11) NOT NULL,
  `nim` varchar(8) NOT NULL,
  `sem_ta` varchar(2) NOT NULL,
  `ta` varchar(5) NOT NULL,
  `tahun_kurikulum_id` int(11) NOT NULL,
  `status_approval` tinyint(1) DEFAULT '0',
  `status_periode` varchar(4) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL COMMENT 'dosen_id',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`krs_mhs_id`),
  KEY `FK_prkl_krs_mhs_ta_kur` (`tahun_kurikulum_id`),
  KEY `FK_prkl_krs_mhs_ta` (`ta`),
  KEY `FK_prkl_krs_mhs-dim` (`dim_id`),
  KEY `FK_prkl_krs_mhs_wali` (`approved_by`),
  CONSTRAINT `FK_prkl_krs_mhs-dim` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_prkl_krs_mhs_pegawai_id` FOREIGN KEY (`approved_by`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_prkl_krs_mhs_ta_kur` FOREIGN KEY (`tahun_kurikulum_id`) REFERENCES `krkm_r_tahun_kurikulum` (`tahun_kurikulum_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9822 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_krs_review` */

DROP TABLE IF EXISTS `prkl_krs_review`;

CREATE TABLE `prkl_krs_review` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_by` int(11) DEFAULT NULL,
  `krs_mhs_id` int(11) DEFAULT NULL,
  `comment` text,
  `tgl_comment` date DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`review_id`),
  KEY `FK_prkl_krs_review_dosen` (`comment_by`),
  KEY `FK_prkl_krs_review` (`krs_mhs_id`),
  CONSTRAINT `FK_prkl_krs_review` FOREIGN KEY (`krs_mhs_id`) REFERENCES `prkl_krs_mhs` (`krs_mhs_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_prkl_krs_review_dosen` FOREIGN KEY (`comment_by`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=730 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_kuesioner_materi` */

DROP TABLE IF EXISTS `prkl_kuesioner_materi`;

CREATE TABLE `prkl_kuesioner_materi` (
  `kuesioner_materi_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kuesioner` int(11) NOT NULL,
  `id_kur` int(11) DEFAULT NULL,
  `ta` int(11) DEFAULT NULL,
  `sem` int(11) DEFAULT NULL,
  `kode_mk` varchar(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'NOT ACTIVE',
  `pengajar` varchar(20) DEFAULT NULL,
  `time_activated` datetime DEFAULT NULL,
  `kurikulum_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_id` datetime DEFAULT NULL,
  `updated_id` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kuesioner_materi_id`),
  KEY `FK_t_kuesioner_materi` (`kurikulum_id`),
  CONSTRAINT `FK_t_kuesioner_materi` FOREIGN KEY (`kurikulum_id`) REFERENCES `krkm_kuliah` (`kuliah_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1623 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_kuesioner_praktikum` */

DROP TABLE IF EXISTS `prkl_kuesioner_praktikum`;

CREATE TABLE `prkl_kuesioner_praktikum` (
  `kuesioner_praktikum_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kuesioner` int(11) NOT NULL,
  `id_kur` int(11) DEFAULT NULL,
  `ta` int(11) DEFAULT NULL,
  `sem` int(11) DEFAULT NULL,
  `kode_mk` varchar(11) DEFAULT NULL,
  `kuliah_id` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'NOT ACTIVE',
  `pengajar` varchar(50) DEFAULT NULL,
  `time_activated` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kuesioner_praktikum_id`),
  KEY `FK_t_kuesioner_praktikum` (`kuliah_id`),
  CONSTRAINT `FK_t_kuesioner_praktikum` FOREIGN KEY (`kuliah_id`) REFERENCES `krkm_kuliah` (`kuliah_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1043 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_kurikulum_syllabus` */

DROP TABLE IF EXISTS `prkl_kurikulum_syllabus`;

CREATE TABLE `prkl_kurikulum_syllabus` (
  `kurikulum_syllabus_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kur` int(11) DEFAULT '2001',
  `kode_mk` varchar(11) DEFAULT NULL,
  `ta` int(4) DEFAULT '2005',
  `sem_ta` int(11) NOT NULL,
  `map_to_kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `prerequisites` text,
  `corerequisites` text,
  `course_description` text,
  `course_objectives` text,
  `learning_outcomes` text,
  `course_format` text,
  `grading_procedure` text,
  `course_content` text,
  `reference` text,
  `tools` text,
  `kuliah_id` int(11) DEFAULT NULL,
  `ta_id` int(11) NOT NULL,
  `meetings` varchar(100) DEFAULT NULL,
  `tipe` varchar(25) DEFAULT NULL,
  `level` varchar(15) DEFAULT NULL,
  `web_page` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kurikulum_syllabus_id`),
  KEY `KODE_MK_2` (`kode_mk`),
  KEY `ID_KUR` (`id_kur`),
  KEY `KODE_MK_3` (`kode_mk`),
  KEY `TA` (`ta`),
  KEY `fk_t_kurikulum_syllabus_t_kurikulum1_idx` (`kuliah_id`),
  KEY `FK_prkl_kurikulum_syllabus_ta` (`ta_id`),
  CONSTRAINT `FK_prkl_kurikulum_syllabus` FOREIGN KEY (`kuliah_id`) REFERENCES `krkm_kuliah` (`kuliah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_prkl_kurikulum_syllabus_ta` FOREIGN KEY (`ta_id`) REFERENCES `mref_r_ta` (`ta_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2435 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_kurikulum_syllabus_file` */

DROP TABLE IF EXISTS `prkl_kurikulum_syllabus_file`;

CREATE TABLE `prkl_kurikulum_syllabus_file` (
  `kurikulum_syllabus_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `kode_file` varchar(255) DEFAULT NULL,
  `keterangan` text,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kurikulum_syllabus_file_id`),
  KEY `FK_prkl_kurikulum_syllabus_file` (`kurikulum_syllabus_id`),
  CONSTRAINT `FK_prkl_kurikulum_syllabus_file` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1058 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_materi` */

DROP TABLE IF EXISTS `prkl_materi`;

CREATE TABLE `prkl_materi` (
  `materi_id` int(11) NOT NULL AUTO_INCREMENT,
  `no` smallint(6) NOT NULL DEFAULT '0',
  `ta` int(4) NOT NULL DEFAULT '2002',
  `id_kur` int(4) NOT NULL DEFAULT '2002',
  `kode_mk` varchar(11) NOT NULL,
  `minggu_ke` char(2) DEFAULT NULL,
  `sesi` smallint(6) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `inisial` varchar(15) DEFAULT NULL,
  `isi` longtext,
  `tgl_sesi` datetime DEFAULT NULL,
  `tgl_view` datetime DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `counter` int(11) DEFAULT '0',
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `group_kuliah_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`materi_id`),
  KEY `FK_prkl_materi_syllabus` (`kurikulum_syllabus_id`),
  KEY `FK_prkl_materi_group_kuliah` (`group_kuliah_id`),
  CONSTRAINT `FK_prkl_materi_group_kuliah` FOREIGN KEY (`group_kuliah_id`) REFERENCES `prkl_group_kuliah` (`group_kuliah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_prkl_materi_syllabus` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22517 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_material` */

DROP TABLE IF EXISTS `prkl_material`;

CREATE TABLE `prkl_material` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_material` varchar(30) NOT NULL DEFAULT '',
  `kategori` varchar(255) NOT NULL DEFAULT '',
  `ta` int(4) NOT NULL DEFAULT '0',
  `id_kur` int(4) NOT NULL DEFAULT '0',
  `kode_mk` varchar(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `aktifitas` varchar(255) DEFAULT NULL,
  `ket_setoran` varchar(255) DEFAULT NULL,
  `batas_akhir` datetime DEFAULT NULL,
  `metoda_penyerahan` enum('Hardcopy','Email','Web') DEFAULT 'Hardcopy',
  `tujuan` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `tgl_view` bigint(20) DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  `komentar` char(1) DEFAULT '0',
  `isi` longtext,
  `material_kategori_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`material_id`),
  KEY `ID_MATERIAL` (`material_id`),
  KEY `fk_t_material_t_material_kategori1_idx` (`material_kategori_id`),
  CONSTRAINT `fk_t_material_t_material_kategori1` FOREIGN KEY (`material_kategori_id`) REFERENCES `prkl_material_kategori` (`material_kategori_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7087 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_material_files` */

DROP TABLE IF EXISTS `prkl_material_files`;

CREATE TABLE `prkl_material_files` (
  `material_files_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_material` varchar(30) NOT NULL DEFAULT '0',
  `nama_file` varchar(255) DEFAULT NULL,
  `kode_file` varchar(100) DEFAULT NULL COMMENT 'id file dari puro',
  `data` longblob,
  `ket` varchar(255) DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `lokasi` enum('DB','FILE') NOT NULL DEFAULT 'DB',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`material_files_id`),
  KEY `ID_MATERIAL` (`id_material`),
  KEY `NAMA_FILE` (`nama_file`)
) ENGINE=InnoDB AUTO_INCREMENT=7458 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_material_kategori` */

DROP TABLE IF EXISTS `prkl_material_kategori`;

CREATE TABLE `prkl_material_kategori` (
  `material_kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) NOT NULL DEFAULT '',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`material_kategori_id`),
  UNIQUE KEY `KATEGORI_UNIQUE` (`kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_penilaian_materi` */

DROP TABLE IF EXISTS `prkl_penilaian_materi`;

CREATE TABLE `prkl_penilaian_materi` (
  `penilaian_materi_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kuesioner` int(11) DEFAULT NULL,
  `id_kur` int(11) DEFAULT NULL,
  `ta` int(11) DEFAULT NULL,
  `kode_mk` varchar(20) DEFAULT NULL,
  `peserta` varchar(20) DEFAULT NULL,
  `s1` int(11) DEFAULT NULL,
  `s2` int(11) DEFAULT NULL,
  `s3` int(11) DEFAULT NULL,
  `s4` int(11) DEFAULT NULL,
  `s5` int(11) DEFAULT NULL,
  `s6` int(11) DEFAULT NULL,
  `skor_total` int(11) DEFAULT NULL,
  `kuesioner_materi_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`penilaian_materi_id`),
  KEY `fk_t_penilaian_materi_t_kuesioner_materi1_idx` (`kuesioner_materi_id`),
  CONSTRAINT `fk_t_penilaian_materi_t_kuesioner_materi1` FOREIGN KEY (`kuesioner_materi_id`) REFERENCES `prkl_kuesioner_materi` (`kuesioner_materi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=93630 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_penilaian_materi_nilai` */

DROP TABLE IF EXISTS `prkl_penilaian_materi_nilai`;

CREATE TABLE `prkl_penilaian_materi_nilai` (
  `penilaian_materi_nilai_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kuesioner` int(11) DEFAULT NULL,
  `peserta` varchar(20) DEFAULT NULL,
  `kesulitan_materi` varchar(10) DEFAULT NULL,
  `pemahaman_mahasiswa` varchar(10) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`penilaian_materi_nilai_id`)
) ENGINE=InnoDB AUTO_INCREMENT=93630 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_penilaian_praktikum` */

DROP TABLE IF EXISTS `prkl_penilaian_praktikum`;

CREATE TABLE `prkl_penilaian_praktikum` (
  `penilaian_praktikum_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kuesioner` int(11) DEFAULT NULL,
  `id_kur` int(11) DEFAULT NULL,
  `ta` int(11) DEFAULT NULL,
  `kode_mk` varchar(20) DEFAULT NULL,
  `peserta` varchar(20) DEFAULT NULL,
  `s1` int(11) DEFAULT NULL,
  `s2` int(11) DEFAULT NULL,
  `s3` int(11) DEFAULT NULL,
  `s4` int(11) DEFAULT NULL,
  `s5` int(11) DEFAULT NULL,
  `s6` int(11) DEFAULT NULL,
  `skor_total` int(11) DEFAULT NULL,
  `kuesioner_praktikum_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`penilaian_praktikum_id`),
  KEY `fk_t_penilaian_praktikum_t_kuesioner_praktikum1_idx` (`kuesioner_praktikum_id`),
  CONSTRAINT `fk_t_penilaian_praktikum_t_kuesioner_praktikum1` FOREIGN KEY (`kuesioner_praktikum_id`) REFERENCES `prkl_kuesioner_praktikum` (`kuesioner_praktikum_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66533 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_penilaian_praktikum_nilai` */

DROP TABLE IF EXISTS `prkl_penilaian_praktikum_nilai`;

CREATE TABLE `prkl_penilaian_praktikum_nilai` (
  `penilaian_praktikum_nilai_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kuesioner` int(11) DEFAULT NULL,
  `peserta` varchar(20) DEFAULT NULL,
  `penyelesaian` varchar(20) DEFAULT NULL,
  `kesulitan_praktikum` varchar(20) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`penilaian_praktikum_nilai_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66533 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_penilaian_tim_pengajar` */

DROP TABLE IF EXISTS `prkl_penilaian_tim_pengajar`;

CREATE TABLE `prkl_penilaian_tim_pengajar` (
  `penilaian_tim_pengajar_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kuesioner` int(11) DEFAULT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `ta` int(11) DEFAULT NULL,
  `kode_mk` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `k1` int(11) DEFAULT NULL,
  `k2` int(11) DEFAULT NULL,
  `k3` int(11) DEFAULT NULL,
  `k4` int(11) DEFAULT NULL,
  `k5` int(11) DEFAULT NULL,
  `k6` int(11) DEFAULT NULL,
  `skor_total` int(11) DEFAULT '0',
  `profile_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`penilaian_tim_pengajar_id`),
  KEY `FK_prkl_penilaian_tim_pengajar_profile` (`profile_id`),
  CONSTRAINT `FK_prkl_penilaian_tim_pengajar_profile` FOREIGN KEY (`profile_id`) REFERENCES `hrdx_profile` (`profile_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10654 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_penilaian_tim_pengajar_nilai` */

DROP TABLE IF EXISTS `prkl_penilaian_tim_pengajar_nilai`;

CREATE TABLE `prkl_penilaian_tim_pengajar_nilai` (
  `penilaian_tim_pengajar_nilai_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kuesioner` int(11) DEFAULT NULL,
  `user` varchar(20) DEFAULT NULL,
  `dosen_id` varchar(20) DEFAULT NULL,
  `ta` int(11) DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `nilai` varchar(5) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`penilaian_tim_pengajar_nilai_id`)
) ENGINE=InnoDB AUTO_INCREMENT=160162 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_praktikum` */

DROP TABLE IF EXISTS `prkl_praktikum`;

CREATE TABLE `prkl_praktikum` (
  `praktikum_id` int(11) NOT NULL AUTO_INCREMENT,
  `no` smallint(6) NOT NULL DEFAULT '0',
  `ta` int(4) NOT NULL DEFAULT '0',
  `id_kur` int(4) NOT NULL DEFAULT '0',
  `kode_mk` varchar(11) NOT NULL,
  `minggu_ke` smallint(6) DEFAULT NULL,
  `sesi` smallint(6) DEFAULT NULL,
  `topik` varchar(255) DEFAULT NULL,
  `aktifitas` varchar(255) DEFAULT NULL,
  `waktu_pengerjaan` varchar(50) DEFAULT NULL,
  `setoran` varchar(255) DEFAULT NULL,
  `batas_akhir` varchar(50) DEFAULT NULL,
  `tempat_penyerahan` varchar(50) DEFAULT NULL,
  `tujuan` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `tgl_view` datetime DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `counter` int(11) DEFAULT '1',
  `isi` longtext,
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `group_kuliah_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`praktikum_id`),
  KEY `NO` (`no`),
  KEY `TOPIK` (`topik`),
  KEY `fk_t_praktikum_t_kurikulum1_idx` (`kurikulum_syllabus_id`),
  KEY `FK_prkl_praktikum_group_kuliah` (`group_kuliah_id`),
  CONSTRAINT `FK_prkl_praktikum_group_kuliah` FOREIGN KEY (`group_kuliah_id`) REFERENCES `prkl_group_kuliah` (`group_kuliah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_prkl_praktikum_syllabus` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11591 DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_rpp` */

DROP TABLE IF EXISTS `prkl_rpp`;

CREATE TABLE `prkl_rpp` (
  `rpp_id` int(11) NOT NULL AUTO_INCREMENT,
  `minggu` int(2) DEFAULT NULL,
  `sesi` int(2) DEFAULT NULL,
  `topik` text,
  `kurikulum_syllabus_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`rpp_id`),
  KEY `FK_prkl_rpp_kurikulum_syllabus` (`kurikulum_syllabus_id`),
  CONSTRAINT `FK_prkl_rpp_kurikulum_syllabus` FOREIGN KEY (`kurikulum_syllabus_id`) REFERENCES `prkl_kurikulum_syllabus` (`kurikulum_syllabus_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `prkl_ruangan` */

DROP TABLE IF EXISTS `prkl_ruangan`;

CREATE TABLE `prkl_ruangan` (
  `ruangan_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_ruangan` varchar(20) NOT NULL DEFAULT '',
  `short_name` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(200) DEFAULT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `ket` text,
  `status` char(1) NOT NULL DEFAULT '1',
  `update_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`ruangan_id`),
  UNIQUE KEY `KODE_RUANGAN_UNIQUE` (`kode_ruangan`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Table structure for table `rakx_detil_program` */

DROP TABLE IF EXISTS `rakx_detil_program`;

CREATE TABLE `rakx_detil_program` (
  `detil_program_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `desc` text,
  `jumlah` decimal(19,4) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`detil_program_id`),
  KEY `fk_detil_program_program_idx` (`program_id`),
  CONSTRAINT `fk_detil_program_program` FOREIGN KEY (`program_id`) REFERENCES `rakx_program` (`program_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `rakx_mata_anggaran` */

DROP TABLE IF EXISTS `rakx_mata_anggaran`;

CREATE TABLE `rakx_mata_anggaran` (
  `mata_anggaran_id` int(11) NOT NULL AUTO_INCREMENT,
  `standar_id` int(11) DEFAULT NULL,
  `kode_anggaran` varchar(45) NOT NULL,
  `name` varchar(100) NOT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`mata_anggaran_id`),
  KEY `fk_mata_anggaran_standar_idx` (`standar_id`),
  KEY `KODE_ANGGARAN` (`kode_anggaran`),
  KEY `NAME` (`name`),
  CONSTRAINT `fk_mata_anggaran_standar` FOREIGN KEY (`standar_id`) REFERENCES `rakx_r_standar` (`standar_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

/*Table structure for table `rakx_program` */

DROP TABLE IF EXISTS `rakx_program`;

CREATE TABLE `rakx_program` (
  `program_id` int(11) NOT NULL AUTO_INCREMENT,
  `struktur_jabatan_has_mata_anggaran_id` int(11) NOT NULL,
  `kode_program` varchar(45) NOT NULL,
  `name` text NOT NULL,
  `tujuan` text,
  `sasaran` text,
  `target` text,
  `desc` text,
  `rencana_strategis_id` int(11) DEFAULT NULL,
  `volume` float NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `harga_satuan` decimal(19,4) NOT NULL,
  `jumlah_sebelum_revisi` decimal(19,4) NOT NULL,
  `jumlah` decimal(19,4) DEFAULT NULL,
  `status_program_id` int(11) DEFAULT NULL,
  `diusulkan_oleh` int(11) NOT NULL,
  `tanggal_diusulkan` datetime DEFAULT NULL,
  `dilaksanakan_oleh` int(11) DEFAULT NULL,
  `disetujui_oleh` int(11) DEFAULT NULL,
  `tanggal_disetujui` datetime DEFAULT NULL,
  `ditolak_oleh` int(11) DEFAULT NULL,
  `tanggal_ditolak` datetime DEFAULT NULL,
  `is_revisi` tinyint(1) DEFAULT '0',
  `direvisi_oleh` int(11) DEFAULT NULL,
  `tanggal_direvisi` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`program_id`),
  KEY `fk_program_satuan_idx` (`satuan_id`),
  KEY `fk_program_rencana_strategis_idx` (`rencana_strategis_id`),
  KEY `fk_program_struktur_jabatan_has_mata_anggaran_idx` (`struktur_jabatan_has_mata_anggaran_id`),
  KEY `fk_program_status_program_idx` (`status_program_id`),
  KEY `fk_program_pengusul_idx` (`diusulkan_oleh`),
  KEY `fk_program_pelaksana_idx` (`dilaksanakan_oleh`),
  KEY `fk_program_perevisi_idx` (`direvisi_oleh`),
  KEY `fk_program_disetujui_idx` (`disetujui_oleh`),
  KEY `fk_program_ditolak_idx` (`ditolak_oleh`),
  KEY `KODE_PROGRAM` (`kode_program`),
  CONSTRAINT `fk_program_dilaksanakan` FOREIGN KEY (`dilaksanakan_oleh`) REFERENCES `inst_struktur_jabatan` (`struktur_jabatan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_program_direvisi` FOREIGN KEY (`direvisi_oleh`) REFERENCES `inst_pejabat` (`pejabat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_program_disetujui` FOREIGN KEY (`disetujui_oleh`) REFERENCES `inst_pejabat` (`pejabat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_program_ditolak` FOREIGN KEY (`ditolak_oleh`) REFERENCES `inst_pejabat` (`pejabat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_program_diusulkan` FOREIGN KEY (`diusulkan_oleh`) REFERENCES `inst_pejabat` (`pejabat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_program_rencana_strategis` FOREIGN KEY (`rencana_strategis_id`) REFERENCES `rakx_r_rencana_strategis` (`rencana_strategis_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_program_satuan` FOREIGN KEY (`satuan_id`) REFERENCES `rakx_r_satuan` (`satuan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_program_status_program` FOREIGN KEY (`status_program_id`) REFERENCES `rakx_r_status_program` (`status_program_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_program_struktur_jabatan_has_mata_anggaran` FOREIGN KEY (`struktur_jabatan_has_mata_anggaran_id`) REFERENCES `rakx_struktur_jabatan_has_mata_anggaran` (`struktur_jabatan_has_mata_anggaran_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=701 DEFAULT CHARSET=latin1;

/*Table structure for table `rakx_program_has_sumber_dana` */

DROP TABLE IF EXISTS `rakx_program_has_sumber_dana`;

CREATE TABLE `rakx_program_has_sumber_dana` (
  `program_has_sumber_dana_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_id` int(11) NOT NULL,
  `sumber_dana_id` int(11) NOT NULL,
  `jumlah` decimal(19,4) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`program_has_sumber_dana_id`),
  KEY `fk_program_has_sumber_dana_program_idx` (`program_id`),
  KEY `fk_program_has_sumber_dana_sumber_dana_idx` (`sumber_dana_id`),
  CONSTRAINT `fk_program_has_sumber_dana_program` FOREIGN KEY (`program_id`) REFERENCES `rakx_program` (`program_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_program_has_sumber_dana_sumber_dana` FOREIGN KEY (`sumber_dana_id`) REFERENCES `rakx_r_sumber_dana` (`sumber_dana_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Table structure for table `rakx_program_has_waktu` */

DROP TABLE IF EXISTS `rakx_program_has_waktu`;

CREATE TABLE `rakx_program_has_waktu` (
  `program_has_waktu_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_id` int(11) NOT NULL,
  `bulan_id` int(11) NOT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`program_has_waktu_id`),
  KEY `fk_program_has_waktu_program_idx` (`program_id`),
  KEY `fk_program_has_waktu_bulan_idx` (`bulan_id`),
  CONSTRAINT `fk_program_has_waktu_bulan` FOREIGN KEY (`bulan_id`) REFERENCES `rakx_r_bulan` (`bulan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_program_has_waktu_program` FOREIGN KEY (`program_id`) REFERENCES `rakx_program` (`program_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Table structure for table `rakx_r_bulan` */

DROP TABLE IF EXISTS `rakx_r_bulan`;

CREATE TABLE `rakx_r_bulan` (
  `bulan_id` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`bulan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Table structure for table `rakx_r_rencana_strategis` */

DROP TABLE IF EXISTS `rakx_r_rencana_strategis`;

CREATE TABLE `rakx_r_rencana_strategis` (
  `rencana_strategis_id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` varchar(11) NOT NULL,
  `name` text NOT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`rencana_strategis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `rakx_r_satuan` */

DROP TABLE IF EXISTS `rakx_r_satuan`;

CREATE TABLE `rakx_r_satuan` (
  `satuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`satuan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Table structure for table `rakx_r_standar` */

DROP TABLE IF EXISTS `rakx_r_standar`;

CREATE TABLE `rakx_r_standar` (
  `standar_id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` int(11) NOT NULL,
  `name` text NOT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`standar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `rakx_r_status_program` */

DROP TABLE IF EXISTS `rakx_r_status_program`;

CREATE TABLE `rakx_r_status_program` (
  `status_program_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`status_program_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Table structure for table `rakx_r_sumber_dana` */

DROP TABLE IF EXISTS `rakx_r_sumber_dana`;

CREATE TABLE `rakx_r_sumber_dana` (
  `sumber_dana_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`sumber_dana_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `rakx_r_tahun_anggaran` */

DROP TABLE IF EXISTS `rakx_r_tahun_anggaran`;

CREATE TABLE `rakx_r_tahun_anggaran` (
  `tahun_anggaran_id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`tahun_anggaran_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `rakx_review_program` */

DROP TABLE IF EXISTS `rakx_review_program`;

CREATE TABLE `rakx_review_program` (
  `review_program_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_id` int(11) NOT NULL,
  `pejabat_id` int(11) NOT NULL,
  `review` text NOT NULL,
  `tanggal_review` datetime NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`review_program_id`),
  KEY `fk_review_anggaran_program_idx` (`program_id`),
  KEY `TANGGAL_REVIEW` (`tanggal_review`),
  KEY `fk_review_anggaran_pejabat_idx` (`pejabat_id`),
  CONSTRAINT `fk_review_anggaran_pejabat` FOREIGN KEY (`pejabat_id`) REFERENCES `inst_pejabat` (`pejabat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_review_anggaran_program` FOREIGN KEY (`program_id`) REFERENCES `rakx_program` (`program_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `rakx_struktur_jabatan_has_mata_anggaran` */

DROP TABLE IF EXISTS `rakx_struktur_jabatan_has_mata_anggaran`;

CREATE TABLE `rakx_struktur_jabatan_has_mata_anggaran` (
  `struktur_jabatan_has_mata_anggaran_id` int(11) NOT NULL AUTO_INCREMENT,
  `struktur_jabatan_id` int(11) NOT NULL,
  `mata_anggaran_id` int(11) NOT NULL,
  `tahun_anggaran_id` int(11) NOT NULL,
  `subtotal` decimal(19,4) DEFAULT '0.0000',
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`struktur_jabatan_has_mata_anggaran_id`),
  KEY `fk_struktur_jabatan_has_mata_anggaran_struktur_jabatan_idx` (`struktur_jabatan_id`),
  KEY `fk_struktur_jabatan_has_mata_anggaran_mata_anggaran_idx` (`mata_anggaran_id`),
  KEY `fk_struktur_jabatan_has_mata_anggaran_tahun_anggaran_idx` (`tahun_anggaran_id`),
  CONSTRAINT `fk_struktur_jabatan_has_mata_anggaran_mata_anggaran` FOREIGN KEY (`mata_anggaran_id`) REFERENCES `rakx_mata_anggaran` (`mata_anggaran_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_struktur_jabatan_has_mata_anggaran_struktur_jabatan` FOREIGN KEY (`struktur_jabatan_id`) REFERENCES `inst_struktur_jabatan` (`struktur_jabatan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_struktur_jabatan_has_mata_anggaran_tahun_anggaran` FOREIGN KEY (`tahun_anggaran_id`) REFERENCES `rakx_r_tahun_anggaran` (`tahun_anggaran_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=256 DEFAULT CHARSET=latin1;

/*Table structure for table `rprt_complaint` */

DROP TABLE IF EXISTS `rprt_complaint`;

CREATE TABLE `rprt_complaint` (
  `complaint_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `bagian_id` int(11) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `desc` text,
  `status_id` int(11) DEFAULT NULL,
  `estimated_date` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`complaint_id`),
  KEY `FK_rprt_complaint_status` (`status_id`),
  KEY `FK_rprt_complaint_user` (`user_id`),
  KEY `FK_rprt_complaint_bagian` (`bagian_id`),
  CONSTRAINT `FK_rprt_complaint_bagian` FOREIGN KEY (`bagian_id`) REFERENCES `rprt_r_bagian` (`bagian_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_rprt_complaint_status` FOREIGN KEY (`status_id`) REFERENCES `rprt_r_status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_rprt_complaint_user` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=517 DEFAULT CHARSET=latin1;

/*Table structure for table `rprt_r_bagian` */

DROP TABLE IF EXISTS `rprt_r_bagian`;

CREATE TABLE `rprt_r_bagian` (
  `bagian_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`bagian_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

/*Table structure for table `rprt_r_status` */

DROP TABLE IF EXISTS `rprt_r_status`;

CREATE TABLE `rprt_r_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `rprt_response` */

DROP TABLE IF EXISTS `rprt_response`;

CREATE TABLE `rprt_response` (
  `response_id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`response_id`),
  KEY `FK_rprt_response_complaint` (`complaint_id`),
  KEY `FK_rprt_response_user` (`user_id`),
  CONSTRAINT `FK_rprt_response_complaint` FOREIGN KEY (`complaint_id`) REFERENCES `rprt_complaint` (`complaint_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_rprt_response_user` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=415 DEFAULT CHARSET=latin1;

/*Table structure for table `rprt_user_has_bagian` */

DROP TABLE IF EXISTS `rprt_user_has_bagian`;

CREATE TABLE `rprt_user_has_bagian` (
  `user_has_bagian_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `bagian_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`user_has_bagian_id`),
  KEY `FK_rprt_user_has_bagian_user` (`user_id`),
  KEY `FK_rprt_user_has_bagian_bagian` (`bagian_id`),
  CONSTRAINT `FK_rprt_user_has_bagian_bagian` FOREIGN KEY (`bagian_id`) REFERENCES `rprt_r_bagian` (`bagian_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_rprt_user_has_bagian_user` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

/*Table structure for table `schd_event` */

DROP TABLE IF EXISTS `schd_event`;

CREATE TABLE `schd_event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `calender_id` int(11) NOT NULL,
  `event` varchar(150) NOT NULL,
  `desc` text,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `all_day` tinyint(1) DEFAULT '0',
  `lokasi_id` int(11) DEFAULT NULL,
  `lokasi_text` varchar(250) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`event_id`),
  KEY `FK_schd_event` (`lokasi_id`),
  KEY `FK_schd_event_calender` (`calender_id`),
  CONSTRAINT `FK_schd_event` FOREIGN KEY (`lokasi_id`) REFERENCES `invt_r_lokasi` (`lokasi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_schd_event_calender` FOREIGN KEY (`calender_id`) REFERENCES `schd_r_calender` (`calender_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `schd_event_invitee` */

DROP TABLE IF EXISTS `schd_event_invitee`;

CREATE TABLE `schd_event_invitee` (
  `event_invitee_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`event_invitee_id`),
  KEY `FK_schd_event_invitee` (`event_id`),
  KEY `FK_schd_event_invitee-user` (`user_id`),
  CONSTRAINT `FK_schd_event_invitee` FOREIGN KEY (`event_id`) REFERENCES `schd_event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_schd_event_invitee-user` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `schd_file_event` */

DROP TABLE IF EXISTS `schd_file_event`;

CREATE TABLE `schd_file_event` (
  `file_event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `nama_file` varchar(200) DEFAULT NULL,
  `kode_file` varchar(200) DEFAULT NULL,
  `ket` text,
  `ta` int(11) DEFAULT NULL,
  `sem_ta` int(11) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`file_event_id`),
  KEY `FK_schd_file_event_file` (`event_id`),
  CONSTRAINT `FK_schd_file_event_file` FOREIGN KEY (`event_id`) REFERENCES `schd_event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `schd_jadwal_kuliah` */

DROP TABLE IF EXISTS `schd_jadwal_kuliah`;

CREATE TABLE `schd_jadwal_kuliah` (
  `jadwal_kuliah_id` int(11) NOT NULL AUTO_INCREMENT,
  `kuliah_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`jadwal_kuliah_id`),
  KEY `FK_schd_jadwal_kuliah` (`event_id`),
  KEY `FK_schd_jadwal_kuliah_kuliah` (`kuliah_id`),
  KEY `FK_schd_jadwal_kuliah_kelas` (`kelas_id`),
  CONSTRAINT `FK_schd_jadwal_kuliah` FOREIGN KEY (`event_id`) REFERENCES `schd_event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_schd_jadwal_kuliah_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `adak_kelas` (`kelas_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_schd_jadwal_kuliah_kuliah` FOREIGN KEY (`kuliah_id`) REFERENCES `krkm_kuliah` (`kuliah_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `schd_r_calender` */

DROP TABLE IF EXISTS `schd_r_calender`;

CREATE TABLE `schd_r_calender` (
  `calender_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `desc` text,
  `is_public` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`calender_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `schd_subscriber` */

DROP TABLE IF EXISTS `schd_subscriber`;

CREATE TABLE `schd_subscriber` (
  `subscriber_id` int(11) NOT NULL AUTO_INCREMENT,
  `calender_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`subscriber_id`),
  KEY `FK_schd_subscriber` (`calender_id`),
  CONSTRAINT `FK_schd_subscriber` FOREIGN KEY (`calender_id`) REFERENCES `schd_r_calender` (`calender_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `sppd_biaya_perjalanan` */

DROP TABLE IF EXISTS `sppd_biaya_perjalanan`;

CREATE TABLE `sppd_biaya_perjalanan` (
  `biaya_perjalanan_id` int(11) NOT NULL AUTO_INCREMENT,
  `surat_tugas_assignee_id` int(11) DEFAULT NULL,
  `status_rencana_sekretariat` tinyint(1) DEFAULT '0',
  `status_rencana_keuangan` tinyint(1) DEFAULT '0',
  `status_realisasi_keuangan` tinyint(1) DEFAULT '0',
  `status_realisasi_dana` tinyint(1) DEFAULT '0',
  `no_spj` varchar(100) DEFAULT NULL,
  `no_surat_pd` varchar(100) DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `status_wr` tinyint(1) DEFAULT '0',
  `status_koordinator_keuangan` tinyint(1) DEFAULT '0',
  `bagian_keuangan` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`biaya_perjalanan_id`),
  KEY `FK_status_realisasi_keuangan` (`status_realisasi_keuangan`),
  KEY `FK_status_rencana_keuangan` (`status_rencana_keuangan`),
  KEY `FK_status_rencana_sekretariat` (`status_rencana_sekretariat`),
  KEY `FK_sppd_biaya_perjalanan_st` (`surat_tugas_assignee_id`),
  CONSTRAINT `FK_sppd_biaya_perjalanan` FOREIGN KEY (`surat_tugas_assignee_id`) REFERENCES `cist_surat_tugas_assignee` (`surat_tugas_assignee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Table structure for table `sppd_biaya_perjalanan_supir` */

DROP TABLE IF EXISTS `sppd_biaya_perjalanan_supir`;

CREATE TABLE `sppd_biaya_perjalanan_supir` (
  `biaya_perjalanan_supir_id` int(11) NOT NULL AUTO_INCREMENT,
  `laporan_pemakaian_kendaraan_id` int(11) DEFAULT NULL,
  `status_realisasi_keuangan` tinyint(1) DEFAULT NULL,
  `kilometer` decimal(19,0) DEFAULT NULL,
  `tanggal_pengambilan` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`biaya_perjalanan_supir_id`),
  UNIQUE KEY `biaya_perjalanan_supir_id` (`biaya_perjalanan_supir_id`),
  KEY `FK_sppd_biaya_perjalanan_supir` (`laporan_pemakaian_kendaraan_id`),
  CONSTRAINT `FK_sppd_biaya_perjalanan_supir` FOREIGN KEY (`laporan_pemakaian_kendaraan_id`) REFERENCES `ubux_laporan_pemakaian_kendaraan` (`laporan_pemakaian_kendaraan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `sppd_daftar_biaya` */

DROP TABLE IF EXISTS `sppd_daftar_biaya`;

CREATE TABLE `sppd_daftar_biaya` (
  `daftar_biaya_id` int(11) NOT NULL AUTO_INCREMENT,
  `biaya_perjalanan_id` int(11) DEFAULT NULL,
  `standar_biaya_id` int(11) DEFAULT NULL,
  `nominal_rencana` decimal(19,4) DEFAULT NULL,
  `nominal_realisasi` decimal(19,4) DEFAULT NULL,
  `desc` text,
  `desc_rencana` text,
  `pengali_rencana` int(11) DEFAULT NULL,
  `pengali_realisasi` int(11) DEFAULT NULL,
  `no_urut_standar` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`daftar_biaya_id`),
  KEY `FK_biaya_perjalanan` (`biaya_perjalanan_id`),
  KEY `FK_sppd_daftar_biaya` (`standar_biaya_id`),
  CONSTRAINT `FK_biaya_perjalanan` FOREIGN KEY (`biaya_perjalanan_id`) REFERENCES `sppd_biaya_perjalanan` (`biaya_perjalanan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_sppd_daftar_biaya` FOREIGN KEY (`standar_biaya_id`) REFERENCES `sppd_standar_biaya` (`standar_biaya_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

/*Table structure for table `sppd_daftar_biaya_supir` */

DROP TABLE IF EXISTS `sppd_daftar_biaya_supir`;

CREATE TABLE `sppd_daftar_biaya_supir` (
  `daftar_biaya_supir_id` int(11) NOT NULL AUTO_INCREMENT,
  `standar_biaya_supir_id` int(11) DEFAULT NULL,
  `biaya_perjalanan_supir_id` int(11) DEFAULT NULL,
  `nominal_realisasi` decimal(19,4) DEFAULT NULL,
  `banyak_hari` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`daftar_biaya_supir_id`),
  KEY `FK_sppd_daftar_biaya_supir` (`standar_biaya_supir_id`),
  KEY `FK_sppd_daftar_biaya_supir_bp` (`biaya_perjalanan_supir_id`),
  CONSTRAINT `FK_sppd_daftar_biaya_supir` FOREIGN KEY (`standar_biaya_supir_id`) REFERENCES `sppd_standar_biaya_supir` (`standar_biaya_supir_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_sppd_daftar_biaya_supir_bp` FOREIGN KEY (`biaya_perjalanan_supir_id`) REFERENCES `sppd_biaya_perjalanan_supir` (`biaya_perjalanan_supir_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Table structure for table `sppd_kategori_biaya` */

DROP TABLE IF EXISTS `sppd_kategori_biaya`;

CREATE TABLE `sppd_kategori_biaya` (
  `kategori_biaya_id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` text,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kategori_biaya_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Table structure for table `sppd_kategori_biaya_supir` */

DROP TABLE IF EXISTS `sppd_kategori_biaya_supir`;

CREATE TABLE `sppd_kategori_biaya_supir` (
  `kategori_biaya_supir_id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` text,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kategori_biaya_supir_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Table structure for table `sppd_standar_biaya` */

DROP TABLE IF EXISTS `sppd_standar_biaya`;

CREATE TABLE `sppd_standar_biaya` (
  `standar_biaya_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_biaya_id` int(11) DEFAULT NULL,
  `biaya` decimal(19,0) DEFAULT NULL,
  `desc` text,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`standar_biaya_id`),
  KEY `FK_kategori_biaya` (`kategori_biaya_id`),
  CONSTRAINT `FK_kategori_biaya` FOREIGN KEY (`kategori_biaya_id`) REFERENCES `sppd_kategori_biaya` (`kategori_biaya_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Table structure for table `sppd_standar_biaya_supir` */

DROP TABLE IF EXISTS `sppd_standar_biaya_supir`;

CREATE TABLE `sppd_standar_biaya_supir` (
  `standar_biaya_supir_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_biaya_supir_id` int(11) DEFAULT NULL,
  `biaya` decimal(19,0) DEFAULT NULL,
  `desc` text,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`standar_biaya_supir_id`),
  KEY `FK_sppd_standar_biaya_supir` (`kategori_biaya_supir_id`),
  CONSTRAINT `FK_sppd_standar_biaya_supir` FOREIGN KEY (`kategori_biaya_supir_id`) REFERENCES `sppd_kategori_biaya_supir` (`kategori_biaya_supir_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Table structure for table `srvy_kuesioner` */

DROP TABLE IF EXISTS `srvy_kuesioner`;

CREATE TABLE `srvy_kuesioner` (
  `kuesioner_id` int(11) NOT NULL AUTO_INCREMENT,
  `sem` int(11) NOT NULL DEFAULT '0',
  `ta` int(11) NOT NULL DEFAULT '0',
  `kode_mk` varchar(11) DEFAULT NULL,
  `nama` varchar(255) NOT NULL DEFAULT '',
  `keterangan` text,
  `instruksi_pengisian` text,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `peserta_kuis` text,
  `is_login` char(1) NOT NULL DEFAULT '1',
  `nilai` float DEFAULT NULL,
  `wajib` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `id_kuesioner` int(11) DEFAULT NULL,
  PRIMARY KEY (`kuesioner_id`),
  KEY `ID_KUESIONER` (`kuesioner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1782 DEFAULT CHARSET=latin1;

/*Table structure for table `srvy_kuesioner_jawaban_peserta` */

DROP TABLE IF EXISTS `srvy_kuesioner_jawaban_peserta`;

CREATE TABLE `srvy_kuesioner_jawaban_peserta` (
  `kuesioner_jawaban_peserta_id` int(11) NOT NULL AUTO_INCREMENT,
  `kuesioner_id` int(11) DEFAULT NULL,
  `kuesioner_pertanyaan_id` int(11) DEFAULT NULL,
  `jawaban` text,
  `peserta` varchar(30) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `id_kuesioner` int(11) DEFAULT '0',
  `id_pertanyaan` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kuesioner_jawaban_peserta_id`),
  KEY `FK_srvy_kuesioner_jawaban_peserta` (`kuesioner_pertanyaan_id`),
  KEY `FK_srvy_kuesioner_jawaban_peserta_kuesioner` (`kuesioner_id`),
  KEY `FK_srvy_kuesioner_jawaban_peserta_user` (`user_id`),
  CONSTRAINT `FK_srvy_kuesioner_jawaban_peserta` FOREIGN KEY (`kuesioner_pertanyaan_id`) REFERENCES `srvy_kuesioner_pertanyaan` (`kuesioner_pertanyaan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_srvy_kuesioner_jawaban_peserta_kuesioner` FOREIGN KEY (`kuesioner_id`) REFERENCES `srvy_kuesioner` (`kuesioner_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_srvy_kuesioner_jawaban_peserta_user` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1886781 DEFAULT CHARSET=latin1;

/*Table structure for table `srvy_kuesioner_opsi` */

DROP TABLE IF EXISTS `srvy_kuesioner_opsi`;

CREATE TABLE `srvy_kuesioner_opsi` (
  `kuesioner_opsi_id` int(11) NOT NULL AUTO_INCREMENT,
  `no_opsi` int(11) NOT NULL,
  `kuesioner_pertanyaan_id` int(11) DEFAULT NULL,
  `ket_opsi` text NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `id_pertanyaan` varchar(20) DEFAULT '0',
  PRIMARY KEY (`kuesioner_opsi_id`),
  KEY `NO_OPSI` (`kuesioner_opsi_id`),
  KEY `FK_srvy_kuesioner_opsi_pertanyaan` (`kuesioner_pertanyaan_id`),
  CONSTRAINT `FK_srvy_kuesioner_opsi_pertanyaan` FOREIGN KEY (`kuesioner_pertanyaan_id`) REFERENCES `srvy_kuesioner_pertanyaan` (`kuesioner_pertanyaan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=190648 DEFAULT CHARSET=latin1;

/*Table structure for table `srvy_kuesioner_pertanyaan` */

DROP TABLE IF EXISTS `srvy_kuesioner_pertanyaan`;

CREATE TABLE `srvy_kuesioner_pertanyaan` (
  `kuesioner_pertanyaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `kuesioner_id` int(11) DEFAULT NULL,
  `nomor` int(11) DEFAULT NULL,
  `pertanyaan` text,
  `tipe_opsi` enum('C','R','T') NOT NULL DEFAULT 'R',
  `kategori` varchar(200) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `id_kuesioner` int(11) DEFAULT '0',
  `id_pertanyaan` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kuesioner_pertanyaan_id`),
  KEY `ID_KUESIONER` (`id_kuesioner`),
  KEY `ID_PERTANYAAN` (`id_pertanyaan`),
  KEY `fk_t_kuesioner_pertanyaan_t_kuesioner1_idx` (`kuesioner_id`),
  CONSTRAINT `fk_t_kuesioner_pertanyaan_t_kuesioner1` FOREIGN KEY (`kuesioner_id`) REFERENCES `srvy_kuesioner` (`kuesioner_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40889 DEFAULT CHARSET=latin1;

/*Table structure for table `srvy_polling` */

DROP TABLE IF EXISTS `srvy_polling`;

CREATE TABLE `srvy_polling` (
  `polling_id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` varchar(20) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT 'All',
  `judul` varchar(255) DEFAULT NULL,
  `pertanyaan` text,
  `ket` text,
  `tgl_exp` datetime DEFAULT NULL,
  `tgl_view` datetime DEFAULT NULL,
  `wajib` tinyint(1) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`polling_id`),
  UNIQUE KEY `POLL_ID_UNIQUE` (`poll_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

/*Table structure for table `srvy_pollopsi` */

DROP TABLE IF EXISTS `srvy_pollopsi`;

CREATE TABLE `srvy_pollopsi` (
  `pollopsi_id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` varchar(20) DEFAULT NULL,
  `no_opsi` smallint(6) DEFAULT '0',
  `polling_id` int(11) DEFAULT NULL,
  `opsi` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`pollopsi_id`),
  KEY `fk_t_POLLOPSI_t_POLLING1_idx` (`polling_id`),
  CONSTRAINT `fk_t_POLLOPSI_t_POLLING1` FOREIGN KEY (`polling_id`) REFERENCES `srvy_polling` (`polling_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=latin1;

/*Table structure for table `srvy_pollvote` */

DROP TABLE IF EXISTS `srvy_pollvote`;

CREATE TABLE `srvy_pollvote` (
  `pollvote_id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` varchar(20) DEFAULT NULL,
  `polling_id` int(11) DEFAULT NULL,
  `no_opsi` smallint(6) DEFAULT '0',
  `pollopsi_id` int(11) DEFAULT NULL,
  `vote_by` int(11) DEFAULT NULL,
  `vote_by_old` varchar(50) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`pollvote_id`),
  KEY `FK_t_pollvote` (`pollopsi_id`),
  KEY `FK_srvy_pollvote_polling_id` (`polling_id`),
  CONSTRAINT `FK_srvy_pollvote_polling_id` FOREIGN KEY (`polling_id`) REFERENCES `srvy_polling` (`polling_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_t_pollvote` FOREIGN KEY (`pollopsi_id`) REFERENCES `srvy_pollopsi` (`pollopsi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5062 DEFAULT CHARSET=latin1;

/*Table structure for table `srvy_workgroup_kuesioner` */

DROP TABLE IF EXISTS `srvy_workgroup_kuesioner`;

CREATE TABLE `srvy_workgroup_kuesioner` (
  `workgroup_id` int(11) DEFAULT NULL,
  `kuesioner_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  KEY `FK_srvy_workgroup_kuesioner_wg` (`workgroup_id`),
  KEY `FK_srvy_workgroup_kuesioner_kuesioner` (`kuesioner_id`),
  CONSTRAINT `FK_srvy_workgroup_kuesioner_kuesioner` FOREIGN KEY (`kuesioner_id`) REFERENCES `srvy_kuesioner` (`kuesioner_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_srvy_workgroup_kuesioner_wg` FOREIGN KEY (`workgroup_id`) REFERENCES `sysx_workgroup` (`workgroup_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `srvy_workgroup_polling` */

DROP TABLE IF EXISTS `srvy_workgroup_polling`;

CREATE TABLE `srvy_workgroup_polling` (
  `workgroup_id` int(11) DEFAULT NULL,
  `polling_id` int(11) DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  KEY `FK_srvy_workgroup_polling_wk` (`workgroup_id`),
  KEY `FK_srvy_workgroup_polling_poll` (`polling_id`),
  CONSTRAINT `FK_srvy_workgroup_polling_poll` FOREIGN KEY (`polling_id`) REFERENCES `srvy_polling` (`polling_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_srvy_workgroup_polling_wk` FOREIGN KEY (`workgroup_id`) REFERENCES `sysx_workgroup` (`workgroup_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `sysx_action` */

DROP TABLE IF EXISTS `sysx_action`;

CREATE TABLE `sysx_action` (
  `action_id` int(11) NOT NULL AUTO_INCREMENT,
  `controller_id` int(11) NOT NULL,
  `identifier` varchar(32) NOT NULL COMMENT 'Action Unique ID',
  `desc` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL COMMENT '	',
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`action_id`),
  KEY `fk_action_controller1_idx` (`controller_id`),
  CONSTRAINT `fk_action_controller1` FOREIGN KEY (`controller_id`) REFERENCES `sysx_controller` (`controller_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1708 DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_application` */

DROP TABLE IF EXISTS `sysx_application`;

CREATE TABLE `sysx_application` (
  `application_id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(32) NOT NULL COMMENT 'Application Unique ID',
  `desc` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL COMMENT '	',
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL COMMENT '	',
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`application_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_authentication_method` */

DROP TABLE IF EXISTS `sysx_authentication_method`;

CREATE TABLE `sysx_authentication_method` (
  `authentication_method_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `server_address` varchar(45) DEFAULT NULL,
  `authentication_string` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `redirected` tinyint(1) DEFAULT '0',
  `redirect_to` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`authentication_method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_config` */

DROP TABLE IF EXISTS `sysx_config`;

CREATE TABLE `sysx_config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL COMMENT '	',
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`config_id`),
  KEY `fk_config_application1_idx` (`application_id`),
  CONSTRAINT `fk_config_application1` FOREIGN KEY (`application_id`) REFERENCES `sysx_application` (`application_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

/*Table structure for table `sysx_controller` */

DROP TABLE IF EXISTS `sysx_controller`;

CREATE TABLE `sysx_controller` (
  `controller_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `identifier` varchar(32) NOT NULL COMMENT 'Controller Unique ID',
  `desc` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL COMMENT '	',
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`controller_id`),
  KEY `fk_controller_module1_idx` (`module_id`),
  CONSTRAINT `fk_controller_module1` FOREIGN KEY (`module_id`) REFERENCES `sysx_module` (`module_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_job_allocation` */

DROP TABLE IF EXISTS `sysx_job_allocation`;

CREATE TABLE `sysx_job_allocation` (
  `job_allocation_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_definition_id` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`job_allocation_id`),
  KEY `fk_job_allocation_job_definition1_idx` (`job_definition_id`),
  CONSTRAINT `fk_job_allocation_job_definition1` FOREIGN KEY (`job_definition_id`) REFERENCES `sysx_job_definition` (`job_definition_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `sysx_job_definition` */

DROP TABLE IF EXISTS `sysx_job_definition`;

CREATE TABLE `sysx_job_definition` (
  `job_definition_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`job_definition_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Table structure for table `sysx_log` */

DROP TABLE IF EXISTS `sysx_log`;

CREATE TABLE `sysx_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message` varchar(500) DEFAULT NULL,
  `host` varchar(45) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `fk_Log_user1_idx` (`user_id`),
  CONSTRAINT `fk_Log_user1` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_menu_group` */

DROP TABLE IF EXISTS `sysx_menu_group`;

CREATE TABLE `sysx_menu_group` (
  `menu_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`menu_group_id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_menu_item` */

DROP TABLE IF EXISTS `sysx_menu_item`;

CREATE TABLE `sysx_menu_item` (
  `menu_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_group_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  `alt` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `is_ajax` tinyint(1) NOT NULL DEFAULT '0',
  `container_id` varchar(45) DEFAULT NULL,
  `disabled` tinyint(1) DEFAULT '0',
  `order_number` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`menu_item_id`),
  KEY `fk_menu_item_menu_group1_idx` (`menu_group_id`),
  CONSTRAINT `fk_menu_item_menu_group1` FOREIGN KEY (`menu_group_id`) REFERENCES `sysx_menu_group` (`menu_group_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=488 DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_module` */

DROP TABLE IF EXISTS `sysx_module`;

CREATE TABLE `sysx_module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `identifier` varchar(32) NOT NULL COMMENT 'Module Unique ID',
  `desc` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL COMMENT '	',
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`module_id`),
  KEY `fk_module_application1_idx` (`application_id`),
  CONSTRAINT `fk_module_application1` FOREIGN KEY (`application_id`) REFERENCES `sysx_application` (`application_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_permission` */

DROP TABLE IF EXISTS `sysx_permission`;

CREATE TABLE `sysx_permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `action_id` int(11) NOT NULL,
  `identifier` varchar(32) NOT NULL COMMENT 'Permission Unique ID',
  `desc` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL COMMENT '	',
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`permission_id`),
  KEY `fk_permission_action1_idx` (`action_id`),
  CONSTRAINT `fk_permission_action1` FOREIGN KEY (`action_id`) REFERENCES `sysx_action` (`action_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_profile` */

DROP TABLE IF EXISTS `sysx_profile`;

CREATE TABLE `sysx_profile` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `avatar_url` varchar(255) DEFAULT NULL,
  `email_2` varchar(100) DEFAULT NULL,
  `mobile_phone_1` varchar(45) DEFAULT NULL,
  `mobile_phone_2` varchar(45) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL COMMENT '	',
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1991 DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_role` */

DROP TABLE IF EXISTS `sysx_role`;

CREATE TABLE `sysx_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL COMMENT '	',
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_role_has_action` */

DROP TABLE IF EXISTS `sysx_role_has_action`;

CREATE TABLE `sysx_role_has_action` (
  `role_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL COMMENT '	',
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`role_id`,`action_id`),
  KEY `fk_role_has_action_action1_idx` (`action_id`),
  KEY `fk_role_has_action_role1_idx` (`role_id`),
  CONSTRAINT `fk_role_has_action_action1` FOREIGN KEY (`action_id`) REFERENCES `sysx_action` (`action_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_role_has_action_role1` FOREIGN KEY (`role_id`) REFERENCES `sysx_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_role_has_application` */

DROP TABLE IF EXISTS `sysx_role_has_application`;

CREATE TABLE `sysx_role_has_application` (
  `role_id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL COMMENT '	',
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`role_id`,`application_id`),
  KEY `fk_role_has_application_application1_idx` (`application_id`),
  KEY `fk_role_has_application_role1_idx` (`role_id`),
  CONSTRAINT `fk_role_has_application_application1` FOREIGN KEY (`application_id`) REFERENCES `sysx_application` (`application_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_role_has_application_role1` FOREIGN KEY (`role_id`) REFERENCES `sysx_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_role_has_controller` */

DROP TABLE IF EXISTS `sysx_role_has_controller`;

CREATE TABLE `sysx_role_has_controller` (
  `role_id` int(11) NOT NULL,
  `controller_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL COMMENT '	',
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`role_id`,`controller_id`),
  KEY `fk_role_has_controller_controller1_idx` (`controller_id`),
  KEY `fk_role_has_controller_role1_idx` (`role_id`),
  CONSTRAINT `fk_role_has_controller_controller1` FOREIGN KEY (`controller_id`) REFERENCES `sysx_controller` (`controller_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_role_has_controller_role1` FOREIGN KEY (`role_id`) REFERENCES `sysx_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_role_has_menu_item` */

DROP TABLE IF EXISTS `sysx_role_has_menu_item`;

CREATE TABLE `sysx_role_has_menu_item` (
  `menu_item_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL COMMENT '	',
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`menu_item_id`,`role_id`),
  KEY `fk_menu_item_has_role_role1_idx` (`role_id`),
  KEY `fk_menu_item_has_role_menu_item1_idx` (`menu_item_id`),
  CONSTRAINT `fk_menu_item_has_role_menu_item1` FOREIGN KEY (`menu_item_id`) REFERENCES `sysx_menu_item` (`menu_item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_menu_item_has_role_role1` FOREIGN KEY (`role_id`) REFERENCES `sysx_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_role_has_module` */

DROP TABLE IF EXISTS `sysx_role_has_module`;

CREATE TABLE `sysx_role_has_module` (
  `role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL COMMENT '	',
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`role_id`,`module_id`),
  KEY `fk_role_has_module_module1_idx` (`module_id`),
  KEY `fk_role_has_module_role1_idx` (`role_id`),
  CONSTRAINT `fk_role_has_module_module1` FOREIGN KEY (`module_id`) REFERENCES `sysx_module` (`module_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_role_has_module_role1` FOREIGN KEY (`role_id`) REFERENCES `sysx_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_role_has_permission` */

DROP TABLE IF EXISTS `sysx_role_has_permission`;

CREATE TABLE `sysx_role_has_permission` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL COMMENT '	',
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `fk_role_has_permission_permission2_idx` (`permission_id`),
  KEY `fk_role_has_permission_role2_idx` (`role_id`),
  CONSTRAINT `fk_role_has_permission_permission2` FOREIGN KEY (`permission_id`) REFERENCES `sysx_permission` (`permission_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_role_has_permission_role2` FOREIGN KEY (`role_id`) REFERENCES `sysx_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_role_has_task` */

DROP TABLE IF EXISTS `sysx_role_has_task`;

CREATE TABLE `sysx_role_has_task` (
  `role_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL COMMENT '	',
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`role_id`,`task_id`),
  KEY `fk_role_has_permission_permission1_idx` (`task_id`),
  KEY `fk_role_has_permission_role1_idx` (`role_id`),
  CONSTRAINT `fk_role_has_permission_permission1` FOREIGN KEY (`task_id`) REFERENCES `sysx_task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_role_has_permission_role1` FOREIGN KEY (`role_id`) REFERENCES `sysx_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_task` */

DROP TABLE IF EXISTS `sysx_task`;

CREATE TABLE `sysx_task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `desc` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL COMMENT '	',
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`task_id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_telkom_sso_user` */

DROP TABLE IF EXISTS `sysx_telkom_sso_user`;

CREATE TABLE `sysx_telkom_sso_user` (
  `telkom_sso_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `forward_auth` tinyint(1) DEFAULT '0' COMMENT 'Forward authentication to local authentication system, or terminate here with provided password',
  `active` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`telkom_sso_user_id`),
  KEY `FK_sysx_telkom_sso_user` (`user_id`),
  CONSTRAINT `FK_sysx_telkom_sso_user` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2348 DEFAULT CHARSET=latin1;

/*Table structure for table `sysx_telkom_sso_user_log` */

DROP TABLE IF EXISTS `sysx_telkom_sso_user_log`;

CREATE TABLE `sysx_telkom_sso_user_log` (
  `telkom_sso_user_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `telkom_sso_user_id` int(11) NOT NULL,
  `action` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  PRIMARY KEY (`telkom_sso_user_log_id`),
  KEY `FK_sysx_telkom_sso_user_log` (`telkom_sso_user_id`),
  CONSTRAINT `FK_sysx_telkom_sso_user_log` FOREIGN KEY (`telkom_sso_user_id`) REFERENCES `sysx_telkom_sso_user` (`telkom_sso_user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2116507 DEFAULT CHARSET=latin1;

/*Table structure for table `sysx_user` */

DROP TABLE IF EXISTS `sysx_user`;

CREATE TABLE `sysx_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) DEFAULT NULL,
  `sysx_key` varchar(32) DEFAULT NULL,
  `authentication_method_id` int(11) NOT NULL DEFAULT '1',
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL COMMENT '	',
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_user_profile1_idx` (`profile_id`),
  KEY `fk_user_authentication_method1_idx` (`authentication_method_id`),
  CONSTRAINT `fk_user_authentication_method1` FOREIGN KEY (`authentication_method_id`) REFERENCES `sysx_authentication_method` (`authentication_method_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_profile1` FOREIGN KEY (`profile_id`) REFERENCES `sysx_profile` (`profile_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3717 DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_user_config` */

DROP TABLE IF EXISTS `sysx_user_config`;

CREATE TABLE `sysx_user_config` (
  `user_config_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL COMMENT '    ',
  `updated_by` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_config_id`),
  KEY `fk_sysx_user_config_sysx_application1_idx` (`application_id`),
  KEY `fk_sysx_user_config_sysx_user1_idx` (`user_id`),
  CONSTRAINT `fk_sysx_user_config_sysx_application1` FOREIGN KEY (`application_id`) REFERENCES `sysx_application` (`application_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sysx_user_config_sysx_user1` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4347 DEFAULT CHARSET=latin1;

/*Table structure for table `sysx_user_has_role` */

DROP TABLE IF EXISTS `sysx_user_has_role`;

CREATE TABLE `sysx_user_has_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL COMMENT '	',
  `updated_by` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `fk_user_has_role_role1_idx` (`role_id`),
  KEY `fk_user_has_role_user_idx` (`user_id`),
  CONSTRAINT `fk_user_has_role_role1` FOREIGN KEY (`role_id`) REFERENCES `sysx_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_has_role_user` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_user_has_workgroup` */

DROP TABLE IF EXISTS `sysx_user_has_workgroup`;

CREATE TABLE `sysx_user_has_workgroup` (
  `user_id` int(11) NOT NULL,
  `workgroup_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`workgroup_id`),
  KEY `fk_user_has_workgroup_workgroup1_idx` (`workgroup_id`),
  CONSTRAINT `fk_user_has_workgroup_user1` FOREIGN KEY (`user_id`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_workgroup_workgroup1` FOREIGN KEY (`workgroup_id`) REFERENCES `sysx_workgroup` (`workgroup_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `sysx_workgroup` */

DROP TABLE IF EXISTS `sysx_workgroup`;

CREATE TABLE `sysx_workgroup` (
  `workgroup_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `protected` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`workgroup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Table structure for table `tmbh_agenda` */

DROP TABLE IF EXISTS `tmbh_agenda`;

CREATE TABLE `tmbh_agenda` (
  `agenda_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_agenda` varchar(20) NOT NULL DEFAULT '',
  `judul` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `isi` longtext,
  `status` char(1) DEFAULT '1',
  `tgl_start` datetime NOT NULL,
  `tgl_end` datetime NOT NULL,
  `waktu_notifikasi` int(11) DEFAULT NULL,
  `notifikasi_by_email` char(1) NOT NULL DEFAULT '0',
  `notifikasi_by_popup` char(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`agenda_id`),
  UNIQUE KEY `AGENDA_ID_UNIQUE` (`id_agenda`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tmbh_file_pengumuman` */

DROP TABLE IF EXISTS `tmbh_file_pengumuman`;

CREATE TABLE `tmbh_file_pengumuman` (
  `file_pengumuman_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_file` text NOT NULL,
  `kode_file` varchar(50) DEFAULT NULL,
  `ket` text NOT NULL,
  `pengumuman_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(32) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`file_pengumuman_id`),
  KEY `FK_tmbh_file_pengumuman` (`pengumuman_id`),
  CONSTRAINT `FK_tmbh_file_pengumuman` FOREIGN KEY (`pengumuman_id`) REFERENCES `tmbh_pengumuman` (`pengumuman_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4313 DEFAULT CHARSET=latin1;

/*Table structure for table `tmbh_kamus_it` */

DROP TABLE IF EXISTS `tmbh_kamus_it`;

CREATE TABLE `tmbh_kamus_it` (
  `kamus_it_id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(255) NOT NULL DEFAULT '',
  `keterangan` text,
  `kategori` varchar(30) DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kamus_it_id`),
  UNIQUE KEY `WORD_UNIQUE` (`word`),
  KEY `WORD` (`word`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

/*Table structure for table `tmbh_kegiatan` */

DROP TABLE IF EXISTS `tmbh_kegiatan`;

CREATE TABLE `tmbh_kegiatan` (
  `kegiatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` varchar(255) NOT NULL DEFAULT '',
  `penyelengara` varchar(100) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `keterangan` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kegiatan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `tmbh_news` */

DROP TABLE IF EXISTS `tmbh_news`;

CREATE TABLE `tmbh_news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_kategori_id` int(11) DEFAULT NULL,
  `id_news` varchar(20) NOT NULL DEFAULT '',
  `judul` varchar(255) DEFAULT NULL,
  `kat_id` varchar(30) DEFAULT NULL,
  `ket_gambar` varchar(255) DEFAULT NULL,
  `pre` text,
  `isi` longtext,
  `sumber` varchar(50) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  `listing` char(1) DEFAULT '1',
  `komentar` char(1) DEFAULT '0',
  `language` char(3) NOT NULL DEFAULT 'INA',
  `tgl_start` datetime NOT NULL,
  `tgl_end` datetime NOT NULL,
  `last_post` bigint(20) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`news_id`),
  KEY `JUDUL` (`judul`),
  KEY `fk_t_NEWS_t_NEWS_KATEGORI1_idx` (`news_kategori_id`),
  CONSTRAINT `fk_t_NEWS_t_NEWS_KATEGORI1` FOREIGN KEY (`news_kategori_id`) REFERENCES `tmbh_news_kategori` (`news_kategori_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tmbh_news_files` */

DROP TABLE IF EXISTS `tmbh_news_files`;

CREATE TABLE `tmbh_news_files` (
  `news_files_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_news` varchar(20) NOT NULL DEFAULT '0',
  `nama_file` varchar(255) NOT NULL DEFAULT '',
  `ket` varchar(255) DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`news_files_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tmbh_news_kategori` */

DROP TABLE IF EXISTS `tmbh_news_kategori`;

CREATE TABLE `tmbh_news_kategori` (
  `news_kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `kat_id` varchar(30) NOT NULL,
  `pkat_id` varchar(30) DEFAULT NULL,
  `kat_nama_ina` varchar(255) NOT NULL DEFAULT '',
  `kat_nama_eng` varchar(255) DEFAULT NULL,
  `kat_ket` varchar(255) DEFAULT NULL,
  `kat_icon` blob,
  `no_urut` smallint(6) NOT NULL DEFAULT '0',
  `kat_list` char(1) NOT NULL DEFAULT '1',
  `tipe` varchar(30) NOT NULL DEFAULT 'konten',
  `menu` varchar(255) DEFAULT NULL,
  `params` varchar(255) DEFAULT NULL,
  `put_as_menu` varchar(30) NOT NULL DEFAULT '',
  `views` char(1) NOT NULL DEFAULT '1',
  `r_akses` varchar(255) DEFAULT NULL,
  `w_akses` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`news_kategori_id`),
  UNIQUE KEY `KAT_ID_UNIQUE` (`kat_id`),
  KEY `KAT_ID` (`kat_id`),
  KEY `PKAT_ID` (`pkat_id`),
  KEY `KAT_NAMA_INA` (`kat_nama_ina`),
  KEY `KAT_NAMA_ENG` (`kat_nama_eng`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tmbh_news_komentar` */

DROP TABLE IF EXISTS `tmbh_news_komentar`;

CREATE TABLE `tmbh_news_komentar` (
  `news_komentar_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_komentar` varchar(10) NOT NULL DEFAULT '',
  `id_news` varchar(20) NOT NULL DEFAULT '',
  `id_parent` varchar(10) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `isi` longtext,
  `pengirim` varchar(50) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`news_komentar_id`),
  KEY `ID_KOMENTAR` (`id_komentar`),
  KEY `JUDUL` (`judul`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tmbh_pengumuman` */

DROP TABLE IF EXISTS `tmbh_pengumuman`;

CREATE TABLE `tmbh_pengumuman` (
  `pengumuman_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(10) NOT NULL DEFAULT '',
  `kategori` varchar(50) NOT NULL DEFAULT '',
  `judul` varchar(255) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `isi` longtext,
  `tgl_exp` date DEFAULT NULL,
  `post_web` char(1) NOT NULL DEFAULT '1',
  `post_dinding` char(1) NOT NULL DEFAULT '0',
  `post_mail` char(1) NOT NULL DEFAULT '0',
  `done_tempel` char(1) NOT NULL DEFAULT '0',
  `done_cabut` char(1) NOT NULL DEFAULT '0',
  `isSticky` char(1) DEFAULT '0',
  `owner` int(11) DEFAULT NULL,
  `user_old` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`pengumuman_id`),
  KEY `FK_tmbh_pengumuman` (`owner`),
  CONSTRAINT `FK_tmbh_pengumuman` FOREIGN KEY (`owner`) REFERENCES `sysx_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11727 DEFAULT CHARSET=latin1;

/*Table structure for table `tmbh_software_tools` */

DROP TABLE IF EXISTS `tmbh_software_tools`;

CREATE TABLE `tmbh_software_tools` (
  `software_tools_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kur` int(4) NOT NULL DEFAULT '0',
  `kode_mk` varchar(8) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `kurikulum_id` int(11) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`software_tools_id`),
  KEY `fk_t_software_tools_t_kurikulum1_idx` (`kurikulum_id`),
  CONSTRAINT `fk_t_software_tools_t_kurikulum1` FOREIGN KEY (`kurikulum_id`) REFERENCES `krkm_kuliah` (`kuliah_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=287 DEFAULT CHARSET=latin1;

/*Table structure for table `ubux_data_paket` */

DROP TABLE IF EXISTS `ubux_data_paket`;

CREATE TABLE `ubux_data_paket` (
  `data_paket_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` int(11) DEFAULT NULL,
  `dim_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `pengirim` varchar(32) DEFAULT NULL,
  `tanggal_kedatangan` datetime NOT NULL,
  `diambil_oleh` varchar(32) DEFAULT NULL,
  `tanggal_diambil` datetime DEFAULT NULL,
  `posisi_paket_id` int(11) DEFAULT NULL,
  `status_paket_id` int(11) DEFAULT NULL,
  `desc` text,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`data_paket_id`),
  KEY `fk_posisi` (`posisi_paket_id`),
  KEY `fk_status` (`status_paket_id`),
  KEY `fk_dim` (`dim_id`),
  KEY `fk_pegawai` (`pegawai_id`),
  CONSTRAINT `fk_dim` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pegawai` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_posisi` FOREIGN KEY (`posisi_paket_id`) REFERENCES `ubux_r_posisi_paket` (`posisi_paket_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_status` FOREIGN KEY (`status_paket_id`) REFERENCES `ubux_r_status_paket` (`status_paket_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6632 DEFAULT CHARSET=latin1;

/*Table structure for table `ubux_data_tamu` */

DROP TABLE IF EXISTS `ubux_data_tamu`;

CREATE TABLE `ubux_data_tamu` (
  `data_tamu_id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(32) DEFAULT NULL,
  `nama` varchar(32) DEFAULT NULL,
  `waktu_kedatangan` datetime NOT NULL,
  `desc` text,
  `waktu_kembali` datetime DEFAULT NULL,
  `kendaraan` varchar(32) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`data_tamu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

/*Table structure for table `ubux_kendaraan` */

DROP TABLE IF EXISTS `ubux_kendaraan`;

CREATE TABLE `ubux_kendaraan` (
  `kendaraan_id` int(11) NOT NULL AUTO_INCREMENT,
  `kendaraan` varchar(100) NOT NULL,
  `daya_tampung_kendaraan` int(11) NOT NULL,
  `plat_nomor` varchar(50) NOT NULL DEFAULT '-',
  `status` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`kendaraan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Table structure for table `ubux_laporan_pemakaian_kendaraan` */

DROP TABLE IF EXISTS `ubux_laporan_pemakaian_kendaraan`;

CREATE TABLE `ubux_laporan_pemakaian_kendaraan` (
  `laporan_pemakaian_kendaraan_id` int(11) NOT NULL AUTO_INCREMENT,
  `pemakaian_kendaraan_id` int(11) NOT NULL,
  `tujuan` text NOT NULL,
  `desc` text NOT NULL,
  `jumlah_penumpang` int(11) NOT NULL,
  `keperluan` text NOT NULL,
  `waktu_keberangkatan` datetime NOT NULL,
  `waktu_tiba` datetime NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  `kendaraan_id` int(11) DEFAULT NULL,
  `supir_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`laporan_pemakaian_kendaraan_id`),
  KEY `fk_ubux_laporan_pemakaian_kendaraan_ubux_supir1_idx` (`supir_id`),
  KEY `kendaraan_id` (`kendaraan_id`),
  KEY `ubux_pemakaian_kendaraaan_id` (`pemakaian_kendaraan_id`),
  CONSTRAINT `ubux_kendaraan_id` FOREIGN KEY (`kendaraan_id`) REFERENCES `ubux_kendaraan` (`kendaraan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ubux_pemakaian_kendaraaan_id` FOREIGN KEY (`pemakaian_kendaraan_id`) REFERENCES `ubux_pemakaian_kendaraan` (`pemakaian_kendaraan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ubux_supir_id` FOREIGN KEY (`supir_id`) REFERENCES `ubux_supir` (`supir_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Table structure for table `ubux_pemakaian_kendaraan` */

DROP TABLE IF EXISTS `ubux_pemakaian_kendaraan`;

CREATE TABLE `ubux_pemakaian_kendaraan` (
  `pemakaian_kendaraan_id` int(11) NOT NULL AUTO_INCREMENT,
  `pemakaian_kendaraan_mhs_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `desc` text NOT NULL,
  `tujuan` text NOT NULL,
  `jumlah_penumpang_kendaraan` int(11) NOT NULL DEFAULT '1',
  `rencana_waktu_keberangkatan` datetime NOT NULL,
  `rencana_waktu_kembali` datetime NOT NULL,
  `status_req_sekretaris_rektorat` int(11) NOT NULL DEFAULT '1',
  `status_request_kemahasiswaan` int(11) NOT NULL DEFAULT '1',
  `jenis_keperluan_id` int(11) NOT NULL DEFAULT '1',
  `proposal` varchar(100) NOT NULL DEFAULT '-',
  `no_telepon` varchar(32) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT '-',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT '-',
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT '-',
  `kendaraan_id` int(11) DEFAULT NULL,
  `supir_id` int(11) DEFAULT NULL,
  `no_hp_supir` varchar(300) NOT NULL DEFAULT '-',
  `status_request_kabiro_KSD` int(11) NOT NULL DEFAULT '1',
  `biaya` decimal(19,4) DEFAULT NULL,
  `konfirmasi_keuangan` tinyint(1) NOT NULL DEFAULT '0',
  `status_request_wr2` int(11) NOT NULL DEFAULT '1',
  `laporan` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`pemakaian_kendaraan_id`),
  KEY `kendaraan_id` (`kendaraan_id`),
  KEY `Supir` (`supir_id`),
  KEY `transaksi_kendaraan_mahasiswa_id` (`pemakaian_kendaraan_mhs_id`),
  KEY `role` (`jenis_keperluan_id`),
  KEY `pegawai_id` (`pegawai_id`),
  CONSTRAINT `FK_jenis_keperluan` FOREIGN KEY (`jenis_keperluan_id`) REFERENCES `ubux_r_jenis_keperluan` (`jenis_keperluan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_pegawai_id` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ubux_permintaan_kendaraan_mahasiswa` FOREIGN KEY (`pemakaian_kendaraan_mhs_id`) REFERENCES `ubux_pemakaian_kendaraan_mhs` (`pemakaian_kendaraan_mhs_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ubux_supir_fk` FOREIGN KEY (`supir_id`) REFERENCES `ubux_supir` (`supir_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ubux_transaksi_kendaraan_mahasiswa_fk` FOREIGN KEY (`kendaraan_id`) REFERENCES `ubux_kendaraan` (`kendaraan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Table structure for table `ubux_pemakaian_kendaraan_mhs` */

DROP TABLE IF EXISTS `ubux_pemakaian_kendaraan_mhs`;

CREATE TABLE `ubux_pemakaian_kendaraan_mhs` (
  `pemakaian_kendaraan_mhs_id` int(11) NOT NULL AUTO_INCREMENT,
  `dim_id` int(11) NOT NULL,
  `desc` text NOT NULL,
  `tujuan` text NOT NULL,
  `jumlah_penumpang_kendaraan` int(11) NOT NULL DEFAULT '1',
  `rencana_waktu_keberangkatan` datetime NOT NULL,
  `rencana_waktu_kembali` datetime NOT NULL,
  `status_req_sekretaris_rektorat` int(11) NOT NULL DEFAULT '1',
  `status_request_kemahasiswaan` int(11) NOT NULL DEFAULT '1',
  `proposal` varchar(100) NOT NULL DEFAULT '-',
  `no_telepon` varchar(32) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT '-',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT '-',
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT '-',
  `kendaraan_id` int(11) DEFAULT NULL,
  `supir_id` int(11) DEFAULT NULL,
  `no_hp_supir` varchar(300) NOT NULL DEFAULT '-',
  `kode_proposal` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`pemakaian_kendaraan_mhs_id`),
  KEY `kendaraan_id` (`kendaraan_id`),
  KEY `Supir` (`supir_id`),
  KEY `dim_id` (`dim_id`),
  KEY `FK_ubux_referensi_1` (`status_req_sekretaris_rektorat`),
  KEY `FK_ubux_referensi_2` (`status_request_kemahasiswaan`),
  CONSTRAINT `FK_dimx_dim_constrain` FOREIGN KEY (`dim_id`) REFERENCES `dimx_dim` (`dim_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ubux_referensi_1` FOREIGN KEY (`status_req_sekretaris_rektorat`) REFERENCES `ubux_r_status_request` (`status_request_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ubux_referensi_2` FOREIGN KEY (`status_request_kemahasiswaan`) REFERENCES `ubux_r_status_request` (`status_request_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Table structure for table `ubux_r_jenis_keperluan` */

DROP TABLE IF EXISTS `ubux_r_jenis_keperluan`;

CREATE TABLE `ubux_r_jenis_keperluan` (
  `jenis_keperluan_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_keperluan` varchar(100) NOT NULL,
  `deleted` tinyint(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`jenis_keperluan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `ubux_r_lokasi_log` */

DROP TABLE IF EXISTS `ubux_r_lokasi_log`;

CREATE TABLE `ubux_r_lokasi_log` (
  `lokasi_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `desc` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`lokasi_log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `ubux_r_posisi_paket` */

DROP TABLE IF EXISTS `ubux_r_posisi_paket`;

CREATE TABLE `ubux_r_posisi_paket` (
  `posisi_paket_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`posisi_paket_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `ubux_r_status_paket` */

DROP TABLE IF EXISTS `ubux_r_status_paket`;

CREATE TABLE `ubux_r_status_paket` (
  `status_paket_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`status_paket_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `ubux_r_status_request` */

DROP TABLE IF EXISTS `ubux_r_status_request`;

CREATE TABLE `ubux_r_status_request` (
  `status_request_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(100) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`status_request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Table structure for table `ubux_supir` */

DROP TABLE IF EXISTS `ubux_supir`;

CREATE TABLE `ubux_supir` (
  `supir_id` int(11) NOT NULL AUTO_INCREMENT,
  `pegawai_id` int(11) NOT NULL DEFAULT '0',
  `no_telepon_supir` varchar(32) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(32) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`supir_id`),
  KEY `hrdx_pegawai_id` (`pegawai_id`),
  CONSTRAINT `FK_hrdx_pegawai_constrain` FOREIGN KEY (`pegawai_id`) REFERENCES `hrdx_pegawai` (`pegawai_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/* Procedure structure for procedure `create_syllabus_by_komposisi_nilai` */

/*!50003 DROP PROCEDURE IF EXISTS  `create_syllabus_by_komposisi_nilai` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`cis_db_admin`@`%` PROCEDURE `create_syllabus_by_komposisi_nilai`()
BEGIN
DECLARE ta_syllabus VARCHAR(10);
declare _id_kur,_kode_mk,_ta,_sem_ta,_kuliah_id,_ta_id varchar(10);
declare rows_count,i, syllabus_count int;
DECLARE curs1 CURSOR FOR SELECT count(a.ta)
FROM `nlai_komposisi_nilai` a
LEFT OUTER JOIN `prkl_kurikulum_syllabus` b
ON a.`kurikulum_syllabus_id` = b.`kurikulum_syllabus_id`
INNER JOIN `krkm_kuliah` c
ON a.`id_kur`=c.`id_kur` AND a.`kode_mk`=c.`kode_mk`
INNER JOIN `mref_r_ta` d
ON a.`ta`=d.`nama`;
DECLARE curs2 cursor for SELECT b.ta,a.id_kur,a.kode_mk,a.ta,a.sem_ta,c.kuliah_id,d.ta_id
FROM `nlai_komposisi_nilai` a
LEFT OUTER JOIN `prkl_kurikulum_syllabus` b
ON a.`kurikulum_syllabus_id` = b.`kurikulum_syllabus_id`
INNER JOIN `krkm_kuliah` c
ON a.`id_kur`=c.`id_kur` AND a.`kode_mk`=c.`kode_mk`
INNER JOIN `mref_r_ta` d
ON a.`ta`=d.`nama`;
open curs1;
	fetch curs1 into rows_count;
close curs1;
open curs2;
Set i=1;
REPEAT
    FETCH curs2 INTO ta_syllabus,_id_kur,_kode_mk,_ta,_sem_ta,_kuliah_id,_ta_id;
    if ta_syllabus is null then
    
	Select count(*) into syllabus_count FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	if syllabus_count=0 then
		insert into `prkl_kurikulum_syllabus` (`id_kur`,`kode_mk`,`ta`,`sem_ta`,`kuliah_id`,`ta_id`) values(_id_kur,_kode_mk,_ta,_sem_ta,_kuliah_id,_ta_id);
	end if;
		
	update `nlai_komposisi_nilai`
	set `kurikulum_syllabus_id`=(select `kurikulum_syllabus_id` from `prkl_kurikulum_syllabus` where `id_kur`=_id_kur and `kode_mk`=_kode_mk and `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `prkl_materi`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `prkl_praktikum`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `nlai_nilai`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `nlai_nilai_praktikum`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `nlai_nilai_quis`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `nlai_nilai_tugas`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `nlai_nilai_uas`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `nlai_nilai_uts`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `nlai_rentang_nilai`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
    end if;
    set i=i+1;
UNTIL i>rows_count END REPEAT;
close curs2;
END */$$
DELIMITER ;

/* Procedure structure for procedure `create_syllabus_by_nilai` */

/*!50003 DROP PROCEDURE IF EXISTS  `create_syllabus_by_nilai` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`cis_db_admin`@`%` PROCEDURE `create_syllabus_by_nilai`()
BEGIN
DECLARE syllabus_id VARCHAR(10);
DECLARE _id_kur,_kode_mk,_ta,_sem_ta,_kuliah_id,_ta_id VARCHAR(10);
DECLARE rows_count,i, syllabus_count INT;
DECLARE curs1 CURSOR FOR SELECT COUNT(a.ta)
FROM `nlai_nilai` a
LEFT OUTER JOIN `krkm_kuliah` c
ON a.`id_kur`=c.`id_kur` AND a.`kode_mk`=c.`kode_mk`
INNER JOIN `mref_r_ta` d
ON a.`ta`=d.`nama`;
DECLARE curs2 CURSOR FOR SELECT a.kurikulum_syllabus_id,a.id_kur,a.kode_mk,a.ta,a.sem_ta,c.kuliah_id,d.ta_id
FROM `nlai_nilai` a
LEFT OUTER JOIN `krkm_kuliah` c
ON a.`id_kur`=c.`id_kur` AND a.`kode_mk`=c.`kode_mk`
INNER JOIN `mref_r_ta` d
ON a.`ta`=d.`nama`;
OPEN curs1;
	FETCH curs1 INTO rows_count;
CLOSE curs1;
OPEN curs2;
SET i=1;
REPEAT
    FETCH curs2 INTO syllabus_id,_id_kur,_kode_mk,_ta,_sem_ta,_kuliah_id,_ta_id;
    IF syllabus_id IS NULL THEN
    
	SELECT COUNT(*) INTO syllabus_count FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	IF syllabus_count=0 THEN
		INSERT INTO `prkl_kurikulum_syllabus` (`id_kur`,`kode_mk`,`ta`,`sem_ta`,`kuliah_id`,`ta_id`) VALUES(_id_kur,_kode_mk,_ta,_sem_ta,_kuliah_id,_ta_id);
	END IF;
			
	UPDATE `nlai_nilai`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	
	UPDATE `nlai_rentang_nilai`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
    END IF;
    SET i=i+1;
UNTIL i>rows_count END REPEAT;
CLOSE curs2;
END */$$
DELIMITER ;

/* Procedure structure for procedure `create_syllabus_by_prkl_materi` */

/*!50003 DROP PROCEDURE IF EXISTS  `create_syllabus_by_prkl_materi` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`cis_db_admin`@`%` PROCEDURE `create_syllabus_by_prkl_materi`()
BEGIN
DECLARE syllabus_id VARCHAR(10);
DECLARE _id_kur,_kode_mk,_ta,_sem,_kuliah_id,_ta_id VARCHAR(10);
DECLARE rows_count,i, syllabus_count,_sem_ta INT;
DECLARE curs1 CURSOR FOR SELECT COUNT(a.ta)
FROM `prkl_materi` a
LEFT OUTER JOIN `krkm_kuliah` c
ON a.`id_kur`=c.`id_kur` AND a.`kode_mk`=c.`kode_mk`
INNER JOIN `mref_r_ta` d
ON a.`ta`=d.`nama`;
DECLARE curs2 CURSOR FOR SELECT a.`kurikulum_syllabus_id`,a.id_kur,a.kode_mk,a.ta,c.sem,c.kuliah_id,d.ta_id
FROM `prkl_materi` a
LEFT OUTER JOIN `krkm_kuliah` c
ON a.`id_kur`=c.`id_kur` AND a.`kode_mk`=c.`kode_mk`
INNER JOIN `mref_r_ta` d
ON a.`ta`=d.`nama`;
OPEN curs1;
	FETCH curs1 INTO rows_count;
CLOSE curs1;
OPEN curs2;
SET i=1;
REPEAT
    FETCH curs2 INTO syllabus_id,_id_kur,_kode_mk,_ta,_sem,_kuliah_id,_ta_id;
    IF syllabus_id IS NULL THEN
    
	SELECT COUNT(*) INTO syllabus_count FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	IF (_sem MOD 2)=0 THEN
		SET _sem_ta=2;
	ELSE
		SET _sem_ta=1;
	END IF;
	
	
	IF syllabus_count=0 THEN
		INSERT INTO `prkl_kurikulum_syllabus` (`id_kur`,`kode_mk`,`ta`,`sem_ta`,`kuliah_id`,`ta_id`) VALUES(_id_kur,_kode_mk,_ta,_sem_ta,_kuliah_id,_ta_id);
	END IF;
		
	UPDATE `prkl_materi`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
    END IF;
    SET i=i+1;
UNTIL i>rows_count END REPEAT;
CLOSE curs2;
END */$$
DELIMITER ;

/* Procedure structure for procedure `create_syllabus_by_prkl_praktikum` */

/*!50003 DROP PROCEDURE IF EXISTS  `create_syllabus_by_prkl_praktikum` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`cis_db_admin`@`%` PROCEDURE `create_syllabus_by_prkl_praktikum`()
BEGIN
DECLARE syllabus_id VARCHAR(10);
DECLARE _id_kur,_kode_mk,_ta,_sem,_kuliah_id,_ta_id VARCHAR(10);
DECLARE rows_count,i, syllabus_count,_sem_ta INT;
DECLARE curs1 CURSOR FOR SELECT COUNT(a.ta)
FROM `prkl_praktikum` a
LEFT OUTER JOIN `krkm_kuliah` c
ON a.`id_kur`=c.`id_kur` AND a.`kode_mk`=c.`kode_mk`
INNER JOIN `mref_r_ta` d
ON a.`ta`=d.`nama`;
DECLARE curs2 CURSOR FOR SELECT a.`kurikulum_syllabus_id`,a.id_kur,a.kode_mk,a.ta,c.sem,c.kuliah_id,d.ta_id
FROM `prkl_praktikum` a
LEFT OUTER JOIN `krkm_kuliah` c
ON a.`id_kur`=c.`id_kur` AND a.`kode_mk`=c.`kode_mk`
INNER JOIN `mref_r_ta` d
ON a.`ta`=d.`nama`;
OPEN curs1;
	FETCH curs1 INTO rows_count;
CLOSE curs1;
OPEN curs2;
SET i=1;
REPEAT
    FETCH curs2 INTO syllabus_id,_id_kur,_kode_mk,_ta,_sem,_kuliah_id,_ta_id;
    IF syllabus_id IS NULL THEN
    
	SELECT COUNT(*) INTO syllabus_count FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
	IF (_sem MOD 2)=0 THEN
		SET _sem_ta=2;
	ELSE
		SET _sem_ta=1;
	END IF;
	
	
	IF syllabus_count=0 THEN
		INSERT INTO `prkl_kurikulum_syllabus` (`id_kur`,`kode_mk`,`ta`,`sem_ta`,`kuliah_id`,`ta_id`) VALUES(_id_kur,_kode_mk,_ta,_sem_ta,_kuliah_id,_ta_id);
	END IF;
		
	UPDATE `prkl_praktikum`
	SET `kurikulum_syllabus_id`=(SELECT `kurikulum_syllabus_id` FROM `prkl_kurikulum_syllabus` WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta)
	WHERE `id_kur`=_id_kur AND `kode_mk`=_kode_mk AND `ta`=_ta;
    END IF;
    SET i=i+1;
UNTIL i>rows_count END REPEAT;
CLOSE curs2;
END */$$
DELIMITER ;

/* Procedure structure for procedure `migrate_data_to_kuliah_prodi` */

/*!50003 DROP PROCEDURE IF EXISTS  `migrate_data_to_kuliah_prodi` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`cis_db_admin`@`%` PROCEDURE `migrate_data_to_kuliah_prodi`()
BEGIN
DECLARE _kuliah_id, _ref_kbk_id, _sem INT;
DECLARE krkm_kuliah_count, i, j, max_prodi INT;
DECLARE curs_krkm_kuliah CURSOR FOR SELECT `kuliah_id`, `ref_kbk_id`, `sem` FROM `krkm_kuliah`;
DECLARE curs_krkm_kuliah_count CURSOR FOR SELECT COUNT(*) FROM `krkm_kuliah`;
OPEN curs_krkm_kuliah_count;
	FETCH curs_krkm_kuliah_count INTO krkm_kuliah_count;
CLOSE curs_krkm_kuliah_count;
OPEN curs_krkm_kuliah;
	SET i=1;
	REPEAT
	FETCH curs_krkm_kuliah INTO _kuliah_id, _ref_kbk_id, _sem;
	IF _ref_kbk_id=11 THEN
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 1, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 2, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 3, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 4, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 5, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 6, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 7, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 8, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 9, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 10, _sem);
	ELSEIF _ref_kbk_id=12 THEN
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 1, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 2, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 3, _sem);
	ELSEIF _ref_kbk_id=13 THEN
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 4, _sem);
	ELSEIF _ref_kbk_id=14 THEN
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 6, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 7, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 8, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 9, _sem);
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, 10, _sem);
	ELSE
		INSERT INTO `krkm_kuliah_prodi` (`kuliah_id`, `ref_kbk_id`, `sem`) VALUES (_kuliah_id, _ref_kbk_id, _sem);
	END IF;
	SET i=i+1;
	UNTIL i>krkm_kuliah_count END REPEAT;
CLOSE curs_krkm_kuliah;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
