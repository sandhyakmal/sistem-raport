<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card">

      <div class="card-header">
        <h4>Group Menu | <a href="?page=tambah_menu_permission" class="btn btn-primary">Tambah Group Menu</a></h4>
      </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>ID</th>
                  <th>Nama Group Menu</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $query = "SELECT * FROM roles";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $data_siswa = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($data_siswa as $data) {
                ?>
                  <tr>
                    <td>#</td>
                    <td><?php echo $data['id']; ?></td>
                    <td><?php echo $data['name']; ?></td>
                    <td>
                      <a href="?page=edit_menu_permission&id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
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
