<?php
require 'functions.php';
if (isset($_GET['id'])) {
    deleteStudent($pdo, $_GET['id']);
}
header("Location: index.php");
exit();
?>