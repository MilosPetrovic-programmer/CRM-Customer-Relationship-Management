<?php
include '../functions/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['company_id'])) {
        $company_id = (int)$_GET['company_id'];

        // Pripremanje SQL upita
        $stmt = $con->prepare('SELECT * FROM klijenti WHERE company_id = ?');
        
        if ($stmt) {
            // Bindovanje parametra
            $stmt->bind_param('i', $company_id);

            // Izvršavanje upita
            $stmt->execute();

            // Dohvatanje rezultata
            $result = $stmt->get_result();
            $clients = $result->fetch_all(MYSQLI_ASSOC);

            // Vraćanje rezultata u JSON formatu
            echo json_encode($clients);

            // Zatvaranje statement-a
            $stmt->close();
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Database query failed']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Bad Request: company_id is required']);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Method Not Allowed']);
}
?>
