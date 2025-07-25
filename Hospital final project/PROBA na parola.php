<?php
// Паролата, която искаме да хешираме
$password = "12345678";

// Хеширане на паролата
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Отпечатване на хешираната парола
echo $hashedPassword;
?>



