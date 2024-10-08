<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Bunga</title>
    <style>
        body {
            background: #f2f2f2;
            font-family: sans-serif;
        }

        .kalkulator {
            width: 950px;
            height: auto;
            margin: 100px auto;
            padding: 10px 20px 50px 20px;
            border-radius: 5px;
            box-shadow: 0px 10px 20px 0px #d1d1d1;
            background-color: white;
        }

        .input-field {
            width: 300px;
            border: none;
            font-size: 16pt;
            border-radius: 5px;
            padding: 10px;
            margin: 5px;
        }

        .input-label {
            margin-right: 20px;
        }

        .opt {
            font-size: 16pt;
            border: none;
            width: 215px;
            margin: 5px;
            border-radius: 5px;
            padding: 10px;
        }

        .tombol {
            background: lightgreen;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            color: black;
            font-size: 15pt;
            margin-top: 20px;
        }

        .judul {
            text-align: center;
            color: black;
            font-weight: normal;
            margin-top: 50px;
            font-size: 3rem;
        }

        .container {
            display: flex;
            align-items: center;
        }

        .hasil {
            width: 350px;
            margin: 5px;
            border: none;
            font-size: 16pt;
            border-radius: 5px;
            padding: 10px;
            margin-top: 35px;
            text-align: center;
        }

        .hasil-container {
            text-align: center;
        }
    </style>
</head>
<body>
<?php
$hasil = null;

if (isset($_POST['hitung'])) {
    $modal = $_POST['modal'];
    $bunga = $_POST['bunga'] / 100;
    $periode = $_POST['periode'];
    $waktu = $_POST['waktu'];
    $jenis_bunga = $_POST['jenis_bunga'];

    if (is_numeric($modal) && is_numeric($bunga) && is_numeric($periode) && is_numeric($waktu)) {
        switch ($jenis_bunga) {
            case 'tunggal':
                $hasil = $modal + ($modal * $bunga * $waktu);
                break;
            case 'majemuk':
                $hasil = $modal * pow((1 + $bunga / $periode), $periode * $waktu);
                break;
            case 'anuitas':
                $hasil = $modal * $bunga / $periode * (pow(1 + $bunga / $periode, $periode * $waktu)) / (pow(1 + $bunga / $periode, $periode * $waktu) - 1);
                break;
        }
    } else {
        $hasil = null;
    }

    if ($hasil === null) {
        echo "<script>alert('Error: Invalid input!');</script>";
    }
}
?>

<h2 class="judul">Kalkulator Bunga</h2>
<div class="kalkulator">
    <form method="post" action="">
        <div class="container">
            <label class="input-label">Modal Awal (Rp):</label>
            <input type="number" name="modal" class="input-field" placeholder="Masukkan modal awal" required>
        </div>
        <div class="container">
            <label class="input-label">Suku Bunga (%):</label>
            <input type="number" step="0.01" name="bunga" class="input-field" placeholder="Masukkan suku bunga" required>
        </div>
        <div class="container">
            <label class="input-label">waktu:</label>
            <input type="number" name="waktu" class="input-field" placeholder="Masukkan waktu" required>
        </div>
        <div class="container">
            <label class="input-label">Periode Per:</label>
            <select name="periode" class="opt">
                <option value="1">Tahun</option>
                <option value="12">Bulan</option>
                <option value="4">Triwulan</option>
                <option value="3">Caturwulan</option>
                <option value="2">Semester</option>
            </select>
        </div>
        <div class="container">
            <label class="input-label">Jenis Bunga:</label>
            <select name="jenis_bunga" class="opt">
                <option value="tunggal">Bunga Tunggal</option>
                <option value="majemuk">Bunga Majemuk</option>
                <option value="anuitas">Bunga Anuitas</option>
            </select>
        </div>
        <center>
            <input type="submit" name="hitung" value="Hitung" class="tombol">
        </center>
    </form>

    <?php if (isset($_POST['hitung'])) { ?>
        <div class="hasil-container">
            <input type="text" value="Rp <?php echo number_format($hasil, 2); ?>" class="hasil" readonly>
        </div>
    <?php } else { ?>
        <div class="hasil-container">
            <input type="text" value="Rp 0.00" class="hasil" readonly>
        </div>
    <?php } ?>
</div>

</body>
</html>
