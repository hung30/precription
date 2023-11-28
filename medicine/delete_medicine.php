<?php
require_once '../connection/connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['medicineId'])) {
  $medicineId = $_GET['medicineId'];
  $delete_sql = "DELETE FROM medicine WHERE medicineId = $medicineId";
  if ($conn->query($delete_sql) === TRUE) {
    mysqli_close($conn);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  } else {
    echo "Lỗi khi xóa: " . $conn->error;
  }
} else {
  echo "Lỗi khi xoá thuốc: " . $conn->error;
}
