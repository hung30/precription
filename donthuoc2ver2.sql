-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 27, 2023 lúc 06:24 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `donthuoc2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doctor`
--

CREATE TABLE `doctor` (
  `doctorId` int(255) NOT NULL,
  `doctorName` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `doctor`
--

INSERT INTO `doctor` (`doctorId`, `doctorName`, `email`, `phone`) VALUES
(1, 'Lê Phú Khoa', 'khoa@gmail.com', '0135666451'),
(2, 'Nguyễn Đình Thiên Quý', 'quy@gmail.com', '012346789'),
(4, 'Trần Minh Thiện', 'thien@gmail.com', '0500500055');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `medicine`
--

CREATE TABLE `medicine` (
  `medicineId` int(255) NOT NULL,
  `medicineName` varchar(30) NOT NULL,
  `doseMin` int(255) NOT NULL,
  `doseMax` int(255) NOT NULL,
  `Frequence` int(255) NOT NULL,
  `Unit` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `medicine`
--

INSERT INTO `medicine` (`medicineId`, `medicineName`, `doseMin`, `doseMax`, `Frequence`, `Unit`) VALUES
(1, 'paracetamol', 7, 15, 4, 10),
(3, 'thuốc ho', 12, 30, 6, 100);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `patient`
--

CREATE TABLE `patient` (
  `patientId` int(255) NOT NULL,
  `patientName` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gender` char(3) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `patient`
--

INSERT INTO `patient` (`patientId`, `patientName`, `gender`, `phone`) VALUES
(1, 'Nguyễn Đình Hưng', 'Nam', '0364561315'),
(2, 'Nguyễn Văn Lâm vlog', 'Nữ', '0123456789'),
(3, 'Nguyễn Chánh Hoàng', 'Gay', '0130139111'),
(4, 'Nguyễn Quốc Huy', 'Nữ', '0364561314'),
(5, 'Nguyễn Đức Vinh', 'Gay', '0791341141');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `prescription`
--

CREATE TABLE `prescription` (
  `prescriptionId` int(255) NOT NULL,
  `doctorId` int(200) NOT NULL,
  `patientId` int(255) NOT NULL,
  `dayStart` datetime NOT NULL,
  `dayEnd` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `prescription`
--

INSERT INTO `prescription` (`prescriptionId`, `doctorId`, `patientId`, `dayStart`, `dayEnd`) VALUES
(1, 2, 1, '2023-11-23 09:45:00', '2023-12-01 09:45:00'),
(2, 1, 2, '2023-11-22 09:45:00', '2023-11-24 09:45:00'),
(3, 1, 1, '2023-11-27 16:35:00', '2024-02-23 16:35:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `prescription_detail`
--

CREATE TABLE `prescription_detail` (
  `id` int(255) NOT NULL,
  `prescriptionId` int(255) NOT NULL,
  `medicineId` int(255) NOT NULL,
  `frequency` int(255) NOT NULL,
  `doseOnly` int(255) NOT NULL,
  `doseDay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `prescription_detail`
--

INSERT INTO `prescription_detail` (`id`, `prescriptionId`, `medicineId`, `frequency`, `doseOnly`, `doseDay`) VALUES
(1, 2, 1, 3, 2, 3);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorId`);

--
-- Chỉ mục cho bảng `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicineId`);

--
-- Chỉ mục cho bảng `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientId`);

--
-- Chỉ mục cho bảng `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescriptionId`),
  ADD KEY `FK_prescription_doctor` (`doctorId`),
  ADD KEY `FK_prescription_patein` (`patientId`);

--
-- Chỉ mục cho bảng `prescription_detail`
--
ALTER TABLE `prescription_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_prescription_detail` (`prescriptionId`),
  ADD KEY `FK_detail_medicine` (`medicineId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicineId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `patient`
--
ALTER TABLE `patient`
  MODIFY `patientId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescriptionId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `prescription_detail`
--
ALTER TABLE `prescription_detail`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `FK_prescription_doctor` FOREIGN KEY (`doctorId`) REFERENCES `doctor` (`doctorId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_prescription_patein` FOREIGN KEY (`patientId`) REFERENCES `patient` (`patientId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `prescription_detail`
--
ALTER TABLE `prescription_detail`
  ADD CONSTRAINT `FK_detail_medicine` FOREIGN KEY (`medicineId`) REFERENCES `medicine` (`medicineId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_prescription_detail` FOREIGN KEY (`prescriptionId`) REFERENCES `prescription` (`prescriptionId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
