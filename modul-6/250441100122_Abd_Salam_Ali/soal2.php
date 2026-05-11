<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Timeline Sederhana</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        
        /* 2. Visualisasi Timeline Vertikal Sederhana */
        .timeline-container {
            border-left: 4px solid #333; /* Garis vertikal timeline */
            padding-left: 20px;
            margin-left: 10px;
        }
        
        .timeline-item {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <h2>Timeline Belajar Coding</h2>

    <?php
    // 1. Struktur Data: Array Asosiatif (5 data)
    $dataBelajar = [
        "2022" => "Mulai masuk kuliah jurusan IT.",
        "2023" => "Belajar HTML dan CSS dasar.",
        "2024" => "Membuat program kasir sederhana dengan Python.",
        "2025" => "Mulai belajar PHP dan manipulasi Database SQL.",
        "2026" => "Mengerjakan proyek website UMKM Batik."
    ];

    // 4. Fungsi Kustom: Memberi warna merah jika tahunnya "2026"
    function highlightTahun($tahun) {
        if ($tahun == "2026") {
            return "color: red; font-weight: bold;";
        }
        return "color: black;";
    }
    ?>

    <!-- Garis Waktu -->
    <div class="timeline-container">
        
        <?php 
        // 3. Perulangan: Membedah data array dengan foreach
        foreach ($dataBelajar as $tahun => $kegiatan) { 
        ?>
            <div class="timeline-item">
                <!-- Memanggil fungsi kustom di dalam style -->
                <h3 style="<?php echo highlightTahun($tahun); ?>">
                    Tahun <?php echo $tahun; ?>
                </h3>
                <p><?php echo $kegiatan; ?></p>
            </div>
        <?php } ?>

    </div>

    <hr>

    <!-- 5. Navigasi -->
    <div>
        <a href="soal1.php"><button>Kembali ke Profil</button></a>
        <a href="soal3.php"><button>Menuju Blog Developer</button></a>
    </div>

</body>
</html>