<?php
require_once '../connection/connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['patientId'])) {
  $patientId = $_GET['patientId'];
  $delete_sql = "DELETE FROM patient WHERE patientId = $patientId";
  if ($conn->query($delete_sql) === TRUE) {
    mysqli_close($conn);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  } else {
    echo "Lỗi khi xóa: " . $conn->error;
  }
} else {
  echo "Lỗi khi xoá bệnh nhân: " . $conn->error;
}
