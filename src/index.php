<?php
/**
 * Contador de Visitas.
 *
 * Este código implementa un contador de visitas usando un servidor MySQL.
 *
 * @package    ProyectoVisitas
 * @author     Donovan Saucedo Villarroel
 * @version    1.0.0
 * @link       http://localhost/index.php
 */

// Configuración con credenciales.
define('DB_DSN', 'mysql:host=db;dbname=dwes;charset=utf8mb4');
define('DB_USER', 'dwes');
define('DB_PASS', 'dwes');

/**
 * Conecta a la base de datos MySQL.
 *
 * @return Objeto PDO de conexión activo.
 * @throws PDOException si falla la conexión o las credenciales son incorrectas.
 */
function conectarBaseDatos(): PDO
{
    return new PDO(DB_DSN, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}

/**
 * Inicializa la tabla y registra una nueva visita.
 *
 * Ejecuta las sentencias CREATE e INSERT necesarias.
 *
 * @param PDO $pdo Conexión activa a la base de datos.
 * @return void
 */
function registrarNuevaVisita(PDO $pdo): void
{
    $pdo->exec("CREATE TABLE IF NOT EXISTS visitas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    $pdo->exec("INSERT INTO visitas () VALUES ()");
}

/**
 * Obtiene el número actual de visitas.
 *
 * @param PDO $pdo Conexión activa.
 * @return int con el total de visitas registradas.
 */
function obtenerVisitas(PDO $pdo): int
{
    $stmt = $pdo->query("SELECT COUNT(*) FROM visitas");
    return (int) $stmt->fetchColumn();
}

//--------------------------------
//Ejecución principal.
//--------------------------------

try {
    $db = conectarBaseDatos();
    registrarNuevaVisita($db);
    $total = obtenerVisitas($db);

    echo "<h1>Proyecto Funcionando</h1>";
    echo "<p>Total de visitas: <strong>$total</strong></p>";
} catch (Throwable $e) {
    echo "<h1>Error</h1><p>" . $e->getMessage() . "</p>";
}
?>
