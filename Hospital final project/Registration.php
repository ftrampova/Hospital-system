<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "hospital";

$conn = new mysqli($hostName, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
    <link rel="stylesheet" href="Login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <link rel="icon" href="logo.jpg">
</head>

<body>
    <div class="container">
    <h1>Регистрация</h1>
    <form action="Registration.php" method="post">

        <input type="radio" id="patient" name="role" value="patient" required>
        <label for="patient">Пациент</label>

    

        <label for="name">Три имена:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="gsm">Телефон за контакт:</label>
        <input type="tel" id="gsm" name="gsm" required><br><br>

        <label for="email">Електронна поща:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Парола:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="repeat_password">Повтори паролата:</label>
        <input type="password" id="repeat_password" name="repeat_password" required><br><br>

        

        <input type="submit" value="Регистрирай">
    </form>
        <div class="login-link">
            <p>Съществуваща регистрация? <a href="login.php">Влез тук</a></p>
            <?php
// Проверка дали формата е изпратена
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hostName = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "hospital";

    $conn = new mysqli($hostName, $dbUser, $dbPassword, $dbName);
 

    // Проверка за връзка
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Получаване на данните от формата
    $role = $_POST['role'];
    $name = $_POST['name'];
    $gsm = $_POST['gsm'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Невалиден имейл!");
    }

    if (!preg_match("/^[0-9]{10}$/", $gsm)) {
        die("Невалиден телефонен номер!");
    }

    if (strlen($password) < 8) {
        die("Паролата трябва да е минимум 8 символа!");
    }


    if ($password !== $repeat_password) {
        die("Паролите не съвпадат!");
    }

     if (!preg_match("/^\S+\s\S+\s\S+$/", $name)) {
        die("Моля, въведете и трите си имена!");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($role === 'patient') {
        $sql = "INSERT INTO patients (Name, Phone, Email, Password) VALUES ('$name', '$gsm', '$email', '$hashed_password')";
    } else if ($role === 'doctor') {
        $sql = "INSERT INTO doctors (Name, Phone, Email, Password) VALUES ('$name', '$gsm', '$email', '$hashed_password')";
    } else if ($role === 'nurse') {
        $sql = "INSERT INTO nurses (Name, Phone, Email, Password) VALUES ('$name', '$gsm', '$email', '$hashed_password')";
    } else if ($role === 'maintenance') {
        $sql = "INSERT INTO maintenance (Name, Phone, Email, Password) VALUES ('$name', '$gsm', '$email', '$hashed_password')";
    } else if ($role === 'administrator') {
        $sql = "INSERT INTO administrators (Name, Phone, Email, Password) VALUES ('$name', '$gsm', '$email', '$hashed_password')";
    } else {
        die("Invalid role selected!");
    }

    if ($conn->query($sql) === TRUE) {
        echo "Регистрацията е успешна!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
$conn->close();
?>

        </div>
        </div>


       

<script>
function validateForm() {
    var name = document.forms["registrationForm"]["name"].value;
    var gsm = document.forms["registrationForm"]["gsm"].value;
    var email = document.forms["registrationForm"]["email"].value;
    var password = document.forms["registrationForm"]["password"].value;
    var repeat_password = document.forms["registrationForm"]["repeat_password"].value;
    var role = document.forms["registrationForm"]["role"].value;
    
    if (name == "" || gsm == "" || email == "" || password == "" || repeat_password == "" || role == "") {
        alert("Моля, попълнете всички полета.");
        return false;
    }

    return true;
}
</script>
</body>
</html>