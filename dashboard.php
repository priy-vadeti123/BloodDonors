
<?php
session_start();

if (!isset($_SESSION["donor_id"])) {
    header("Location: login.php");
    exit;
}

$name = $_SESSION["donor_name"] ?? "Donor";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Dashboard</title>
    <link rel="stylesheet" href="/BloodDonors/assets/style.css">
</head>
<body>
    <h1>Blood Donors Management System</h1>

    <h2>Welcome, <?= htmlspecialchars($name, ENT_QUOTES, "UTF-8") ?>!</h2>

    <p>You are logged in successfully.</p>

    <h3>Dashboard Menu</h3>
    <ul>
        <li><a href="search_donors.php">Search Blood Donors</a></li>
        <li><a href="request_blood.php">Request Blood</a></li>
        <li><a href="my_requests.php">My Blood Requests</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>
