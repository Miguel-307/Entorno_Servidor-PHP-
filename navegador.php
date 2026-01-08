<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestor de Archivos PHP</title>
  <style>
    :root {
      --bg: #0e0e10;
      --card: #1e1e22;
      --accent: #00a8ff;
      --accent-hover: #4cd2ff;
      --danger: #e84118;
      --danger-hover: #c23616;
      --text: #f5f6fa;
      --muted: #888;
      --success: #4cd137;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--bg);
      margin: 0;
      padding: 30px;
      color: var(--text);
    }

    h1 {
      text-align: center;
      color: var(--accent);
      margin-bottom: 20px;
      letter-spacing: 1px;
    }

    .form-container {
      display: flex;
      justify-content: center;
      margin-bottom: 30px;
    }

    form {
      background: var(--card);
      padding: 20px 25px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0, 168, 255, 0.2);
      width: auto;
      color: var(--text);
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    label {
      font-weight: bold;
      font-size: 0.9em;
      color: var(--accent);
    }

    input[type="text"] {
      width: 100%;
      padding: 8px;
      border: 1px solid #333;
      border-radius: 6px;
      background: #141417;
      color: var(--text);
      font-size: 1em;
    }

    input[type="submit"] {
      background: var(--accent);
      border: none;
      color: white;
      border-radius: 6px;
      padding: 8px 15px;
      cursor: pointer;
      transition: 0.2s;
      font-weight: bold;
    }

    input[type="submit"]:hover {
      background: var(--accent-hover);
    }

    hr {
      border: none;
      height: 1px;
      background: rgba(255,255,255,0.2);
      margin: 30px 0;
    }

    .back {
      display: inline-block;
      margin-bottom: 20px;
      text-decoration: none;
      background: var(--accent);
      padding: 6px 12px;
      border-radius: 8px;
      color: white;
      font-weight: bold;
      transition: 0.3s;
    }

    .back:hover {
      background: var(--accent-hover);
    }

    .message {
      text-align: center;
      padding: 10px;
      margin: 15px auto;
      width: 60%;
      border-radius: 8px;
      font-weight: bold;
    }

    .success { background-color: rgba(76, 209, 55, 0.15); color: var(--success); }
    .warning { background-color: rgba(255, 211, 42, 0.15); color: #ffd32a; }
    .error   { background-color: rgba(232, 65, 24, 0.15); color: var(--danger); }

    .flex-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }

    .card {
      background: var(--card);
      border-radius: 12px;
      padding: 15px;
      width: 180px;
      height: 170px;
      text-align: center;
      box-shadow: 0 0 8px rgba(0,0,0,0.3);
      transition: 0.25s ease;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 0 12px rgba(0,168,255,0.3);
    }

    .icon {
      font-size: 42px;
      margin-bottom: 10px;
    }

    .folder { color: #fbc531; }
    .file { color: var(--accent); }

    a {
      text-decoration: none;
      color: var(--text);
      font-weight: bold;
      word-wrap: break-word;
      font-size: 14px;
    }

    .actions { display: flex; justify-content: center; }

    .delete-btn {
      background-color: var(--danger);
      color: white;
      border: none;
      border-radius: 6px;
      padding: 5px 10px;
      cursor: pointer;
      font-size: 0.85em;
      transition: 0.2s;
    }

    .delete-btn:hover {
      background-color: var(--danger-hover);
      transform: scale(1.05);
    }
  </style>
</head>
<body>

<h1>📁 Gestor de Archivos PHP</h1>

<div class="form-container">
  <form method="post">
    <label>Nombre de carpeta (opcional):</label>
    <input type="text" name="carpeta" placeholder="Ej: nueva_carpeta">

    <label>Nombre del archivo (con extensión):</label>
    <input type="text" name="archivo" placeholder="Ej: index.php, notas.txt, style.css">

    <input type="submit" name="accion" value="Crear">
  </form>
</div>

<hr>

<?php
// 📂 Carpeta base
$base = realpath('C:/xampp/htdocs/');

// 📍 Ruta actual
$subruta = isset($_GET['ruta']) ? $_GET['ruta'] : '';
$ruta_actual = realpath($base . DIRECTORY_SEPARATOR . $subruta);

// 🚫 Seguridad: impedir acceso fuera de la carpeta base
if ($ruta_actual === false || strpos($ruta_actual, $base) !== 0) {
  die("<div class='message error'>❌ Acceso no permitido.</div>");
}

// 🗑️ Función recursiva para eliminar carpetas
function eliminarCarpeta($dir) {
  if (!file_exists($dir)) return;
  foreach (scandir($dir) as $item) {
    if ($item == '.' || $item == '..') continue;
    $path = $dir . DIRECTORY_SEPARATOR . $item;
    is_dir($path) ? eliminarCarpeta($path) : unlink($path);
  }
  rmdir($dir);
}

// ⚙️ ELIMINAR
if (isset($_GET['delete'])) {
  $target = $ruta_actual . DIRECTORY_SEPARATOR . basename($_GET['delete']);
  if (is_file($target)) {
    unlink($target);
    echo "<div class='message success'>🗑️ Archivo eliminado correctamente.</div>";
  } elseif (is_dir($target)) {
    eliminarCarpeta($target);
    echo "<div class='message success'>🗑️ Carpeta eliminada correctamente.</div>";
  }
}

// ⚙️ CREAR ARCHIVO / CARPETA
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
  $nombre_carpeta = trim($_POST['carpeta']);
  $nombre_archivo = trim($_POST['archivo']);
  $ruta_destino = $ruta_actual;

  if ($nombre_carpeta !== '') {
    $ruta_destino .= DIRECTORY_SEPARATOR . $nombre_carpeta;
    if (!file_exists($ruta_destino)) {
      mkdir($ruta_destino, 0777, true);
      echo "<div class='message success'>✅ Carpeta '$nombre_carpeta' creada correctamente.</div>";
    }
  }

  if ($nombre_archivo !== '') {
    $ruta_archivo = $ruta_destino . DIRECTORY_SEPARATOR . $nombre_archivo;
    if (!file_exists($ruta_archivo)) {
      file_put_contents($ruta_archivo, '');
      echo "<div class='message success'>✅ Archivo '$nombre_archivo' creado correctamente.</div>";
    } else {
      echo "<div class='message warning'>⚠️ El archivo '$nombre_archivo' ya existe.</div>";
    }
  }
}

