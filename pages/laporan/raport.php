<?php
    
    $role_id = $_SESSION['role_id'];
    $username = $_SESSION['username'];
    $where = '';

    if ($role_id == 4) {
        $where = " WHERE nisn = :username";
    }

    $query_siswa = "SELECT * FROM tb_siswa" . $where . " ORDER BY kelas ASC";
    $stmt = $pdo->prepare($query_siswa);

    if ($role_id == 4) {
        $stmt->execute(['username' => $username]);
    } else {
        $stmt->execute();
    }

    $data_siswa = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // Tangkap siswa yang dipili
    $siswaDipilih = $_POST['id_siswa'] ?? null;
    $listKelasSiswa = [];
    

    if ($siswaDipilih) {
        // Temukan kelas dari pelajaran terpilih
        $siswaTerpilih = null;
       
        foreach ($data_siswa as $p) {
            if ($p['id'] == $siswaDipilih) {
                $siswaTerpilih = $p['id'];
                break;
            }
        }
        // Ambil siswa dari kelas tersebut
        if ($siswaTerpilih) {
            $stmt = $pdo->prepare("SELECT DISTINCT(kelas) FROM tb_nilai_siswa WHERE id_siswa = :id_siswa");
            $stmt->execute(['id_siswa' => $siswaTerpilih]);
            $listKelasSiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    // end ambil siswa terpilih

    if (isset($_POST['submit'])) {
        $id_siswa = $_POST['id_siswa'];
        $kelas = $_POST['kelas'];

        if ($id_siswa && $kelas) {
            // Redirect ke halaman cetak raport
            header("Location: ./pages/laporan/pdf_raport.php?id_siswa=$id_siswa&kelas=$kelas");
            exit();
        }

    }

?>

<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
        <div class="card">
            <form method="POST" enctype="multipart/form-data">
                <div class="card-header">
                    <h4>Cetak Raport</h4>
                </div>
                <div class="card-body">

                    <!-- Pilih Pelajaran -->
                    <div class="form-group">
                        <label>Nama Siswa </label>

                        <select name="id_siswa" class="form-control selectric" onchange="this.form.submit()">
                            <option value="">- Pilih Siswa -</option>
                            <?php foreach ($data_siswa as $siswa): ?>
                                <option value="<?= $siswa['id'] ?>" 
                                    <?= $siswaDipilih == $siswa['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($siswa['nama_lengkap']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <?php if (!empty($listKelasSiswa)): ?>
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas" class="form-control selectric">
                                <option value="">- Pilih Kelas -</option>
                                <?php foreach ($listKelasSiswa as $kelas): ?>
                                    <option value="<?= $kelas['kelas'] ?>">
                                        <?= htmlspecialchars($kelas['kelas']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Nilai -->

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