<?php
// Include koneksi dan dompdf
include '../../koneksi.php';
require_once '../../assets/dompdf/autoload.inc.php';

use Dompdf\Options;
use Dompdf\Dompdf;


// $id_siswa = $_POST['siswa'] ?? null;

$id_siswa = $_GET['id_siswa'] ?? null;
$kelas = $_GET['kelas'] ?? null;

// Ambil data siswa
$query_siswa = "SELECT * FROM tb_siswa WHERE id = :id_siswa";
$stmt = $pdo->prepare($query_siswa);
$stmt->execute([
    'id_siswa' => $id_siswa
]);
$siswa = $stmt->fetch(PDO::FETCH_ASSOC);

$query_ket_siswa = "SELECT * FROM tb_keterangan_siswa WHERE id_siswa = :id_siswa AND kelas = :kelas";
$stmt2 = $pdo->prepare($query_ket_siswa);
$stmt2->execute([
    'id_siswa' => $id_siswa,
    'kelas' => $kelas
]);
$ket_siswa = $stmt2->fetch(PDO::FETCH_ASSOC);


$foto_path = $_SERVER['DOCUMENT_ROOT'] . '/sistem-raport/foto_siswa/' . $siswa['foto'];

if (file_exists($foto_path)) {
    $foto_url = 'http://' . $_SERVER['HTTP_HOST'] . '/sistem-raport/foto_siswa/' . $siswa['foto'];
}

// Ambil nilai-nilai siswa
$query_nilai = "SELECT a.kelas, a.nilai_akhir, c.nama as nama_mapel, a.capaian
                FROM tb_nilai_siswa a
                JOIN tb_pelajaran c ON a.id_pelajaran = c.id
                WHERE a.id_siswa = :id_siswa AND a.kelas = :kelas";
$stmt2 = $pdo->prepare($query_nilai);
$stmt2->execute([
    'id_siswa' => $id_siswa,
    // 'kelas' => $siswa['kelas']
    'kelas' => $kelas
]);
$data_nilai = $stmt2->fetchAll(PDO::FETCH_ASSOC);

if (empty($data_nilai) || $ket_siswa === false) {
    echo "  <script>
            alert('Data tidak ditemukan! Cek Kembali Input Nilai / Keterangan Wali Kelas');
            window.location.href='../../index.php?page=raport';
            </script>";
    exit;
}


ob_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Raport Siswa</title>
    <style>

        @page {
            margin-top: 100px;
        }

        .pdf-header {
            position: fixed;
            top: -70px;
            left: 0;
            right: 0;
            height: 80px;
            text-align: center;
            font-size: 12px;
            /* border-bottom: 1px solid #000; */
        }

        body { 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            margin: 30px; 
        }

        .page-break { 
            page-break-after: always; 
        }

        table, th, td { 
            border: 1px solid black; 
            border-collapse: collapse; 
            padding: 5px; 
        }

        th { 
            background-color: #eee; 
        }

        img {
            width: 100px; 
        }

        .center { 
            text-align: center; 
        }
    </style>
</head>
<body>

<!-- Halaman 1: Cover -->
<div class="center">
    <!-- <img src="../../assets/img/logo-kemendikbud.png" alt="Logo Pemerintah"> -->
    <img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/sistem-raport/assets/img/pem_purb.png'; ?>">
    <h2>SEKOLAH DASAR (SD)</h2>
    <img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/sistem-raport/assets/img/logo-tut-wuri.png'; ?>">
    <br>
    <h3>Nama Peserta Didik</h3>
    <h2><?= $siswa['nama_lengkap'] ?></h2>
    <br>
    <h3>NISN / NIS</h3>
    <h2><?= $siswa['nisn'] ?> / -</h2>
    <br>
    <h4>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI</h4>
    <h4>REPUBLIK INDONESIA</h4>
</div>

<div class="page-break"></div>

<!-- Halaman 2: Data Sekolah -->
<div>
    <h2 class="center">SEKOLAH DASAR (SD)</h2>
    <table width="100%">
        <tr><td>Nama Sekolah</td><td>SD NEGERI 2 PEKALONGAN</td></tr>
        <tr><td>NPSN</td><td>20302876</td></tr>
        <tr><td>NIS/NSS/NDS</td><td>101030307045</td></tr>
        <tr><td>Alamat</td><td>Jl. Desa Pekalongan</td></tr>
        <tr><td>Kelurahan / Desa</td><td>Pekalongan</td></tr>
        <tr><td>Kecamatan</td><td>Kec. Bojongsari</td></tr>
        <tr><td>Kabupaten / Kota</td><td>Kab. Purbalingga</td></tr>
        <tr><td>Provinsi</td><td>Prov. Jawa Tengah</td></tr>
        <tr><td>Website</td><td>-</td></tr>
        <tr><td>Email</td><td>sdn2pekalongan640@gmil.com</td></tr>
    </table>
</div>

<div class="page-break"></div>

