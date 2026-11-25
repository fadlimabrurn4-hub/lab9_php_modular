<?php
require_once __DIR__ . '/helpers/functions.php';
require_once __DIR__ . '/views/header.php';

$simpan = $_POST['simpan'] ?? '';
$email = $_POST['email'] ?? '';
if (!is_string($email)) {
    $email = '';
}
$pesan = '';
$kelas = '';

if ($simpan !== '') {
    if (validasiEmail($email)) {
        $pesan = 'Email valid: ' . e($email);
        $kelas = 'sukses';
    } else {
        $pesan = 'Format email tidak valid.';
        $kelas = 'gagal';
    }
}
?>
<section class="content">
    <h2>Form Pendaftaran</h2>
    <form method="post" action="">
        <label>Email</label>
        <input type="text" name="email" value="<?php echo e($email); ?>">
        <button type="submit" name="simpan" value="1">Kirim</button>
    </form>
    <p class="<?php echo $kelas; ?>"><?php echo $pesan; ?></p>
</section>
<?php require_once __DIR__ . '/views/footer.php'; ?>
