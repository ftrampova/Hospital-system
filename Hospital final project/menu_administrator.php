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

if (!isset($_SESSION["administrators_id"]) || empty($_SESSION["administrators_id"])) {
    die("ID на администратора не е намерено в сесията или е празно!");
}

$administrator_id = $_SESSION["administrators_id"];
$sql = "SELECT * FROM administrators WHERE ID = $administrator_id";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}

if (isset($_POST['logout'])) {
    // Унищожаваме сесията
    session_destroy();
    // Препращаме към index_administrator.php
    header("Location: index_administrator.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добре дошъл</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="menu_doctorstyle.css"> <!-- Използваме стиловете за доктори -->
    <link rel="icon" href="logo.jpg">
    <style>
        /* Основни стилове за body */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-image: linear-gradient(rgba(4, 9, 30, 0.7), rgba(4, 9, 30, 0.7)), url(images/doctors.jpg); /* Променена фонова снимка */
            background-position: center;
            background-size: cover;
            position: relative;
            overflow-x: hidden;
            overflow-y: scroll;
            height: 100vh;
            color: #fff; /* Цвят на текста */
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
            color: #333; /* Цвят на текста */
            position: relative; /* Добавяме position: relative за позициониране на абсолютния елемент */
            text-align: center; /* Центриране на съдържанието във container */
        }

        h1 {
            text-align: center;
            font-size: 36px;
            font-weight: 600;
            margin-bottom: 30px;
            position: relative; /* Задаваме position: relative за позициониране на абсолютния елемент */
        }

        .home-button {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
        }

        .home-button a {
            text-decoration: none;
            color: #fff;
            display: inline-block;
            background-color: #f44336;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        .home-button a:hover {
            background-color: #d32f2f; /* Тъмнорозов цвят при hover */
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
            color: #fff; /* Цвят на текста */
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
            background-color: #d32f2f; /* Тъмнорозов цвят при hover */
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #fff;
            font-size: 14px;
        }

        .login-link a {
            color: #f44336;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .doctor-info {
            margin-top: 20px;
        }

        .field {
            margin-bottom: 10px;
            color: #333; /* Цвят на текста */
        }

        .label {
            font-weight: bold;
            color: #000; /* Цвят на текста */
        }

        .edit-icon {
            color: #f44336; /* Оранжев цвят на молива */
            cursor: pointer;
            transition: color 0.3s;
        }

        .edit-icon:hover {
            color: #d32f2f; /* Тъмнорозов цвят на молива при hover */
        }

        .logout-icon {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000; /* Уверете се, че иконата за изход е преди контента */
    }

    .logout-icon a img {
        width: 70px; /* Размер на изображението */
        height: auto; /* Автоматично съотношение на ширината и височината */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Сянка */
    }

    </style>
</head>

<body>

    <div class="container">

        <?php
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $administratorName = $row['Name'];

            echo "<h1>Добре дошъл, {$administratorName}!</h1>";
            echo "<h2>Данни за администратора:</h2>";
            echo "<div class='patient-info'>";
            echo "<form id='logoutForm' method='POST' action='index_administrator.php'>";
            echo "<div class='field'><i class='fas fa-pencil-alt edit-icon' onclick='editField(\"Name\")'></i> <span class='label'>Име:</span> {$row['Name']}</div>";
            echo "<div class='field'><i class='fas fa-pencil-alt edit-icon' onclick='editField(\"Phone\")'></i> <span class='label'>Телефон:</span> {$row['Phone']}</div>";
            echo "<div class='field'><i class='fas fa-pencil-alt edit-icon' onclick='editField(\"Email\")'></i> <span class='label'>Имейл:</span> {$row['Email']}</div>";
            echo "</form>";
            echo "</div>";
            
        } else {
            echo "Данни за администратора не са намерени.";
        }

        $conn->close();
        ?>
    </div>


    <div class="logout-icon">
        <a href="index_administrator.php"><img src= "https://cdn-icons-png.freepik.com/512/6187/6187031.png"></a>
    </div>


    <script>
        function editField(field) {
            var administratorId = <?php echo json_encode($administrator_id); ?>;
            window.location.href = "edit_administrator.php?field=" + field + "&administrator_id=" + administratorId;
        }
    </script>

</body>

</html>


