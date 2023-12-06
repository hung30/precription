document.addEventListener("DOMContentLoaded", function () {
  var nav_button = document.querySelector(".nav-right-content");
  nav_button.addEventListener("click", function () {
    // Lấy phần tử dropdown
    var dropdown = this.querySelector(".dropdown");

    // Kiểm tra xem dropdown có đang hiển thị hay không
    var isDropdownVisible =
      window.getComputedStyle(dropdown).display !== "none";

    // Thêm hoặc xóa class 'active' tùy thuộc vào trạng thái hiện tại của dropdown
    if (isDropdownVisible) {
      this.classList.remove("active");
    } else {
      this.classList.add("active");
    }
  });

  nav_button.addEventListener("blur", function () {
    // Kiểm tra xem dropdown đang hiển thị hay không
    var isDropdownVisible = this.classList.contains("active");

    // Nếu dropdown đang hiển thị, xóa class 'active'
    if (isDropdownVisible) {
      this.classList.remove("active");
    }
  });
});
