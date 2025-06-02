<!-- Saya Ahmad Izzuddin Azzam dengan NIM 2300492 mengerjakan Ujian Akhir Semester dalam 
mata kuliah Desain Pemograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan 
kecurangan seperti yang telah dispesifikasikan. Aamiin. -->

<!-- 
1. index.php (Controller utama)
   - index.php adalah awal mulanya kitaa masuk aplikasi. Di sini, parameter 'action' dari URL dibaca untuk menentukan aksi apa yang dilakukan user (list, add, save, update, setlayak, delete).
   - index.php membuat objek VegetableViewModel (ViewModel) dan memanggil fungsi-fungsi di ViewModel sesuai aksi user.
   - Untuk aksi 'list', index.php Get / mengambil data dari ViewModel lalu mengirimkannya ke views/vegetable_list.php untuk ditampilkan.
   - Untuk aksi 'add', index.php menampilkan form tambah/edit lewat views/vegetable_form.php.
   - Untuk aksi 'save', 'update', 'setlayak', dan 'delete', index.php memanggil fungsi ViewModel yang sesuai untuk memproses data ke database, lalu redirect ke halaman utama.
 
2. Alur Jalannya Program
   - User mengakses aplikasi lewat index.php.
   - index.php membaca aksi user (dari URL atau form), lalu memanggil fungsi di ViewModel.
   - ViewModel mengambil/memproses data dari database (lewat Model/Database.php).
   - Data yang sudah siap dikirim ke View untuk ditampilkan.
   - Jika user melakukan aksi (tambah/edit/hapus/set layak), data dikirim dari View ke index.php, lalu ke ViewModel, lalu ke database.
   - Setelah aksi selesai, user akan diarahkan kembali ke halaman utama (list data).

Intinya: index.php sebagai controller utama, ViewModel sebagai jembatan logika, Model untuk struktur data, View untuk tampilan. Semua akses database lewat ViewModel, View tidak pernah langsung akses database.
-->

<?php
require_once 'viewmodel/VegetableViewModel.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$viewModel = new VegetableViewModel();

if ($action == 'list') {
    $vegetableMasukList = $viewModel->getVegetableMasukList();
    $vegetableLayakList = $viewModel->getVegetableLayakList();
    require_once 'views/vegetable_list.php';
} elseif ($action == 'add') {
    require_once 'views/vegetable_form.php';
} elseif ($action == 'save') {
    $viewModel->addVegetable(
        $_POST['id'],
        $_POST['nama'],
        $_POST['tanggalmasuk'],
        $_POST['harga'],
        $_POST['deskripsi'],
        $_POST['asalpertanian']
    );
    header('Location: index.php');
} elseif ($action == 'update') {
    $viewModel->updateVegetable(
        $_GET['id'],
        $_POST['harga'],
        $_POST['status']
    );
    header('Location: index.php');
} elseif ($action == 'setlayak') {
    $viewModel->setVegetableLayak($_GET['id']);
    header('Location: index.php');
} elseif ($action == 'delete') {
    $viewModel->deleteVegetable($_GET['id']);
    header('Location: index.php');
}
?>
