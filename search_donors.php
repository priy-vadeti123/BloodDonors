
<?php
session_start();
require_once "config/db.php";

if (!isset($_SESSION["donor_id"])) {
    header("Location: login.php");
    exit;
}

$blood_group = $_GET["blood_group"] ?? "";
$city = trim($_GET["city"] ?? "");
$donors = [];

$allowed_groups = [
    "A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"
];

if ($blood_group !== "" && !in_array($blood_group, $allowed_groups, true)) {
    $blood_group = "";
}

if ($blood_group !== "" || $city !== "") {
    $group_search = "%" . $blood_group . "%";
    $city_search = "%" . $city . "%";

    $stmt = $conn->prepare(
        "SELECT full_name, age, gender, blood_group, city
         FROM donors
         WHERE blood_group LIKE ? AND city LIKE ? AND id != ?
         ORDER BY full_name"
    );

    $stmt->bind_param(
        "ssi",
        $group_search,
        $city_search,
        $_SESSION["donor_id"]
    );

    $stmt->execute();
    $stmt->bind_result($name, $age, $gender, $group, $donor_city);

    while ($stmt->fetch()) {
        $donors[] = [
            "name" => $name,
            "age" => $age,
            "gender" => $gender,
            "group" => $group,
            "city" => $donor_city
        ];
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Blood Donors</title>
    <link rel="stylesheet" href="/BloodDonors/assets/style.css">
</head>
<body>
    <h1>Search Blood Donors</h1>

    <form method="GET">
        <label>Blood Group</label><br>
        <select name="blood_group">
            <option value="">All groups</option>
            <?php foreach ($allowed_groups as $group): ?>
                <option value="<?= htmlspecialchars($group) ?>"
                    <?= $blood_group === $group ? "selected" : "" ?>>
                    <?= htmlspecialchars($group) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>City</label><br>
        <input type="text" name="city"
               value="<?= htmlspecialchars($city, ENT_QUOTES, "UTF-8") ?>"><br><br>

        <button type="submit">Search</button>
    </form>

    <h2>Search Results</h2>

    <?php if ($blood_group === "" && $city === ""): ?>
        <p>Select a blood group or enter a city to search.</p>
    <?php elseif (count($donors) === 0): ?>
        <p>No matching donors found.</p>
    <?php else: ?>
        <table border="1" cellpadding="8">
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Blood Group</th>
                <th>City</th>
            </tr>
            <?php foreach ($donors as $donor): ?>
                <tr>
                    <td><?= htmlspecialchars($donor["name"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= (int)$donor["age"] ?></td>
                    <td><?= htmlspecialchars($donor["gender"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars($donor["group"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars($donor["city"], ENT_QUOTES, "UTF-8") ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
