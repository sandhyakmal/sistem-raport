<?php

    $roleId = $_SESSION['role_id'] ?? '';

    $query = $pdo->query("SELECT * FROM role_permissions WHERE role_id = $roleId");
    $permissions = $query->fetchAll(PDO::FETCH_ASSOC);

    // Susun array permission per menu
    $allowed = [];
    foreach ($permissions as $perm) {
        $slug = strtolower(str_replace(' ', '_', $perm['menu_name']));
        $allowed[$slug] = [
            'create' => $perm['can_create'],
            'view'   => $perm['can_view'],
            'update' => $perm['can_update'],
            'delete' => $perm['can_delete'],
        ];
    }
?>