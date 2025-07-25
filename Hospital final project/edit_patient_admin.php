<?php
session_start();

if (!isset($_GET['field']) || !isset($_GET['patient_id'])) {
    die("Невалидна заявка!");
}

$field = $_GET['field'];
$patient_id = $_GET['patient_id'];

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "hospital";

$conn = new mysqli($hostName, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Асоциативен масив за превод на имената на полетата
$fieldNames = [
    "ID" => "Идентификатор",
    "Name" => "Име",
    "Phone" => "Телефон",
    "Address" => "Адрес",
    "DateOfBirth" => "Дата на раждане",
    "Gender" => "Пол",
    "Disease" => "Заболяване",
    "TreatingDoctorID" => "Идентификатор на лекуващия доктор",
    "Treatment" => "Лечение",
    "TreatmentDays" => "Дата на прием",
    "Email" => "Имейл",
    "Password" => "Парола",
    "Operation" => "Операция",
    "DepartmentID" => "Идентификатор на отделение",
    "RoomType" => "Тип на стая",
    "RoomNumber" => "Номер на стая" 
];

// Проверка дали полето съществува в преводния масив
if (!array_key_exists($field, $fieldNames)) {
    die("Невалидно поле!");
}

$sql = "SELECT $field FROM patients WHERE ID = $patient_id";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fieldValue = $row[$field];

    // Генериране на HTML изход със стиловете от вашето второ HTML
    echo "<!DOCTYPE html>";
    echo "<html lang='bg'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>Редактиране на {$fieldNames[$field]}</title>";
    echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>";
    echo "<link rel='stylesheet' href='menu_nursestyle.css'> <!-- Използваме стиловете за медицинска сестра -->";
    echo "<link rel='icon' href='logo.jpg'>";
    echo "<style>";
    echo "/* Основни стилове за body */";
    echo "body {";
    echo "    margin: 0;";
    echo "    padding: 0;";
    echo "    font-family: 'Poppins', sans-serif;";
    echo "    background-image: linear-gradient(rgba(4, 9, 30, 0.7), rgba(4, 9, 30, 0.7)), url(images/doctors.jpg); /* Задаваме фоновата снимка */";
    echo "    background-position: center;";
    echo "    background-size: cover;";
    echo "    position: relative;";
    echo "    overflow-x: hidden;";
    echo "    overflow-y: scroll;";
    echo "    height: 100vh;";
    echo "    color: #000; /* Цвят на текста */";
    echo "}";
    echo "";
    echo "/* Стилове за контейнера */";
    echo ".container {";
    echo "    width: 80%;";
    echo "    max-width: 400px;";
    echo "    margin: 20vh auto;";
    echo "    background-color: rgba(255, 255, 255, 0.9);";
    echo "    padding: 40px;";
    echo "    border-radius: 10px;";
    echo "    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);";
    echo "    color: #333; /* Цвят на текста */";
    echo "}";
    echo "";
    echo "h1 {";
    echo "    text-align: center;";
    echo "    font-size: 36px;";
    echo "    font-weight: 600;";
    echo "    margin-bottom: 30px;";
    echo "}";
    echo "";
    echo "form {";
    echo "    margin-top: 20px;";
    echo "}";
    echo "";
    echo "input[type='text'] {";
    echo "    width: 100%;";
    echo "    padding: 15px;";
    echo "    margin-bottom: 20px;";
    echo "    border: none;";
    echo "    border-bottom: 1px solid #ccc;";
    echo "    background-color: transparent;";
    echo "    font-size: 16px;";
    echo "    color: #000; /* Цвят на текста */";
    echo "}";
    echo "";
    echo "input[type='text']:focus {";
    echo "    outline: none;";
    echo "    border-bottom: 1px solid #f44336;";
    echo "}";
    echo "";
    echo "button[type='submit'] {";
    echo "    width: 100%;";
    echo "    padding: 15px;";
    echo "    background-color: #f44336;";
    echo "    color: #fff;";
    echo "    border: none;";
    echo "    border-radius: 25px;";
    echo "    cursor: pointer;";
    echo "    transition: background-color 0.3s;";
    echo "    font-size: 18px;";
    echo "}";
    echo "";
    echo "button[type='submit']:hover {";
    echo "    background-color: #e53935; /* Цвят на бутона при хоувър */";
    echo "}";
    echo "</style>";
    echo "</head>";
    echo "<body>";
    echo "<div class='container'>";
    echo "<h1>Редактиране на {$fieldNames[$field]}</h1>";
    echo "<form method='POST' action='update_patient_admin.php'>";
    echo "<input type='hidden' name='patient_id' value='$patient_id'>";
    echo "<input type='hidden' name='field' value='$field'>";
    echo "<label for='{$field}'>{$fieldNames[$field]}:</label>";
    echo "<input type='text' id='{$field}' name='field_value' value='{$fieldValue}' required>";
    echo "<button type='submit'>Запази</button>";
    echo "</form>";
    echo "</div>";
    echo "</body>";
    echo "</html>";
} else {
    die("Няма данни за пациента!");
}

$conn->close();
?>