<!-- Halaman 3: Identitas Peserta Didik -->
<div>
    <h2 class="center">IDENTITAS PESERTA DIDIK</h2>
    <table width="100%">
        <tr><td>Nama Lengkap</td><td><?= $siswa['nama_lengkap'] ?></td></tr>
        <tr><td>NISN</td><td><?= $siswa['nisn'] ?></td></tr>
        <tr><td>Tempat, Tanggal Lahir</td><td><?= $siswa['tempat_lahir'] ?>, <?php echo date("d-m-Y", strtotime($siswa['tanggal_lahir'])) ?></td></tr>
        <tr><td>Jenis Kelamin</td><td><?= $siswa['jenis_kelamin'] ?></td></tr>
        <tr><td>Agama</td><td><?= $siswa['agama'] ?></td></tr>
        <tr><td>Status dalam Keluarga</td><td>Anak ke <?= $siswa['anak_ke'] ?></td></tr>
        <tr><td>Alamat</td><td><?= $siswa['alamat'] ?></td></tr>
        <tr><td>No Telepon Rumah</td><td><?= $siswa['no_telp_rumah'] ?></td></tr>
        <tr><td>Nama Ayah</td><td><?= $siswa['nama_ayah'] ?></td></tr>
        <tr><td>Pekerjaan Ayah</td><td><?= $siswa['pekerjaan_ayah'] ?></td></tr>
        <tr><td>Nama Ibu</td><td><?= $siswa['nama_ibu'] ?></td></tr>
        <tr><td>Pekerjaan Ibu</td><td><?= $siswa['pekerjaan_ibu'] ?></td></tr>
    </table>
    <div class="center" style="margin-top:20px;">
        <img src="<?= $foto_url ?>" style="width:400px; height:250px">

        <p>Bojongsari, <?php echo date("d-m-Y", strtotime($siswa['diterima_tanggal'])) ?></p>
        <p>Kepala Sekolah</p><br><br>
        <p><strong>KUSNINGSIH, S.Pd</strong></p>
    </div>
</div>

<div class="page-break"></div>

<!-- Halaman 4: Laporan Hasil Belajar -->
<div>

    <div class="pdf-header" style="text-align: center;">
        <table width="100%" style="font-size:12px; border: none; border-collapse: collapse; margin: 0 auto;">
            <tr>
                <td style="border: none; text-align: left;">Nama</td>
                <td style="border: none; text-align: left;">: <?= $siswa['nama_lengkap'] ?></td>
                <td style="border: none; text-align: left;">Kelas</td>
                <td style="border: none; text-align: left;">: <?= $kelas ?></td>
            </tr>
            <tr>
                <td style="border: none; text-align: left;">NIS/NISN</td>
                <td style="border: none; text-align: left;">: - / <?= $siswa['nisn'] ?></td>
                <td style="border: none; text-align: left;">Fase</td>
                <td style="border: none; text-align: left;">: <?= $ket_siswa['fase'] ?></td>
            </tr>
            <tr>
                <td style="border: none; text-align: left;">Nama Sekolah</td>
                <td style="border: none; text-align: left;">: SD NEGERI 2 PEKALONGAN</td>
                <td style="border: none; text-align: left;">Semester</td>
                <td style="border: none; text-align: left;">: <?= $ket_siswa['semester'] ?></td>
            </tr>
            <tr>
                <td style="border: none; text-align: left;">Alamat</td>
                <td style="border: none; text-align: left;">: Jl. Desa Pekalongan</td>
                <td style="border: none; text-align: left;">Tahun Pelajaran</td>
                <td style="border: none; text-align: left;">: <?= $ket_siswa['tahun_ajaran'] ?></td>
            </tr>
        </table>
    </div>


    <h2 class="center">LAPORAN HASIL BELAJAR</h2>
    <table width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>Nilai Akhir</th>
                <th>Capaian Kompetensi</th>
            </tr>
        </thead>
        <tbody>
        
            <?php $no = 1; foreach($data_nilai as $n): ?>
            <tr style="text-align:center;">
                <td><?= $no++ ?></td>
                <td><?= $n['nama_mapel'] ?></td>
                <td><?= $n['nilai_akhir'] ?></td>
                <td><?= $n['capaian'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <br>
    <br>
    <br>
    <table width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan Ekstrakurikuler</th>
                <th>Predikat</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1; 
            ?>
            <tr style="text-align:center;">
                <td><?= $no++ ?></td>
                <td><?= $ket_siswa['kegiatan'] ?></td>
                <td><?= $ket_siswa['predikat'] ?></td>
                <td><?= $ket_siswa['keterangan'] ?></td>
            </tr>
        </tbody>
    </table>

    <table width="100%">
        <tr>
            <td style="border: none;  width:100px; text-align: left;">Sakit</td>
            <td style="border: none; text-align: left;">: <?= $ket_siswa['sakit'] ?></td>
        </tr>
        <tr>
            <td style="border: none; text-align: left;">Izin</td>
            <td style="border: none; text-align: left;">: <?= $ket_siswa['izin'] ?></td>
        </tr>
        <tr>
            <td style="border: none; text-align: left;">Tanpa Keterangan</td>
            <td style="border: none; text-align: left;">: <?= $ket_siswa['alpa'] ?></td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td style="border: none;  width:100px; text-align: left;">Catatan Wali Kelas</td>
            <td style="border: none; text-align: left;">: <?= $ket_siswa['catatan'] ?></td>
        </tr>
    </table>

</div>

</body>
</html>

<?php
$html = ob_get_clean();

$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("RAPORT.pdf", ["Attachment" => false]);
?>
