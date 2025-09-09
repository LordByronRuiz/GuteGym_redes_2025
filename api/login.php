<?php
header('Content-Type: application/json');
include_once __DIR__ . '/../config/database.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data['email']) && !empty($data['password'])) {
    $email = $data['email'];
    $password = $data['password'];
    
    try {
        $stmt = $pdo->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            // Eliminar password del resultado
            unset($user['password']);
            echo json_encode(['success' => true, 'user' => $user]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Credenciales incorrectas.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error en el servidor.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}
?>