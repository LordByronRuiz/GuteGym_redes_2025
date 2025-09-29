<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
include_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['routine_id'])) {
        $routine_id = $_GET['routine_id'];
        
        try {
            // Obtener nombre de la rutina
            $stmt = $pdo->prepare("SELECT name FROM routines WHERE id = ?");
            $stmt->execute([$routine_id]);
            $routine = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Obtener ejercicios
            $stmt = $pdo->prepare("SELECT id, name, sets, reps, weight FROM exercises WHERE routine_id = ?");
            $stmt->execute([$routine_id]);
            $exercises = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode([
                'success' => true, 
                'routine_name' => $routine['name'],
                'exercises' => $exercises
            ]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error al obtener ejercicios.']);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!empty($data['routine_id']) && !empty($data['name']) && 
        !empty($data['sets']) && !empty($data['reps']) && !empty($data['weight'])) {
        
        $routine_id = $data['routine_id'];
        $name = $data['name'];
        $sets = $data['sets'];
        $reps = $data['reps'];
        $weight = $data['weight'];
        
        try {
            $stmt = $pdo->prepare("INSERT INTO exercises (routine_id, name, sets, reps, weight) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$routine_id, $name, $sets, $reps, $weight]);
            
            echo json_encode(['success' => true, 'message' => 'Ejercicio añadido correctamente.']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error al añadir ejercicio.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
    }
    
}
elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['exercise_id'])) {
        $exercise_id = $_GET['exercise_id'];
        
        try {
            $stmt = $pdo->prepare("DELETE FROM exercises WHERE id = ?");
            $stmt->execute([$exercise_id]);
            
            echo json_encode(['success' => true, 'message' => 'Ejercicio eliminado correctamente.']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar ejercicio.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID de ejercicio requerido.']);
    }
}
?>