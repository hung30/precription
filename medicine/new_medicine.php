<?php
require_once '../connection/connect.php';
function checkDoseMinMax($doseMin, $doseMax)
{
  if ($doseMin > $doseMax) {
    echo '<script>alert("Liều dùng tối thiểu không thể lớn hơn liều dùng tối đa");</script>';
    echo '<script>window.history.back();</script>';
    return false;
  }
  return true;
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $name = $_POST['medicineName'];
  $min = $_POST['doseMin'];
  $max = $_POST['doseMax'];
  $frequency = $_POST['frequency'];
  $unit = $_POST['unit'];
  $checkIsValid = checkDoseMinMax($min, $max);
  if ($checkIsValid) {
    $sql = "INSERT INTO medicine(medicineName, doseMin, doseMax, Frequence, unit) VALUES ('$name', $min, $max, $frequency, $unit)";
    if ($conn->query($sql) === TRUE) {
      echo '<script>alert("Thông tin đơn thuốc đã được lưu thành công.");';
      echo 'setTimeout(function() { window.location.href = "./index.php"; }, 500);</script>';
      mysqli_close($conn);
      exit();
    } else {
      echo "Lỗi khi lưu: " . $conn->error;
    }
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
    <a href="../index.php">THÊM THUỐC</a>
  </header>
  <div class="edit-patient-form">
    <h2 style="text-align: center;">THÊM THUỐC</h2>
    <form method="post" class="form">
      <div class="f">
        <label for="medicineName">Tênthuốc:</label>
        <input type="text" class="form-input" name="medicineName" placeholder="Nhập tên thuốc">
      </div>
      <div class="f">
        <label for="doseMin">DoseMin:</label>
        <input type="text" class="form-input" name="doseMin" placeholder="ví dụ:14 viên">
      </div>
      <div class="f">
        <label for="doseMax">DoseMax:</label>
        <input type="text" class="form-input" name="doseMax" placeholder="ví dụ:20 viên">
      </div>
      <div class="f">
        <label for="frequency">Tần suất</label>
        <input type="text" class="form-input" name="frequency" placeholder="ví dụ:6 viên/ngày">
      </div>
      <div class="f">
        <label for="unit">Đơn vị:</label>
        <input type="text" class="form-input" name="unit" placeholder="nhập đơn vị">
      </div>
      <button type="submit" class="button-form">Lưu</button>
    </form>
  </div>
  <footer>
    Design by: Nguyễn Đình Hưng
  </footer>
</body>

</html>