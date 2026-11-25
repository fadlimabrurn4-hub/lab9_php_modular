<?php
require_once __DIR__ . '/../../config/database.php';

$sql = 'SELECT * FROM data_barang';
$result = mysqli_query($conn, $sql);
?>
<section class="main">
    <h2>Data Barang</h2>
    <p><a href="index.php?page=user/add">Tambah Barang</a></p>
    <div class="main">
        <table>
            <tr>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Katagori</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            <?php if ($result): ?>
                <?php while ($row = mysqli_fetch_array($result)): ?>
                    <tr>
                        <td>
                            <img
                                src="<?= htmlspecialchars($row['gambar']); ?>"
                                alt="<?= htmlspecialchars($row['nama']); ?>"
                            >
                        </td>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td><?= htmlspecialchars($row['kategori']); ?></td>
                        <td><?= htmlspecialchars($row['harga_jual']); ?></td>
                        <td><?= htmlspecialchars($row['harga_beli']); ?></td>
                        <td><?= htmlspecialchars($row['stok']); ?></td>
                        <td>
                            <a href="index.php?page=user/edit&id=<?= urlencode($row['id_barang']); ?>">Ubah</a>
                            <form
                                method="post"
                                action="index.php?page=user/delete"
                                class="inline-form"
                                onsubmit="return confirm('Yakin ingin menghapus data ini?');"
                            >
                                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id_barang']); ?>">
                                <button type="submit" name="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; else: ?>
                    <tr>
                        <td colspan="7">Belum ada data</td>
                    </tr>
            <?php endif; ?>
        </table>
    </div>
</section>
