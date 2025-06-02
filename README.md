# UASDPBOAhmadIzzuddinAzzamC2

Program ini merupakan implementasi pola **MVVM (Model - View - ViewModel)** dalam pengelolaan data sayuran. Aplikasi ini dibuat sebagai tugas UAS mata kuliah **Design Pemrograman Berorientasi Objek (DPBO)**.

---

## 🧩 Struktur MVVM

### 1. `index.php` (Controller Utama)
- Merupakan titik awal aplikasi.
- Membaca parameter `action` dari URL untuk menentukan aksi:
  - `list`, `add`, `save`, `update`, `setlayak`, `delete`
- Membuat objek `VegetableViewModel` dan memanggil metode yang sesuai.
- Menampilkan view (`vegetable_list.php`, `vegetable_form.php`) atau mengarahkan ulang (redirect) sesuai aksi user.

### 2. ViewModel (`viewmodel/VegetableViewModel.php`)
- Penghubung antara Controller (`index.php`) dan Model/database.
- Berisi logika aplikasi:
  - Validasi input
  - Mengambil data dari database
  - Menambah, mengubah, menghapus, dan mengatur status kelayakan data sayuran.

### 3. Model (`model/Vegetable.php`)
- Mewakili struktur data objek sayur.
- Menyimpan properti seperti:
  - `id`, `nama`, `harga`, `tanggal_masuk`, `deskripsi`, `asal_pertanian`, `status`, dll.
- Tidak berisi logika database secara langsung; akses database dilakukan melalui ViewModel.

### 4. View (`views/`)
- Menampilkan data kepada user dan menerima input.
- Terdiri dari:
  - `vegetable_list.php` → Menampilkan daftar data.
  - `vegetable_form.php` → Menampilkan form tambah/edit.
  - `template/header.php` dan `template/footer.php` → Template HTML dasar.
- Tidak berisi logika bisnis dan tidak mengakses database secara langsung.

---

## 🔄 Alur Jalannya Program

1. User mengakses `index.php`.
2. `index.php` membaca parameter `action` dan memanggil fungsi di `VegetableViewModel`.
3. ViewModel memproses permintaan dan berinteraksi dengan database menggunakan Model.
4. Data yang dihasilkan dikirim ke View untuk ditampilkan.
5. Aksi dari user (tambah/edit/hapus/set layak) diproses melalui ViewModel, lalu disimpan ke database.
6. Setelah aksi selesai, user diarahkan kembali ke halaman utama (list).

---

## 🧠 Ringkasan MVVM
| Komponen     | Fungsi                                                                 |
|--------------|------------------------------------------------------------------------|
| `index.php`  | Controller utama aplikasi                                              |
| ViewModel    | Jembatan logika antara View dan Model/database                         |
| Model        | Representasi struktur data sayur                                       |
| View         | Menyajikan data ke user dan menerima input, tanpa logika atau database |

---

## 📁 Struktur Folder
UASDPBOAhmadIzzuddinAzzamC2/
│
├── index.php
├── model/
│ └── Vegetable.php
├── viewmodel/
│ └── VegetableViewModel.php
├── views/
│ ├── vegetable_list.php
│ ├── vegetable_form.php
│ └── template/
│ ├── header.php
│ └── footer.php
└── 

## 👨‍💻 Dibuat Oleh
**Ahmad Izzuddin Azzam (C2)**  
UAS - Design Pemrograman Berorientasi Objek  
Semester 4 - Ilmu Komputer
