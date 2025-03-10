<?php
require 'config.php';

function getStudents($pdo) {
    return $pdo->query("SELECT * FROM students")->fetchAll(PDO::FETCH_ASSOC);
}

function getStudentById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addStudent($pdo, $name, $nim, $major) {
    $stmt = $pdo->prepare("INSERT INTO students (name, nim, major) VALUES (?, ?, ?)");
    $stmt->execute([$name, $nim, $major]);
}

function updateStudent($pdo, $id, $name, $nim, $major) {
    $stmt = $pdo->prepare("UPDATE students SET name = ?, nim = ?, major = ? WHERE id = ?");
    $stmt->execute([$name, $nim, $major, $id]);
}

function deleteStudent($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$id]);
}
?>