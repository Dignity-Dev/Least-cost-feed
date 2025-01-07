<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'includes/db.php';

$user_id = $_SESSION['user_id'];
$message = "";

// Fetch user details
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_profile'])) {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);

        $update_query = "UPDATE users SET name = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('ssi', $name, $email, $user_id);

        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>Profile updated successfully.</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error updating profile. Please try again.</div>";
        }
    }

    // Handle password update
    if (isset($_POST['update_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Verify current password
        if (password_verify($current_password, $user['password'])) {
            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                $password_query = "UPDATE users SET password = ? WHERE id = ?";
                $stmt = $conn->prepare($password_query);
                $stmt->bind_param('si', $hashed_password, $user_id);

                if ($stmt->execute()) {
                    $message = "<div class='alert alert-success'>Password updated successfully.</div>";
                } else {
                    $message = "<div class='alert alert-danger'>Error updating password. Please try again.</div>";
                }
            } else {
                $message = "<div class='alert alert-danger'>New password and confirmation do not match.</div>";
            }
        } else {
            $message = "<div class='alert alert-danger'>Current password is incorrect.</div>";
        }
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2>Profile</h2>
        <?php echo $message; ?>
        <form action="" method="POST">
            <h4>Update Profile</h4>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
        </form>

        <hr>

        <form action="" method="POST">
            <h4>Update Password</h4>
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm New Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            </div>
            <button type="submit" name="update_password" class="btn btn-warning">Update Password</button>
        </form>
    </div>
</body>
</html>
