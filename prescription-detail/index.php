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
      <a href="../medicine/index.php">Thông tin thuốc</a>
      <a href="./index.php" style="background-color: gray;">Thông tin kê đơn</a>
    </div>
    <div class="nav-right-content">
      <div>Xin chào</div>
      <img src="../img/expand_more.svg" alt="menu">
    </div>
  </nav>
  <div class="content">
    <h2>Thông tin kê thuốc</h2>
    <table>
      <tr class="th">
        <th>Stt</th>
        <th>Bệnh nhân</th>
        <th>Bác sĩ kê đơn</th>
        <th>Tên thuốc</th>
        <th>Liều dùng một lần(viên)</th>
        <th>Số lần dùng trong ngày</th>
        <th>Số ngày uống</th>
      </tr>
      <?php
      require_once '../connection/connect.php';
      $sql = "SELECT del.id AS id, pat.patientName AS patientName, doc.doctorName AS doctorName, med.medicineName AS medicineName, del.doseOnly AS doseOnly, del.doseDay AS doseDay, del.frequency AS frequency FROM prescription_detail as del
      JOIN prescription AS pre ON del.prescriptionId = pre.prescriptionId
      JOIN patient AS pat ON pre.patientId = pat.patientId
      JOIN doctor AS doc ON pre.doctorId = doc.doctorId
      JOIN medicine AS med ON del.medicineId = med.medicineId";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr class='td'>";
          echo "<td><strong>" . $row['id'] . "</strong></td>";
          echo "<td>" . $row['patientName'] . "</td>";
          echo "<td>" . $row['doctorName'] . "</td>";
          echo "<td>" . $row['medicineName'] . "</td>";
          echo "<td>" . $row['doseOnly'] . "</td>";
          echo "<td>" . $row['doseDay'] . "</td>";
          echo "<td>" . $row['frequency'] . "</td>";
          echo "<td><a href='./delete_prescription_detail.php?id=" . $row['id'] . "' class='a_xoa'>Xóa</a></td>";
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