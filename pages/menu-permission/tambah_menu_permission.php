<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Menu Permission</h4>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <form method="POST">
            <div class="p-3">
              <label for="role_name">Role Name:</label>
              <input type="text" name="role_name" id="role_name" class="form-control" required>
            </div>

            <table class="table table-striped mb-0">
              <thead>
                <tr>
                  <th>Privileges</th>
                  <th>Create</th>
                  <th>Read</th>
                  <th>Update</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $menus = [
                  "Data Siswa",
                  "Data Guru",
                  "Data Pelajaran",
                  "Jadwal Pelajaran",
                  "Input Nilai",
                  "Cetak Raport",
                  "Laporan"
                ];

                foreach ($menus as $menu) {
                  $slug = strtolower(str_replace(' ', '_', $menu));
                  echo "<tr>
                    <td>$menu</td>
                    <td><input type='checkbox' name='permissions[{$slug}][]' value='create'></td>
                    <td><input type='checkbox' name='permissions[{$slug}][]' value='view'></td>
                    <td><input type='checkbox' name='permissions[{$slug}][]' value='update'></td>
                    <td><input type='checkbox' name='permissions[{$slug}][]' value='delete'></td>
                  </tr>";
                }
                ?>
              </tbody>
            </table>

            <div class="p-3">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $roleName = $_POST['role_name'];
    $permissions = $_POST['permissions'];

    // Simpan role
    $insertRole = $pdo->exec("INSERT INTO roles (name) VALUES ('$roleName')");
    $roleId = $pdo->lastInsertId();

    // Cek apakah penyimpanan role berhasil
    if ($insertRole) {
        foreach ($permissions as $menu => $actions) {
            $menuName = str_replace('_', ' ', $menu);

            $can_create = in_array('create', $actions) ? 1 : 0;
            $can_view   = in_array('view', $actions) ? 1 : 0;
            $can_update = in_array('update', $actions) ? 1 : 0;
            $can_delete = in_array('delete', $actions) ? 1 : 0;

            $pdo->exec("
                INSERT INTO role_permissions 
                (role_id, menu_name, can_create, can_view, can_update, can_delete)
                VALUES (
                    '$roleId',
                    '$menuName',
                    '$can_create',
                    '$can_view',
                    '$can_update',
                    '$can_delete'
                )
            ");
        }

        echo "
        <script>
        alert('Data berhasil disimpan!');
        window.location.href='?page=menu_permission';
        </script>";
    } else {
        echo "
        <script>
        alert('Data gagal disimpan!');
        window.location.href='?page=menu_permission';
        </script>";
    }
}
?>
