<!-- Saya Ahmad Izzuddin Azzam dengan NIM 2300492 mengerjakan Ujian Akhir Semester dalam 
mata kuliah Desain Pemograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan 
kecurangan seperti yang telah dispesifikasikan. Aamiin. -->

<!-- 
2. ViewModel (viewmodel/VegetableViewModel.php)
   - ViewModel adalah penghubung antara index.php (controller/view) dan Model/database.
   - ViewModel berisi fungsi untuk mengambil, menambah, mengupdate, menghapus, dan mengubah status data sayur.
   - Semua logika pengolahan data dilakukan di ViewModel, termasuk validasi dan pemanggilan Model.
 -->
<?php
require_once 'model/Vegetable.php';

class VegetableViewModel {
    private $vegetable;

    public function __construct() {
        $this->vegetable = new Vegetable();
    }

    public function getVegetableMasukList() {
        return $this->vegetable->getAllMasuk();
    }

    public function getVegetableLayakList() {
        return $this->vegetable->getAllLayak();
    }    public function addVegetable($id, $nama, $tanggalmasuk, $harga, $deskripsi, $asalpertanian) {
        return $this->vegetable->create($id, $nama, $tanggalmasuk, $harga, $deskripsi, $asalpertanian);
    }

    public function setVegetableLayak($id) {
        return $this->vegetable->setLayak($id);
    }

    public function updateVegetable($id, $harga, $status) {
        return $this->vegetable->update($id, $harga, $status);
    }

    public function deleteVegetable($id) {
        return $this->vegetable->delete($id);
    }
}
?>
