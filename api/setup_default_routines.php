<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Manejar preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Incluir configuración con manejo de errores mejorado
$config_path = __DIR__ . '/../config/database.php';
if (!file_exists($config_path)) {
    echo json_encode(['success' => false, 'message' => 'Archivo de configuración no encontrado: ' . $config_path]);
    exit;
}

include_once $config_path;

// Verificar si la conexión se estableció
if (!isset($pdo)) {
    echo json_encode(['success' => false, 'message' => 'Conexión a BD no inicializada']);
    exit;
}

// Rutinas predeterminadas
$defaultRoutines = [
    'Principiante - Fuerza Base' => [
        ['name' => 'Sentadillas', 'sets' => 3, 'reps' => 10, 'weight' => 20],
        ['name' => 'Press de Banca', 'sets' => 3, 'reps' => 8, 'weight' => 30],
        ['name' => 'Peso Muerto', 'sets' => 3, 'reps' => 8, 'weight' => 40],
        ['name' => 'Press Militar', 'sets' => 3, 'reps' => 10, 'weight' => 15],
        ['name' => 'Dominadas Asistidas', 'sets' => 3, 'reps' => 6, 'weight' => 0]
    ],
    'Intermedio - Hipertrofia' => [
        ['name' => 'Sentadillas', 'sets' => 4, 'reps' => 8, 'weight' => 40],
        ['name' => 'Press de Banca', 'sets' => 4, 'reps' => 8, 'weight' => 50],
        ['name' => 'Remo con Barra', 'sets' => 4, 'reps' => 10, 'weight' => 35],
        ['name' => 'Press Militar', 'sets' => 4, 'reps' => 10, 'weight' => 25],
        ['name' => 'Curl de Bíceps', 'sets' => 3, 'reps' => 12, 'weight' => 15],
        ['name' => 'Extensiones de Tríceps', 'sets' => 3, 'reps' => 12, 'weight' => 20]
    ],
    'Avanzado - Fuerza Máxima' => [
        ['name' => 'Sentadillas Pesadas', 'sets' => 5, 'reps' => 5, 'weight' => 60],
        ['name' => 'Press de Banca', 'sets' => 5, 'reps' => 5, 'weight' => 70],
        ['name' => 'Peso Muerto', 'sets' => 3, 'reps' => 5, 'weight' => 80],
        ['name' => 'Press Militar', 'sets' => 4, 'reps' => 6, 'weight' => 35],
        ['name' => 'Dominadas con Peso', 'sets' => 4, 'reps' => 6, 'weight' => 10]
    ]
];

try {
    // Verificar que la base de datos existe
    $stmt = $pdo->query("SELECT DATABASE() as db_name");
    $db_info = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (empty($db_info['db_name'])) {
        echo json_encode(['success' => false, 'message' => 'No se pudo seleccionar la base de datos. Verifica que exista.']);
        exit;
    }
    
    $created_count = 0;
    $errors = [];
    
    // Insertar rutinas predeterminadas
    foreach ($defaultRoutines as $routineName => $exercises) {
        try {
            // Verificar si la rutina ya existe
            $stmt = $pdo->prepare("SELECT id FROM routines WHERE name = ? AND user_id IS NULL");
            $stmt->execute([$routineName]);
            
            if ($stmt->rowCount() == 0) {
                // Insertar rutina con user_id NULL para rutinas predeterminadas
                $stmt = $pdo->prepare("INSERT INTO routines (name, user_id, is_default) VALUES (?, NULL, TRUE)");
                $stmt->execute([$routineName]);
                $routineId = $pdo->lastInsertId();
                
                // Insertar ejercicios
                foreach ($exercises as $exercise) {
                    $stmt = $pdo->prepare("INSERT INTO exercises (routine_id, name, sets, reps, weight) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([$routineId, $exercise['name'], $exercise['sets'], $exercise['reps'], $exercise['weight']]);
                }
                
                $created_count++;
            }
        } catch (PDOException $e) {
            $errors[] = "Error con rutina '$routineName': " . $e->getMessage();
        }
    }
    
    if ($created_count > 0) {
        $message = "Se crearon $created_count rutinas predeterminadas correctamente.";
        if (!empty($errors)) {
            $message .= " Errores: " . implode('; ', $errors);
        }
        echo json_encode(['success' => true, 'message' => $message]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se crearon rutinas. Posiblemente ya existían. Errores: ' . implode('; ', $errors)]);
    }
    
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error de base de datos: ' . $e->getMessage()]);
}
?>