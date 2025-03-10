<?php
require 'functions.php';

if (isset($_POST['add'])) {
    addStudent($pdo, $_POST['name'], $_POST['nim'], $_POST['major']);
    header("Location: index.php");
    exit();
}

if (isset($_POST['update'])) {
    updateStudent($pdo, $_POST['id'], $_POST['name'], $_POST['nim'], $_POST['major']);
    header("Location: index.php");
    exit();
}

$editData = isset($_GET['edit']) ? getStudentById($pdo, $_GET['edit']) : null;
$students = getStudents($pdo);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Data Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <div class="row">
        <div class="col-md-5">
            <div class="card shadow p-4">
                <h2 class="text-center mb-4">Manajemen Data Mahasiswa</h2>
                <form method="POST" class="mb-3">
                    <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" value="<?= $editData['name'] ?? '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" name="nim" class="form-control" value="<?= $editData['nim'] ?? '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jurusan</label>
                        <input type="text" name="major" class="form-control" value="<?= $editData['major'] ?? '' ?>" required>
                    </div>
                    <?php if ($editData): ?>
                        <button type="submit" name="update" class="btn btn-success w-100">Simpan Perubahan</button>
                    <?php else: ?>
                        <button type="submit" name="add" class="btn btn-primary w-100">Tambah</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card shadow p-4">
                <h4 class="text-center mb-3">Daftar Mahasiswa</h4>
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student) : ?>
                            <tr>
                                <td><?= $student['id'] ?></td>
                                <td><?= $student['name'] ?></td>
                                <td><?= $student['nim'] ?></td>
                                <td><?= $student['major'] ?></td>
                                <td>
                                    <a href="index.php?edit=<?= $student['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete.php?id=<?= $student['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
