<?php
require_once 'inc/config.php';
require_once 'class/Database.php';
require_once 'class/Utility.php';
$db = Database::getInstance()->getConnection();


$errors = [];
$old = ['nim'=>'','nama'=>'','angkatan'=>'','prodi'=>'TI','status'=>'active'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$old = [
'nim' => $_POST['nim'] ?? '',
'nama' => $_POST['nama'] ?? '',
'angkatan' => $_POST['angkatan'] ?? '',
'prodi' => $_POST['prodi'] ?? 'TI',
'status' => $_POST['status'] ?? 'active'
];


$v = Utility::validateMahasiswa($old, $_FILES['foto'] ?? null, $errors, false);
if ($v['is_valid']) {
$fotoPath = Utility::uploadFoto($_FILES['foto']);
if ($fotoPath === false) {
$errors['foto'] = 'Gagal menyimpan file.';
} else {
$sql = 'INSERT INTO mahasiswa (nim, nama, angkatan, prodi, foto_path, status) VALUES (:nim,:nama,:angkatan,:prodi,:foto,:status)';
$stmt = $db->prepare($sql);
$stmt->execute([
':nim' => $old['nim'],
':nama' => $old['nama'],
':angkatan' => (int)$old['angkatan'],
':prodi' => $old['prodi'],
':foto' => $fotoPath,
':status' => $old['status']
]);
header('Location: index.php'); exit;
}
}
$allowed_prodi = $v['allowed_prodi'];
} else {
$meta = Utility::validateMahasiswa([], null, $dummy = [], true);
$allowed_prodi = $meta['allowed_prodi'];
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Tambah Mahasiswa</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<h1>Tambah Mahasiswa</h1>
<p><a href="index.php">← Kembali</a></p>
<?php if (!empty($errors)): ?>
<div class="error"><ul><?php foreach ($errors as $e) echo '<li>'.htmlspecialchars($e).'</li>'; ?></ul></div>
<?php endif; ?>
<form method="post" enctype="multipart/form-data">
<div class="form-group"><label>NIM:<br><input type="text" name="nim" value="<?=htmlspecialchars($old['nim'])?>" required maxlength="20"></label></div>
<div class="form-group"><label>Nama:<br><input type="text" name="nama" value="<?=htmlspecialchars($old['nama'])?>" required maxlength="100"></label></div>
<div class="form-group"><label>Angkatan:<br><input type="number" name="angkatan" value="<?=htmlspecialchars($old['angkatan'])?>" min="0" required></label></div>
