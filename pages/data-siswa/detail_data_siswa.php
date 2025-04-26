<?php

    $id = $_GET['id'] ;

    $query = "SELECT * FROM tb_siswa WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
    <div class="card">
        <form method="POST" enctype="multipart/form-data">
        <div class="card-header">
            <h4>Detail Data Siswa</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="<?php echo $data['nama_lengkap'] ?>" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label>NISN</label>
                <input type="text" name="nisn" value="<?php echo $data['nisn'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <input type="text" name="kelas" value="<?php echo $data['kelas'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" value="<?php echo $data['tempat_lahir'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="<?php echo $data['tanggal_lahir'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label>
                <input type="text" name="tanggal_lahir" value="<?php echo $data['jenis_kelamin'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Agama</label>
                <input type="text" name="agama" value="<?php echo $data['agama'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Status dalam Keluarga</label>
                <input type="text" name="status_keluarga" value="<?php echo $data['status_dalam_keluarga'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Anak ke</label>
                <input type="number" min="0" name="anak_ke" value="<?php echo $data['anak_ke'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Alamat Peserta Didik</label>
                <input type="text" name="alamat" value="<?php echo $data['alamat'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>No. Telepon Rumah</label>
                <input type="text" name="no_telp_rumah" value="<?php echo $data['no_telp_rumah'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Sekolah Asal</label>
                <input type="text" name="sekolah_asal" value="<?php echo $data['sekolah_asal'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Diterima Tanggal</label>
                <input type="date" name="diterima_tanggal" value="<?php echo $data['diterima_tanggal'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Diterima di Kelas</label>
                <input type="text" name="diterima_di_kelas" value="<?php echo $data['diterima_di_kelas'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Nama Ayah</label>
                <input type="text" name="nama_ayah" value="<?php echo $data['nama_ayah'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Nama Ibu</label>
                <input type="text" name="nama_ibu" value="<?php echo $data['nama_ibu'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Alamat Orang Tua</label>
                <input type="text" name="alamat_orang_tua" value="<?php echo $data['alamat_orang_tua'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>No. Telepon Orang Tua</label>
                <input type="text" name="no_telp_orang_tua" value="<?php echo $data['no_telp_orang_tua'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Pekerjaan Ayah</label>
                <input type="text" name="pekerjaan_ayah" value="<?php echo $data['pekerjaan_ayah'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Pekerjaan Ibu</label>
                <input type="text" name="pekerjaan_ibu" value="<?php echo $data['pekerjaan_ibu'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Nama Wali</label>
                <input type="text" name="nama_wali" value="<?php echo $data['nama_wali'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Alamat Wali</label>
                <input type="text" name="alamat_wali" value="<?php echo $data['alamat_wali'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>No. Telepon Wali</label>
                <input type="text" name="no_telp_wali" value="<?php echo $data['no_telp_wali'] ?>" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Pekerjaan Wali</label>
                <input type="text" name="pekerjaan_wali" value="<?php echo $data['pekerjaan_wali'] ?>" readonly class="form-control">
            </div>

            <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Foto Siswa</h4>
                  </div>
                  <div class="card-body">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img class="d-block w-100" src="./foto_siswa/<?php echo $data['foto'] ?>" alt="First slide">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

        </div>

        <!-- <div class="card-footer text-right">
            <button class="btn btn-primary">Submit</button>
        </div> -->
        </form>
    </div>
    </div>
</div>