<?php
include_once 'validar.php';

// Solo procesamos si el formulario se envió por POST
// Visualización de los datos del archivo a registrar a través
// de la función print_r($POST)
//echo "Datos del bolígrafo a registrar";
echo "<h2>Datos del bolígrafo a registrar</h2>"; 
print_r($_POST);
if (isset($_POST['registrar'])) {

    //Recoger los datos enviados por el formulario
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email_disenador'];
    $material = $_POST['material'];
    $precio = $_POST['precio'];
    $tipo = $_POST['estuche'];

    //Array para guardar errores que son de tipo string
    $errores = [];
    
    /* $errores en un array de strings */

    // Validar cada campo usando las funciones del archivo validaciones.php
    // En caso de ser incorrecto añadir al array $errores
    // el mensaje oportuno
    if (validarCodigo($codigo) == 0) {
        $errores[] = "❌ El código de serie no es válido. Ejemplo correcto: BLG-1234.";
    }

    if (validarNombre($nombre) == 0) {
        $errores[] = "❌ El nombre no es válido. Debe contener entre 10 y 50 caractere.s";
    }

    if (validarEmail($email) == 0) {
        $errores[] = "❌ El email no es válido. Ejemplo correcto: example@example.com.";
    }

    if (validarMaterial($material) == 0) {
        $errores[] = "❌ El material no es válido. Están permitidos los siguientes: 'oro',
        'platino', 'rodio', 'paladio' o 'carbono'.";
    }

    if (validarPrecio($precio) == 0) {
        $errores[] = "❌ El precio no es válido. Debe ser un número no menor a 30000.";
    }

    if (validarEstuche($tipo) == 0) {
        $errores[] = "❌ El tipo de estuche no es válido. Están permitidos: 'Piel italiana' y 'Estuche de lujo'.";
    }

    // Si hay errores, los mostramos y detenemos el script
    // La detención del script se ha realizado mendiante la instrucción
    // exit()

    if (!empty($errores)){
      echo "<h2>⛔Listado de errores</h2>";
      foreach ($errores as $key => $value){
        echo "<p>" . $value . "</p>";
      }
      exit();
    }

    
    
    /* NO TOCAR CODIGO: inicio************************ */
    $archivo = 'boligrafos.json';
    if (file_exists($archivo)) {
    $boligrafos = json_decode(file_get_contents($archivo), true);
    // Si el JSON está vacío o es inválido, inicializar como array vacío
    if (!is_array($boligrafos)) {
        $boligrafos = [];
    }
    } else {
    $boligrafos = [];
    }
    /* fin****************************************/

    // Crear el array asociativo del bolígrafo validado

    $boligrafo = [
        'codigo' => strtoupper($codigo),
        'nombre' => trim($nombre),
        'email_disenador' => strtolower($email),
        'material' => $material,
        'precio' => floatval($precio),
        'estuche' => $tipo,
    ];

    // Realizado: Añado el bolígrafo al array $boligrafos
    $boligrafos[] = $boligrafo;
    
    /* NO TOCAR:inicio */
    file_put_contents($archivo, json_encode($boligrafos, JSON_PRETTY_PRINT));
    /* fin: ******************************************** */

    //Realizado: muestro confirmación
    echo "<h3>👍Bolígrafo registrado correctamente</h3>";
    echo "<h3>Datos registrados:</h3>";
    echo "<pre>";
    print_r($boligrafo);
    echo "</pre>";

    echo "<p><a href='registrar.php'>Registrar otro bolígrafo</a></p>";
    echo "<p><a href='index.php'>Menú principal</a></p>";
   
} else {
    echo "<h3>No se ha enviado ningún formulario.</h3>";
}
?>
