<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kê đơn thuốc</title>
  <link rel="stylesheet" href="../style.css">
</head>

<body>
  <header>
    <a href="../index.php">QUẢN TRỊ ĐƠN THUỐC</a>
  </header>
  <nav>
    <div class="nav-left-content">
      <a href="../index.php">Trang chủ</a>
      <a href="../patient/new_patient.php">Thêm bệnh nhân</a>
      <a href="./index.php" style="background-color: gray;">Thông tin thuốc</a>
      <a href="../prescription-detail/index.php">Thông tin kê đơn</a>
    </div>
    <div class="nav-right-content">
      <div>Xin chào</div>
      <img src="../img/expand_more.svg" alt="menu">
    </div>
  </nav>
  <div class="content">
    <h2>Thông tin thuốc</h2>
    <div class="new-patient-button">
      <a href="./new_medicine.php">Thêm thuốc</a>
    </div>
    <table>
      <tr class="th">
        <th>Stt</th>
        <th>Tên thuốc</th>
        <th>Liều lượng tối thiểu(viên)</th>
        <th>Liều lượng tối đa(viên)</th>
        <th>Tần suất sử dụng(v/ngày)</th>
        <th>Đơn vị(mg)</th>
        <th>Hành động</th>
      </tr>
      <?php
      require_once '../connection/connect.php';
      $sql = "SELECT * from medicine
        order by medicineId";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr class='td'>";
          echo "<td><strong>" . $row['medicineId'] . "</strong></td>";
          echo "<td>" . $row['medicineName'] . "</td>";
          echo "<td>" . $row['doseMin'] . "</td>";
          echo "<td>" . $row['doseMax'] . "</td>";
          echo "<td>" . $row['Frequence'] . "</td>";
          echo "<td>" . $row['Unit'] . "</td>";
          echo "<td><a href='./edit_medicine.php?medicineId=" . $row['medicineId'] . "' class='a_sua'>Sửa</a>  <a href='./delete_medicine.php?medicineId=" . $row['medicineId'] . "' class='a_xoa'>Xóa</a></td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='5'>Không có dữ liệu</td></tr>";
      }
      mysqli_close($conn);
      ?>
    </table>
  </div>
  <footer>
    Design by: Nguyễn Đình Hưng
  </footer>
</body>

</html>