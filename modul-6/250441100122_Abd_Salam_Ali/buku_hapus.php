<?php
require_once "config/admin.php";
require_once "config/db.php";

$id = (int) ($_GET["id"] ?? 0);

$stmt = $conn->prepare("DELETE FROM buku WHERE id_buku = ?");
$stmt->bind_param("i", $id);

$stmt->execute();

header("Location: dashboard.php");
exit;