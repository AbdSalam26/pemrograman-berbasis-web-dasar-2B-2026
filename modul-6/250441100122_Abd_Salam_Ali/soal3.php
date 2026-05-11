<?php
// 1. Array Artikel Sederhana
$artikel = [
    [
        'judul' => 'Belajar HTML Pertama Kali',
        'tanggal' => '10 April 2026',
        'konten' => 'kukira ngoding itu asik.',
        'gambar' => 'img1.png',
        'referensi' => 'https://developer.mozilla.org/'
    ],
    [
        'judul' => 'Error Pertama di PHP',
        'tanggal' => '12 April 2026',
        'konten' => 'tertanya bikin panik.',
        'gambar' => 'img2.png',
        'referensi' => 'https://www.php.net/'
    ],
    [
        'judul' => 'Memahami Diagram Use Case',
        'tanggal' => '15 April 2026',
        'konten' => 'Diagram ini sangat membantu memetakan aktor dan fitur sistem.',
        'gambar' => 'img3.png',
        'referensi' => 'https://id.wikipedia.org/wiki/Use_case'
    ]
];

// 2. Kutipan Acak
$kutipan = ["Teruslah belajar!", "Error adalah guru terbaik.", "Coding itu menyenangkan."];
$kutipan_hari_ini = $kutipan[array_rand($kutipan)];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog Sederhana</title>
</head>
<body>

    <h1>Blog Developer</h1>
    <p><i>Kutipan: "<?php echo $kutipan_hari_ini; ?>"</i></p>
    <hr>

    <!-- Daftar Judul (Navigasi GET) -->
    <h3>Pilih Artikel:</h3>
    <ul>
        <?php foreach($artikel as $id => $data): ?>
            <li><a href="?id=<?php echo $id; ?>"><?php echo $data['judul']; ?></a></li>
        <?php endforeach; ?>
    </ul>
    <hr>

    <!-- Area Konten Dinamis -->
    <?php
    // Jika ada parameter 'id' di URL dan id tersebut valid di array
    if (isset($_GET['id']) && isset($artikel[$_GET['id']])) {
        
        $id = $_GET['id'];
        $post = $artikel[$id];
        
        // Tampilkan Detail Artikel
        echo "<h2>" . $post['judul'] . "</h2>";
        echo "<p><small>Tanggal: " . $post['tanggal'] . "</small></p>";
        echo "<img src='" . $post['gambar'] . "' width='300' alt='Ilustrasi'>";
        echo "<p>" . $post['konten'] . "</p>";
        echo "<p><a href='" . $post['referensi'] . "' target='_blank'>Link Referensi</a></p>";

        // Navigasi Sebelumnya / Selanjutnya
        echo "<br><br>";
        
        if (isset($artikel[$id - 1])) {
            echo "<a href='?id=" . ($id - 1) . "'>&laquo; Sebelumnya</a> | ";
        }
        
        if (isset($artikel[$id + 1])) {
            echo "<a href='?id=" . ($id + 1) . "'>Selanjutnya &raquo;</a>";
        }

    } else {
        // Jika belum ada yang diklik
        echo "<p>Silakan klik salah satu judul artikel di atas.</p>";
    }
    ?>

</body>
</html>