<?php
require_once "config/admin.php";
require_once "config/db.php";

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $judul = trim($_POST["judul"]);
    $penulis = trim($_POST["penulis"]);
    $kategori = trim($_POST["kategori"]);
    $stok = (int) $_POST["stok"];
    $harga = (float) $_POST["harga"];
    $deskripsi = trim($_POST["deskripsi"]);

    $stmt = $conn->prepare("INSERT INTO buku (judul, penulis, kategori, stok, harga, deskripsi) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssids", $judul, $penulis, $kategori, $stok, $harga, $deskripsi);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit;
    } else {
        $pesan = "Gagal menambah data.";
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow">
        <div class="card-body p-4">
            <h3>Tambah Buku</h3>
            <?php if ($pesan): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($pesan) ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="penulis" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" min="0" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" min="0" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                </div>
                <button class="btn btn-primary">Simpan</button>
                <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>