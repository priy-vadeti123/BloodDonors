
<?php
session_start();
require_once "config/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    $stmt = $conn->prepare(
        "SELECT id, full_name, password FROM donors WHERE email = ?"
    );
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $full_name, $password_hash);

    if ($stmt->fetch() && password_verify($password, $password_hash)) {
        session_regenerate_id(true);
        $_SESSION["donor_id"] = $id;
        $_SESSION["donor_name"] = $full_name;

        header("Location: dashboard.php");
        exit;
    } else {
        $message = "Invalid email or password.";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Login</title>
      <link rel="stylesheet" href="/BloodDonors/assets/style.css">
</head>
<body>
    <h1>Donor Login</h1>

    <p><?= htmlspecialchars($message, ENT_QUOTES, "UTF-8") ?></p>

    <form method="POST">
        <label>Email</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

    <p>New donor? <a href="register.php">Register here</a></p>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
