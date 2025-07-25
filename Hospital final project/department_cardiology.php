<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отделение по Кардиология</title>
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
        <h1>Отделение по Кардиология</h1>
    </header>

    <div class="slideshow-container">
        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img src="images/doctors.jpg" alt="">
        </div>
      
        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <img src="images/cardiology.jpg" alt="">
        </div>
      
        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <img src="images/staq1.jpg" alt="">
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
        <p>В отделението по кардиология и инвазивна кардиология се извършват високо специализирани изследвания и интервенционални процедури: селективна коронарна ангиография, вентрикулография, аортография, дилатация на коронарни артерии и имплантиране на стентове, балонна митрална валвулопластика, дясна сърдечна катетеризация, пулмоангиография, тромбаспирация и локална тромболиза при белодробен тромбемболизъм, имплантация на кава филтър, каротидно стентиране, периферна ангиопластика и стентиране, имплантиране на постоянни пейсмейкъри, пейсмейкъри за сърдечна недостатъчност (кардиоресинхронизираща терапия) и кардиовертер-дефибрилатори. В сектора по неинвазивна диагностика се извършват всички функционални изследвания на сърдечно-съдовата система: електрокардиография (ЕКГ), холтер-мониториране на ЕКГ и артериално налягане, трансторакална ехокардиография, трансезофагeална ехокардиография (ТЕЕ), стрес ехокардиография, дуплекс-сонография на периферни съдове.</p>
            <p> Специалистите от Клиниката по кардиология и инвазивна кардиология към болница „Естетик Мед“ предлагат възможност за персонализиран подход при диагностиката, лечението и наблюдението  на всеки пациент. За тази цел, на абонаментен принцип функционират и два модерни центъра: за лечение на сърдечна недостатъчност и за лечение на артериална хипертония.</p>
    </section>
    
    <section id="equipment" class="tab-content">
        <h2>Апаратура</h2>
        <p>Отделението по инвазивна кардиология на „Естетик Мед“ разполага с най-добрия ангиографски апарат с плосък панел, а именно последната версия Artis SEE на Siemens.</p>
        <p> На територията на отделението функционира и втори ангиографски апарат от най-ново поколение, произведен през март 2013г. - „Allura Centron“ на фирма Philips Healthcare. Той е първият инсталиран апарат от този тип в България. Апаратът се отличава с високото качество на образа и предлага разширени възможности за извършване на 3-размерна ротационна ангиография, даваща информация при интервенции в областта на главата и торакса. Софтуерът позволява прецизни измервания и анализ на функциите на изследваните органи и системи, а апаратурата за следене параметрите на кръвоносната система (т.нар. хемодинамична мониторна система) дава детайлна информация за състоянието на пациента и увеличава диагностичните способности на целия комплекс.Ангиографът притежава специална технология за намаляване на радиацията и предпазване на пациента от облъчване.</p>
            <p> Кардиологията е оборудвана и с един ехокардиографски апарaт Аcuson C 300 на Siemens и два ехокардиографа на Philips от най-висок клас.</p>
                <p>  В отделението функционира и ехокардиографски апарат от най-висок премиум клас. Той е произведен от технологичния гигант PHILIPS Healthcare. Чрез него кардиолозите от болница „Естетик Мед“ могат да извършват прецизна неинвазивна диагностика на сърдечно-съдовата система за установяване на вродени и придобити сърдечни и съдови болести. </p>
                    <p>  В секцията по кардиостимулация се работи с най-съвременните програмери и анализатори за имплантация и проследяване на пейсмейкъри на фирмите St. Jude Medical, Biotronik и Medtronic.</p>
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
        
        $sql = "SELECT Name, Description, Qualification, Photo FROM doctors WHERE DepartmentID = 1";
        
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
