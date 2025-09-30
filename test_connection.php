<?php
header('Content-Type: text/plain');

echo "=== Test de Conexión a Base de Datos ===\n\n";

// Probando diferentes configuraciones comunes
$configs = [
    ['host' => 'localhost', 'user' => 'root', 'pass' => ''],
    ['host' => '127.0.0.1', 'user' => 'root', 'pass' => ''],
    ['host' => 'server-prog', 'user' => 'phpmyadmin', 'pass' => 'RedesInformaticas'],
    ['host' => 'server-prog', 'user' => 'phpmyadmin', 'pass' => 'RedesInformaticas'],

];

$dbname = 'gymtrack_db';

foreach ($configs as $config) {
    echo "Probando: {$config['host']} con usuario {$config['user']}\n";
    
    try {
        $pdo = new PDO("mysql:host={$config['host']};dbname=$dbname", $config['user'], $config['pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Verificar si la base de datos existe
        $stmt = $pdo->query("SELECT DATABASE() as db");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo "✅ CONEXIÓN EXITOSA - Base de datos: {$result['db']}\n";
        echo "✅ ¡Esta configuración funciona!\n\n";
        
        // Guardar configuración exitosa
        file_put_contents('working_config.txt', json_encode($config));
        break;
        
    } catch (PDOException $e) {
        echo "❌ Error: " . $e->getMessage() . "\n\n";
    }
}

// Verificar si MySQL está corriendo
echo "=== Verificando estado de MySQL ===\n";
exec('netstat -tulpn 2>/dev/null | grep :3306', $output);
if (!empty($output)) {
    echo "✅ MySQL parece estar corriendo en puerto 3306\n";
} else {
    echo "❌ MySQL no parece estar corriendo en puerto 3306\n";
}

echo "\n=== Fin del test ===\n";
?>