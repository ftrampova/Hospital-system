<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Болница "Естетик Мед"</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: black;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            text-align: left;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ff6666;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #ff6666;
        }

        .logout-icon {
        position: fixed;
        top: 20px;
        right: 1300px;
        z-index: 1000; 
    }

    .logout-icon a img {
        width: 70px; 
        height: auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
    }

    </style>
</head>
<body>
    <section class="header">
        <nav>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-close" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="menu_administrator.php">Профил</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropbtn">Редактиране на данни</a>
                        <div class="dropdown-content">
                            <a href="patients.php">Пациенти</a>
                            <a href="doctors.php">Доктори</a>
                            <a href="nurses.php">Мед. сестри</a>
                            <a href="maintenance.php">Поддръжка</a>
                        </div>
                    </li>
                    <li><a href="patient_accommodation.php">Настаняване на пациенти</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>
        
        <div class="text-box">
            <h1>Администраторски панел</h1>
        </div>
    </section>
    
    
    <script>
        var navLinks = document.getElementById("navLinks");

        function showMenu() {
            navLinks.style.right = "0";
        }

        function hideMenu() {
            navLinks.style.right = "-200px";
        }
    </script>

    
<div class="logout-icon">
        <a href="logout.php"><img src= "https://cdn-icons-png.freepik.com/512/6187/6187031.png"></a>
    </div>


</body>
</html>








