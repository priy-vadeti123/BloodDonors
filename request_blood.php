
<?php
session_start();
require_once "config/db.php";

if (!isset($_SESSION["donor_id"])) {
    header("Location: login.php");
    exit;
}

$message = "";
$groups = ["A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $patient = trim($_POST["patient_name"] ?? "");
    $group = $_POST["blood_group"] ?? "";
    $units = (int)($_POST["units"] ?? 0);
    $hospital = trim($_POST["hospital"] ?? "");
    $city = trim($_POST["city"] ?? "");
    $phone = trim($_POST["contact_phone"] ?? "");
    $urgency = $_POST["urgency"] ?? "Normal";

    if (
        $patient === "" || $hospital === "" || $city === "" ||
        $phone === "" || !in_array($group, $groups, true) ||
        $units < 1 || $units > 10 ||
        !in_array($urgency, ["Normal", "Urgent"], true)
    ) {
        $message = "Please enter valid details in all fields.";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO blood_requests
            (donor_id, patient_name, blood_group, units, hospital,
             city, contact_phone, urgency)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "ississss",
            $_SESSION["donor_id"], $patient, $group, $units,
            $hospital, $city, $phone, $urgency
        );

        if ($stmt->execute()) {
            $message = "Blood request submitted successfully!";
        } else {
            $message = "Unable to submit the request. Please try again.";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Blood</title>
    <link rel="stylesheet" href="/BloodDonors/assets/style.css">
</head>
<body>
    <h1>Blood Request Form</h1>

    <p><?= htmlspecialchars($message, ENT_QUOTES, "UTF-8") ?></p>

    <form method="POST">
        <label>Patient Name</label><br>
        <input type="text" name="patient_name" required><br><br>

        <label>Blood Group Required</label><br>
        <select name="blood_group" required>
            <option value="">Select blood group</option>
            <?php foreach ($groups as $group): ?>
                <option value="<?= htmlspecialchars($group) ?>">
                    <?= htmlspecialchars($group) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Units Required (1–10)</label><br>
        <input type="number" name="units" min="1" max="10" value="1" required><br><br>

        <label>Hospital Name</label><br>
        <input type="text" name="hospital" required><br><br>

        <label>City</label><br>
        <input type="text" name="city" required><br><br>

        <label>Contact Phone</label><br>
        <input type="tel" name="contact_phone" required><br><br>

        <label>Urgency</label><br>
        <select name="urgency" required>
            <option value="Normal">Normal</option>
            <option value="Urgent">Urgent</option>
        </select><br><br>

        <button type="submit">Submit Blood Request</button>
    </form>

    <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
