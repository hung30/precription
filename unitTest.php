<?php
require_once './connection/connect.php';
function checkDose($conn, $medicine, $dose_only, $dose_day, $day)
{
  $sql_medicine = "SELECT * FROM medicine where medicineId = $medicine";
  $result = $conn->query($sql_medicine);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $doseMin = $row['doseMin'];
      $doseMax = $row['doseMax'];
      $frequency = $row['Frequence'];
      $dose_day_check = $dose_only * $dose_day;
      $dose_all_check = $dose_day_check * $day;
      $dose_one_day = ($dose_day_check <= $frequency);
      $dose_all = ($doseMin < $dose_all_check && $doseMax > $dose_all_check);
      if (!$dose_one_day) {
        echo '<script>alert("Bạn nhập liều dùng  trong 1 ngày: ' . $dose_all_check . 'viên là không hợp lý vì liều dùng tối đa trong một ngày là ' . $frequency . 'viên");</script>';
        echo '<script>window.history.back();</script>';
        return false;
      } else if (!$dose_all) {
        echo '<script>alert("Tổng liều dùng của bạn không hợp lý");</script>';
        echo '<script>window.history.back();</script>';
        return false;
      }
    }
    return true;
  } else {
    echo "Không tìm thấy medicine với ID = $medicine";
    return false;
  }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['prescription_detail'])) {
    $prescription_id = $_POST['prescriptionId'];
    $medicine = $_POST['medicine'];
    $dose_only = $_POST['dose_only'];
    $dose_day = $_POST['dose_day'];
    $day = $_POST['frequency'];

    $dosageIsValid = checkDose($conn, $medicine, $dose_only, $dose_day, $day);

    if ($dosageIsValid) {
      $sql = "INSERT INTO prescription_detail (prescriptionId, medicineId, doseOnly, doseDay, frequency) VALUES ('$prescription_id', '$medicine', '$dose_only', '$dose_day, '$day')";
      $result = mysqli_query($conn, $sql);

      if ($result) {
        mysqli_close($conn);
        echo '<script>alert("Dữ liệu thuốc đã được lưu thành công.");</script>';
        echo '<script>window.history.back();</script>';
        exit();
      } else {
        echo '<script>alert("Có lỗi xảy ra khi lưu dữ liệu thuốc.");</script>';
      }
    }
  }
}
