<?php
session_start();

if (!isset($_GET['field']) || !isset($_GET['administrator_id'])) {
    die("Invalid request");
}

$field = $_GET['field'];
$administrator_id = $_GET['administrator_id'];

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "hospital";

$conn = new mysqli($hostName, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT $field FROM administrators WHERE ID = $administrator_id";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fieldValue = $row[$field];
} else {
    die("Patient data not found.");
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
    <link rel="stylesheet" href="menu_nursestyle.css"> <!-- Използваме стиловете за медицинска сестра -->
    <link rel="icon" href="logo.jpg">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-image: linear-gradient(rgba(4, 9, 30, 0.7), rgba(4, 9, 30, 0.7)), url(images/doctors.jpg); /* Задаваме фоновата снимка */
            background-position: center;
            background-size: cover;
            position: relative;
            overflow-x: hidden;
            overflow-y: scroll;
            height: 100vh;
            color: #000; 
        }

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

        input[type="text"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: none;
            border-bottom: 1px solid #ccc;
            background-color: transparent;
            font-size: 16px;
            color: #000; 
        }

        input[type="text"]:focus {
            outline: none;
            border-bottom: 1px solid #f44336;
        }

        button[type="submit"] {
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

        button[type="submit"]:hover {
            background-color: #e53935; 
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Редактиране на <?php echo htmlspecialchars($field); ?></h1>
        <form method="POST" action="update_administrator.php">
        <input type="hidden" name="administrator_id" value="<?php echo htmlspecialchars($administrator_id); ?>">
        <input type="hidden" name="field" value="<?php echo htmlspecialchars($field); ?>">
    

            <label for="<?php echo htmlspecialchars($field); ?>"><?php echo htmlspecialchars($field); ?>:</label>
            <input type="text" id="<?php echo htmlspecialchars($field); ?>" name="field_value" value="<?php echo htmlspecialchars($fieldValue); ?>">
            <button type="submit">Запази</button>
        </form>
    </div>

</body>

</html>


