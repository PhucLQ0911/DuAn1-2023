// Bước 1: Cập nhật trạng thái tài khoản trong cơ sở dữ liệu (ví dụ cho MySQLi)
$userIdToLock = 123; // Điều chỉnh với ID của người dùng cần khóa
$newStatus = 'locked';

$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "your_dbname";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE users SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $newStatus, $userIdToLock);
$stmt->execute();

$stmt->close();
$conn->close();

// Bước 2: Kiểm tra trạng thái tài khoản trước khi xử lý yêu cầu
session_start();

// Kiểm tra trạng thái tài khoản từ cơ sở dữ liệu hoặc bất kỳ nguồn dữ liệu nào khác
$userStatus = getStatusFromDatabase($_SESSION['user_id']); // Điều chỉnh hàm này dựa trên cách bạn lấy trạng thái

if ($userStatus === 'locked') {
    // Nếu trạng thái là 'locked', hủy bỏ phiên đăng nhập và chuyển hướng đến trang đăng nhập
    session_destroy();
    header("Location: login.php");
    exit();
}

// Tiếp tục xử lý yêu cầu nếu tài khoản không bị khóa
// ...

function getStatusFromDatabase($userId) {
    // Hàm này cần được điều chỉnh để trả về trạng thái từ cơ sở dữ liệu hoặc bất kỳ nguồn dữ liệu nào khác
    // Ví dụ, nếu bạn có một bảng tên 'users' và có cột 'status', thì sử dụng một câu truy vấn SELECT
    // để lấy trạng thái dựa trên $userId.
    // Đây chỉ là một ví dụ đơn giản và nên được thay thế bằng phương thức xử lý thực tế.
    return 'active';
}
