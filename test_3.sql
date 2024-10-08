/* CREATE TABLE */
CREATE TABLE level (
    id_level INT AUTO_INCREMENT PRIMARY KEY,
    nama_level VARCHAR(100) NOT NULL
);

CREATE TABLE department (
    id_dept INT AUTO_INCREMENT PRIMARY KEY,
    nama_dept VARCHAR(100) NOT NULL
);

CREATE TABLE jabatan (
    id_jabatan INT AUTO_INCREMENT PRIMARY KEY,
    nama_jabatan VARCHAR(100) NOT NULL
);

CREATE TABLE karyawan (
    id_karyawan INT AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(10) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    ttl DATE NOT NULL,
    alamat TEXT NOT NULL,
    id_jabatan INT NOT NULL,
    id_dept INT NOT NULL,
    id_level INT NOT NULL,
    FOREIGN KEY (id_jabatan) REFERENCES jabatan(id_jabatan),
    FOREIGN KEY (id_dept) REFERENCES department(id_dept),
    FOREIGN KEY (id_level) REFERENCES level(id_level)
);


/* INSERT DATA TO TABLE */
INSERT INTO level (nama_level) VALUES  ('Junior'), ('Middle'), ('Senior');
INSERT INTO department (nama_dept) VALUES ('Human Resources'), ('IT'), ('Finance');
INSERT INTO jabatan (nama_jabatan) VALUES ('Staff IT'), ('Manager HR'), ('Financial Analyst');
INSERT INTO karyawan (nik, nama, ttl, alamat, id_jabatan, id_dept, id_level) VALUES 
    ('1234567890', 'Andi', '1990-05-15', 'Jl. Merdeka No. 1', 1, 3, 2),
    ('0987654321', 'Budi', '1985-08-22', 'Jl. Sudirman No. 10', 2, 1, 3),
    ('1122334455', 'Citra', '1992-12-05', 'Jl. Diponegoro No. 5', 3, 2, 1);

/* SELECT DATA */
SELECT 
    karyawan.nik,
    karyawan.nama AS nama_karyawan,
    karyawan.ttl AS tempat_tanggal_lahir,
    jabatan.nama_jabatan,
    department.nama_dept,
    level.nama_level
FROM 
    karyawan
INNER JOIN 
    jabatan ON karyawan.id_jabatan = jabatan.id_jabatan
INNER JOIN 
    department ON karyawan.id_dept = department.id_dept
INNER JOIN 
    level ON karyawan.id_level = level.id_level;


/* EXAMPLE QUERY FOR UPDATE DATA */
UPDATE karyawan
SET 
    nama = 'Yudha',
    ttl = '1999-01-13',
    alamat = 'CIampea, Bogor, Jawa Barat.',
    id_jabatan = 2,
    id_dept = 3,
    id_level = 1
WHERE 
    id_karyawan = 1;

/* EXAMPLE QUERY FOR DELETE DATA */
DELETE FROM karyawan WHERE id_karyawan = 1