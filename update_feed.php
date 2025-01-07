<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $feed_name = $_POST['feed_name'];
    $ingredients = $_POST['ingredients'];
    $cost = $_POST['cost'];

    // Update the feed recipe in the database
    $query = "UPDATE feed_recipes SET feed_name = ?, ingredients = ?, cost = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssdii', $feed_name, $ingredients, $cost, $id, $_SESSION['user_id']);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Feed recipe updated successfully!";
    } else {
        $_SESSION['error_message'] = "Error updating feed recipe: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header('Location: feed_recipes.php');
    exit();
} else {
    header('Location: feed_recipes.php');
    exit();
}
?>
