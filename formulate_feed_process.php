<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $feed_name = $_POST['feed_name'];
    $ingredients = $_POST['ingredients'];
    $cost = $_POST['cost'];

    // Insert the feed data into the database
    $query = "INSERT INTO feed_recipes (user_id, feed_name, ingredients, cost) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('isss', $user_id, $feed_name, $ingredients, $cost);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Feed formulated successfully!";
        header('Location: feed_recipes.php');
    } else {
        $_SESSION['error_message'] = "Error formulating feed: " . $stmt->error;
        header('Location: formulate_feed.php');
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: formulate_feed.php');
    exit();
}
?>
