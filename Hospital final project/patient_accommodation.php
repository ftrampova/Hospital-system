<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Room Registration</title>
    <link rel="stylesheet" href="accommodation.css">
</head>
<body>
    <div class="container">
        <h1>Регистрация на пациент в стая</h1>
        <form id="patientForm" action="patient_accommodation.php" method="POST">
            
            <label for="patientName">Име на пациента:</label>
            <input type="text" id="patientName" name="patientName" required>
            
            <label for="department">Отделение:</label>
<select id="department" name="department" required>
    <option value="" selected>Изберете отделение</option>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hospital";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql_departments = "SELECT DepartmentName FROM departments";
    $result_departments = $conn->query($sql_departments);

    if ($result_departments->num_rows > 0) {
        while ($row = $result_departments->fetch_assoc()) {
            echo '<option value="' . $row['DepartmentName'] . '">' . $row['DepartmentName'] . '</option>';
        }
    } else {
        echo '<option value="">Няма налични отделения</option>';
    }

    $conn->close();
    ?>
</select>
            
            <label for="doctor">Лекар:</label>
            <select id="doctor" name="doctor" required>
                <option value="">Изберете лекар</option>
                <?php
                $hardcoded_doctors = array(
                    'Д-р Иван Иванов',
                    'Д-р Мария Петрова',
                    'Д-р Анна Георгиева',
                    'Д-р Петър Иванов'
                );

                foreach ($hardcoded_doctors as $doctor_name) {
                    echo '<option value="' . $doctor_name . '">' . $doctor_name . '</option>';
                }
                ?>
            </select>
            
            <label for="roomType">Тип на стая:</label>
            <select id="roomType" name="roomType" required onchange="this.form.submit()">
                <option value="">Изберете тип стая</option>
                <option value="Standard" <?php if (isset($_POST['roomType']) && $_POST['roomType'] == 'Standard') echo 'selected'; ?>>Стандартна стая</option>
                <option value="Intensive" <?php if (isset($_POST['roomType']) && $_POST['roomType'] == 'Intensive') echo 'selected'; ?>>Интензивно</option>
            </select>
            
            <div id="roomSelection">
                <label for="roomNumber">Изберете номер:</label>
                <div class="room-container" id="roomContainer">
                    <?php
                    if (isset($_POST['roomType']) && ($_POST['roomType'] == 'Standard' || $_POST['roomType'] == 'Intensive')) {
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $roomType = $_POST['roomType'];
                        $sql_rooms = "SELECT RoomNumber, OccupiedCount FROM rooms WHERE RoomType = '$roomType'";
                        $result_rooms = $conn->query($sql_rooms);

                        if ($result_rooms->num_rows > 0) {
                            while ($row = $result_rooms->fetch_assoc()) {
                                $class = ($row['OccupiedCount'] > 0) ? 'occupied' : '';
                                echo '<div class="room-option ' . $class . '" data-room-number="' . $row['RoomNumber'] . '">' . $row['RoomNumber'] . '</div>';
                            }
                        } else {
                            echo '<p>Няма налични стаи за избрания тип</p>';
                        }

                        $conn->close();
                    }
                    ?>
                </div>
            </div>
            <input type="hidden" id="roomNumber" name="roomNumber"> 
            <input type="hidden" id="operationRoomNumber" name="operationRoomNumber">

            
            <label for="days">Брой дни за престой:</label>
            <input type="number" id="days" name="days" required>
            
            <div id="operationSection">
                <label for="operation">Предстои операция:</label>
                <input type="checkbox" id="operation" name="operation" onchange="toggleOperationFields()">
                
                <div id="operationFieldsContainer" style="display: none;">
                    <div id="operationTimeContainer">
                        <label for="operationTime">Дата и час за операция:</label>
                        <input type="datetime-local" id="operationTime" name="operationTime">
                    </div>
                    
                    <div id="operationRoomSelection">
                        <label for="operationRoomNumber">Изберете стая за операция:</label>
                        <div class="room-container" id="operationRoomContainer">
                            <?php
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $sql_operation_rooms = "SELECT RoomNumber, OccupiedCount FROM rooms WHERE RoomType = 'Operation'";
                            $result_operation_rooms = $conn->query($sql_operation_rooms);

                            if ($result_operation_rooms->num_rows > 0) {
                                while ($row = $result_operation_rooms->fetch_assoc()) {
                                    $class = ($row['OccupiedCount'] > 0) ? 'occupied' : '';
                                    echo '<div class="room-option ' . $class . '" data-room-number="' . $row['RoomNumber'] . '">' . $row['RoomNumber'] . '</div>';
                                }
                            } else {
                                echo '<p>Няма налични стаи за операции</p>';
                            }

                            $conn->close();
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <button type="submit">Регистрирай</button>
        </form>
        <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['patientName'], $_POST['department'], $_POST['doctor'], $_POST['roomNumber'], $_POST['days'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hospital";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $patientName = $_POST['patientName'];
        $departmentID = $_POST['department'];
        $treatingDoctorName = $_POST['doctor'];
        $roomNumber = $_POST['roomNumber'];
        $days = $_POST['days'];
        $operationTime = isset($_POST['operationTime']) ? $_POST['operationTime'] : null;
        $operationRoomNumber = isset($_POST['operationRoomNumber']) ? $_POST['operationRoomNumber'] : null;

        if ($operationRoomNumber) {
            $roomNumber .= ', ' . $operationRoomNumber;
        }

        $sql = "INSERT INTO patients (Name, DepartmentName, TreatingDoctorName, RoomNumber, TreatmentDays, Operation) 
                VALUES ('$patientName', (SELECT DepartmentName FROM departments WHERE DepartmentID = '$departmentID'), 
                        '$treatingDoctorName', '$roomNumber', '$days', '$operationTime')";

        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Грешка при регистрация на пациент: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Моля, попълнете всички полета.";
    }
}
?>
    </div>

    <script src="accommodation.js"></script>
</body>
</html>
