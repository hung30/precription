<?php
require_once '../connection/connect.php';
if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $patientId = $_POST['patient'];
  $dayStart = str_replace('T', ' ', $_POST['dayStart']);
  $dayEnd = str_replace('T', ' ', $_POST['dayEnd']);
  $doctorId = $_POST['doctor'];
  $sql = "INSERT INTO prescription(doctorId, patientId, dayStart, dayEnd) VALUES ($doctorId, $patientId, '$dayStart', '$dayEnd')";
  if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Thông tin đơn thuốc đã được lưu thành công.");';
    echo 'setTimeout(function() { window.location.href = "../index.php"; }, 500);</script>';
    mysqli_close($conn);
    exit();
  } else {
    echo "Lỗi khi lưu: " . $conn->error;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chỉnh sửa thông tin đơn thuốc</title>
  <link rel="stylesheet" href="../style.css">
</head>

<body>
  <header>
    <a href="../index.php">THÊM THÔNG TIN ĐƠN THUỐC</a>
  </header>
  <div class="edit-patient-form">
    <h2 style="text-align: center;">THÊM THÔNG TIN</h2>
    <form method="post" class="form">
      <div class="f">
        <label for="patient">Họ tên</label>
        <?php
        require_once '../connection/connect.php';
        $sql = 'SELECT patientId, patientName FROM patient';
        $result = $conn->query($sql);

        if ($result) {
          echo '<select class="form-input" name="patient" >';
          echo '<option value="0">Chọn bệnh nhân</option>';
          while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['patientId'] . '">' . $row['patientName'] . '</option>';
          }

          echo '</select>';
        } else {
          die('Error: ' . mysqli_error($conn));
        }
        ?>
      </div>
      <div class="f">
        <label for="dayStart">Day start:</label>
        <input type="datetime-local" class="form-input" name="dayStart">
      </div>
      <div class="f">
        <label for="dayEnd">Day end:</label>
        <input type="datetime-local" class="form-input" name="dayEnd">
      </div>
      <div class="f">
        <label>Bác sĩ</label>
        <?php
        require_once '../connection/connect.php';
        $sql = 'SELECT doctorId, doctorName FROM doctor';
        $result = $conn->query($sql);

        if ($result) {
          echo '<select class="form-input" name="doctor" >';
          echo '<option value="0">Chọn bác sĩ</option>';
          while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['doctorId'] . '">' . $row['doctorName'] . '</option>';
          }

          echo '</select>';
        } else {
          die('Error: ' . mysqli_error($conn));
        }
        ?>
      </div>
      <button type="submit" class="button-form">Lưu</button>
    </form>
  </div>
  <footer>
    Design by: Nguyễn Đình Hưng
  </footer>
</body>

</html>