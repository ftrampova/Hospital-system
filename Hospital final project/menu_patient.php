<?php
session_start();
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
            background-color: #f44336; /* Остава същия цвят при hover */
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
            color: #f44336; /* Оранжев цвят на молива още веднъж при ховър */
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
        if (!isset($_SESSION["user"]) || $_SESSION["user"] !== "patients") {
            header("Location: login.php");
            exit();
        }

        $hostName = "localhost";
        $dbUser = "root";
        $dbPassword = "";
        $dbName = "hospital";

        $conn = new mysqli($hostName, $dbUser, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (!isset($_SESSION["patients_id"]) || empty($_SESSION["patients_id"])) {
            die("ID на пациента не е намерено в сесията или е празно!");
        }

        $patient_id = $_SESSION["patients_id"];
        $sql = "SELECT * FROM patients WHERE ID = $patient_id";
        $result = $conn->query($sql);

        if ($result === false) {
            die("Error executing query: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $patientName = $row['Name'];

            

            echo "<h1>Добре дошъл, {$patientName}!</h1>";
            echo "<h2>Данни за пациента:</h2>";
            echo "<div class='patient-info'>";
            echo "<form id='editForm' method='POST' action='edit_patient.php'>";
            echo "<div class='field'><i class='fas fa-pencil-alt edit-icon' onclick='editField(\"Name\")'></i> <span class='label'>Име:</span> {$row['Name']}</div>";
            echo "<div class='field'><i class='fas fa-pencil-alt edit-icon' onclick='editField(\"Phone\")'></i> <span class='label'>Телефон:</span> {$row['Phone']}</div>";
            echo "<div class='field'><i class='fas fa-pencil-alt edit-icon' onclick='editField(\"Address\")'></i> <span class='label'>Адрес:</span> {$row['Address']}</div>";
            echo "<div class='field'><i class='fas fa-pencil-alt edit-icon' onclick='editField(\"DateOfBirth\")'></i> <span class='label'>Дата на раждане:</span> {$row['DateOfBirth']}</div>";
            echo "<div class='field'><i class='fas fa-pencil-alt edit-icon' onclick='editField(\"Gender\")'></i> <span class='label'>Пол:</span> {$row['Gender']}</div>";
            echo "<div class='field'><i class='fas fa-pencil-alt edit-icon' onclick='editField(\"Email\")'></i> <span class='label'>Имейл:</span> {$row['Email']}</div>";
            echo "<div class='field'> <span class='label'>Заболяване:</span> {$row['Disease']}</div>";
            echo "<div class='field'> <span class='label'>Лечение:</span> {$row['Treatment']}</div>";
            echo "<div class='field'><span class='label'>Номер на стая:</span> {$row['RoomNumber']}</div>";
           
            echo "</form>"; 
            echo "</div>";
           


            

            echo "<h2>Записване на час:</h2>";
            echo "<form id='appointmentForm' method='POST' action=''>";
            echo "<div class='field'><label for='doctor' class='label'>Изберете лекар:</label>";
            echo "<select name='doctor' id='doctor'>";

            $sqlDoctors = "SELECT ID, Name FROM doctors";
            $resultDoctors = $conn->query($sqlDoctors);

            if ($resultDoctors->num_rows > 0) {
                while ($doctor = $resultDoctors->fetch_assoc()) {
                    echo "<option value='{$doctor['ID']}'>{$doctor['Name']}</option>";
                }
            } else {
                echo "<option value=''>Няма налични лекари</option>";
            }

            echo "</select></div>";
            echo "<div class='field'><label for='appointment_time' class='label'>Изберете дата и час:</label>";
            echo "<input type='datetime-local' name='appointment_datetime' id='appointment_datetime' required></div>";
            
            
            echo "<div class='field'>";
            echo "<input type='submit' name='submitAppointment' value='Запиши час'>";
            echo "</div>";
            
            echo "</form>"; 
           
           
        } else {
            echo "Данни за пациента не са намерени.";
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitAppointment'])) {
            $selectedDoctorId = $_POST['doctor'];
            $appointmentDatetime = $_POST['appointment_datetime'];
        
            // Извличане на името на избрания лекар
            $sqlDoctorName = "SELECT Name FROM doctors WHERE ID = $selectedDoctorId";
            $resultDoctorName = $conn->query($sqlDoctorName);
        
            if ($resultDoctorName->num_rows > 0) {
                $doctorName = $resultDoctorName->fetch_assoc()['Name'];
        
                
                $patientName = $row['Name']; 
        
                $appointmentText = "Запис за пациент {$patientName} на {$appointmentDatetime}";
        
                $sqlUpdateDoctor = "UPDATE doctors SET appointments_hour = CONCAT(appointments_hour, '{$appointmentText}\n') WHERE ID = $selectedDoctorId";
        

                if ($conn->query($sqlUpdateDoctor) === TRUE) {
                     echo "Успешно записахте час за $doctorName на $appointmentDatetime.";

                    $appointmentTextForPatient = "Запис при лекар $doctorName на $appointmentDatetime";
                    $sqlUpdatePatient = "UPDATE patients SET appointment = CONCAT(IFNULL(appointment, ''), '{$appointmentTextForPatient}\n') WHERE ID = $patient_id";

                    if ($conn->query($sqlUpdatePatient) === TRUE) {
                        // echo " Успешно записахте час и в таблицата на пациента."; 
                    } else {
                        echo " Грешка при запис в таблицата на пациента: " . $conn->error;
                    }

                } else {
                    echo "Грешка при запис на час: " . $conn->error;
                }
            } else {
                echo "Лекар с ID $selectedDoctorId не беше намерен.";
            }
        }
        
        
        echo "<h2>Имате следните записани часове:</h2>";
        $sqlGetAppointments = "SELECT appointment FROM patients WHERE ID = $patient_id";
        $resultAppointments = $conn->query($sqlGetAppointments);

        if ($resultAppointments && $resultAppointments->num_rows > 0) {
            $rowAppointments = $resultAppointments->fetch_assoc();
            $appointment = $rowAppointments['appointment'];
            echo nl2br(htmlspecialchars($appointment)); 
        } else {
            echo "Нямате записани часове.";
        }

        
        


    

      

        $conn->close();
        ?>
  
    <div class="logout-icon">
        <a href="logout.php"><img src= "https://cdn-icons-png.freepik.com/512/6187/6187031.png"></a>
    </div>

    <script>
        function editField(field) {
            var patientId = <?php echo json_encode($patient_id); ?>;
            window.location.href = "edit_patient.php?field=" + field + "&patient_id=" + patientId;
        }
    </script>





</body>

</html>