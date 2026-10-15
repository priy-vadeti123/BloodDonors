
<?php
session_start();

if (empty($_SESSION["is_admin"])) {
    header("Location: login.php");
    exit;
}

require_once "../config/db.php";

$result = $conn->query(
    "SELECT id, full_name, age, gender, blood_group, phone, city, email
     FROM donors
     ORDER BY id DESC"
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Donors</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Manage Registered Donors</h1>

    <?php if ($result && $result->num_rows > 0): ?>
        <table border="1" cellpadding="8">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Blood Group</th>
                <th>Phone</th>
                <th>City</th>
                <th>Email</th>
            </tr>

            <?php while ($donor = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= (int)$donor["id"] ?></td>
                    <td><?= htmlspecialchars($donor["full_name"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= (int)$donor["age"] ?></td>
                    <td><?= htmlspecialchars($donor["gender"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars($donor["blood_group"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars($donor["phone"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars($donor["city"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars($donor["email"], ENT_QUOTES, "UTF-8") ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No donors registered yet.</p>
    <?php endif; ?>

    <p><a href="dashboard.php">Back to Admin Dashboard</a></p>
</body>
</html>
