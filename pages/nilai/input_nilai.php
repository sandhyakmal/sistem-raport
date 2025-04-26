<?php

    $nip = $_SESSION['username'] ?? null;

    // Ambil data guru
    $query_guru = "SELECT * FROM tb_guru WHERE nip = :nip";
    $stmt1 = $pdo->prepare($query_guru);
    $stmt1->execute(['nip' => $nip]);
    $data_guru = $stmt1->fetch(PDO::FETCH_ASSOC);

    // Ambil jadwal mengajar guru
    $query_mapel_guru = "SELECT c.id, c.nama AS nama_mapel, c.kelas, a.hari, a.jam_mulai, a.jam_selesai 
                        FROM tb_jadwal_pelajaran a
                        JOIN tb_pelajaran c ON a.id_pelajaran = c.id 
                        WHERE a.id_guru = :id_guru";
    $stmt2 = $pdo->prepare($query_mapel_guru);
    $stmt2->execute(['id_guru' => $data_guru['id']]);
    $data_jadwal = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    // Tangkap pelajaran yang dipilih
    $pelajaranDipilih = $_POST['pelajaran'] ?? null;
    $lisSiswa = [];
    

    if ($pelajaranDipilih) {
        // Temukan kelas dari pelajaran terpilih
        $kelasTerpilih = null;
        foreach ($data_jadwal as $p) {
            if ($p['id'] == $pelajaranDipilih) {
                $kelasTerpilih = $p['kelas'];
                break;
            }
        }

        // Ambil siswa dari kelas tersebut
        if ($kelasTerpilih) {
            $stmt = $pdo->prepare("SELECT * FROM tb_siswa WHERE kelas = :kelas");
            $stmt->execute(['kelas' => $kelasTerpilih]);
            $lisSiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>

<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
        <div class="card">
            <form method="POST" enctype="multipart/form-data">
                <div class="card-header">
                    <h4>Input Nilai Siswa</h4>
                </div>
                <div class="card-body">

                    <!-- Pilih Pelajaran -->
                    <div class="form-group">
                        <label>Kelas - Nama Pelajaran </label>

                        <select name="pelajaran" class="form-control selectric" onchange="this.form.submit()">
                            <option value="">- Pilih Pelajaran yang Diajar -</option>
                            <?php foreach ($data_jadwal as $pelajaran): ?>
                                <option value="<?= $pelajaran['id'] ?>" 
                                    <?= $pelajaranDipilih == $pelajaran['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($pelajaran['kelas'] . ' - ' . $pelajaran['nama_mapel']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Pilih Siswa (hanya muncul kalau pelajaran dipilih) -->
                    <?php if (!empty($lisSiswa)): ?>
                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <select name="siswa" class="form-control selectric">
                                <option value="">- Pilih Siswa -</option>
                                <?php foreach ($lisSiswa as $siswa): ?>
                                    <option value="<?= $siswa['id'] ?>">
                                        <?= htmlspecialchars($siswa['nama_lengkap']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Nilai -->
                        <div class="form-group">
                            <label>Nilai Akhir</label>
                            <input type="text" name="nilai" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Capaian Kompetensi</label>
                            <textarea  name="capaian" class="form-control" required></textarea>
                        </div>


                        <?php if (isset($kelasTerpilih)): ?>
                            <input type="hidden" name="kelas" value="<?= htmlspecialchars($kelasTerpilih) ?>" class="form-control" >
                        <?php endif; ?>

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
    $pelajaran = $_POST['pelajaran'];
    $siswa     = $_POST['siswa'];
    $kelas     = $_POST['kelas'];
    $nilai     = $_POST['nilai'];
    $capaian   = $_POST['capaian'];

    // Cek apakah data sudah ada
    $cek_sql = "SELECT COUNT(*) FROM tb_nilai_siswa WHERE id_pelajaran = :id_pelajaran AND id_siswa = :id_siswa AND kelas = :kelas";
    $cek_stmt = $pdo->prepare($cek_sql);
    $cek_stmt->execute([
        ':id_pelajaran' => $pelajaran,
        ':id_siswa'     => $siswa,
        ':kelas'        => $kelas
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
        $sql = "INSERT INTO tb_nilai_siswa (id_pelajaran, id_siswa, kelas, nilai_akhir, capaian) 
                VALUES (:id_pelajaran, :id_siswa, :kelas, :nilai, :capaian)";
        $stmt = $pdo->prepare($sql);

        $success = $stmt->execute([
            ':id_pelajaran' => $pelajaran,
            ':id_siswa'     => $siswa,
            ':kelas'        => $kelas,
            ':nilai'        => $nilai,
            ':capaian'      => $capaian
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

