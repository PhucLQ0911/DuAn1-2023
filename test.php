<?php

// Kết nối đến cơ sở dữ liệu


// Hàm tạo mã voucher
function generateVoucherCode($length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $code;
}

// Hàm tạo mã voucher và lưu vào cơ sở dữ liệu
function createVoucher($discountAmount) {
    global $conn;

    $code = generateVoucherCode();
    $sql = "INSERT INTO vouchers (code, discount_amount) VALUES ('$code', $discountAmount)";
    $conn->query($sql);
}

// Hàm kiểm tra tính hợp lệ của mã voucher và đánh dấu đã sử dụng
function redeemVoucher($voucherCode) {
    global $conn;

    // Kiểm tra xem mã voucher có tồn tại và chưa sử dụng
    $sql = "SELECT * FROM vouchers WHERE code = '$voucherCode' AND is_used = FALSE";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Đánh dấu mã voucher đã sử dụng
        $sqlUpdate = "UPDATE vouchers SET is_used = TRUE WHERE code = '$voucherCode'";
        $conn->query($sqlUpdate);

        return true; // Mã voucher hợp lệ
    } else {
        return false; // Mã voucher không hợp lệ hoặc đã sử dụng
    }
}

// Sử dụng hàm để tạo và quản lý mã voucher
createVoucher(10); // Tạo mã voucher giảm giá 10%
$voucherCode = 'ABC123'; // Thay thế bằng mã voucher thực tế
if (redeemVoucher($voucherCode)) {
    echo "Mã voucher hợp lệ. Giảm giá đã được áp dụng!";
} else {
    echo "Mã voucher không hợp lệ hoặc đã được sử dụng.";
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();

?>
