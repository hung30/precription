<?php
require_once '../connection/connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
  $id = $_GET['id'];
  $delete_sql = "DELETE FROM prescription_detail WHERE id = $id";
  if ($conn->query($delete_sql) === TRUE) {
    mysqli_close($conn);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  } else {
    echo "Lỗi khi xóa: " . $conn->error;
  }
} else {
  echo "Lỗi khi xoá kê đơn thuốc: " . $conn->error;
}
