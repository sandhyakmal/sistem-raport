<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card">

      <div class="card-header">
        <h4>Jadwal Pelajaran
        <?php
          if ($allowed['jadwal_pelajaran']['create']) {
            echo ' | <a href="?page=tambah_jadwal_pelajaran" class="btn btn-primary">Tambah Jadwal Pelajaran</a>';
          } 
        ?>
      </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th>Nama Guru</th>
                  <th>Kelas - Nama Pelajaran</th>
                  <th>Hari</th>
                  <th>Jam Mulai</th>
                  <th>Jam Selesai</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $no = 1;
                $query = "  SELECT  a.id,b.nama as nama_guru, c.nama as nama_mapel, c.kelas as kelas, a.hari, a.jam_mulai, a.jam_selesai FROM tb_jadwal_pelajaran a
                            JOIN tb_guru b  ON a.id_guru = b.id 
                            JOIN tb_pelajaran c ON a.id_pelajaran = c.id 
                            ORDER BY a.id ASC ";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $data_siswa = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($data_siswa as $data) {
                ?>
                  <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td><?php echo $data['nama_guru']; ?></td>
                    <td><?php echo $data['kelas'].' - '.$data['nama_mapel']; ?></td>
                    <td><?php echo $data['hari']; ?></td>
                    <td><?php echo $data['jam_mulai']; ?></td>
                    <td><?php echo $data['jam_selesai']; ?></td>
                    
                    <td>
                      <?php
                        if ($allowed['jadwal_pelajaran']['update']) { 
                          echo '<a href="?page=edit_jadwal_pelajaran&id=' . $data['id'] . '" class="btn btn-warning btn-sm">Edit</a> &nbsp;';
                        }
                        if ($allowed['jadwal_pelajaran']['delete']) { 
                          echo '<a href="?page=hapus_jadwal_pelajaran&id=' . $data['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\');">Hapus</a>';
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
</div>
