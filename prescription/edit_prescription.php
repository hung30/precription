<?php
require_once '../connection/connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['prescriptionId'])) {
  $prescriptionId = $_GET['prescriptionId'];
  $sql = "SELECT pat.patientName AS patientName, pat.gender AS gender, pat.phone AS phone, doc.doctorName AS doctorName from prescription AS pre
  JOIN patient AS pat ON pre.patientId = pat.patientId
  JOIN doctor AS doc ON pre.doctorId = doc.doctorId WHERE prescriptionId = $prescriptionId";
  $result = mysqli_query($conn, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
  } else {
    echo "Không tìm thấy thông tin bệnh nhân.";
    exit();
  }
} else if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $prescriptionId = $_GET['prescriptionId'];
  $updated_doctorId = $_POST['doctor'];
  $update_sql = "UPDATE prescription
  SET doctorId = '$updated_doctorId'
  where prescriptionId = $prescriptionId";
  if ($conn->query($update_sql) === TRUE) {
    echo '<script>alert("Thông tin bệnh nhân đã được cập nhật thành công.");';
    echo 'setTimeout(function() { window.location.href = "../index.php"; }, 500);</script>';
    mysqli_close($conn);
    exit();
  } else {
    echo "Lỗi khi cập nhật: " . $conn->error;
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
    <a href="../index.php">CHỈNH SỬA THÔNG TIN ĐƠN THUỐC</a>
  </header>
  <div class="edit-patient-form">
    <h2 style="text-align: center;">Đổi bác sĩ cho bệnh nhân <?php echo $data['patientName'] ?></h2>
    <form method="post" class="form">
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
      <button type="submit" class="button-form">Cập nhật thông tin</button>
    </form>
  </div>
  <footer>
    Design by: Nguyễn Đình Hưng
  </footer>
</body>

</html>