// 🔙 BOTÓN VOLVER
if ($subruta) {
  $ruta_padre = dirname($subruta);
  echo "<a class='back' href='?ruta=" . urlencode($ruta_padre) . "'>⬅️ Volver atrás</a>";
}

// 📋 LISTAR
$elementos = scandir($ruta_actual);
echo "<div class='flex-container'>";
foreach ($elementos as $item) {
  if ($item == '.' || $item == '..') continue;

  $ruta_relativa = $subruta ? $subruta . DIRECTORY_SEPARATOR . $item : $item;
  $ruta_completa = $ruta_actual . DIRECTORY_SEPARATOR . $item;

  if (is_dir($ruta_completa)) {
    echo "
      <div class='card'>
        <div class='icon folder'>📁</div>
        <a href='?ruta=" . urlencode($ruta_relativa) . "'>$item</a>
        <div class='actions'>
          <form method='get' onsubmit=\"return confirm('¿Eliminar carpeta y su contenido?')\">
            <input type='hidden' name='ruta' value='" . htmlspecialchars($subruta) . "'>
            <input type='hidden' name='delete' value='" . htmlspecialchars($item) . "'>
            <button class='delete-btn'>Eliminar</button>
          </form>
        </div>
      </div>";
  } else {
    echo "
      <div class='card'>
        <div class='icon file'>📄</div>
        <a href='" . htmlspecialchars($ruta_relativa) . "' target='_blank'>$item</a>
        <div class='actions'>
          <form method='get' onsubmit=\"return confirm('¿Eliminar este archivo?')\">
            <input type='hidden' name='ruta' value='" . htmlspecialchars($subruta) . "'>
            <input type='hidden' name='delete' value='" . htmlspecialchars($item) . "'>
            <button class='delete-btn'>Eliminar</button>
          </form>
        </div>
      </div>";
  }
}
echo "</div>";
?>
</body>
</html>
