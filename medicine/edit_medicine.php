<?php
require_once '../connection/connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['medicineId'])) {
  $medicineId = $_GET['medicineId'];
  $sql = "SELECT * FROM medicine WHERE medicineId = $medicineId";
  $result = mysqli_query($conn, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
    $medicine_data = mysqli_fetch_assoc($result);
  } else {
    echo "Không tìm thấy thông tin bệnh nhân.";
    exit();
  }
} else if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $medicineId = $_GET['medicineId'];
  $updated_name = $_POST['name'];
  $updated_doseMin = $_POST['dosemin'];
  $updated_doseMax = $_POST['dosemax'];
  $updated_frequence = $_POST['frequence'];
  $updated_unit = $_POST['unit'];
  $update_sql = "UPDATE medicine
  SET medicineName = '$updated_name', doseMin = $updated_doseMin, doseMax = $updated_doseMax, Frequence = $updated_frequence, Unit = $updated_unit
  where medicineId = $medicineId";
  if ($conn->query($update_sql) === TRUE) {
    echo '<script>alert("Thông tin bệnh nhân đã được cập nhật thành công.");';
    echo 'setTimeout(function() { window.location.href = "./index.php"; }, 500);</script>';
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
  <title>Chỉnh sửa thông tin bệnh nhân</title>
  <link rel="stylesheet" href="../style.css">
</head>

<body>
  <header>
    <a href="../index.php">CHỈNH SỬA THÔNG TIN THUỐC</a>
  </header>
  <div class="edit-patient-form">
    <h2 style="text-align: center;">CHỈNH SỬA THÔNG TIN</h2>
    <form method="post" class="form">
      <div class="f">
        <label for="name">Thuốc:</label>
        <input type="text" class="form-input" name="name" value="<?php echo $medicine_data['medicineName']; ?>" placeholder="Tên thuốc">
      </div>
      <div class="f">
        <label for="dosemin">doseMin:</label>
        <input type="text" class="form-input" name="dosemin" value="<?php echo $medicine_data['doseMin']; ?>" placeholder="liều dùng tối thiểu">
      </div>
      <div class="f">
        <label for="dosemax">doseMax:</label>
        <input type="text" class="form-input" name="dosemax" value="<?php echo $medicine_data['doseMax']; ?>" placeholder="liều dùng tối đa">
      </div>
      <div class="f">
        <label for="frequence">Tần suất:</label>
        <input type="text" class="form-input" name="frequence" value="<?php echo $medicine_data['Frequence']; ?>" placeholder="Tần suất">
      </div>
      <div class="f">
        <label for="unit">Đơn vị:</label>
        <input type="text" class="form-input" name="unit" value="<?php echo $medicine_data['Unit']; ?>" placeholder="Đơn vị">
      </div>
      <button type="submit" class="button-form">Cập nhật thông tin</button>
    </form>
  </div>
  <footer>
    Design by: Nguyễn Đình Hưng
  </footer>
</body>

</html>