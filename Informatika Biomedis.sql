-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Des 2024 pada 11.17
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `informatika_biomedis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$8rPxSY8mBEEBjwjosrQpT.mqu.OFeE9UWdpEVfJWfqnBv1v/Ps1lW');

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian`
--

CREATE TABLE `antrian` (
  `id_antrian` int(10) NOT NULL,
  `id_pasien` int(10) NOT NULL,
  `id_jadwal_dokter` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `no_antrian` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `antrian`
--

INSERT INTO `antrian` (`id_antrian`, `id_pasien`, `id_jadwal_dokter`, `tanggal`, `no_antrian`) VALUES
(1, 10, 1, '0000-00-00', 1),
(2, 10, 1, '0000-00-00', 2),
(3, 10, 1, '0000-00-00', 3),
(4, 10, 1, '0000-00-00', 4),
(5, 10, 1, '0000-00-00', 5),
(6, 10, 1, '0000-00-00', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(10) NOT NULL,
  `judul_berita` text NOT NULL,
  `isi_berita` text NOT NULL,
  `waktu_berita` datetime NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(10) NOT NULL,
  `id_poli` int(10) NOT NULL,
  `nama_dokter` varchar(40) NOT NULL,
  `no_wa` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `deskripsi` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `id_poli`, `nama_dokter`, `no_wa`, `image`, `deskripsi`) VALUES
(1, 1, 'Dr. Vina Amelia', '+628991655470', 'VinaAmelia.jpg', 'Dr. Vina Amelia adalah seorang dokter umum yang berpraktik di Poli Umum. Beliau menyelesaikan pendidikan kedokteran di Universitas Indonesia dan memiliki pengalaman luas dalam memberikan pelayanan kesehatan primer kepada pasien dari berbagai usia. Dr. Vina Amelia menangani berbagai keluhan kesehatan umum, termasuk pemeriksaan rutin, diagnosis awal, pengobatan penyakit ringan hingga sedang, serta rujukan untuk kasus yang memerlukan spesialisasi lebih lanjut. Beliau dikenal karena pendekatan yang ramah, teliti, dan komunikatif dalam menangani pasien, sehingga memberikan kenyamanan dan kepercayaan kepada pasien selama konsultasi. Anda dapat berkonsultasi langsung dengan Dr. Vina Amelia di Poli Umum sesuai jadwal yang tersedia.'),
(2, 2, 'Dr. Siti Aisyah, Sp.A', '+6282195778424', 'SitiAisyah.jpg', 'Dr. Siti Aisyah, Sp.A adalah seorang Dokter Spesialis Anak yang berpraktik di Poli Anak. Beliau menyelesaikan pendidikan kedokteran umum di Universitas Indonesia sebelum melanjutkan spesialisasi di bidang kesehatan anak dan memperoleh gelar Spesialis Anak (Sp.A) dari universitas yang sama. Dengan latar belakang pendidikan yang kuat dan pengalaman klinis yang luas, Dr. Siti Aisyah memiliki keahlian dalam mendiagnosa dan menangani berbagai kondisi kesehatan anak, termasuk gangguan tumbuh kembang, penyakit infeksi, dan alergi. Beliau juga aktif dalam kegiatan seminar medis untuk memperbarui pengetahuan terkini di bidang pediatri. Dengan pendekatan yang humanis dan ramah anak, Dr. Siti Aisyah selalu mengutamakan kenyamanan dan keselamatan pasien dalam setiap sesi konsultasi.'),
(3, 3, 'Dr. Andi Kusuma, Sp.OG', '+62895802929397', 'AndiKusuma.jpg', 'Dr. Andi Kusuma, Sp.OG adalah seorang Dokter Spesialis Obstetri dan Ginekologi yang berpengalaman dalam menangani berbagai masalah kesehatan reproduksi wanita. Beliau menyelesaikan pendidikan kedokteran di Universitas Hasanuddin, Makassar, sebelum melanjutkan pendidikan spesialisasi di bidang Obstetri dan Ginekologi di Fakultas Kedokteran Universitas Indonesia, Jakarta, di mana beliau meraih gelar Sp.OG. Dr. Andi Kusuma memiliki pengalaman yang luas dalam menangani kehamilan, persalinan, serta gangguan pada sistem reproduksi wanita, termasuk masalah menstruasi, kista ovarium, miom, dan penyakit ginekologi lainnya.\n\nSebagai bagian dari komitmennya untuk terus meningkatkan keahlian medis, Dr. Andi Kusuma aktif mengikuti berbagai pelatihan dan seminar. Beliau pernah mengikuti pelatihan internasional mengenai manajemen kehamilan berisiko tinggi di Singapura dan menghadiri konferensi obstetri dan ginekologi di beberapa negara. Selain itu, Dr. Andi Kusuma juga rutin mengikuti workshop tentang teknik terbaru dalam bedah ginekologi dan perawatan kesehatan ibu hamil untuk memberikan pelayanan terbaik kepada pasien.\n\nDengan pendekatan yang ramah dan empatik, Dr. Andi Kusuma memberikan perhatian penuh kepada pasiennya, memastikan mereka mendapatkan perawatan yang sesuai dengan kebutuhan medis dan emosional mereka. Untuk konsultasi, Anda dapat mengunjungi Poli Kandungan di rumah sakit tempat beliau berpraktik.'),
(4, 4, 'Dr. Iwan Setiawan, Sp.PD', '+6285156237557', 'IwanSetiawan.jpg', 'Dr. Iwan Setiawan, Sp.PD adalah seorang Dokter Spesialis Penyakit Dalam yang berpengalaman dalam menangani berbagai kondisi medis pada organ tubuh internal. Beliau menyelesaikan pendidikan kedokteran di Universitas Gadjah Mada, Yogyakarta, sebelum melanjutkan spesialisasi dalam bidang Penyakit Dalam di Fakultas Kedokteran Universitas Indonesia, Jakarta, di mana beliau meraih gelar Sp.PD. Dr. Iwan Setiawan memiliki keahlian dalam mendiagnosis dan mengobati berbagai penyakit kompleks yang melibatkan sistem tubuh internal, seperti penyakit jantung, hipertensi, diabetes, gangguan ginjal, gangguan pencernaan, serta penyakit infeksi dan autoimun.\n\nDr. Iwan Setiawan juga aktif dalam mengikuti pelatihan dan seminar internasional untuk memperbarui pengetahuan medisnya. Beliau pernah mengikuti pelatihan tentang manajemen penyakit jantung di Australia dan konferensi penyakit dalam di Eropa. Dengan pendekatan yang teliti dan komunikatif, Dr. Iwan Setiawan selalu memastikan pasiennya memahami kondisi kesehatannya serta mendapatkan pengobatan terbaik yang sesuai dengan kebutuhan medis mereka.\n\nBeliau juga berfokus pada pengelolaan penyakit kronis dan memberikan perawatan jangka panjang bagi pasien dengan kondisi kesehatan yang memerlukan perhatian khusus. Untuk berkonsultasi, pasien dapat mengunjungi Poli Penyakit Dalam di rumah sakit tempat beliau berpraktik.'),
(5, 5, 'Dr. Lita Pramesti, Sp.THT', '+6282195778424', 'LitaPramesti.jpg', 'Dr. Lita Pramesti, Sp.THT adalah seorang Dokter Spesialis Telinga, Hidung, Tenggorokan (THT) yang memiliki keahlian dalam menangani berbagai gangguan dan penyakit yang berhubungan dengan saluran pernapasan atas dan organ-organ pendengaran. Beliau menyelesaikan pendidikan kedokteran di Universitas Airlangga, Surabaya, dan melanjutkan spesialisasi di bidang THT di Fakultas Kedokteran Universitas Indonesia, Jakarta, meraih gelar Sp.THT. Dr. Lita Pramesti memiliki pengalaman dalam menangani berbagai keluhan pasien yang terkait dengan gangguan telinga, hidung, tenggorokan, seperti infeksi telinga, sinusitis, radang tenggorokan, gangguan pendengaran, serta masalah yang berhubungan dengan keseimbangan tubuh.\n\nSelain berpraktik di Poli THT, Dr. Lita Pramesti aktif mengikuti pelatihan dan seminar mengenai perkembangan terbaru dalam bidang THT, baik di dalam maupun luar negeri. Beliau pernah mengikuti pelatihan terkait pengobatan gangguan pendengaran dan terapi bedah pada saluran pernapasan atas di Eropa. Dengan pendekatan yang ramah dan profesional, Dr. Lita Pramesti memberikan pelayanan medis yang menyeluruh kepada pasien dengan memperhatikan kondisi medis dan kebutuhan individu setiap pasien.\n\nUntuk konsultasi atau pemeriksaan lebih lanjut, pasien dapat mengunjungi Poli THT di rumah sakit tempat beliau berpraktik.'),
(6, 6, 'Dr. Erna Sari, Sp.D', '+628991655470', 'ErnaSari.jpg', 'Dr. Erna Sari, Sp.D adalah seorang Dokter Spesialis Gigi yang berpraktik di Poli Gigi (Odontologi). Beliau menyelesaikan pendidikan kedokteran gigi di Universitas Padjadjaran, Bandung, dan melanjutkan pendidikan spesialisasi di bidang odontologi di Universitas Indonesia, Jakarta, di mana beliau meraih gelar Sp.D. Dr. Erna Sari memiliki keahlian dalam menangani berbagai masalah kesehatan gigi dan mulut, termasuk perawatan gigi berlubang, perawatan saluran akar (endodontik), penyakit gusi, pemasangan gigi palsu, serta pencegahan dan pengobatan masalah gigi pada anak-anak dan orang dewasa.\n\nDr. Erna Sari juga aktif mengikuti pelatihan dan seminar nasional maupun internasional mengenai perkembangan terbaru dalam bidang kedokteran gigi, baik dalam hal perawatan gigi konservatif maupun bedah mulut. Beliau pernah mengikuti pelatihan terkait teknik-teknik terbaru dalam perawatan restorasi gigi dan terapi penyakit gusi di luar negeri. Dengan pendekatan yang komunikatif dan penuh perhatian, Dr. Erna Sari berkomitmen untuk memberikan pelayanan terbaik bagi pasien dengan memperhatikan kenyamanan serta kebutuhan individual pasien.\n\nUntuk berkonsultasi atau melakukan pemeriksaan gigi, pasien dapat mengunjungi Poli Gigi di rumah sakit tempat beliau berpraktik.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_dokter`
--

CREATE TABLE `jadwal_dokter` (
  `id_jadwal_dokter` int(10) NOT NULL,
  `id_dokter` int(10) NOT NULL,
  `hari` varchar(30) NOT NULL,
  `jam` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal_dokter`
--

INSERT INTO `jadwal_dokter` (`id_jadwal_dokter`, `id_dokter`, `hari`, `jam`) VALUES
(1, 1, 'Senin', '9:00 - 17:00'),
(2, 1, 'Selasa', '9:00 - 17:00'),
(3, 1, 'Rabu', '9:00 - 17:00'),
(4, 1, 'Kamis', '9:00 - 17:00'),
(5, 1, 'Jumat', '9:00 - 17:00'),
(6, 1, 'Sabtu', '9:00 - 17:00'),
(7, 1, 'Minggu', 'Tutup'),
(8, 2, 'Senin', '9:00 - 17:00'),
(9, 2, 'Selasa', '9:00 - 17:00'),
(10, 2, 'Rabu', '9:00 - 17:00'),
(11, 2, 'Kamis', '9:00 - 17:00'),
(12, 2, 'Jumat', '9:00 - 17:00'),
(13, 2, 'Sabtu', '9:00 - 17:00'),
(14, 2, 'Minggu', 'Tutup'),
(15, 3, 'Senin', '9:00 - 17:00'),
(16, 3, 'Selasa', '9:00 - 17:00'),
(17, 3, 'Rabu', '9:00 - 17:00'),
(18, 3, 'Kamis', '9:00 - 17:00'),
(19, 3, 'Jumat', '9:00 - 17:00'),
(20, 3, 'Sabtu', '9:00 - 17:00'),
(21, 3, 'Minggu', 'Tutup'),
(22, 4, 'Senin', '9:00 - 17:00'),
(23, 4, 'Selasa', '9:00 - 17:00'),
(24, 4, 'Rabu', '9:00 - 17:00'),
(25, 4, 'Kamis', '9:00 - 17:00'),
(26, 4, 'Jumat', '9:00 - 17:00'),
(27, 4, 'Sabtu', '9:00 - 17:00'),
(28, 4, 'Minggu', 'Tutup'),
(29, 5, 'Senin', '9:00 - 17:00'),
(30, 5, 'Selasa', '9:00 - 17:00'),
(31, 5, 'Rabu', '9:00 - 17:00'),
(32, 5, 'Kamis', '9:00 - 17:00'),
(33, 5, 'Jumat', '9:00 - 17:00'),
(34, 5, 'Sabtu', '9:00 - 17:00'),
(35, 5, 'Minggu', 'Tutup'),
(36, 6, 'Senin', '9:00 - 17:00'),
(37, 6, 'Selasa', '9:00 - 17:00'),
(38, 6, 'Rabu', '9:00 - 17:00'),
(39, 6, 'Kamis', '9:00 - 17:00'),
(40, 6, 'Jumat', '9:00 - 17:00'),
(41, 6, 'Sabtu', '9:00 - 17:00'),
(42, 6, 'Minggu', 'Tutup');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(10) NOT NULL,
  `nama_pasien` varchar(40) NOT NULL,
  `no_ktp` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `nama_wali` varchar(40) NOT NULL,
  `no_kontak_pasien` varchar(20) NOT NULL,
  `no_kontak_wali` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `no_ktp`, `username`, `password`, `tgl_lahir`, `nama_wali`, `no_kontak_pasien`, `no_kontak_wali`) VALUES
(10, 'bang sat', '220211060171', 'sat_21', '$2y$10$daDP8niOOHwxlH.empRug.DM1WplRaTiiBtF.vGYD70/2PtXjNpb6', '2121-02-21', 'herman', '2121212122112', '21122112122112'),
(11, 'admin', '21212121212', 'admin', '$2y$10$8rPxSY8mBEEBjwjosrQpT.mqu.OFeE9UWdpEVfJWfqnBv1v/Ps1lW', '1222-12-12', 'herman', '1212121', '1221211212');

-- --------------------------------------------------------

--
-- Struktur dari tabel `poli`
--

CREATE TABLE `poli` (
  `id_poli` int(10) NOT NULL,
  `nama_poli` varchar(40) NOT NULL,
  `deskripsi_poli` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `poli`
--

INSERT INTO `poli` (`id_poli`, `nama_poli`, `deskripsi_poli`, `image`) VALUES
(1, 'Umum', 'Menangani berbagai keluhan kesehatan umum dan penyakit ringan, memberikan pemeriksaan rutin, serta pengobatan untuk kondisi medis yang tidak memerlukan spesialisasi tertentu.', 'umum.jpg'),
(2, 'Anak', 'Menyediakan perawatan kesehatan untuk anak-anak, dari bayi hingga remaja, meliputi vaksinasi, pemeriksaan tumbuh kembang, dan pengobatan penyakit khas anak.', 'anak.jpg'),
(3, 'Kandungan (Obstetri dan Ginekologi)', 'Menyediakan layanan untuk perawatan kesehatan wanita, terutama terkait dengan kehamilan, persalinan, serta masalah kesehatan reproduksi wanita lainnya.', 'kandungan.jpg'),
(4, 'Penyakit Dalam', 'Fokus pada diagnosis dan pengobatan penyakit yang memengaruhi organ dalam tubuh, seperti jantung, paru, ginjal, dan organ pencernaan.', 'penyakitDalam.jpg'),
(5, 'Poli THT (Telinga, Hidung, Tenggorokan)', 'Menangani masalah kesehatan terkait dengan telinga, hidung, tenggorokan, dan saluran pernapasan atas, termasuk gangguan pendengaran, infeksi saluran pernapasan, dan gangguan lainnya.', 'poliTHT.jpg'),
(6, 'Poli Gigi (Odontologi)', 'Menyediakan layanan perawatan gigi dan mulut, termasuk pemeriksaan, pembersihan gigi, penambalan, pencabutan, serta perawatan saluran akar dan masalah lainnya pada gigi.', 'gigi.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id_rekam_medis` int(10) NOT NULL,
  `id_pasien` int(10) NOT NULL,
  `id_antrian` int(10) NOT NULL,
  `diagnosa` text NOT NULL,
  `id_dokter` int(10) NOT NULL,
  `tekanan_darah_tinggi` int(11) NOT NULL,
  `berat_badan` int(11) NOT NULL,
  `tinggi_badan` int(11) NOT NULL,
  `suhu_badan` int(11) NOT NULL,
  `obat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id_antrian`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indeks untuk tabel `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD PRIMARY KEY (`id_jadwal_dokter`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indeks untuk tabel `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id_poli`);

--
-- Indeks untuk tabel `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`id_rekam_medis`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id_antrian` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  MODIFY `id_jadwal_dokter` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `poli`
--
ALTER TABLE `poli`
  MODIFY `id_poli` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id_rekam_medis` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
