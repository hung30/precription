<?php
require_once '../connection/connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['prescriptionId'])) {
  $prescriptionId = $_GET['prescriptionId'];
  $delete_sql = "DELETE FROM prescription WHERE prescriptionId = $prescriptionId";
  if ($conn->query($delete_sql) === TRUE) {
    mysqli_close($conn);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  } else {
    echo "Lỗi khi xóa: " . $conn->error;
  }
} else {
  echo "Lỗi khi xoá đơn thuốc: " . $conn->error;
}
