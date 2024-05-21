<?php
include "functions/init.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CRM</title>
	<link rel="stylesheet" type="text/css" href="css/stil.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
</head>
<header>
	<div class="logo">
            <p>CRM</p>
        </div>
        <div class="headerList">
            <ul>
                <?php if (!isset($_SESSION['email'])) : ?>
                	<li><a href="index.php">Home🏠</a></li>
                    <li><a href="login.php">Login🔑</a></li>
                    <li><a href="register.php">Register📝</a></li>
                <?php elseif (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 2) : ?>
                    <li><a href="index.php">Home🏠</a></li>
                    <li><a href="super_admin_register.php">Registracija korisnika📝</a></li>
                    <li><a href="registracija_kompanije.php">Registracija kompanije💼</a></li>
                    <li><a href="registracija_klijenata.php">Registracija klijenta🤝</a></li>
                    <li><a href="logout.php">Logout👋</a></li>
                <?php elseif (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) : ?>
                    <li><a href="index.php">Home🏠</a></li>
                    <li><a href="registracija_kompanije.php">Registracija kompanije💼</a></li>
                    <li><a href="registracija_klijenata.php">Registracija klijenta🤝</a></li>
                    <li><a href="logout.php">Logout👋</a></li>
                <?php endif; ?>
            </ul>
        </div>   
</header>