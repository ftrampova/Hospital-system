<?php
session_start();


if (!isset($_GET['maintenance_id'])) {
    die("Невалидна заявка!");
}

$maintenance_id = $_GET['maintenance_id'];
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Смяна на парола</title>
</head>
<body>
    <h1>Смяна на парола</h1>
    <form method="POST" action="update_password_maintenance.php">
        <input type="hidden" name="maintenance_id" value="<?php echo htmlspecialchars($maintenance_id); ?>">
        <label for="new_password">Нова парола:</label>
        <input type="password" id="new_password" name="new_password" required>
        <button type="submit">Смени</button>
    </form>
</body>
</html>
