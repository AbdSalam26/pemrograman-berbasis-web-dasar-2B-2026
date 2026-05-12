<?php
require_once __DIR__ . '/auth.php';

if ($_SESSION['user']['role'] !== 'admin') {
    die("Akses ditolak. Halaman ini hanya untuk admin.");
}