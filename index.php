<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kê đơn thuốc</title>
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <header>
    <a href="./index.php">QUẢN TRỊ ĐƠN THUỐC</a>
  </header>
  <nav>
    <div class="nav-left-content">
      <a href="./index.php" style="background-color: gray;">Trang chủ</a>
      <a href="./patient/new_patient.php">Thêm bệnh nhân</a>
      <a href="./medicine/index.php">Thông tin thuốc</a>
      <a href="./prescription-detail/index.php">Thông tin kê đơn</a>
    </div>
    <div class="nav-right-content">
      <div>Xin chào</div>
      <img src="./img/expand_more.svg" alt="menu">
    </div>
  </nav>
  <div class="content">
    <h2>Danh sách đơn thuốc</h2>
    <div class="new-patient-button">
      <a href="./prescription/new_prescription.php">Thêm đơn thuốc</a>
    </div>
    <table>
      <tr class="th">
        <th>Stt</th>
        <th>Tên bệnh nhân</th>
        <th>Giới tính</th>
        <th>Số điện thoại</th>
        <th>Bác sĩ phụ trách</th>
        <th>Ngày bắt đầu</th>
        <th>Ngày kết thúc</th>
        <th>Hành động</th>
      </tr>
      <?php
      require_once './connection/connect.php';
      $sql = "SELECT pre.prescriptionId, pat.patientName, pat.gender, pat.phone, doc.doctorName, pre.dayStart, pre.dayEnd  FROM prescription as pre
        join patient as pat on pre.patientId = pat.patientId
        join doctor as doc on pre.doctorId = doc.doctorId
        order by pre.prescriptionId";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr class='td'>";
          echo "<td><strong>" . $row['prescriptionId'] . "</strong></td>";
          echo "<td>" . $row['patientName'] . "</td>";
          echo "<td>" . $row['gender'] . "</td>";
          echo "<td>" . $row['phone'] . "</td>";
          echo "<td>" . $row['doctorName'] . "</td>";
          echo "<td>" . strstr($row['dayStart'], ' ', true) . "</td>";
          echo "<td>" . strstr($row['dayEnd'], ' ', true) . "</td>";
          echo "<td><a href='./prescription-detail/new_prescription_detail.php?prescriptionId=" . $row['prescriptionId'] . "' class='a_kedon'>Kê đơn</a> <a href='./prescription/edit_prescription.php?prescriptionId=" . $row['prescriptionId'] . "' class='a_sua'>Sửa</a> <a href='./prescription/delete_prescription.php?prescriptionId=" . $row['prescriptionId'] . "' class='a_xoa'>Xóa</a></td>";
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