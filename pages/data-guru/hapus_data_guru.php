<?php

$id = $_GET['id'] ?? null;

if ($id) {
    // Siapkan statement DELETE
    $stmt = $pdo->prepare("DELETE FROM tb_guru WHERE id = :id");
    $stmt->execute([':id' => $id]);

    echo "<script>
        alert('Data Berhasil dihapus!');
        window.location.href = '?page=data_guru';
    </script>";
} else {
    echo "<script>
        alert('ID tidak ditemukan.');
        window.location.href = '?page=data_guru';
    </script>";
}
?>
