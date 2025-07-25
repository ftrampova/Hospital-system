<?php
session_start();

if (!isset($_GET['field']) || !isset($_GET['doctor_id'])) {
    die("Invalid request");
}

$field = $_GET['field'];
$doctor_id = $_GET['doctor_id'];

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "hospital";

$conn = new mysqli($hostName, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT $field FROM doctors WHERE ID = $doctor_id";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fieldValue = $row[$field];
} else {
    die("Doctor data not found.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактиране на <?php echo htmlspecialchars($field); ?></title>
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

        /* Стилове за контейнера */
        .container {
            width: 80%;
            max-width: 400px;
            margin: 20vh auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #333; /* Цвят на текста */
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

        input[type='text'] {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: none;
            border-bottom: 1px solid #ccc;
            background-color: transparent;
            font-size: 16px;
            color: #000; /* Цвят на текста */
        }

        input[type='text']:focus {
            outline: none;
            border-bottom: 1px solid #f44336;
        }

        button[type='submit'] {
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

        button[type='submit']:hover {
            background-color: #e53935; /* Цвят на бутона при хоувър */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Редактиране на <?php echo htmlspecialchars($field); ?></h1>
        <form method="POST" action="update_doctor_admin.php">
            <input type="hidden" name="doctor_id" value="<?php echo htmlspecialchars($doctor_id); ?>">
            <input type="hidden" name="field" value="<?php echo htmlspecialchars($field); ?>">
            <input type="text" name="field_value" value="<?php echo htmlspecialchars($fieldValue); ?>" required>
            <button type="submit">Запази</button>
        </form>
    </div>
</body>
</html>

