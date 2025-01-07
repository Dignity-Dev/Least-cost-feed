<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'includes/db.php';

// Fetch feed recipes
$query = "SELECT * FROM feed_recipes WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="feed_recipes_report.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, ['Feed Name', 'Ingredients', 'Cost (₦)']);

while ($row = $result->fetch_assoc()) {
    fputcsv($output, [$row['feed_name'], $row['ingredients'], $row['cost']]);
}

fclose($output);
$stmt->close();
$conn->close();
exit();
?>
