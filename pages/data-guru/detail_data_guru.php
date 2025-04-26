<?php

    $id = $_GET['id'] ;

    $query = "SELECT * FROM tb_guru WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
    <div class="card">
        <form method="POST" enctype="multipart/form-data">
        <div class="card-header">
            <h4>Detail Data Guru</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" value="<?php echo $data['nama'] ?>" readonly name="nama" class="form-control" >
            </div>

            <div class="form-group">
                <label>NIP</label>
                <input type="text" value="<?php echo $data['nip'] ?>" readonly  name="nip" class="form-control">
            </div>

            <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" value="<?php echo $data['tempat_lahir'] ?>" readonly  name="tempat_lahir" class="form-control">
            </div>

            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" value="<?php echo $data['tanggal_lahir'] ?>" readonly  name="tanggal_lahir" class="form-control">
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" value="<?php echo $data['alamat'] ?>" readonly  class="form-control">
            </div>

            <div class="form-group">
                <label>Ijazah Terakhir</label>
                <input type="text" name="ijazah_terakhir"  value="<?php echo $data['ijazah_terakhir'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Tahun Lulus</label>
                <input type="text" name="tahun_lulus" value="<?php echo $data['tahun_lulus'] ?>" readonly  class="form-control">
            </div>

            <div class="form-group">
                <label>Pangkat Golongan</label>
                <input type="text" name="pangkat_golongan" value="<?php echo $data['pangkat_golongan'] ?>" readonly  class="form-control">
            </div>

            <div class="form-group">
                <label>Tmt CPNS</label>
                <input type="date" name="tmt_cpns" value="<?php echo $data['tmt_cpns'] ?>" readonly  class="form-control">
            </div>

            <div class="form-group">
                <label>Tmt PNS</label>
                <input type="date" name="tmt_pns" value="<?php echo $data['tmt_pns'] ?>" readonly  class="form-control">
            </div>

            <div class="form-group">
                <label>Masa Kerja</label>
                <input type="text" name="masa_kerja" value="<?php echo $data['masa_kerja'] ?>" readonly  class="form-control">
            </div>

            <div class="form-group">
                <label>NUPTK</label>
                <input type="text" name="nuptk" value="<?php echo $data['nuptk'] ?>" readonly  class="form-control">
            </div>

            <div class="form-group">
                <label>Karpeg</label>
                <input type="text" name="karpeg" value="<?php echo $data['karpeg'] ?>" readonly  class="form-control">
            </div>

            <div class="form-group">
                <label>NPWP</label>
                <input type="text" name="npwp" value="<?php echo $data['npwp'] ?>" readonly  class="form-control">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo $data['email_aktif'] ?>" readonly  class="form-control">
            </div>
        </div>

        <!-- <div class="card-footer text-right">
            <button class="btn btn-primary">Submit</button>
        </div> -->
        </form>
    </div>
    </div>
</div>