<?php
require_once '../connection/connect.php';
function check($id)
{
  if ($id > 0) {
    return true;
  } else {
    return false;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kê đơn</title>
  <link rel="stylesheet" href="../style.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
  <script>
    function getValue() {
      var selectElement = document.getElementById("nameP");
      var selectedValue = selectElement.options[selectElement.selectedIndex].value;
      console.log("f:" + selectedValue);
      // Gửi giá trị đến  PHP bằng Ajax
      window.location.href = 'new_prescription_detail.php?prescriptionId=0&patientId=' + selectedValue;
    }
  </script>
  <header>
    <a href="../index.php">QUẢN TRỊ ĐƠN THUỐC</a>
  </header>
  <div class="content">
    <h2>Kê đơn</h2>
    <!-- <div class="new-patient-button">
      <a href="./prescription/new_prescription.php">Kê đơn</a>
    </div> -->
    <form action="../unitTest.php" method="post" class="form">
      <input type="hidden" name="prescription_detail" value="1">
      <div class="f">
        <label for="name">Bệnh nhân:</label>
        <?php
        $sql = 'SELECT pat.patientName AS patientName FROM prescription AS pre JOIN patient as pat ON pre.patientId = pat.patientId WHERE pre.prescriptionId =  ' . $_GET["prescriptionId"] . '';
        $result = $conn->query($sql);

        if ($result) {
          while ($row = $result->fetch_assoc()) {
            echo '<input type="text" class="form-input" name="name" value="' . $row['patientName'] . '" placeholder="Tên">';
          }
        } else {
          die('Error: ' . mysqli_error($conn));
        }
        ?>
      </div>
      <div class="f">
        <label for="prescriptionId">Đơn thuốc số:</label>
        <input type="text" class="form-input" name="prescriptionId" value="<?php echo $_GET['prescriptionId']; ?>">
      </div>
      <div class="f">
        <label>Chọn thuốc</label>
        <?php
        $sql = 'SELECT medicineId, medicineName FROM medicine';
        $result = $conn->query($sql);
        if ($result) {
          echo '<select class="form-input" name="medicine" >';
          echo '<option value="0">Chọn thuốc</option>';
          while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['medicineId'] . '">' . $row['medicineName'] . '</option>';
          }

          echo '</select>';
        } else {
          die('Error: ' . mysqli_error($conn));
        }
        ?>
      </div>
      <div class="f">
        <label for="dose_only">Liều dùng 1 lần</label>
        <input type="text" class="form-input" name="dose_only" placeholder="ví dụ: 2viên">
      </div>
      <div class="f">
        <label>Số lần dùng trong ngày</label>
        <select class="form-input" name="dose_day">
          <option value="2">2/buổi (sáng / tối)</option>
          <option value="3">3/buổi (sáng / trưa / tối)</option>
        </select>
      </div>
      <div class="f">
        <label for="frequency">Số ngày uống</label>
        <input type="text" class="form-input" name="frequency" placeholder="ví dụ:3 ngày">
      </div>
      <button type="submit" class="button-form">Lưu thông tin</button>
    </form>
  </div>
  <footer>
    Design by: Nguyễn Đình Hưng
  </footer>
</body>

</html>