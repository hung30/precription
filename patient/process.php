<?php
require_once '../connection/connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['form_type'])) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO patient(patientName, gender, phone) VALUES ('$name', '$gender', '$phone')";
    if ($conn->query($sql) === TRUE) {
      mysqli_close($conn);
      echo '<script>alert("Dữ liệu bệnh nhân đã được lưu thành công.");';
      echo 'setTimeout(function() { window.location.href = "./new_patient.php"; }, 500);</script>';
      exit();
    } else {
      echo "Lỗi: " . $patient_sql . "<br>" . $conn->error;
    }
  }
}
