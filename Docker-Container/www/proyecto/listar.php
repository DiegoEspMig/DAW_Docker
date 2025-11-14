<?php
$archivo = 'boligrafos.json';

// Verificar si existe el archivo y leer su contenido
if (file_exists($archivo)) {
    $boligrafos = json_decode(file_get_contents($archivo), true);

    // Si el JSON está vacío o es inválido, inicializar como array vacío
    if (!is_array($boligrafos)) {
        $boligrafos = [];
    }
} else {
    $boligrafos = [];
}
?>

<?php
/* Los bolígrafos añadidos se encuentran en un array de arrays
/* asociativos, llamado boligrafos, que tienen la siguiente estuctura,
mostrada a continuación */
/* EXISTE Y NO OS TENÉIS QUE PREOCUPAR DE NADA MÁS
SI HABÉIS INSERTADO BOLÍGRAFOS CON ESO BASTA */

print_r($boligrafos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Bolígrafos</title>
</head>
<body>
 <!--

El alumno tendrá que realizar una tabla donde se visualicen
por fila cada bolígrafo. La cabecera de la tabla se ve en
el enunciado 

-->
<h1>Listado de Bolígrafos de Lujo</h1>
<?php 
  echo "<table style='border:1px solid;'>";
  echo "<tr>";
  echo "<th>Código</th>";
  echo "<th>Nombre</th>";
  echo "<th>Email del diseñador</th>";
  echo "<th>Material</th>";
  echo "<th>Precio(€)</th>";
  echo "<th>Estuche</th>";
  echo "</tr>";

  for ($i = 0; $i < count($boligrafos); $i++){
    echo "<tr>";
    foreach ($boligrafos[$i] as $key => $value){
      echo "<td>" . $value . "</td>";
    }
    echo "</tr>";
  }

  echo "</table>";
?>
<p><a href='index.php'>Menú principal</a></p>
</body>
</html>