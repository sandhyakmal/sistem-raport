<?php

$id = $_GET['id'] ?? null;

if ($id) {
    // Siapkan statement DELETE
    $stmt = $pdo->prepare("DELETE FROM tb_siswa WHERE id = :id");
    $stmt->execute([':id' => $id]);

    echo "<script>
        alert('Data Berhasil dihapus!');
        window.location.href = '?page=data_siswa';
    </script>";
} else {
    echo "<script>
        alert('ID tidak ditemukan.');
        window.location.href = '?page=data_siswa';
    </script>";
}
?>
