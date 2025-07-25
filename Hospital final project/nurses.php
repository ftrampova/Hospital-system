<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Списък с медицински сестри</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="menu_patientstyle.css"> 
    <style>
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

        .container {
            width: 80%;
            max-width: 600px;
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

        .nurse {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nurse-name {
            font-weight: bold;
        }

        .edit-button {
            text-decoration: none;
            color: #ff6666;
            font-size: 14px;
            transition: color 0.3s;
        }

        .edit-button:hover {
            color: pink;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Списък с медицински сестри</h1>
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

        $sql = "SELECT * FROM nurses";
        $result = $conn->query($sql);

        if ($result === false) {
            die("Error executing query: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nurseId = $row['ID'];
                $nurseName = $row['Name'];
                echo "<div class='nurse'>
                        <span class='nurse-name'>$nurseName</span>
                        <a href='menu_nurse_admin.php?nurse_id=$nurseId' class='edit-button'>Редактиране</a>
                      </div>";
            }
        } else {
            echo "<p>Няма намерени медицински сестри.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
