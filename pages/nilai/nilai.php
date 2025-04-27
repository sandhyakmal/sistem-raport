
<div class="section-body">
 
<?php if ($_SESSION['role_id'] == 5 || $_SESSION['role_id'] == 6 || $_SESSION['role_id'] == 3): ?>
  <div class="row">
    <div class="col-12">
      <div class="card">

      <div class="card-header">
        <h4>Data Nilai Siswa
        <?php
          if ($allowed['input_nilai']['create'] && $_SESSION['role_id'] == 5) {
            echo ' | <a href="?page=input_nilai" class="btn btn-primary">Input Nilai Siswa</a> ';
          } 
        ?>
      </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th>Nama Siswa</th>
                  <th>Kelas</th>
                  <th>Mata Pelajaran</th>
                  <th>Nilai Akhir</th>
                  <th>Capaian Kompetensi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $no = 1;
                $query = "SELECT tns.id, tns.kelas, tns.nilai_akhir, tns.capaian, tp.nama as nama_mapel, ts.nama_lengkap as nama_siswa 
                          FROM tb_nilai_siswa tns 
                          JOIN tb_pelajaran tp ON tns.id_pelajaran = tp.id
                          JOIN tb_siswa ts ON tns.id_siswa = ts.id ";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $data_siswa = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($data_siswa as $data) {
                ?>
                  <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td><?php echo $data['nama_siswa']; ?></td>
                    <td><?php echo $data['kelas']; ?></td>
                    <td><?php echo $data['nama_mapel']; ?></td>
                    <td><?php echo $data['nilai_akhir']; ?></td>
                    <td><?php echo $data['capaian']; ?></td>
                    <td>
                      <?php
            
                        // if ($allowed['input_nilai']['update']) { 
                        //   echo '<a href="?page=edit_data_siswa&id=' . $data['id'] . '" class="btn btn-warning btn-sm">Edit</a> &nbsp;';
                        // }
                        if ($allowed['input_nilai']['delete'] && $_SESSION['role_id'] == 5) { 
                          echo '<a href="?page=hapus_nilai&id=' . $data['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\');">Hapus</a>';
                        } 
                      ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php if ($_SESSION['role_id'] == 6 || $_SESSION['role_id'] == 3): ?>
  <div class="row">
    <div class="col-12">
      <div class="card">

      <div class="card-header">
        <h4>Data Keterangan Siswa
        <?php
          if ($allowed['input_nilai']['create'] && $_SESSION['role_id'] == 6) {
            echo ' | <a href="?page=input_keterangan" class="btn btn-primary">Input Wali Kelas Siswa</a> ';
          }
        ?>
      </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-2">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th>Nama Siswa</th>
                  <th>Kelas</th>
                  <th>Kegiatan Ekstrakurikuler</th>
                  <th>Predikat</th>
                  <th>Keterangan</th>
                  <th>Sakit</th>
                  <th>Izin</th>
                  <th>Alpa</th>
                  <th>Semester</th>
                  <th>Fase</th>
                  <th>Tahun Ajaran</th>
                  <th>Catatan Wali Kelas</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $no = 1;
                $query = "SELECT tks.id, ts.nama_lengkap, tks.kelas, tks.kegiatan, tks.predikat, tks.keterangan, tks.sakit, tks.izin, tks.alpa, tks.semester, tks.fase, tks.tahun_ajaran, tks.catatan FROM tb_keterangan_siswa tks
                          JOIN tb_siswa ts ON tks.id_siswa = ts.id ";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $data_siswa = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($data_siswa as $data) {
                ?>
                  <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td><?php echo $data['nama_lengkap']; ?></td>
                    <td><?php echo $data['kelas']; ?></td>
                    <td><?php echo $data['kegiatan']; ?></td>
                    <td><?php echo $data['predikat']; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td><?php echo $data['sakit']; ?></td>
                    <td><?php echo $data['izin']; ?></td>
                    <td><?php echo $data['alpa']; ?></td>
                    <td><?php echo $data['semester']; ?></td>
                    <td><?php echo $data['fase']; ?></td>
                    <td><?php echo $data['tahun_ajaran']; ?></td>
                    <td><?php echo $data['catatan']; ?></td>
                    <td>
                      <?php
                        if ($allowed['input_nilai']['delete'] && $_SESSION['role_id'] == 6) { 
                          echo '<a href="?page=hapus_keterangan&id=' . $data['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\');">Hapus</a>';
                        } 
                      ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

</div>
