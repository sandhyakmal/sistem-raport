<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
    <div class="card">
        <form method="POST" enctype="multipart/form-data">
        <div class="card-header">
            <h4>Tambah Data Siswa</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" required>
            </div>

            <div class="form-group">
                <label>NISN</label>
                <input type="text" name="nisn" class="form-control">
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <select name="kelas" class="form-control selectric">
                    <option> - Pilih Kelas - </option>
                    <option value="1">1 - Satu</option>
                    <option value="2">2 - Dua</option>
                    <option value="3">3 - Tiga</option>
                    <option value="4">4 - Empat</option>
                    <option value="5">5 - Lima</option>
                    <option value="6">6 - Enam</option>
                </select>
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
                <label >Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control selectric">
                    <option> - Pilih Jenis Kelamin - </option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label>Agama</label>
                <input type="text" name="agama" class="form-control">
            </div>

            <div class="form-group">
                <label>Status dalam Keluarga</label>
                <input type="text" name="status_keluarga" class="form-control">
            </div>

            <div class="form-group">
                <label>Anak ke</label>
                <input type="number" min="0" name="anak_ke" value="1" class="form-control">
            </div>

            <div class="form-group">
                <label>Alamat Peserta Didik</label>
                <input type="text" name="alamat" class="form-control">
            </div>

            <div class="form-group">
                <label>No. Telepon Rumah</label>
                <input type="text" name="no_telp_rumah" class="form-control">
            </div>

            <div class="form-group">
                <label>Sekolah Asal</label>
                <input type="text" name="sekolah_asal" class="form-control">
            </div>

            <div class="form-group">
                <label>Diterima Tanggal</label>
                <input type="date" name="diterima_tanggal" class="form-control">
            </div>

            <div class="form-group">
                <label>Diterima di Kelas</label>
                <input type="text" name="diterima_di_kelas" class="form-control">
            </div>

            <div class="form-group">
                <label>Nama Ayah</label>
                <input type="text" name="nama_ayah" class="form-control">
            </div>

            <div class="form-group">
                <label>Nama Ibu</label>
                <input type="text" name="nama_ibu" class="form-control">
            </div>

            <div class="form-group">
                <label>Alamat Orang Tua</label>
                <input type="text" name="alamat_orang_tua" class="form-control">
            </div>

            <div class="form-group">
                <label>No. Telepon Orang Tua</label>
                <input type="text" name="no_telp_orang_tua" class="form-control">
            </div>

            <div class="form-group">
                <label>Pekerjaan Ayah</label>
                <input type="text" name="pekerjaan_ayah" class="form-control">
            </div>

            <div class="form-group">
                <label>Pekerjaan Ibu</label>
                <input type="text" name="pekerjaan_ibu" class="form-control">
            </div>

            <div class="form-group">
                <label>Nama Wali</label>
                <input type="text" name="nama_wali" class="form-control">
            </div>

            <div class="form-group">
                <label>Alamat Wali</label>
                <input type="text" name="alamat_wali" class="form-control">
            </div>

            <div class="form-group">
                <label>No. Telepon Wali</label>
                <input type="text" name="no_telp_wali" class="form-control">
            </div>

            <div class="form-group">
                <label>Pekerjaan Wali</label>
                <input type="text" name="pekerjaan_wali" class="form-control">
            </div>

            <div class="form-group">
                <label>Foto Siswa</label>
                <div class="col-sm-12 col-md-7">
                <div id="image-preview" class="image-preview">
                    <label for="image-upload" id="image-label">Choose File</label>
                    <input type="file" name="foto" id="image-upload" />
                </div>
                </div>
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
    // Ambil semua input dari form
    $nama_lengkap       = $_POST['nama_lengkap'];
    $nisn               = $_POST['nisn'];
    $kelas              = $_POST['kelas'];
    $tempat_lahir       = $_POST['tempat_lahir'];
    $tanggal_lahir      = $_POST['tanggal_lahir'];
    $jenis_kelamin      = $_POST['jenis_kelamin'];
    $agama              = $_POST['agama'];
    $status_keluarga    = $_POST['status_keluarga'];
    $anak_ke            = $_POST['anak_ke'];
    $alamat             = $_POST['alamat'];
    $no_telp_rumah      = $_POST['no_telp_rumah'];
    $sekolah_asal       = $_POST['sekolah_asal'];
    $diterima_tanggal   = $_POST['diterima_tanggal'];
    $diterima_di_kelas  = $_POST['diterima_di_kelas'];
    $nama_ayah          = $_POST['nama_ayah'];
    $nama_ibu           = $_POST['nama_ibu'];
    $alamat_orang_tua   = $_POST['alamat_orang_tua'];
    $no_telp_orang_tua  = $_POST['no_telp_orang_tua'];
    $pekerjaan_ayah     = $_POST['pekerjaan_ayah'];
    $pekerjaan_ibu      = $_POST['pekerjaan_ibu'];
    $nama_wali          = $_POST['nama_wali'];
    $alamat_wali        = $_POST['alamat_wali'];
    $no_telp_wali       = $_POST['no_telp_wali'];
    $pekerjaan_wali     = $_POST['pekerjaan_wali'];

    // Proses upload foto
    $foto = '';
    if (!empty($_FILES['foto']['name'])) {
        $foto_name = $_FILES['foto']['name'];
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_path = 'foto_siswa/' . $foto_name;

        if (move_uploaded_file($foto_tmp, $foto_path)) {
            $foto = $foto_name;
        }
    }

    // Siapkan query insert
    $sql = "INSERT INTO tb_siswa (
        nama_lengkap, nisn, kelas, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, 
        status_dalam_keluarga, anak_ke, alamat, no_telp_rumah, sekolah_asal, diterima_tanggal, 
        diterima_di_kelas, nama_ayah, nama_ibu, alamat_orang_tua, no_telp_orang_tua, 
        pekerjaan_ayah, pekerjaan_ibu, nama_wali, alamat_wali, no_telp_wali, 
        pekerjaan_wali, foto
    ) VALUES (
        :nama_lengkap, :nisn, :kelas, :tempat_lahir, :tanggal_lahir, :jenis_kelamin, :agama,
        :status_keluarga, :anak_ke, :alamat, :no_telp_rumah, :sekolah_asal, :diterima_tanggal,
        :diterima_di_kelas, :nama_ayah, :nama_ibu, :alamat_orang_tua, :no_telp_orang_tua,
        :pekerjaan_ayah, :pekerjaan_ibu, :nama_wali, :alamat_wali, :no_telp_wali,
        :pekerjaan_wali, :foto
    )";

    $stmt = $pdo->prepare($sql);

    // Eksekusi dengan data
    $success = $stmt->execute([
        ':nama_lengkap'     => $nama_lengkap,
        ':nisn'             => $nisn,
        ':kelas'             => $kelas,
        ':tempat_lahir'     => $tempat_lahir,
        ':tanggal_lahir'    => $tanggal_lahir,
        ':jenis_kelamin'    => $jenis_kelamin,
        ':agama'            => $agama,
        ':status_keluarga'  => $status_keluarga,
        ':anak_ke'          => $anak_ke,
        ':alamat'           => $alamat,
        ':no_telp_rumah'    => $no_telp_rumah,
        ':sekolah_asal'     => $sekolah_asal,
        ':diterima_tanggal' => $diterima_tanggal,
        ':diterima_di_kelas'=> $diterima_di_kelas,
        ':nama_ayah'        => $nama_ayah,
        ':nama_ibu'         => $nama_ibu,
        ':alamat_orang_tua' => $alamat_orang_tua,
        ':no_telp_orang_tua'=> $no_telp_orang_tua,
        ':pekerjaan_ayah'   => $pekerjaan_ayah,
        ':pekerjaan_ibu'    => $pekerjaan_ibu,
        ':nama_wali'        => $nama_wali,
        ':alamat_wali'      => $alamat_wali,
        ':no_telp_wali'     => $no_telp_wali,
        ':pekerjaan_wali'   => $pekerjaan_wali,
        ':foto'             => $foto
    ]);

    if ($success) {
        echo "
        <script>
        alert('Data berhasil disimpan!');
        window.location.href='?page=data_siswa';
        </script>";
    } else {
        echo " <script>
        alert('Data gagal tersimpan!');
        window.location.href='?page=data_siswa';
        </script>
        ";
    }
}
?>

