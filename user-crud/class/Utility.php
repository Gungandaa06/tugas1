<?php
// class/Utility.php
class Utility {
public static function validasiMahasiswa($data, $file, &$errors, $is_update = false) {
$errors = [];


// nama (text, required, max 100)
$name = trim($data['nama'] ?? '');
if ($name === '') $errors['nama'] = 'Nama wajib diisi.';
elseif (mb_strlen($name) > 100) $errors['nama'] = 'Nama maksimal 100 karakter.';


// nim (text/short)
$nim = trim($data['nim'] ?? '');
if ($nim === '') $errors['nim'] = 'NIM wajib diisi.';
elseif (mb_strlen($nim) > 20) $errors['nim'] = 'NIM maksimal 20 karakter.';


// angkatan (numeric)
if (!isset($data['angkatan']) || $data['angkatan'] === '') {
$errors['angkatan'] = 'Angkatan wajib diisi.';
} elseif (!ctype_digit(strval($data['angkatan']))) {
$errors['angkatan'] = 'Angkatan harus berupa angka bulat.';
} elseif ((int)$data['angkatan'] < 0) {
$errors['angkatan'] = 'Angkatan tidak boleh negatif.';
}


// prodi (select)
$allowed_prodi = ['TI','SI','Manajemen','Akuntansi','Lainnya'];
if (empty($data['prodi']) || !in_array($data['prodi'], $allowed_prodi, true)) {
$errors['prodi'] = 'Program studi tidak valid.';
}


// foto (file)
$fileProvided = isset($file) && $file['error'] !== UPLOAD_ERR_NO_FILE;
if ($fileProvided) {
if ($file['error'] !== UPLOAD_ERR_OK) {
$errors['foto'] = 'Terjadi kesalahan upload file.';
} else {
if ($file['size'] > 2 * 1024 * 1024) {
$errors['foto'] = 'Ukuran file maksimal 2 MB.';
} else {
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);
$allowed = ['image/jpeg','image/png'];
if (!in_array($mime, $allowed, true)) {
$errors['foto'] = 'Tipe file harus JPG/JPEG atau PNG.';
}
}
}
} else {
if (!$is_update) {
$errors['foto'] = 'Foto wajib diupload.';
}
}
return ['is_valid' => empty($errors), 'errors' => $errors, 'allowed_prodi' => $allowed_prodi];
}

public static function uploadFoto($file, $oldPath = null) {
if (!isset($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
return $oldPath;
}
}
