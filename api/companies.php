<?php
include '../functions/db.php';

header('Content-Type: application/json');

$query = "SELECT * FROM kompanije";
$result = query($query);

confirm($result);

$companies = fetch_all($result);

echo json_encode($companies);
?>
