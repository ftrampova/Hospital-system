<?php
session_start();


if (!isset($_POST['maintenance_id']) || !isset($_POST['new_password'])) {
    die("Невалидна заявка!");
}

$maintenance_id = $_POST['maintenance_id'];
$new_password = $_POST['new_password'];

// Хеширане на паролата
$new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "hospital";

$conn = new mysqli($hostName, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE maintenance SET Password = ? WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('si', $new_password_hash, $maintenance_id);

if ($stmt->execute()) {
    echo "Паролата беше успешно обновена.";
} else {
    echo "Error updating password: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
<a href="menu_maintenance_admin.php">Върни се назад</a>
