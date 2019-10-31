<?php

function erreur(int $code, string $message) {
    http_response_code($code);

    echo json_encode([
        'code' => $code,
        'message' => $message
    ]);
    exit(1);
}

function succes() {
    http_response_code(200);
    echo json_encode(['code' => 200, 'message' => "Succès"]);
    exit(0);
}
