<?php
include "functions/db.php";

$name = 'Milos';
$email = 'mimi@gmail.com';
$username = 'Milos77';
$password = '123';
$is_admin = 2; // Super Admin

// Hashovanje lozinke
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Pripremanje SQL upita sa is_admin vrednošću
$sql = "INSERT INTO korisnici (name, email, username, password, is_admin) VALUES (?, ?, ?, ?, ?)";

// Priprema i izvršavanje upita
$run = $con->prepare($sql);
$run->bind_param("ssssi", $name, $email, $username, $hashed_password, $is_admin);
$run->execute();

echo "Super Admin korisnik uspešno kreiran.";
?>
