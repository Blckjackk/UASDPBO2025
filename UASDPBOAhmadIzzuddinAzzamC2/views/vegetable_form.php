<!-- Saya Ahmad Izzuddin Azzam dengan NIM 2300492 mengerjakan Ujian Akhir Semester dalam 
mata kuliah Desain Pemograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan 
kecurangan seperti yang telah dispesifikasikan. Aamiin. -->

<!-- 
4. View (views/vegetable_list.php, views/vegetable_form.php, views/template/header.php, views/template/footer.php)
   - View bertugas menampilkan data ke user dan menerima input dari user.
   - View hanya menampilkan data yang sudah diolah ViewModel, dan mengirim input user ke index.php (yang nanti diteruskan ke ViewModel).
-->
<?php
require_once 'views/template/header.php';
?>

<div class="max-w-4xl mx-auto p-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl p-6 text-white shadow-lg mb-8">
        <h1 class="text-3xl font-bold mb-2">Tambah Sayur Baru</h1>
        <p class="text-green-100">Masukkan data sayuran yang akan ditambahkan ke inventory</p>
    </div>

    <!-- Form Section -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <h2 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                Form Input Data Sayuran
            </h2>
        </div>
        
        <div class="p-6">
            <form action="index.php?action=save" method="POST" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- ID Field -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            ID Sayuran <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="id" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200" 
                               placeholder="Contoh: KOL1, WRT1, etc."
                               required>
                        <p class="text-xs text-gray-500">Gunakan format singkat dan unik</p>
                    </div>

                    <!-- Nama Field -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            Nama Sayuran <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200" 
                               placeholder="Contoh: Kol Bogor, Wortel Organik"
                               required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tanggal Masuk Field -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            Tanggal Masuk <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggalmasuk" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200" 
                               required>
                    </div>

                    <!-- Harga Field -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            Harga per Pack <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-gray-500 font-medium">Rp</span>
                            <input type="number" step="0.01" name="harga" 
                                   class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200" 
                                   placeholder="15000"
                                   required>
                        </div>
                        <p class="text-xs text-gray-500">Masukkan harga dalam Rupiah</p>
                    </div>
                </div>

                <!-- Asal Pertanian Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        Asal Pertanian <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="asalpertanian" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200" 
                           placeholder="Contoh: Agrofarm, Kinafarm, Junafarm"
                           required>
                </div>

                <!-- Deskripsi Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        Deskripsi Sayuran <span class="text-red-500">*</span>
                    </label>
                    <textarea name="deskripsi" rows="4" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 resize-none" 
                              placeholder="Berikan deskripsi detail tentang sayuran ini, seperti kualitas, ciri khas, dan keunggulan..."
                              required></textarea>
                    <p class="text-xs text-gray-500">Minimal 10 karakter untuk deskripsi yang baik</p>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="index.php" 
                       class="flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors duration-200">
                        ← Kembali ke Daftar
                    </a>
                    <div class="flex gap-4">
                        <button type="reset" 
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-medium">
                            Reset Form
                        </button>
                        <button type="submit" 
                                class="px-8 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg hover:from-green-600 hover:to-emerald-700 transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Simpan Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Info Card -->
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6">
        <div class="flex items-start gap-3">
            <div class="text-blue-500 text-xl">💡</div>
            <div>
                <h3 class="font-semibold text-blue-800 mb-2">Tips Pengisian Form:</h3>
                <ul class="text-sm text-blue-700 space-y-1">
                    <li>• Pastikan ID unik dan mudah diingat</li>
                    <li>• Gunakan nama yang descriptive untuk memudahkan pencarian</li>
                    <li>• Harga dimasukkan dalam format Rupiah tanpa titik</li>
                    <li>• Deskripsi yang detail membantu proses verifikasi</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-format price input
document.querySelector('input[name="harga"]').addEventListener('input', function(e) {
    // Remove non-digit characters except decimal point
    let value = e.target.value.replace(/[^\d.]/g, '');
    e.target.value = value;
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const deskripsi = document.querySelector('textarea[name="deskripsi"]').value;
    const harga = document.querySelector('input[name="harga"]').value;

    
    if (parseFloat(harga) <= 0) {
        e.preventDefault();
        alert('Harga harus lebih dari 0.');
        return false;
    }
    
    // Show loading state
    const submitBtn = e.target.querySelector('button[type="submit"]');
    submitBtn.innerHTML = 'Menyimpan...';
    submitBtn.disabled = true;
});

// Auto-generate ID suggestion based on nama
document.querySelector('input[name="nama"]').addEventListener('input', function(e) {
    const nama = e.target.value;
    const idField = document.querySelector('input[name="id"]');
    
    if (nama && !idField.value) {
        // Generate simple ID from name
        const suggestion = nama.substring(0, 3).toUpperCase() + '1';
        idField.placeholder = `Saran: ${suggestion}`;
    }
});
</script>

<?php
require_once 'views/template/footer.php';
?>