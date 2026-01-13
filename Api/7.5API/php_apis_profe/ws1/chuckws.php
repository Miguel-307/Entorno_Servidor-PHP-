<?php
// URL del servicio web de Chuck Norris
$url = "https://api.chucknorris.io/jokes/random";

// Inicializar cURL 
//esto es para abrir la url 
$ch = curl_init($url);

// Configurar opciones

//le dice que los datos lo guardes en una variable para que no lo imprima todos 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Evita errores de conexion ssl
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Opcional, dependiendo del servidor

// Ejecutar solicitud
$response = curl_exec($ch);//enviar peticion y guardar respuesta 

// Verificar errores
if ($response === false) {//si hubo un error en la conexion
    echo "Error en la consulta: " . curl_error($ch);
    curl_close($ch);//cierra la pestaña del navegador para liberar memoria
    exit;//termina la ejecucion del script
}

curl_close($ch);

// Decodificar JSON
$data = json_decode($response, true);

// Mostrar resultado
if (isset($data['value'])) {
    echo "Chiste de Chuck Norris:<br>";
    echo $data['value'];
} else {
    echo "No se pudo obtener el chiste.";
}
?>