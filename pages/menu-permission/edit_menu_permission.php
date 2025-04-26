<?php
// Ambil role_id dari URL
$roleId = $_GET['id'];

// Ambil nama role
$roleQuery = $pdo->query("SELECT * FROM roles WHERE id = $roleId");
$role = $roleQuery->fetch();

// Ambil semua permissions-nya
$permissionsQuery = $pdo->query("SELECT * FROM role_permissions WHERE role_id = $roleId");
$permissionsData = $permissionsQuery->fetchAll(PDO::FETCH_ASSOC);

// Susun ulang agar gampang dicek
$existingPermissions = [];
foreach ($permissionsData as $p) {
    $slug = strtolower(str_replace(' ', '_', $p['menu_name']));
    $existingPermissions[$slug] = [
        'create' => $p['can_create'],
        'view'   => $p['can_view'],
        'update' => $p['can_update'],
        'delete' => $p['can_delete'],
    ];
}
?>


<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Edit Menu Permission</h4>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
            <form method="POST">
                <div class="p-3">
                <label for="role_name">Role Name:</label>
                <input type="text" name="role_name" id="role_name" class="form-control" value="<?= $role['name'] ?>" required>
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
                        $perm = $existingPermissions[$slug] ?? ['create'=>0, 'view'=>0, 'update'=>0, 'delete'=>0];
    
                        echo "<tr>
                            <td>$menu</td>
                            <td><input type='checkbox' name='permissions[{$slug}][]' value='create' ".($perm['create'] ? 'checked' : '')."></td>
                            <td><input type='checkbox' name='permissions[{$slug}][]' value='view' ".($perm['view'] ? 'checked' : '')."></td>
                            <td><input type='checkbox' name='permissions[{$slug}][]' value='update' ".($perm['update'] ? 'checked' : '')."></td>
                            <td><input type='checkbox' name='permissions[{$slug}][]' value='delete' ".($perm['delete'] ? 'checked' : '')."></td>
                        </tr>";
                    }
                    ?>
                </tbody>
                </table>
    
                <div class="p-3">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
    
            </form>
        </div>
      </div>
    </div>
  </div>
</div>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $roleId = $_GET['id'];
    $roleName = $_POST['role_name'];
    $permissions = $_POST['permissions'];

    // Update nama role
    $pdo->exec("UPDATE roles SET name = '$roleName' WHERE id = $roleId");

    // Hapus semua permission lama
    $success =  $pdo->exec("DELETE FROM role_permissions WHERE role_id = $roleId");

    if ($success) {
        
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
        alert('Data role berhasil diperbarui!');
        window.location.href='?page=menu_permission';
        </script>";
       
    } else {
        echo "
        <script>
        alert('Data role gagal diperbarui!');
        window.location.href='?page=menu_permission';
        </script>";
    }


}

?>