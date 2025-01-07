<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the feed recipe from the database
    $query = "DELETE FROM feed_recipes WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $id, $_SESSION['user_id']);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Feed recipe deleted successfully!";
    } else {
        $_SESSION['error_message'] = "Error deleting feed recipe: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $_SESSION['error_message'] = "Invalid feed recipe ID.";
}

header('Location: feed_recipes.php');
exit();
?>
