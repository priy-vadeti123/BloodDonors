
<?php
session_start();

if (empty($_SESSION["is_admin"])) {
    header("Location: login.php");
    exit;
}

require_once "../config/db.php";

$donor_count = 0;
$request_count = 0;

$result = $conn->query("SELECT COUNT(*) AS total FROM donors");
if ($result) {
    $donor_count = (int)$result->fetch_assoc()["total"];
}

$result = $conn->query("SELECT COUNT(*) AS total FROM blood_requests");
if ($result) {
    $request_count = (int)$result->fetch_assoc()["total"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Blood Donors Management System</h1>
    <h2>Admin Dashboard</h2>

    <h3>System Statistics</h3>
    <p>Total Registered Donors: <?= $donor_count ?></p>
    <p>Total Blood Requests: <?= $request_count ?></p>

    <h3>Admin Menu</h3>
    <ul>
        <li><a href="donors.php">Manage Donors</a></li>
        <li><a href="../index.php">Visit Home Page</a></li>
        <li><a href="logout.php">Admin Logout</a></li>
    </ul>
</body>
</html>
