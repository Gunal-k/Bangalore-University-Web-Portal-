<?php
session_start();

require_once "database/db.php";
require_once "database/cloudinary.php";

use Cloudinary\Api\Upload\UploadApi;

// 🔒 Optional: admin-only protection
// if ($_SESSION['role'] !== 'admin') {
//     exit('Unauthorized');
// }

function getCloudinaryPublicId($url) {
    $path = parse_url($url, PHP_URL_PATH);
    $path = preg_replace('#^/[^/]+/image/upload/[^/]+/#', '', $path);
    return pathinfo($path, PATHINFO_DIRNAME) . '/' . pathinfo($path, PATHINFO_FILENAME);
}

$user_id = $_POST['user_id'] ?? null;
if (!$user_id) {
    $_SESSION['message'] = "Invalid user";
    header("Location: ../admin/adminHome.php");
    exit();
}

try {
    $conn->begin_transaction();

    // 1️⃣ Get user's photo URL
    $stmt = $conn->prepare(
        "SELECT photo FROM users WHERE user_id = ?"
    );
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    // 2️⃣ Delete Cloudinary image (if not default)
    if (
        $user &&
        !empty($user['photo']) &&
        strpos($user['photo'], 'cloudinary.com') !== false
    ) {
        $public_id = getCloudinaryPublicId($user['photo']);
        (new UploadApi())->destroy($public_id);
    }

    // 3️⃣ Delete user (results auto-deleted by FK CASCADE)
    $stmt2 = $conn->prepare(
        "DELETE FROM users WHERE user_id = ?"
    );
    $stmt2->bind_param("i", $user_id);
    $stmt2->execute();

    $conn->commit();

    $_SESSION['message'] = "User deleted successfully";
    header("Location: ../admin/adminHome.php");
    exit();

} catch (Exception $e) {
    $conn->rollback();
    $_SESSION['message'] = "Delete failed";
    header("Location: ../admin/adminHome.php");
    exit();
}
?>