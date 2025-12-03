<?php
// authenticate.php - include ini untuk halaman yang butuh login
session_start();
if (!isset($_SESSION['user'])) {
header('Location: login.php'); exit;
}
