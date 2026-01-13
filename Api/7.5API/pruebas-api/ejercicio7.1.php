<?php

$url ='https://randomuser.me/api/';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

if ($response === false) {
    echo "Error en la consulta: " . curl_error($ch);
    curl_close($ch);
    exit;
}
curl_close($ch);
$data = json_decode($response, true);

if (isset($data['results'][0])) {
    $user = $data['results'][0];
    echo "Nombre: " . $user['name']['first'] . " " . $user['name']['last'] . "<br>";
    echo "Email: " . $user['email'] . "<br>";
    echo "País: " . $user['location']['country'] . "<br>";
    echo "<img src='" . $user['picture']['large'] . "' alt='Foto de usuario'><br>";
    echo "Street: " . $user['location']['street']['number'] . " " . $user['location']['street']['name'] . "<br>";
} else {
    echo "No se pudo obtener la información del usuario.";
}
?>
