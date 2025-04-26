<?php
    // Ambil data guru
    $query_siswa = " SELECT * FROM tb_siswa ORDER BY kelas ASC";
    $stmt = $pdo->prepare($query_siswa);
    $stmt->execute();
    $data_siswa = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
        <div class="card">
            <form method="POST" action="./pages/laporan/pdf_raport.php" enctype="multipart/form-data">
                <div class="card-header">
                    <h4>Cetak Raport</h4>
                </div>
                <div class="card-body">

                    <!-- Pilih Pelajaran -->
                    <div class="form-group">
                        <label>Kelas - Nama Siswa </label>

                        <!-- <select name="pelajaran" class="form-control selectric" onchange="this.form.submit()"> -->
                        <select name="siswa" class="form-control selectric">
                            <option value="">- Pilih Siswa -</option>
                            <?php foreach ($data_siswa as $siswa): ?>
                                <option value="<?= $siswa['id'] ?>" >
                                    <?= htmlspecialchars($siswa['kelas'] . ' - ' . $siswa['nama_lengkap']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary">Cetak Report</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>