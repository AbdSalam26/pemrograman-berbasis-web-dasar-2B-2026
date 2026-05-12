<?php
require_once "config/admin.php";
require_once "config/db.php";

$id = (int) ($_GET["id"] ?? 0);
$stmt = $conn->prepare("SELECT * FROM buku WHERE id_buku = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if (!$data) {
    die("Data tidak ditemukan.");
}

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $judul = trim($_POST["judul"]);
    $penulis = trim($_POST["penulis"]);
    $kategori = trim($_POST["kategori"]);
    $stok = (int) $_POST["stok"];
    $harga = (float) $_POST["harga"];
    $deskripsi = trim($_POST["deskripsi"]);

    $update = $conn->prepare("UPDATE buku SET judul=?, penulis=?, kategori=?, stok=?, harga=?, deskripsi=? WHERE id_buku=?");
    $update->bind_param("sssidsi", $judul, $penulis, $kategori, $stok, $harga, $deskripsi, $id);

    if ($update->execute()) {
        header("Location: dashboard.php");
        exit;
    } else {
        $pesan = "Gagal mengubah data.";
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow">
        <div class="card-body p-4">
            <h3>Edit Buku</h3>
            <?php if ($pesan): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($pesan) ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($data["judul"]) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="penulis" class="form-control" value="<?= htmlspecialchars($data["penulis"]) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control" value="<?= htmlspecialchars($data["kategori"]) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" min="0" value="<?= htmlspecialchars($data["stok"]) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" min="0" step="0.01" value="<?= htmlspecialchars($data["harga"]) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4"><?= htmlspecialchars($data["deskripsi"]) ?></textarea>
                </div>
                <button class="btn btn-warning">Update</button>
                <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>