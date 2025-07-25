<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Администраторски панел за медицински сестри</title>
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
        }

        h1 {
            text-align: center;
            font-size: 36px;
            font-weight: 600;
            margin-bottom: 30px;
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
            background-color: #d32f2f; /* Тъмнорозов цвят при hover */
        }

        .nurse-info {
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
            color: #f44336; /* Оранжев цвят на молива още веднъж при ховър */
        }
    </style>
</head>
<body>

<div class="container">
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

    if (!isset($_GET["nurse_id"]) || empty($_GET["nurse_id"])) {
        die("ID на медицинската сестра не е намерено!");
    }

    $nurse_id = $_GET["nurse_id"];
    $sql = "SELECT * FROM nurses WHERE ID = $nurse_id";
    $result = $conn->query($sql);

    if ($result === false) {
        die("Error executing query: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nurseName = $row['Name'];

        $fieldNames = [
            "ID" => "Идентификатор",
            "Name" => "Име",
            "Phone" => "Телефон",
            "Address" => "Адрес",
            "DateOfBirth" => "Дата на раждане",
            "Email" => "Имейл",
            "Password" => "Парола",
            "Operation" => "Операция",
            "Description" => "Описание",
            "doctor_id" => "Ръководен доктор",
            "Gender" => "Пол",



        ];

        echo "<h1>Добре дошъл, {$nurseName}!</h1>";
        echo "<h2>Данни за медицинската сестра:</h2>";
        echo "<div class='nurse-info'>";
        echo "<form id='editForm' method='POST' action='edit_nurse_admin.php'>";
   

        foreach ($row as $field => $value) {
            if ($field === 'Password') {
                echo "<div class='field'><i class='fas fa-pencil-alt edit-icon' onclick='editField(\"$field\")'></i> <span class='label'>Парола: </span> (скрит)</div>";
            }
           else if ($field != 'ID' && $field != 'Photo' ) {
            $label = isset($fieldNames[$field]) ? $fieldNames[$field] : $field;
            echo "<div class='field'><i class='fas fa-pencil-alt edit-icon' onclick='editField(\"$field\")'></i> <span class='label'>$label:</span> $value</div>";
            }
            
            
             

        }

                   // Проверка дали полето е doctor_id и има стойност
                   if ($field == 'doctor_id' && $value !== '') {
                    // Извличане на името на доктора от таблицата doctors
                    $doctorId = $value;
                    $sqlDoctorName = "SELECT Name FROM doctors WHERE ID = $doctorId";
                    $resultDoctorName = $conn->query($sqlDoctorName);
    
                    if ($resultDoctorName && $resultDoctorName->num_rows > 0) {
                        $doctorName = $resultDoctorName->fetch_assoc()['Name'];
                        echo " $doctorName";
                    } else {
                        echo " Неизвестен лекар (ID: $doctorId)";
                    }
                } else {
                    // Изобразяване на стойността на полето
                    echo " $value";
                }
        
        echo "</form>";
        echo "</div>";
    } else {
        echo "Данни за медицинската сестра не са намерени.";
    }

    $conn->close();
    ?>
</div>

<script>
    function editField(field) {
        var nurseId = <?php echo json_encode($nurse_id); ?>;
        window.location.href = "edit_nurse_admin.php?field=" + field + "&nurse_id=" + nurseId;
    }
</script>

</body>
</html>






