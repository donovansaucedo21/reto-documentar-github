# Proyecto Contador de Visitas PHP

Este proyecto implementa una API para contar las visitas a una página web utilizando un servidor MySQL y Docker Compose.

## Funcionalidades

- Conexión mediante PDO a una base de datos MySQL.
- Creación automática de la tabla 'visitas' en caso de que no exista.
- Inserción de un nuevo registro con *timestamp* en cada ejecución.
- Consulta y muestra el número total de visitas registradas.

## Requisitos previos

Antes de instalar el proyecto, asegúrate de tener:
- Docker y Docker Compose instalados.
- Un entorno compatible con contenedores Linux.
- Un navegador web.

## Instalación

1. **Clonar el repositorio**:
	```bash
	git clone [https://github.com/donovansaucedo21/reto-documentar-github.git](https://github.com/donovansaucedo21/reto-documentar-github.git)
	```

## Uso

### Acceso a la Aplicación
Una vez levantados los contenedores, abre tu navegador web e ingresa a:

[http://localhost/index.php](http://localhost/index.php)

Verás el mensaje "Proyecto Funcionando" y el contador de visitas incrementándose cada vez que recargues la página.

## Estructura del Proyecto

El repositorio tiene la siguiente organización:

```text
/proyecto_web_compose
├── Caddyfile            # Configuración del servidor web Caddy
├── docker-compose.yml   # Orquestación de contenedores
├── php/
│   └── Dockerfile       # Configuración de la imagen PHP
├── src/
│   ├── .phpdoc/         # Configuración de PHPDocumentor
│   ├── docs/            # Documentación generada (HTML)
│   └── index.php        # Código fuente principal
└── README.md            # Instrucciones del proyecto
```

## Configuración y credenciales

El proyecto ya viene preconfigurado para funcionar en Docker con las siguientes credenciales:

- **Host**: `db` Nombre del servicio en Docker.
- **Base de Datos**: `dwes` Nombre de la base de datos.
- **Usuario**: `dwes` Usuario MySQL.
- **Contraseña**: `dwes` Cpntraseña de acceso.

## Código Fuente Principal

A continuación se muestra la lógica del archivo `index.php`:

```php
<?php
define('DB_DSN', 'mysql:host=db;dbname=dwes;charset=utf8mb4');
define('DB_USER', 'dwes');
define('DB_PASS', 'dwes');

function conectarBaseDatos(): PDO
{
    return new PDO(DB_DSN, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}

function registrarNuevaVisita(PDO $pdo): void
{
    $pdo->exec("CREATE TABLE IF NOT EXISTS visitas (id INT AUTO_INCREMENT PRIMARY KEY, ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
    $pdo->exec("INSERT INTO visitas () VALUES ()");
}

function obtenerVisitas(PDO $pdo): int
{
    $stmt = $pdo->query("SELECT COUNT(*) FROM visitas");
    return (int) $stmt->fetchColumn();
}

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
```

## Contribución

1. Haz un Fork del proyecto.
2. Crea una rama para tu funcionalidad (`git checkout -b feature/nueva-funcionalidad`).
3. Realiza tus cambios (`git commit -m 'Añadir nueva funcionalidad'`).
4. Haz Push a la rama (`git push origin feature/nueva-funcionalidad`).
5. Abre un Pull Request.

## Autor

- **Donovan Saucedo Villarroel**
- Asignatura: Despliegue de Aplicaciones Web
