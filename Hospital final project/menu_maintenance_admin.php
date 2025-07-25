<?php
session_start();

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "hospital";

$conn = new mysqli($hostName, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET["maintenance_id"]) || empty($_GET["maintenance_id"])) {
    die("Doctor ID not found in request!");
}

$maintenance_id = $_GET["maintenance_id"];
$sql = "SELECT * FROM maintenance WHERE ID = $maintenance_id";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добре дошъл</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="menu_doctorstyle.css">
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

        /* Центриране на контейнера за съдържанието */
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
            color: black;
        }

        .home-button {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
        }

        .home-button a {
            background-color: #f44336;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 25px;
            transition: background-color 0.3s;
            font-size: 14px;
        }

        .home-button a:hover {
            background-color: #d32f2f;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"],
        input[type="tel"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: none;
            border-bottom: 1px solid #ccc;
            background-color: transparent;
            font-size: 16px;
            color: #fff;
        }

        input[type="text"]:focus,
        input[type="tel"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-bottom: 1px solid #f44336;
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
            background-color: #f44336;
        }

        .field {
            margin-bottom: 10px;
            color: #333;
        }

        .label {
            font-weight: bold;
            color: #000;
        }

        .edit-icon {
            color: #f44336;
            cursor: pointer;
            transition: color 0.3s;
        }

        .edit-icon:hover {
            color: #f44336;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php
   

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $maintenanceName = $row['Name'];

            echo "<h1>Добре дошъл, {$maintenanceName}!</h1>";
            echo "<h2>Данни за поддръжката:</h2>";
            echo "<div class='maintenance-info'>";
            echo "<form id='editForm' method='POST' action='edit_maintenance_all.php'>";
            foreach ($row as $field => $value) {
                if ($field != 'ID' && $field != 'Password') { // Пропускаме ID и Password
                    echo "<div class='field'><i class='fas fa-pencil-alt edit-icon' onclick='editField(\"$field\")'></i> <span class='label'>" . htmlspecialchars($field) . ":</span> " . htmlspecialchars($value) . "</div>";
                }
            }
            echo "<div class='field'><i class='fas fa-pencil-alt edit-icon' onclick='changePassword()'></i> <span class='label'>Парола:</span> <i>(Скрита)</i></div>"; // Поле за промяна на паролата
            echo "</div>";
        } else {
            echo "Данни за поддръжката не са намерени.";
        }

        $conn->close();
        ?>
    </div>

    <script>
        function editField(field) {
            var maintenanceId = <?php echo json_encode($maintenance_id); ?>;
            window.location.href = "edit_maintenance_admin.php?field=" + field + "&maintenance_id=" + maintenanceId;
        }

        function changePassword() {
            var maintenanceId = <?php echo json_encode($maintenance_id); ?>;
            window.location.href = "change_password_maintenance.php?maintenance_id=" + maintenanceId;
        }
    </script>

</body>

</html>
