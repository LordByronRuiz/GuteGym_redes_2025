<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

include_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!empty($data['user_id']) && !empty($data['routine_id'])) {
        $user_id = $data['user_id'];
        $routine_id = $data['routine_id'];
        $start_time = date('Y-m-d H:i:s');
        
        try {
            $stmt = $pdo->prepare("INSERT INTO workout_sessions (user_id, routine_id, start_time) VALUES (?, ?, ?)");
            $stmt->execute([$user_id, $routine_id, $start_time]);
            $session_id = $pdo->lastInsertId();
            
            echo json_encode(['success' => true, 'session_id' => $session_id]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error al crear sesión: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!empty($data['session_id'])) {
        $session_id = $data['session_id'];
        $end_time = date('Y-m-d H:i:s');
        $duration = $data['duration'] ?? 0;
        
        try {
            // Actualizar sesión
            $stmt = $pdo->prepare("UPDATE workout_sessions SET end_time = ?, duration = ? WHERE id = ?");
            $stmt->execute([$end_time, $duration, $session_id]);
            
            // Guardar cambios en los ejercicios si se solicita
            if (!empty($data['save_changes']) && $data['save_changes'] === true && !empty($data['exercises'])) {
                foreach ($data['exercises'] as $exercise) {
                    if (!empty($exercise['id'])) {
                        // Actualizar ejercicio existente
                        if (!empty($exercise['weight'])) {
                            $stmt = $pdo->prepare("UPDATE exercises SET weight = ? WHERE id = ?");
                            $stmt->execute([$exercise['weight'], $exercise['id']]);
                        }
                        
                        // Guardar progreso
                        $sets_completed = $exercise['sets_completed'] ?? 0;
                        $stmt = $pdo->prepare("INSERT INTO exercise_progress (session_id, exercise_id, sets_completed, weight_used) VALUES (?, ?, ?, ?)");
                        $stmt->execute([$session_id, $exercise['id'], $sets_completed, $exercise['weight'] ?? null]);
                    }
                }
            }
            
            echo json_encode(['success' => true, 'message' => 'Sesión guardada correctamente.']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error al guardar sesión: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID de sesión requerido.']);
    }
}
?>