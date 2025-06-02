-- Create the database
CREATE DATABASE IF NOT EXISTS dbsayur;
USE dbsayur;

-- Create table tsayurmasuk
CREATE TABLE tsayurmasuk (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    tanggalmasuk DATE NOT NULL,
    harga DECIMAL(15,2) NOT NULL,
    deskripsi TEXT,
    asalpertanian VARCHAR(100) NOT NULL,
    status VARCHAR(20) CHECK (status IN ('baru', 'layak', 'ditolak'))
);

-- Create table tsayurlayak
CREATE TABLE tsayurlayak (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    tanggalmasuk DATE NOT NULL,
    harga DECIMAL(15,2) NOT NULL,
    deskripsi TEXT,
    asalpertanian VARCHAR(100) NOT NULL,
    status VARCHAR(20) CHECK (status IN ('baru', 'layak', 'ditolak')),
    FOREIGN KEY (id) REFERENCES tsayurmasuk(id)
);
