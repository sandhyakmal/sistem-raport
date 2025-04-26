<?php
// Menghubungkan ke database
include '../../koneksi.php';
require_once '../../assets/dompdf/autoload.inc.php';
use Dompdf\Options;
use Dompdf\Dompdf;


$id_pelajaran = $_POST['pelajaran'] ?? null;

// print_r($id_pelajaran);

$query = "  SELECT  b.id as id_mapel , a.kelas, f.nama_lengkap as nama_siswa, a.nilai_akhir, b.nama as nama_mapel, e.nama as nama_guru 
            FROM tb_nilai_siswa a 
            JOIN tb_pelajaran b ON a.id_pelajaran = b.id 
            JOIN tb_jadwal_pelajaran d ON a.id_pelajaran = d.id_pelajaran 
            JOIN tb_guru e ON d.id_guru = e.id
            JOIN tb_siswa f ON a.id_siswa = f.id
            where a.id_pelajaran =  :id_pelajaran";
$stmt = $pdo->prepare($query);
$stmt->execute([
    'id_pelajaran' => $id_pelajaran
]);

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($data)) {
    echo "  <script>
            alert('Data tidak ditemukan!');
            window.location.href='../../index.php?page=laporan';
            </script>";
    exit;
}

// ob_start();

?>


<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan Nilai Siswa</title>
<style>
    @media print {
        @page {
        margin: 0;
        }
        body {
            margin: 0;
            padding: 0;
        }
    }
    
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        text-align: center;
    }

    .kop-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
    }

    .kop-surat {
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 2px solid #004080;
        padding-bottom: 10px;
        max-width: 800px;
        width: 100%;
    }

    .kop-surat img {
        width: 100px;
        margin-right: 20px;
    }

    .kop-text {
        text-align: left;
    }

    .kop-text h1 {
        margin: 0;
        font-size: 24px;
        font-weight: bold;
        color: #000;
    }

    .kop-text p {
        margin: 3px 0;
        font-size: 14px;
        color: #333;
    }

    .kop-text .subheading {
        font-weight: bold;
        font-size: 12px;
        color: #555;
    }

    .separator {
        border-top: 3px solid #004080;
        border-bottom: 1px solid #004080;
        margin: 10px auto;
        width: 80%;
        max-width: 800px;
    }

    h2 {
        text-align: center;
        margin-top: 20px;
    }

    .periode {
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 80%;
        max-width: 800px;
        margin: 0 auto;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        border: 1px solid #000;
        padding: 8px;
        text-align: center;
        font-size: 14px;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
</style>
</head>
<body>

<!-- Kop Surat -->
<div class="kop-wrapper">
    <div class="kop-surat">
        <!-- <img src="../../assets/img/logo-tut-wuri.png"> -->
        <img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/sistem-raport/assets/img/logo-tut-wuri.png'; ?>">
        <div class="kop-text">
            <h1 style="text-align:center;">PEMERINTAH KABUPATEN PURBALINGGA</h1>
            <p style="text-align:center;" class="subheading">DINAS PENDIDIKAN DAN KEBUDAYAAN</p>
            <p style="text-align:center;">KECAMATAN BOJONGSARI</p>
            <p style="text-align:center;">SDN 22 PEKALONGAN</p>
            <p style="text-align:center;">Alamat : Desa Pekalongan Kec. Bojongsari Kab. Purbalingga</p>
        </div>
    </div>
</div>

<div class="separator"></div>

<!-- Judul Laporan -->
<h2>LAPORAN NILAI SISWA</h2>

<!-- Periode Laporan -->
<div class="periode">
    <p >Mata Pelajaran : <?php echo $data[0]['nama_mapel'] ?></p>
    <p>Nama Guru : <?php echo $data[0]['nama_guru'] ?></p>
    <p>Kelas : <?php echo $data[0]['kelas'] ?></p>
</div>

<!-- Tabel Laporan Gaji -->
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $no = 1;
    foreach ($data as $d) {
        ?>
        <tr>
            <td class="text-center"><?php echo $no++; ?></td>
            <td><?php echo $d['nama_siswa']; ?></td>
            <td><?php echo $d['nilai_akhir']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
   
</table>


</body>

</html>

<?php

$html = ob_get_clean(); // End buffering, get HTML content

// ==== BUAT PDF ====
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("raport-siswa.pdf", ["Attachment" => false]);
?>