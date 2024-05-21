<?php
include "functions/init.php"; // Ovo uključuje session_start(), db.php i functions.php

header('Content-Type: application/json; charset=UTF-8'); // Postavljanje Content-Type na application/json

$response = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['member_id']) && isset($_POST['name']) && isset($_POST['username']) && isset($_POST['email'])) {
        $member_id = escape($_POST['member_id']);
        $name = escape($_POST['name']);
        $username = escape($_POST['username']);
        $email = escape($_POST['email']);

        // Provera da li je trenutni korisnik super admin
        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 2) {
            // Ako je super admin, može da ažurira i ulogu korisnika
            if (isset($_POST['is_admin'])) {
                $is_admin = escape($_POST['is_admin']);

                // Priprema i izvršenje SQL upita sa pripremljenom izjavom
                $stmt = $con->prepare("UPDATE korisnici SET name = ?, username = ?, email = ?, is_admin = ? WHERE id = ?");
                if ($stmt) {
                    $stmt->bind_param("sssii", $name, $username, $email, $is_admin, $member_id);
                    $stmt->execute();
                    if ($stmt->affected_rows > 0) {
                        redirect("index.php");
                        exit();
                        // echo "Korisnički podaci uspešno ažurirani.";
                        $response['status'] = 'success';
                        $response['message'] = 'Korisnički podaci uspešno ažurirani.';
                    } else {
                        //echo "Greška prilikom ažuriranja podataka ili nema promena.";
                        $response['status'] = 'error';
                        $response['message'] = 'Greška prilikom ažuriranja podataka ili nema promena.';
                    }
                } else {
                    //echo "Greška u pripremi upita: " . $con->error;
                    $response['status'] = 'error';
                    $response['message'] = 'Greška u pripremi upita: ' . $con->error;
                    $stmt->close();
                }
            } else {
                // Ako nije prosleđena uloga, ažuriraju se samo osnovni podaci
                $stmt = $con->prepare("UPDATE korisnici SET name = ?, username = ?, email = ? WHERE id = ?");
                if ($stmt) {
                    $stmt->bind_param("sssi", $name, $username, $email, $member_id);
                    $stmt->execute();
                    if ($stmt->affected_rows > 0) {
                        redirect("index.php");
                        exit();
                        // echo "Korisnički podaci uspešno ažurirani.";
                        $response['status'] = 'success';
                        $response['message'] = 'Korisnički podaci uspešno ažurirani.';
                    } else {
                        //echo "Greška prilikom ažuriranja podataka ili nema promena.";
                        $response['status'] = 'error';
                        $response['message'] = 'Greška prilikom ažuriranja podataka ili nema promena.';
                    }
                } else {
                    //echo "Greška u pripremi upita: " . $con->error;
                    $response['status'] = 'error';
                    $response['message'] = 'Greška u pripremi upita: ' . $con->error;
                    $stmt->close();
                }
            }
        } else {
            // Ako trenutni korisnik nije super admin, ažuriraju se samo osnovni podaci
            $stmt = $con->prepare("UPDATE korisnici SET name = ?, username = ?, email = ? WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("sssi", $name, $username, $email, $member_id);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    redirect("index.php");
                    exit();
                    // echo "Korisnički podaci uspešno ažurirani.";
                    $response['status'] = 'success';
                    $response['message'] = 'Korisnički podaci uspešno ažurirani.';
                } else {
                    //echo "Greška prilikom ažuriranja podataka ili nema promena.";
                    $response['status'] = 'error';
                    $response['message'] = 'Greška prilikom ažuriranja podataka ili nema promena.';
                }
            } else {
                //echo "Greška u pripremi upita: " . $con->error;
                $response['status'] = 'error';
                $response['message'] = 'Greška u pripremi upita: ' . $con->error;
                $stmt->close();
            }
        }
    } else {
        //echo "Svi podaci nisu prosleđeni.";
        $response['status'] = 'error';
        $response['message'] = 'Greška sa prosledjivanjem podataka';
    }
} else {
    //echo "Nevažeći zahtev.";
    $response['status'] = 'error';
    $response['message'] = 'Nevazec zahtev';
}

// Slanje JSON odgovora
echo json_encode($response, JSON_UNESCAPED_UNICODE);

?>
