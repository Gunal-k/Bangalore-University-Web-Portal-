<?php
session_start();

require_once "database/db.php";
require_once "database/cloudinary.php";

// 🔒 Optional: admin-only protection
// if ($_SESSION['role'] !== 'admin') {
//     exit('Unauthorized');
// }

function deleteFromCloudinary($publicId) {
    $cloudName = getenv("CLOUDINARY_CLOUD_NAME");
    $apiKey    = getenv("CLOUDINARY_API_KEY");
    $apiSecret = getenv("CLOUDINARY_API_SECRET");

    $timestamp = time();
    $signature = sha1("public_id={$publicId}&timestamp={$timestamp}{$apiSecret}");

    $post = [
        'public_id' => $publicId,
        'api_key' => $apiKey,
        'timestamp' => $timestamp,
        'signature' => $signature
    ];

    $ch = curl_init("https://api.cloudinary.com/v1_1/{$cloudName}/image/destroy");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

    curl_exec($ch);
    curl_close($ch);
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