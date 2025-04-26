<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card">

      <div class="card-header">
        <h4>Data Siswa 
        <?php
          if ($allowed['data_siswa']['create']) {
            echo ' | <a href="?page=tambah_data_siswa" class="btn btn-primary">Tambah Data Siswa</a>';
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
                  <th>NISN</th>
                  <th>Kelas</th>
                  <th>Jenis Kelamin</th>
                  <th>Tanggal Lahir</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $no = 1;
                $query = "SELECT * FROM tb_siswa";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $data_siswa = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($data_siswa as $data) {
                ?>
                  <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td><?php echo $data['nama_lengkap']; ?></td>
                    <td><?php echo $data['nisn']; ?></td>
                    <td><?php echo $data['kelas']; ?></td>
                    <td><?php echo $data['jenis_kelamin']; ?></td>
                    <td><?php echo $data['tanggal_lahir']; ?></td>
                    <td>
                      <?php
                        if ($allowed['data_siswa']['view']) {
                          echo '<a href="?page=detail_siswa&id=' . $data['id'] . '" class="btn btn-primary btn-sm">Detail</a> &nbsp'; 
                        } 
                        if ($allowed['data_siswa']['update']) { 
                          echo '<a href="?page=edit_data_siswa&id=' . $data['id'] . '" class="btn btn-warning btn-sm">Edit</a> &nbsp;';
                        }
                        if ($allowed['data_siswa']['delete']) { 
                          echo '<a href="?page=hapus_data_siswa&id=' . $data['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\');">Hapus</a>';
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
