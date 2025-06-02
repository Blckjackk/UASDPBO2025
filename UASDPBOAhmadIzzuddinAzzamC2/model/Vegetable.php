<!-- Saya Ahmad Izzuddin Azzam dengan NIM 2300492 mengerjakan Ujian Akhir Semester dalam 
mata kuliah Desain Pemograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan 
kecurangan seperti yang telah dispesifikasikan. Aamiin. -->

<!-- 
3. Model (model/Vegetable.php)
   - Model berisi struktur data sayur (id, nama, harga, tanggal masuk, deskripsi, asal pertanian, status, dll).
   - Model juga bisa berisi fungsi untuk akses database, tapi pada program ini akses database lebih banyak diatur lewat ViewModel.
-->
<?php
require_once 'config/Database.php';

class Vegetable {
    private $conn;
    private $table_masuk = 'tsayurmasuk';
    private $table_layak = 'tsayurlayak';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllMasuk() {
        $query = "SELECT * FROM " . $this->table_masuk;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllLayak() {
        $query = "SELECT * FROM " . $this->table_layak;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    public function create($id, $nama, $tanggalmasuk, $harga, $deskripsi, $asalpertanian) {
        // Validate required fields
        if (!$id || !$nama || !$tanggalmasuk || !$harga || !$asalpertanian) {
            return false;
        }

        $query = "INSERT INTO " . $this->table_masuk . 
                " (id, nama, tanggalmasuk, harga, deskripsi, asalpertanian, status) 
                VALUES (:id, :nama, :tanggalmasuk, :harga, :deskripsi, :asalpertanian, 'baru')";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':tanggalmasuk', $tanggalmasuk);
        $stmt->bindParam(':harga', $harga);
        $stmt->bindParam(':deskripsi', $deskripsi);
        $stmt->bindParam(':asalpertanian', $asalpertanian);
        
        return $stmt->execute();
    }    public function setLayak($id) {
        // Start transaction
        $this->conn->beginTransaction();
        
        try {
            // Get data from tsayurmasuk
            $query = "SELECT * FROM " . $this->table_masuk . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $sayur = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($sayur) {
                // Insert into tsayurlayak
                $query = "INSERT INTO " . $this->table_layak .                        " (id, nama, tanggalmasuk, harga, deskripsi, asalpertanian, status) 
                        VALUES (:id, :nama, :tanggalmasuk, :harga, :deskripsi, :asalpertanian, 'layak')";
                
                $stmt = $this->conn->prepare($query);                $stmt->bindParam(':id', $sayur['id']);
                $stmt->bindParam(':nama', $sayur['nama']);
                $stmt->bindParam(':tanggalmasuk', $sayur['tanggalmasuk']);
                $stmt->bindParam(':harga', $sayur['harga']);
                $stmt->bindParam(':deskripsi', $sayur['deskripsi']);
                $stmt->bindParam(':asalpertanian', $sayur['asalpertanian']);
                $stmt->execute();
                
                // Update status in tsayurmasuk
                $query = "UPDATE " . $this->table_masuk . " SET status = 'layak' WHERE id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                
                $this->conn->commit();
                return true;
            }
            
            $this->conn->rollBack();
            return false;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function update($id, $harga, $status) {
        // Start transaction
        $this->conn->beginTransaction();
        
        try {
            // Update in tsayurmasuk
            $query = "UPDATE " . $this->table_masuk . 
                    " SET harga = :harga, status = :status 
                    WHERE id = :id";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':harga', $harga);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            // If status is layak, ensure it exists in tsayurlayak
            if ($status == 'layak') {
                // Check if already exists in tsayurlayak
                $query = "SELECT COUNT(*) FROM " . $this->table_layak . " WHERE id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $exists = $stmt->fetchColumn();
                
                if (!$exists) {
                    // Get data from tsayurmasuk
                    $query = "SELECT * FROM " . $this->table_masuk . " WHERE id = :id";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    $sayur = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    // Insert into tsayurlayak
                    $query = "INSERT INTO " . $this->table_layak . 
                            " (id, nama, tanggalmasuk, harga, deskripsi, asalpertanian, status) 
                            VALUES (:id, :nama, :tanggalmasuk, :harga, :deskripsi, :asalpertanian, :status)";
                    
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':id', $sayur['id']);
                    $stmt->bindParam(':nama', $sayur['nama']);
                    $stmt->bindParam(':tanggalmasuk', $sayur['tanggalmasuk']);
                    $stmt->bindParam(':harga', $sayur['harga']);
                    $stmt->bindParam(':deskripsi', $sayur['deskripsi']);
                    $stmt->bindParam(':asalpertanian', $sayur['asalpertanian']);
                    $stmt->bindParam(':status', $status);
                    $stmt->execute();
                }
            } elseif ($status == 'ditolak') {
                // If status is ditolak, remove from tsayurlayak if exists
                $query = "DELETE FROM " . $this->table_layak . " WHERE id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
            }
            
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function delete($id) {
        // Start transaction
        $this->conn->beginTransaction();
        
        try {
            // First delete from tsayurlayak if exists
            $query = "DELETE FROM " . $this->table_layak . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            // Then delete from tsayurmasuk
            $query = "DELETE FROM " . $this->table_masuk . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }
}
?>
