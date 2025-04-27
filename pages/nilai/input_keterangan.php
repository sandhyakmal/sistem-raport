<?php

    $query = "SELECT * FROM tb_siswa";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $listSiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $siswaDipilih = $_POST['siswa'] ?? null;
    $kelasTerpilih = null;
    

    if ($siswaDipilih) {
        // Temukan kelas dari pelajaran terpilih
       
        foreach ($listSiswa as $p) {
            if ($p['id'] == $siswaDipilih) {
                $kelasTerpilih = $p['kelas'];
                break;
            }
        }
    }
      
?>

<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
        <div class="card">
            <form method="POST" enctype="multipart/form-data">
                <div class="card-header">
                    <h4>Input Keterangan Siswa</h4>
                </div>
                <div class="card-body">

                <div class="form-group">
                        <label>Kelas - Nama Siswa </label>
                        <select name="siswa" class="form-control selectric" onchange="this.form.submit()">
                            <option value="">- Pilih Siswa -</option>
                            <?php foreach ($listSiswa as $siswa): ?>
                                <option value="<?= $siswa['id'] ?>" 
                                    <?= $siswaDipilih == $siswa['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($siswa['kelas'] . ' - ' . $siswa['nama_lengkap']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <?php if (!empty($kelasTerpilih)): ?>
                        <input type="hidden" value="<?php echo $kelasTerpilih ?>" name="kelas"  class="form-control" >

                        <div class="form-group">
                            <label>Semester</label>
                            <input type="number" min="0" name="semester" value="1" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label>Fase</label>
                            <input type="text"  name="fase"  class="form-control" >
                        </div>

                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label>Kegiatan Ekstrakurikuler</label>
                            <input type="text" name="kegiatan" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label>Predikat</label>
                            <input type="text" name="predikat" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea  name="keterangan" class="form-control" ></textarea>
                        </div>

                        <div class="form-group">
                            <label>Sakit</label>
                            <input type="number" min="0" name="sakit" value="0" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label>Izin</label>
                            <input type="number" min="0" name="izin"  value="0" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label>Tanpa Keterangan</label>
                            <input type="number" min="0" name="alpa"  value="0" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label>Catatan Wali Kelas</label>
                            <textarea name="catatan" class="form-control" ></textarea>
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    <?php endif; ?>
                   


                </div>
            </form>
        </div>
    </div>
</div>

<?php

if (isset($_POST['submit'])) {

    // print_r($_POST['kelas']);

    $siswa          = $_POST['siswa'];
    $kelas          = $_POST['kelas'];
    $kegiatan       = $_POST['kegiatan'];
    $predikat       = $_POST['predikat'];
    $keterangan     = $_POST['keterangan'];
    $sakit          = $_POST['sakit'];
    $izin           = $_POST['izin'];
    $alpa           = $_POST['alpa'];
    $semester       = $_POST['semester'];
    $fase           = $_POST['fase'];
    $tahun_ajaran   = $_POST['tahun_ajaran'];
    $catatan        = $_POST['catatan'];

    // Cek apakah data sudah ada
    $cek_sql = "SELECT COUNT(*) FROM tb_keterangan_siswa WHERE id_siswa = :id_siswa AND semester = :semester AND kelas = :kelas";
    $cek_stmt = $pdo->prepare($cek_sql);
    $cek_stmt->execute([
        ':id_siswa' => $siswa,
        ':semester' => $semester,
        ':kelas'    => $kelas
    ]);
    $jumlah = $cek_stmt->fetchColumn();

    if ($jumlah > 0) {
        echo "
        <script>
        alert('Data sudah ada, tidak dapat menyimpan data!');
        window.location.href='?page=nilai';
        </script>";
    } else {
        // Siapkan query insert
        $sql = "INSERT INTO tb_keterangan_siswa (id_siswa, kelas, kegiatan, predikat, keterangan, sakit, izin, alpa, semester, fase, tahun_ajaran, catatan) 
                VALUES (:id_siswa, :kelas, :kegiatan, :predikat, :keterangan, :sakit, :izin, :alpa, :semester, :fase, :tahun_ajaran, :catatan)";
        $stmt = $pdo->prepare($sql);

        $success = $stmt->execute([
            ':id_siswa'   => $siswa,
            ':kelas'      => $kelas,
            ':kegiatan'   => $kegiatan,
            ':predikat'   => $predikat,
            ':keterangan' => $keterangan,
            ':sakit'      => $sakit,
            ':izin'       => $izin,
            ':alpa'       => $alpa,
            ':semester'   => $semester,
            ':fase'       => $fase,
            ':tahun_ajaran' => $tahun_ajaran,
            ':catatan'    => $catatan
        ]);

        if ($success) {
            echo "
            <script>
            alert('Data berhasil disimpan!');
            window.location.href='?page=nilai';
            </script>";
        } else {
            echo "
            <script>
            alert('Data gagal tersimpan!');
            window.location.href='?page=nilai';
            </script>";
        }
    }
}

?>

