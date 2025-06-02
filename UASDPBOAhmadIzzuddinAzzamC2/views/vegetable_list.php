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

<div class="max-w-7xl mx-auto p-6 space-y-8">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl p-6 text-white shadow-lg">
        <h1 class="text-3xl font-bold mb-2">Supermarket Sayuran UAS DPBO Jack</h1>
        <p class="text-green-100">Sistem Manajemen Sayuran Modern</p>
    </div>

    <!-- Daftar Sayur Masuk -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800">Daftar Sayur Masuk</h2>
                <a href="index.php?action=add" 
                   class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200 shadow-md hover:shadow-lg">
                    + Tambah Sayur
                </a>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">ID</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">Tanggal</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">Harga</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">Deskripsi</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">Asal Pertanian</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($vegetableMasukList as $veg): ?>
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-4 py-4 text-sm font-medium text-gray-900"><?php echo $veg['id']; ?></td>
                        <td class="px-4 py-4 text-sm text-gray-700"><?php echo $veg['nama']; ?></td>
                        <td class="px-4 py-4 text-sm text-gray-600"><?php echo $veg['tanggalmasuk']; ?></td>
                        <td class="px-4 py-4 text-sm font-semibold text-green-600">Rp <?php echo number_format($veg['harga'], 0, ',', '.'); ?></td>
                        <td class="px-4 py-4 text-sm text-gray-600 max-w-xs truncate"><?php echo $veg['deskripsi']; ?></td>
                        <td class="px-4 py-4 text-sm text-gray-600"><?php echo $veg['asalpertanian']; ?></td>
                        <td class="px-4 py-4">
                            <?php 
                            $statusClass = '';
                            switch($veg['status']) {
                                case 'baru': $statusClass = 'bg-blue-100 text-blue-800'; break;
                                case 'layak': $statusClass = 'bg-green-100 text-green-800'; break;
                                case 'ditolak': $statusClass = 'bg-red-100 text-red-800'; break;
                            }
                            ?>
                            <span class="px-3 py-1 rounded-full text-xs font-medium <?php echo $statusClass; ?>">
                                <?php echo ucfirst($veg['status']); ?>
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <div class="space-y-2">
                                <!-- Form Update -->
                                <form action="index.php?action=update&id=<?php echo $veg['id']; ?>" method="POST" class="flex flex-wrap gap-2 items-end">
                                    <div>
                                        <input type="number" step="0.01" name="harga" value="<?php echo $veg['harga']; ?>" 
                                               class="border border-gray-300 rounded-md px-2 py-1 text-sm w-24 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <select name="status" class="border border-gray-300 rounded-md px-2 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <option value="baru" <?php echo $veg['status'] == 'baru' ? 'selected' : ''; ?>>Baru</option>
                                            <option value="layak" <?php echo $veg['status'] == 'layak' ? 'selected' : ''; ?>>Layak</option>
                                            <option value="ditolak" <?php echo $veg['status'] == 'ditolak' ? 'selected' : ''; ?>>Ditolak</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm font-medium transition-colors duration-200">
                                        Ubah
                                    </button>
                                </form>
                                
                                <!-- Action Buttons -->
                                <div class="flex gap-2">
                                    <?php if ($veg['status'] == 'baru'): ?>
                                    <a href="index.php?action=setlayak&id=<?php echo $veg['id']; ?>" 
                                       class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md text-sm font-medium transition-colors duration-200">
                                        ✓ Layak
                                    </a>
                                    <?php endif; ?>
                                    <a href="index.php?action=delete&id=<?php echo $veg['id']; ?>" 
                                       class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm font-medium transition-colors duration-200"
                                       onclick="return confirm('Yakin ingin menghapus?');">
                                        🗑️ Hapus
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Daftar Sayur Layak -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-green-50 px-6 py-4 border-b border-green-200">
            <h2 class="text-2xl font-semibold text-gray-800">Daftar Sayur Layak</h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-green-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">ID</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">Tanggal</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">Harga</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">Deskripsi</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">Asal Pertanian</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($vegetableLayakList as $veg): ?>
                    <tr class="hover:bg-green-50 transition-colors duration-150">
                        <td class="px-4 py-4 text-sm font-medium text-gray-900"><?php echo $veg['id']; ?></td>
                        <td class="px-4 py-4 text-sm text-gray-700"><?php echo $veg['nama']; ?></td>
                        <td class="px-4 py-4 text-sm text-gray-600"><?php echo $veg['tanggalmasuk']; ?></td>
                        <td class="px-4 py-4 text-sm font-semibold text-green-600">Rp <?php echo number_format($veg['harga'], 0, ',', '.'); ?></td>
                        <td class="px-4 py-4 text-sm text-gray-600 max-w-xs truncate"><?php echo $veg['deskripsi']; ?></td>
                        <td class="px-4 py-4 text-sm text-gray-600"><?php echo $veg['asalpertanian']; ?></td>
                        <td class="px-4 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                ✓ Layak
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once 'views/template/footer.php';
?>