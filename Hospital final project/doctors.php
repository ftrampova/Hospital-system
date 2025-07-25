<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Списък с доктори</title>
    <link rel="stylesheet" href="style.css"> 
    <style>
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
            color: #333; 
        }

        .doctor-item {
            margin-bottom: 20px;
            padding: 15px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .doctor-item h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .edit-link {
            display: inline-block;
            padding: 8px 16px;
            background-color: #f44336;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .edit-link:hover {
            background-color: #e53935;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Доктори</h1>

        <?php
        $hostName = "localhost";
        $dbUser = "root";
        $dbPassword = "";
        $dbName = "hospital";

        $conn = new mysqli($hostName, $dbUser, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM doctors";
        $result = $conn->query($sql);

        if ($result === false) {
            die("Error executing query: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $doctorId = $row['ID'];
                $doctorName = $row['Name'];

                echo "<div class='doctor-item'>";
                echo "<h2>{$doctorName}</h2>";
                echo "<a href='menu_doctor_admin.php?doctor_id={$doctorId}' class='edit-link'>Редактиране</a>";
                echo "</div>";
            }
        } else {
            echo "<p>Няма намерени доктори.</p>";
        }

        $conn->close();
        ?>

    </div>

</body>

</html>
