<?php
include "functions/init.php"; // Ovo uključuje session_start(), db.php i functions.php

header('Content-Type: application/json; charset=UTF-8'); // Postavljanje Content-Type na application/json

$response = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['member_id']) && isset($_POST['name']) && isset($_POST['email'])) {
        $member_id = escape($_POST['member_id']);
        $name = escape($_POST['name']);
        $email = escape($_POST['email']);
        $address = escape($_POST['address']);
        $tax_id = escape($_POST['tax_id']);
        $photo_path = $_POST['photo_path'];

        $stmt = $con->prepare("UPDATE kompanije SET name = ?, email = ?, address = ?, tax_id = ?, logo = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("ssssss", $name, $email, $address, $tax_id, $photo_path, $member_id);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
               redirect("index.php");
               exit();
                $response['status'] = 'success';
                $response['message'] = 'Korisnički podaci uspešno ažurirani.';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Greška prilikom ažuriranja podataka ili nema promena.';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Greška u pripremi upita: ' . $con->error;
            $stmt->close();
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Svi podaci nisu prosleđeni.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Nevažeći zahtev.';
}
// Slanje JSON odgovora
echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
