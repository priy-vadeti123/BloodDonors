
<?php
session_start();
require_once "config/db.php";

if (!isset($_SESSION["donor_id"])) {
    header("Location: login.php");
    exit;
}

$requests = [];

$stmt = $conn->prepare(
    "SELECT patient_name, blood_group, units, hospital,
            city, urgency, status, created_at
     FROM blood_requests
     WHERE donor_id = ?
     ORDER BY created_at DESC"
);

$stmt->bind_param("i", $_SESSION["donor_id"]);
$stmt->execute();

$stmt->bind_result(
    $patient, $group, $units, $hospital,
    $city, $urgency, $status, $created
);

while ($stmt->fetch()) {
    $requests[] = [
        "patient" => $patient,
        "group" => $group,
        "units" => $units,
        "hospital" => $hospital,
        "city" => $city,
        "urgency" => $urgency,
        "status" => $status,
        "created" => $created
    ];
}

$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blood Requests</title>
    <link rel="stylesheet" href="/BloodDonors/assets/style.css">
</head>
<body>
    <h1>My Blood Requests</h1>

    <?php if (count($requests) === 0): ?>
        <p>You have not submitted any blood requests yet.</p>
    <?php else: ?>
        <table border="1" cellpadding="8">
            <tr>
                <th>Patient</th>
                <th>Blood Group</th>
                <th>Units</th>
                <th>Hospital</th>
                <th>City</th>
                <th>Urgency</th>
                <th>Status</th>
                <th>Date</th>
            </tr>

            <?php foreach ($requests as $request): ?>
                <tr>
                    <td><?= htmlspecialchars($request["patient"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars($request["group"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= (int)$request["units"] ?></td>
                    <td><?= htmlspecialchars($request["hospital"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars($request["city"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars($request["urgency"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars($request["status"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars($request["created"], ENT_QUOTES, "UTF-8") ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <p><a href="request_blood.php">Submit Another Request</a></p>
    <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
