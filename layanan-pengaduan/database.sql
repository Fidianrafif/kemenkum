CREATE DATABASE layanan_kanwil;

USE layanan_kanwil;

CREATE TABLE pengaduan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  jenis_pengaduan VARCHAR(50) NOT NULL,
  isi_pengaduan TEXT NOT NULL,
  tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
