<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
    <div class="card">
        <form method="POST" enctype="multipart/form-data">
        <div class="card-header">
            <h4>Tambah Data Guru</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="form-group">
                <label>NIP</label>
                <input type="text" name="nip" class="form-control">
            </div>

            <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control">
            </div>

            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control">
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control">
            </div>

            <div class="form-group">
                <label>Ijazah Terakhir</label>
                <input type="text" name="ijazah_terakhir" class="form-control">
            </div>

            <div class="form-group">
                <label>Tahun Lulus</label>
                <input type="text" name="tahun_lulus" class="form-control">
            </div>

            <div class="form-group">
                <label>Pangkat Golongan</label>
                <input type="text" name="pangkat_golongan" class="form-control">
            </div>

            <div class="form-group">
                <label>Tmt CPNS</label>
                <input type="date" name="tmt_cpns" class="form-control">
            </div>

            <div class="form-group">
                <label>Tmt PNS</label>
                <input type="date" name="tmt_pns" class="form-control">
            </div>

            <div class="form-group">
                <label>Masa Kerja</label>
                <input type="text" name="masa_kerja" class="form-control">
            </div>

            <div class="form-group">
                <label>NUPTK</label>
                <input type="text" name="nuptk" class="form-control">
            </div>

            <div class="form-group">
                <label>Karpeg</label>
                <input type="text" name="karpeg" class="form-control">
            </div>

            <div class="form-group">
                <label>NPWP</label>
                <input type="text" name="npwp" class="form-control">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>

        <!-- <div class="card-footer text-right">
            <button class="btn btn-primary">Submit</button>
        </div> -->
        </form>
    </div>
    </div>
</div>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama             = $_POST['nama'];
    $nip              = $_POST['nip'];
    $tempat_lahir     = $_POST['tempat_lahir'];
    $tanggal_lahir    = $_POST['tanggal_lahir'];
    $alamat           = $_POST['alamat'];
    $ijazah_terakhir  = $_POST['ijazah_terakhir'];
    $tahun_lulus      = $_POST['tahun_lulus'];
    $pangkat_golongan = $_POST['pangkat_golongan'];
    $tmt_cpns         = $_POST['tmt_cpns'];
    $tmt_pns          = $_POST['tmt_pns'];
    $masa_kerja       = $_POST['masa_kerja'];
    $nuptk            = $_POST['nuptk'];
    $karpeg           = $_POST['karpeg'];
    $npwp             = $_POST['npwp'];
    $email            = $_POST['email'];

    // Query insert dengan PDO
    $sql = "INSERT INTO tb_guru (
        nama, nip, tempat_lahir, tanggal_lahir, alamat, ijazah_terakhir, 
        tahun_lulus, pangkat_golongan, tmt_cpns, tmt_pns, masa_kerja, 
        nuptk, karpeg, npwp, email_aktif
    ) VALUES (
        :nama, :nip, :tempat_lahir, :tanggal_lahir, :alamat, :ijazah_terakhir,
        :tahun_lulus, :pangkat_golongan, :tmt_cpns, :tmt_pns, :masa_kerja,
        :nuptk, :karpeg, :npwp, :email
    )";

    $stmt = $pdo->prepare($sql);

    // Eksekusi perintah SQL dengan data yang di-bind
    $success = $stmt->execute([
        ':nama'             => $nama,
        ':nip'              => $nip,
        ':tempat_lahir'     => $tempat_lahir,
        ':tanggal_lahir'    => $tanggal_lahir,
        ':alamat'           => $alamat,
        ':ijazah_terakhir'  => $ijazah_terakhir,
        ':tahun_lulus'      => $tahun_lulus,
        ':pangkat_golongan' => $pangkat_golongan,
        ':tmt_cpns'         => $tmt_cpns,
        ':tmt_pns'          => $tmt_pns,
        ':masa_kerja'       => $masa_kerja,
        ':nuptk'            => $nuptk,
        ':karpeg'           => $karpeg,
        ':npwp'             => $npwp,
        ':email'            => $email
    ]);

    if ($success) {
        echo "
        <script>
        alert('Data berhasil disimpan!');
        window.location.href='?page=data_guru';
        </script>";
    } else {
        echo "
        <script>
        alert('Data gagal disimpan!');
        window.location.href='?page=data_guru';
        </script>
        ";
    }
}
?>

