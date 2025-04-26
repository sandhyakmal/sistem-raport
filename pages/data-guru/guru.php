<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card">

      <div class="card-header">
        <h4>Data Guru
        <?php
          if ($allowed['data_guru']['create']) {
            echo ' | <a href="?page=tambah_data_guru" class="btn btn-primary">Tambah Data Guru</a>';
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
                  <th>NIP</th>
                  <th>Tempat Lahir</th>
                  <th>Tanggal Lahir</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
                 $no = 1;
                 $query = "SELECT * FROM tb_guru";
                 $stmt = $pdo->prepare($query);
                 $stmt->execute();
                 $data_siswa = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
                 foreach ($data_siswa as $data) {
                ?>
                  <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['nip']; ?></td>
                    <td><?php echo $data['tempat_lahir']; ?></td>
                    <td><?php echo $data['tanggal_lahir']; ?></td>
                    <td>
                      <?php
                        if ($allowed['data_guru']['view']) {
                          echo '<a href="?page=detail_guru&id=' . $data['id'] . '" class="btn btn-primary btn-sm">Detail</a> &nbsp'; 
                        } 
                        if ($allowed['data_guru']['update']) { 
                          echo '<a href="?page=edit_data_guru&id=' . $data['id'] . '" class="btn btn-warning btn-sm">Edit</a> &nbsp;';
                        }
                        if ($allowed['data_guru']['delete']) { 
                          echo '<a href="?page=hapus_data_guru&id=' . $data['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\');">Hapus</a>';
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
