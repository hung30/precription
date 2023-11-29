<?php
require_once '../connection/connect.php';
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//   if (isset($_POST['form_type'])) {
//     $formType = $_POST['form_type'];

//     if ($formType === 'form1') {
//       $check = false;
//       $name = $_POST['name'];
//       $gender = $_POST['gender'];
//       $phone = $_POST['phone'];

//       $sql = "INSERT INTO patient(patientName, gender, phone) VALUES ('$name', '$gender', '$phone')";
//       if ($conn->query($sql) === TRUE) {
//         mysqli_close($conn);
//         echo '<script>alert("Dữ liệu bệnh nhân đã được lưu thành công.");';
//         echo 'setTimeout(function() { window.location.href = "./new_patient.php"; }, 500);</script>';
//         exit();
//       } else {
//         echo "Lỗi: " . $patient_sql . "<br>" . $conn->error;
//       }
//     } elseif ($formType === 'form2') {
//       $check = true;
//       $searchName = $_POST['search'];
//     }
//   }
// }
?>
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
    <a href="../index.php">THÊM BỆNH NHÂN</a>
  </header>
  <nav>
    <div class="nav-left-content">
      <a href="../index.php">Trang chủ</a>
      <a href="./new_patient.php" style="background-color: gray;">Thêm bệnh nhân</a>
      <a href="../medicine/index.php">Thông tin thuốc</a>
      <a href="../prescription-detail/index.php">Thông tin kê đơn</a>
    </div>
    <div class="nav-right-content">
      <div>Xin chào</div>
      <img src="../img/expand_more.svg" alt="menu">
    </div>
  </nav>
  <div class="new-patient-form">
    <h2 style="text-align: center;">THÊM BỆNH NHÂN</h2>
    <form action="./process.php" method="post" class="form">
      <input type="hidden" name="form_type" value="form1">
      <div class="f">
        <label for="name">Họ tên:</label>
        <input type="text" class="form-input" name="name" " placeholder=" Tên">
      </div>
      <div class="f">
        <label for="gender">Giới tính:</label>
        <input type="text" class="form-input" name="gender" placeholder="Giới tính">
      </div>
      <div class="f">
        <label for="phone">SĐT:</label>
        <input type="text" class="form-input" name="phone" placeholder="Số điện thoại">
      </div>

      <button type="submit" class="button-form">Thêm</button>
    </form>
  </div>
  <hr>
  <div class="content">
    <h2>Danh sách bệnh nhân</h2>
    <div class="searchForm">
      <form method="post" class="searchForm">
        <input type="hidden" name="form_type" value="form2">
        <input type="text" class="searchBox-input" name="search" placeholder="Tìm kiếm theo tên">
        <button type="submit" class="searchBox-button">
          <img src="../img/search-icon.svg" alt="search-icon">
        </button>
      </form>
    </div>
    <table>
      <tr class="th">
        <th>Stt</th>
        <th>Tên bệnh nhân</th>
        <th>Giới tính</th>
        <th>Số điện thoại</th>
        <th>Hành động</th>
      </tr>
      <?php
      $check = false;
      if (isset($_POST['form_type'])) {
        $check = true;
        $searchName = $_POST['search'];
        if ($check) {
          $sql = "SELECT * from patient WHERE patientName like '%$searchName%'";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr class='td'>";
              echo "<td><strong>" . $row['patientId'] . "</strong></td>";
              echo "<td>" . $row['patientName'] . "</td>";
              echo "<td>" . $row['gender'] . "</td>";
              echo "<td>" . $row['phone'] . "</td>";
              echo "<td><a href='./edit_patient.php?patientId=" . $row['patientId'] . "' class='a_sua'>Sửa</a>  <a href='./delete_patient.php?patientId=" . $row['patientId'] . "' class='a_xoa'>Xóa</a></td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='5'>Không có dữ liệu bạn đã nhập</td></tr>";
          }
        }
      } else {
        $sql = "SELECT * FROM patient order by patientId";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr class='td'>";
            echo "<td><strong>" . $row['patientId'] . "</strong></td>";
            echo "<td>" . $row['patientName'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td><a href='./edit_patient.php?patientId=" . $row['patientId'] . "' class='a_sua'>Sửa</a>  <a href='./delete_patient.php?patientId=" . $row['patientId'] . "' class='a_xoa'>Xóa</a></td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='5'>Không có dữ liệu</td></tr>";
        }
        mysqli_close($conn);
      }
      ?>

    </table>
  </div>
  <footer>
    Design by: Nguyễn Đình Hưng
  </footer>
</body>

</html>