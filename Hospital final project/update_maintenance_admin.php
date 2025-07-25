<?php
session_start();

if (!isset($_POST['maintenance_id']) || !isset($_POST['field']) || !isset($_POST['field_value'])) {
    die("Невалидна заявка");
}

$maintenance_id = $_POST['maintenance_id'];
$field = $_POST['field'];
$field_value = $_POST['field_value'];

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "hospital";

$conn = new mysqli($hostName, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Защита от SQL инжекции
$field = $conn->real_escape_string($field);

$sql = "UPDATE maintenance SET $field = ? WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('si', $field_value, $maintenance_id);

if ($stmt->execute()) {
    $success_message = "Данните бяха успешно обновени.";
} else {
    $error_message = "Грешка при обновяване на записа: " . $conn->error;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обновяване на данни</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="menu_nursestyle.css">
    <link rel="icon" href="logo.jpg">
    <style>
        /* Основни стилове за body */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-image: linear-gradient(rgba(4, 9, 30, 0.7), rgba(4, 9, 30, 0.7)), url(images/doctors.jpg);
            background-position: center;
            background-size: cover;
            position: relative;
            overflow-x: hidden;
            overflow-y: scroll;
            height: 100vh;
            color: #fff;
        }

        /* Центриране на контейнера за формата */
        .container {
            width: 80%;
            max-width: 400px;
            margin: 20vh auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #333;
        }

        h1 {
            text-align: center;
            font-size: 36px;
            font-weight: 600;
            margin-bottom: 30px;
        }

        form {
            margin-top: 20px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 15px;
            background-color: #f44336;
            color: #fff;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 18px;
        }

        input[type="submit"]:hover {
            background-color: #e53935;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
        }

        .message.success {
            color: #4CAF50;
        }

        .message.error {
            color: #f44336;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
            color: #fff;
            font-size: 14px;
        }

        .back-link a {
            color: #f44336;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Обновяване на данни</h1>
        <?php if (isset($success_message)): ?>
            <div class="message success"><?php echo $success_message; ?></div>
        <?php elseif (isset($error_message)): ?>
            <div class="message error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <div class="back-link"><a href="menu_maintenance_admin.php">Върни се назад</a></div>
    </div>
</body>

</html>


