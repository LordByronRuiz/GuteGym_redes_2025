<?php
header('Content-Type: application/json');
include_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        
        try {
            $stmt = $pdo->prepare("SELECT id, name FROM routines WHERE user_id = ?");
            $stmt->execute([$user_id]);
            $routines = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode(['success' => true, 'routines' => $routines]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error al obtener rutinas.']);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!empty($data['user_id']) && !empty($data['name'])) {
        $user_id = $data['user_id'];
        $name = $data['name'];
        
        try {
            $stmt = $pdo->prepare("INSERT INTO routines (user_id, name) VALUES (?, ?)");
            $stmt->execute([$user_id, $name]);
            
            echo json_encode(['success' => true, 'message' => 'Rutina creada correctamente.']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error al crear rutina.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
    }
}
?>