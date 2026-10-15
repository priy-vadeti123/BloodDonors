
<?php
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if (
        $username === "admin" &&
        $password === "Admin@123"
    ) {
        session_regenerate_id(true);
        $_SESSION["is_admin"] = true;

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid admin username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Admin Login</h1>

    <p><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></p>

    <form method="POST">
        <label>Username</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Admin Login</button>
    </form>

    <p><a href="../index.php">Back to Home</a></p>
</body>
</html>
