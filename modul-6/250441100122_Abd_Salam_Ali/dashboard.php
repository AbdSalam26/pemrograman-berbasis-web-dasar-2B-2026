<?php
require_once "config/auth.php";
require_once "config/db.php";

$role = $_SESSION["user"]["role"];
$nama = $_SESSION["user"]["nama"];

$result = $conn->query("SELECT * FROM buku ORDER BY id_buku ASC");
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">Inventaris Buku</span>
        <div class="ms-auto text-white">
            <?= htmlspecialchars($nama) ?> (<?= htmlspecialchars($role) ?>)
            <a href="logout.php" class="btn btn-sm btn-danger ms-3">Logout</a>
        </div>
    </div>
</nav>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Buku</h3>
        <?php if ($role === "admin"): ?>
            <a href="buku_tambah.php" class="btn btn-primary">+ Tambah Buku</a>
        <?php endif; ?>
    </div>

    <div class="table-responsive" style="text-align: center;">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <?php if ($role === "admin"): ?>
                <th>Aksi</th>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row["id_buku"]) ?></td>
                    <td><?= htmlspecialchars($row["judul"]) ?></td>
                    <td><?= htmlspecialchars($row["penulis"]) ?></td>
                    <td><?= htmlspecialchars($row["kategori"]) ?></td>
                    <td><?= htmlspecialchars($row["stok"]) ?></td>
                    <td>Rp<?= number_format($row["harga"], 0, ",", ".") ?></td>
                    <td><?= htmlspecialchars($row["deskripsi"]) ?></td>
                    <?php if ($role === "admin"): ?>
                    <td>
                        <a href="buku_edit.php?id=<?= $row["id_buku"] ?>" class="btn btn-warning btn-sm" style="width: 70px; margin-bottom: 5px;">Edit</a>
                        <a href="buku_hapus.php?id=<?= $row["id_buku"] ?>" class="btn btn-danger btn-sm" style="width: 70px;"
                            onclick="return confirm('Hapus data ini?')">Hapus</a>
                    </td>
                    <?php endif; ?>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>