<?php

include "functions/init.php";

header('Content-Type: application/json; charset=UTF-8'); // Postavljanje Content-Type na application/json

$response = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $member_id = escape($_POST['member_id']);

    // Priprema i izvršenje SQL upita sa pripremljenom izjavom
    $stmt = $con->prepare("DELETE FROM klijenti WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $member_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            redirect("index.php"); // Preusmerava na početnu stranu
            exit();
            //echo "Klijent uspešno obrisan.";
            $response['status'] = 'success';
            $response['message'] = 'Klijent je uspešno obrisan.';
        } else {
            //echo "Greška prilikom brisanja klijenta ili klijent ne postoji.";
            $response['status'] = 'error';
            $response['message'] = 'Greška prilikom brisanja klijenta ili korisnik ne postoji.';
        }     
    } else {
        //echo "Greška u pripremi upita: " . $con->error;
        $response['status'] = 'error';
        $response['message'] = 'Greška u pripremi upita: ' . $con->error;
        $stmt->close();
    }
}

// Slanje JSON odgovora
echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>