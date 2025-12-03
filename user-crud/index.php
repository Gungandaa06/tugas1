<?php
require_once 'inc/config.php';
require_once 'class/Database.php';
$db = Database::getInstance()->getConnection();


// ambil data
$stmt = $db->query('SELECT id, nim, nama, angkatan, prodi, foto_path, status FROM mahasiswa ORDER BY id DESC');
$rows = $stmt->fetchAll();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Daftar Mahasiswa</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<h1>Daftar Mahasiswa</h1>
<p><a href="create.php">+ Tambah Mahasiswa</a> | <a href="login.php">Login</a></p>
<table>
<thead>
<tr><th>ID</th><th>NIM</th><th>Nama</th><th>Angkatan</th><th>Prodi</th><th>Foto</th><th>Status</th><th>Aksi</th></tr>
</thead>
<tbody>
<?php if (empty($rows)): ?>
<tr><td colspan="8">Belum ada data.</td></tr>
<?php else: foreach ($rows as $r): ?>
<tr>
<td><?=htmlspecialchars($r['id'])?></td>
<td><?=htmlspecialchars($r['nim'])?></td>
<td><?=htmlspecialchars($r['nama'])?></td>
<td><?=htmlspecialchars($r['angkatan'])?></td>
<td><?=htmlspecialchars($r['prodi'])?></td>
<td><?php if ($r['foto_path']): ?><img class="thumb" src="<?=htmlspecialchars($r['foto_path'])?>" alt="foto"><?php else: echo '-'; endif;?></td>
<td><?=htmlspecialchars($r['status'])?></td>
<td><a href="edit.php?id=<?=urlencode($r['id'])?>">Edit</a> | <a href="delete.php?id=<?=urlencode($r['id'])?>">Hapus</a></td>
</tr>
<?php endforeach; endif; ?>
</tbody>
</table>
</body>
</html>
