<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отделение по Хирургиия</title>
    <link rel="stylesheet" href="department_style.css">
    <style>

.doctor-container {
    display: flex; 
    align-items: center; 
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    padding: 20px;
}

.doctor-container img {
    max-width: 150px; 
    height: auto;
    border-radius: 8px;
    margin-right: 20px; 
}

.doctor-container .doctor-details {
    flex: 1; 
}

.doctor-container h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
}

.doctor-container p {
    margin-bottom: 10px;
    text-align: left; 
}

.doctor-container .more-info {
    display: block;
    background-color: #007bff;
    color: #fff;
    padding: 8px 16px;
    text-decoration: none;
    border-radius: 4px;
    margin-top: 10px; 
    width: fit-content; 
}
    </style>
</head>
<body>
    <header>
        <h1>Отделение по Хирургия</h1>
    </header>

    <div class="slideshow-container">
        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img src="images/surgery1.jpg" alt="">
        </div>
      
        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <img src="images/surgery2.jpg" alt="">
        </div>
      
        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <img src="images/surgery3.jpg" alt="">
        </div>
      <br>
      
      <div class="dots-container">
        <span class="dot"></span> 
        <span class="dot"></span> 
        <span class="dot"></span> 
      </div>
    </div>

    <nav>
        <ul>
            <li><a href="#about">За Отделението</a></li>
            <li><a href="#equipment">Апаратура</a></li>
            <li><a href="#team">Екип</a></li>
        </ul>
    </nav>

    <section id="about" class="tab-content active">
        <h2>За Отделението</h2>
        <p>Отделението по хирургия е разположено на IV етаж на болницата. Операционният блок разполага с три хирургични операционни зали, които са оборудвани с последен модел лапароскопска апаратура, холедохоскоп, ултрасижън, Liga-sure, които се използват за максимално ограничаване на травматизма при една оперативна интервенция.
    Покрива III-ниво на компетентност съгласно изискванията на медицинския стандарт по хирургия. III-ниво на компетентност е най-високото ниво за всяка хирургична клиника в България. То включва:
    Оперативни интервенции с голям и много голям обем и сложност на всички заболявания на гастро-интестиналната система, жлъчно -чернодробната система, далака, ретроперитонеалното пространство, щитовидната, надбъбречните жлези, ануса и перианалното пространство и други, изискващи отстраняване на част или цял орган ,поставяне на импланти, намеса на един и повече органи на един етап, едновременна намеса върху орган или органи от две области /кухини /остър хирургичен корем, заболявания изискващи високо-специализирани оперативни процедури.
    В това число се включват и по-голямата част от онкологичните заболявания на органите на коремната кухина, млечната жлеза и щитовидната жлеза.
    Обемът на дейност за това ниво на компетентност включва най-малко по 1000 операции годишно от които 50% с голям и много голям обем и сложност.
    Изброените по-горе дейности нашата клиника изпълнява в пълен обем.
    В Клиниката по хирургия на „Естетик Мед“ се извършва и лечение на хемороиди с най-съвременна THD технология, което е минимално инвазивно, безболезнено и щадящо за пациента.</p>
    </section>
    
    <section id="equipment" class="tab-content">
        <h2>Апаратура</h2>
        <p>Операционни зали, които са оборудвани с последен модел лапароскопска апаратура, холедохоскоп, ултрасижън, Liga-sure, които се използват за максимално ограничаване на травматизма при една оперативна интервенция.</p>
    </section>
    
    <section id="team" class="tab-content">
        <h2>Екип</h2>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hospital";
        
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT Name, Description, Qualification, Photo FROM doctors WHERE DepartmentID = 2";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="doctor-container">
                        <img src="data:image/jpeg;base64,'.base64_encode($row['Photo']).'" alt="'.$row['Name'].'">
                        <div class="doctor-details">
                            <h3>'.$row['Name'].'</h3>
                            <p>'.$row['Qualification'].'</p>
                            <p>'.$row['Description'].'</p>
                            <a href="doctor_'.$row['Name'].'.html" class="more-info">Виж повече</a>
                        </div>
                    </div>';
            }
        } else {
            echo "Няма намерени резултати";
        }
        $conn->close();
        ?>
        
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="department.js"></script>
</body>
</html>
