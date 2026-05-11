<?php
// Fungsi untuk membersihkan input
function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Fungsi untuk menampilkan hasil dalam tabel
function tampilkanData($data) {
    echo "<h3>Hasil Input</h3>";
    echo "<table border='1' cellpadding='8'>";
    foreach ($data as $key => $value) {
        echo "<tr><td><b>$key</b></td><td>$value</td></tr>";
    }
    echo "</table>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil Interaktif Developer</title>
</head>
<body>

<h2>Profil Interaktif Developer Pemula</h2>

<!-- Profil Statis -->
<table border="1" cellpadding="8">
    <tr><td>Nama</td><td>ABD SALAM ALI</td></tr>
    <tr><td>ID Developer</td><td>DEV001</td></tr>
    <tr><td>Kota/Tgl Lahir</td><td>Pamekasan, 26 Februari 2004</td></tr>
    <tr><td>Email</td><td>abdslm@gmail.com</td></tr>
    <tr><td>No. WhatsApp</td><td>08123456789</td></tr>
</table>

<br>

<!-- Form -->
<form method="POST">
    <label>Framework/Tools (pisahkan dengan koma):</label><br>
    <input type="text" name="framework"><br><br>

    <label>Pengalaman:</label><br>
    <textarea name="pengalaman"></textarea><br><br>

    <label>Tools Penunjang:</label><br>
    <input type="checkbox" name="tools[]" value="VS Code"> VS Code
    <input type="checkbox" name="tools[]" value="GitHub"> GitHub
    <input type="checkbox" name="tools[]" value="Figma"> Figma
    <input type="checkbox" name="tools[]" value="Postman"> Postman
    <br><br>

    <label>Minat Bidang:</label><br>
    <input type="radio" name="minat" value="Frontend"> Frontend
    <input type="radio" name="minat" value="Backend"> Backend
    <input type="radio" name="minat" value="Fullstack"> Fullstack
    <br><br>

    <label>Tingkat Skill:</label><br>
    <select name="skill">
        <option value="">--Pilih--</option>
        <option>Dasar</option>
        <option>Cukup</option>
        <option>Profesional</option>
    </select>
    <br><br>

    <button type="submit" name="submit">Kirim</button>
</form>

<hr>

<?php
if (isset($_POST['submit'])) {

    // Ambil dan bersihkan input
    $framework = cleanInput($_POST['framework']);
    $pengalaman = cleanInput($_POST['pengalaman']);
    $tools = $_POST['tools'] ?? [];
    $minat = $_POST['minat'] ?? '';
    $skill = $_POST['skill'] ?? '';

    // Validasi
    if (empty($framework) || empty($pengalaman) || empty($tools) || empty($minat) || empty($skill)) {
        echo "<p style='color:red;'>Semua input wajib diisi!</p>";
    } else {

        // Proses explode
        $frameworkArray = explode(",", $framework);

        // Trim setiap item
        $frameworkArray = array_map('trim', $frameworkArray);

        // Gabungkan tools
        $toolsList = implode(", ", $tools);

        // Data untuk ditampilkan
        $data = [
            "Framework/Tools" => implode(", ", $frameworkArray),
            "Tools Penunjang" => $toolsList,
            "Minat Bidang" => $minat,
            "Tingkat Skill" => $skill
        ];

        // Tampilkan tabel
        tampilkanData($data);

        // Tampilkan pengalaman
        echo "<p><b>Pengalaman:</b><br>$pengalaman</p>";

        // Kondisi tambahan
        if (count($frameworkArray) > 2) {
            echo "<p style='color:green;'><b>Skill Anda cukup luas di bidang development!</b></p>";
        }
    }
}
?>

</body>
</html>