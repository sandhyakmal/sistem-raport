<?php

    $id = $_GET['id'] ;

    $query = "SELECT * FROM tb_jadwal_pelajaran WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'id' => $id
    ]);

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    $id_guru = $data['id_guru'] ?? ''; 
    $id_pelajaran = $data['id_pelajaran'] ?? ''; 

?>

<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
    <div class="card">
        <form method="POST" enctype="multipart/form-data">
        <div class="card-header">
            <h4>Edit Jadwal Pelajaran</h4>
        </div>
        <div class="card-body">

            <?php 
                // Ambil data kelas dari database
                $stmt = $pdo->query("SELECT * FROM tb_guru ORDER BY id ASC");
                $listGuru = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $stmt = $pdo->query("SELECT * FROM tb_pelajaran ORDER BY id ASC");
                $listPelajaran = $stmt->fetchAll(PDO::FETCH_ASSOC);

            ?>

           <div class="form-group">
                <label>Nama Guru</label>
                <select name="guru" class="form-control selectric">
                    <option value="">- Pilih Guru -</option>
                    <?php foreach ($listGuru as $guru): ?>
                        <option value="<?= $guru['id'] ?>" <?= ($guru['id'] == $id_guru) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($guru['id'] . ' - ' . $guru['nama']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>


            <div class="form-group">
                <label>Kelas - Nama Pelajaran</label>
                <select name="pelajaran" class="form-control selectric">
                    <option value="">- Pilih Pelajaran -</option>
                    <?php foreach ($listPelajaran as $pelajaran): ?>
                        <option value="<?= $pelajaran['id'] ?>" <?= ($pelajaran['id'] == $id_pelajaran) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($pelajaran['id'] . ' - ' . $pelajaran['nama']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Hari</label>
                <select name="hari" class="form-control selectric">
                    <option> - Pilih Hari - </option>
                    <option <?php if($data['hari'] == 'Senin')  echo 'selected' ; ?> value="Senin">Senin</option>
                    <option <?php if($data['hari'] == 'Selasa')  echo 'selected' ; ?> value="Selasa">Selasa</option>
                    <option <?php if($data['hari'] == 'Rabu')  echo 'selected' ; ?> value="Rabu">Rabu</option>
                    <option <?php if($data['hari'] == 'Kamis')  echo 'selected' ; ?> value="Kamis">Kamis</option>
                    <option <?php if($data['hari'] == 'Jumat')  echo 'selected' ; ?> value="Jumat">Jum'at</option>
                </select>
            </div>

            <div class="form-group">
                <label>Jam Mulai</label>
                <input type="time" name="jam_mulai" value="<?php echo $data['jam_mulai'] ?>" class="form-control">
            </div>

            <div class="form-group">
                <label>Jam Selesai</label>
                <input type="time" name="jam_selesai" value="<?php echo $data['jam_selesai'] ?>" class="form-control">
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

    $guru = $_POST['guru'];
    $pelajaran  = $_POST['pelajaran'];
    $hari       = $_POST['hari'];
    $jam_mulai  = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    // Cek duplikat berdasarkan kelas + nama
    // Cek duplikat berdasarkan hari, jam mulai, jam selesai TAPI bukan data yang sedang diupdate
    $check = $pdo->prepare("SELECT COUNT(*) FROM tb_jadwal_pelajaran WHERE hari = :hari AND jam_mulai = :jam_mulai AND jam_selesai = :jam_selesai AND id != :id");
    $check->execute([
        ':hari' => $hari,
        ':jam_mulai' => $jam_mulai,
        ':jam_selesai' => $jam_selesai,
        ':id' => $id
    ]);
    $exists = $check->fetchColumn();


    if ($exists > 0) {
        // Duplikat ditemukan
        echo "
        <script>
        alert(' Data yang diinput sudah ada!');
        window.location.href='?page=jadwal_pelajaran';
        </script>";
    } else {
        // Lanjut insert
        $sql = "UPDATE tb_jadwal_pelajaran SET id_guru = :guru, id_pelajaran = :pelajaran, hari = :hari, jam_mulai = :jam_mulai, jam_selesai = :jam_selesai   WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $success = $stmt->execute([
            ':guru' => $guru,
            ':pelajaran'  => $pelajaran,
            ':hari'  => $hari,
            ':jam_mulai' => $jam_mulai,
            ':jam_selesai' => $jam_selesai,
            ':id' => $id
        ]);

        if ($success) {
            echo "
            <script>
            alert(' Data berhasil terupdate!');
            window.location.href='?page=jadwal_pelajaran';
            </script>";
        } else {
            echo "
            <script>
            alert(' Data gagal terupdate!');
            window.location.href='?page=jadwal_pelajaran';
            </script>";
        }
    }
}

?>

