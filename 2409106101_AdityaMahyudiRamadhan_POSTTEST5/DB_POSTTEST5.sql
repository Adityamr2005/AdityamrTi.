CREATE DATABASE IF NOT EXISTS db_pegawai;
USE db_pegawai;

CREATE TABLE pegawai (
    ID VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100),
    jabatan VARCHAR(100)
);
