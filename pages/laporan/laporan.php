<?php
    // Ambil data guru
    $query_pelajaran = " SELECT * FROM tb_pelajaran ";
    $stmt = $pdo->prepare($query_pelajaran);
    $stmt->execute();
    $data_pelajaran = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
        <div class="card">
            <form method="POST" action="./pages/laporan/pdf_laporan_nilai.php" enctype="multipart/form-data">
                <div class="card-header">
                    <h4>Cetak Laporan</h4>
                </div>
                <div class="card-body">

                    <!-- Pilih Pelajaran -->
                    <div class="form-group">
                        <label>Kelas - Nama Pelajaran </label>

                        <!-- <select name="pelajaran" class="form-control selectric" onchange="this.form.submit()"> -->
                        <select name="pelajaran" class="form-control selectric">
                            <option value="">- Pilih Pelajaran yang Diajar -</option>
                            <?php foreach ($data_pelajaran as $pelajaran): ?>
                                <option value="<?= $pelajaran['id'] ?>" >
                                    <?= htmlspecialchars($pelajaran['kelas'] . ' - ' . $pelajaran['nama']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary">Cetak Laporan</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>