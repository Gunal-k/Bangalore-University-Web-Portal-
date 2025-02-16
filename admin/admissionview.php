<?php
session_start();
include '../login-register/database/db.php';

$query = "SELECT * FROM admissions";
$result = $conn1->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/admissionview.css">
    <title>Admin Dashboard</title>
</head>
<body>

    <h1>Manage Applications</h1>

    <?php if (isset($_SESSION['message'])): ?>
        <p class="message"><?= $_SESSION['message']; unset($_SESSION['message']); ?></p>
    <?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Course</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td><?= htmlspecialchars($row['phone']); ?></td>
                <td><?= htmlspecialchars($row['course']); ?></td>
                <td><?= $row['status']; ?></td>
                <td>
                    <form action="../login-register/admin_admission.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <select name="status">
                            <option value="Pending" <?php echo ($row['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                            <option value="Approved" <?php echo ($row['status'] == 'Approved') ? 'selected' : ''; ?>>Approved</option>
                            <option value="Rejected" <?php echo ($row['status'] == 'Rejected') ? 'selected' : ''; ?>>Rejected</option>
                        </select>
                        <button type="submit" name="update_status">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>

    </table>

</body>
</html>
