<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card">

      <div class="card-header">
        <h4>Data Pelajaran
        <?php
          if ($allowed['data_pelajaran']['create']) {
            echo ' | <a href="?page=tambah_data_pelajaran" class="btn btn-primary">Tambah Data Pelajaran</a>';
          } 
        ?>
      </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th>Kelas</th>
                  <th>Nama Pelajaran</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $no = 1;
                $query = "SELECT * FROM tb_pelajaran ORDER BY kelas ASC";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $data_siswa = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($data_siswa as $data) {
                ?>
                  <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td><?php echo $data['kelas']; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td>
                      <?php
                        if ($allowed['data_pelajaran']['update']) { 
                          echo '<a href="?page=edit_data_pelajaran&id=' . $data['id'] . '" class="btn btn-warning btn-sm">Edit</a> &nbsp;';
                        }
                        if ($allowed['data_pelajaran']['delete']) { 
                          echo '<a href="?page=hapus_data_pelajaran&id=' . $data['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\');">Hapus</a>';
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
