<?php
// api/clients.php
include '../functions/db.php';

header('Content-Type: application/json');

$query = "SELECT * FROM klijenti";
$result = query($query);

confirm($result);

$clients = fetch_all($result);

echo json_encode($clients);
?>
