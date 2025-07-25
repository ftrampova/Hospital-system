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
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="Login.css">
    <link rel="icon" href="logo.jpg" >
</head>

<body>
    <div class="container">
        <h1>Вход</h1>
        <form action="Login.php" method="post">

            <div class="form-group">
                <label for="email">Електронна поща:</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="password">Парола:</label>
                <input type="password" id="password" name="password" required><br><br>

                <input type="submit" value="Вход!" name="submit">
            </div>
        </form>
        
        
        <?php
        if (isset($_POST["submit"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];

            
            $roles = [
                'patients' => 'menu_patient.php',
                'doctors' => 'menu_doctor.php',
                'nurses' => 'menu_nurse.php',
                'maintenance' => 'menu_maintenance.php',
                'administrators' => 'index_administrator.php'
            ];

            $roleFound = false;

            foreach ($roles as $role => $menu) {
                $sql = "SELECT * FROM $role WHERE Email = '$email'";
                $result = mysqli_query($conn, $sql);

                
                if ($result->num_rows > 0) {
                    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    if (password_verify($password, $user["Password"])) {
                        session_start();
                        $_SESSION["user"] = $role;
                        $_SESSION["email"] = $user["Email"];
                        $_SESSION[$role . "_id"] = $user["ID"];
                        header("Location: $menu");
                        die();
                    } else {
                        echo "Паролата е грешна";
                        $roleFound = true;
                        break;
                    }
                }
            }

            if (!$roleFound) {
                echo "Няма такъв email";
            }

            $conn->close();
        }
        ?>
    </div>
</body>

</html>