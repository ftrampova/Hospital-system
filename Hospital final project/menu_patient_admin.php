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

if (!isset($_GET["patient_id"]) || empty($_GET["patient_id"])) {
    die("Пациентът не е намерен в заявката!");
}

$patient_id = $_GET["patient_id"];
$sql = "SELECT * FROM patients WHERE ID = $patient_id";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
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
    "TreatmentDays" => "Дни на лечение",
    "Email" => "Имейл",
    "Password" => "Парола",
    "Operation" => "Операция",
    "DepartmentID" => "Идентификатор на отделение",
    "RoomType" => "Тип на стая",
    "RoomNumber" => "Номер на стая",
    "TreatingDoctorName" => "Лекуващ лекар"
];
?>
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Администраторски панел за пациенти</title>
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
        $patientName = $row['Name'];

        echo "<h1>Редактиране на данни за пациент: {$patientName}</h1>";
        echo "<h2>Данни за пациента:</h2>";
        echo "<div class='patient-info'>";
        echo "<form id='editForm' method='POST' action='edit_patient_admin.php'>";
       
        foreach ($row as $field => $value) {
            if ($field != 'appointment' && $field != 'DepartmentName' && $field != "ID"  && $field != "Password") {
               
           
                    $label = isset($fieldNames[$field]) ? $fieldNames[$field] : $field;
            echo "<div class='field'><i class='fas fa-pencil-alt edit-icon' onclick='editField(\"$field\")'></i> <span class='label'>$label:</span> $value</div>";
           
    } if ($field === 'Password') {
        echo "<div class='field'><i class='fas fa-pencil-alt edit-icon' onclick='editField(\"$field\")'></i> <span class='label'>Парола: </span> (скрит)</div>";
    }
}
        echo "</form>";
        echo "</div>";
    } else {
        echo "Данни за пациента не са намерени.";
    }

    $conn->close();
    ?>
</div>

<script>
    function editField(field) {
        var patientId = <?php echo json_encode($patient_id); ?>;
        window.location.href = "edit_patient_admin.php?field=" + field + "&patient_id=" + patientId;
    }
</script>

</body>
</html>