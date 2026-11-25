<?php
require_once __DIR__ . '/helpers/functions.php';
require_once __DIR__ . '/views/header.php';

$produk = [
    ['nama' => 'Laptop', 'harga' => 7500000, 'deskripsi' => 'Laptop ringan untuk kuliah dan pemrograman
     sehari-hari dengan baterai awet.'],
    ['nama' => 'Mouse', 'harga' => 150000, 'deskripsi' => 'Mouse nirkabel.'],
    ['nama' => 'Keyboard', 'harga' => 350000, 'deskripsi' => 'Keyboard mekanik dengan lampu latar dan
     tombol yang nyaman untuk mengetik lama.'],
];
?>
<section class="content">
    <h2>Daftar Produk</h2>
    <table>
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Diskon 10%</th>
            <th>Harga Akhir</th>
            <th>Deskripsi</th>
        </tr>
        <?php foreach ($produk as $p) { ?>
            <?php $diskon = hitungDiskon($p['harga']); ?>
            <?php $akhir = $p['harga'] - $diskon; ?>
            <tr>
                <td><?php echo e($p['nama']); ?></td>
                <td><?php echo formatRupiah($p['harga']); ?></td>
                <td><?php echo formatRupiah($diskon); ?></td>
                <td><?php echo formatRupiah($akhir); ?></td>
                <td><?php echo e(ringkasTeks($p['deskripsi'], 40)); ?></td>
            </tr>
        <?php } ?>
    </table>
</section>
<?php require_once __DIR__ . '/views/footer.php'; ?>
