<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
    <div class="card">
        <form method="POST" enctype="multipart/form-data">
        <div class="card-header">
            <h4>Tambah Data Pelajaran</h4>
        </div>
        <div class="card-body">

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
                <label>Nama Pelajaran</label>
                <input type="text" name="nama" class="form-control">
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

    $kelas = $_POST['kelas'];
    $nama  = $_POST['nama'];

    // Cek duplikat berdasarkan kelas + nama
    $check = $pdo->prepare("SELECT COUNT(*) FROM tb_pelajaran WHERE kelas = :kelas AND nama = :nama");
    $check->execute([
        ':kelas' => $kelas,
        ':nama'  => $nama
    ]);
    $exists = $check->fetchColumn();

    if ($exists > 0) {
        // Duplikat ditemukan
        echo "
        <script>
        alert(' Data dengan nama dan kelas yang sama sudah ada!');
        window.location.href='?page=data_pelajaran';
        </script>";
    } else {
        // Lanjut insert
        $sql = "INSERT INTO tb_pelajaran (kelas, nama) VALUES (:kelas, :nama)";
        $stmt = $pdo->prepare($sql);
        $success = $stmt->execute([
            ':kelas' => $kelas,
            ':nama'  => $nama
        ]);

        if ($success) {
            echo "
            <script>
            alert(' Data berhasil disimpan!');
            window.location.href='?page=data_pelajaran';
            </script>";
        } else {
            echo "
            <script>
            alert(' Data gagal disimpan!');
            window.location.href='?page=data_pelajaran';
            </script>";
        }
    }
}

?>

