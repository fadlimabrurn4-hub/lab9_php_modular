<?php
$produk = [
    ['nama' => 'Laptop', 'harga' => 7500000],
    ['nama' => 'Mouse', 'harga' => 150000],
    ['nama' => 'Keyboard', 'harga' => 350000],
];
?>
<section>
    <h2>Daftar Produk</h2>
    <table>
        <tr>
            <th>Nama</th>
            <th>Harga</th>
        </tr>
        <?php foreach ($produk as $p) { ?>
            <tr>
                <td><?php echo e($p['nama']); ?></td>
                <td><?php echo formatRupiah($p['harga']); ?></td>
            </tr>
        <?php } ?>
    </table>
</section>
