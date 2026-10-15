
<?php
require_once "config/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST["full_name"] ?? "");
    $age = (int)($_POST["age"] ?? 0);
    $gender = $_POST["gender"] ?? "";
    $blood_group = $_POST["blood_group"] ?? "";
    $phone = trim($_POST["phone"] ?? "");
    $city = trim($_POST["city"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    $allowed_groups = [
        "A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"
    ];

    if (
        $full_name === "" || $age < 18 || $age > 65 ||
        !in_array($gender, ["Male", "Female", "Other"], true) ||
        !in_array($blood_group, $allowed_groups, true) ||
        $phone === "" || $city === "" ||
        !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        strlen($password) < 8
    ) {
        $message = "Please check your details. Donors must be 18–65, and passwords need at least 8 characters.";
    } else {
        $check = $conn->prepare("SELECT id FROM donors WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $message = "This email is already registered.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare(
                "INSERT INTO donors
                (full_name, age, gender, blood_group, phone, city, email, password)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
            );

            $stmt->bind_param(
                "sissssss",
                $full_name, $age, $gender, $blood_group,
                $phone, $city, $email, $hash
            );

            if ($stmt->execute()) {
                $message = "Registration successful! You can now log in.";
            } else {
                $message = "Registration failed. Please try again.";
            }

            $stmt->close();
        }

        $check->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Registration</title>
     <link rel="stylesheet" href="/BloodDonors/assets/style.css">
</head>
<body>
    <h1>Blood Donor Registration</h1>

    <p><?= htmlspecialchars($message, ENT_QUOTES, "UTF-8") ?></p>

    <form method="POST">
        <label>Full Name</label><br>
        <input type="text" name="full_name" required><br><br>

        <label>Age (18–65)</label><br>
        <input type="number" name="age" min="18" max="65" required><br><br>

        <label>Gender</label><br>
        <select name="gender" required>
            <option value="">Select gender</option>
            <option>Male</option>
            <option>Female</option>
            <option>Other</option>
        </select><br><br>

        <label>Blood Group</label><br>
        <select name="blood_group" required>
            <option value="">Select blood group</option>
            <option>A+</option>
            <option>A-</option>
            <option>B+</option>
            <option>B-</option>
            <option>AB+</option>
            <option>AB-</option>
            <option>O+</option>
            <option>O-</option>
        </select><br><br>

        <label>Phone</label><br>
        <input type="tel" name="phone" required><br><br>

        <label>City</label><br>
        <input type="text" name="city" required><br><br>

        <label>Email</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password (at least 8 characters)</label><br>
        <input type="password" name="password" minlength="8" required><br><br>

        <button type="submit">Register</button>
    </form>

    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
