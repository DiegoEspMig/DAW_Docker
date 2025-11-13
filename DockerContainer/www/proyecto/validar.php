<?php
// registrar_boligrafo.php

/* 
1 - No olvidés que en cada función hay que 
Eliminar los espacios en blanco al inicio y al final del nombre 
(usando trim()).
*/

/* Enunciados */
// Función para validar el código de serie
/* Diseñar una función en PHP llamada validarCodigo, que reciba de 
parámetro un código, compruebe si dicho código corresponde a un 
código de serie válido de un bolígrafo.
El código de serie debe cumplir las siguientes condiciones:
No es vacío y Comienza con tres letras mayúsculas, seguidas de un guion y 
cuatro números.
La función devolverá 1 si es válido y en caso contrario 0.
*/

function validarCodigo($cod){
  $cod = trim($cod);
  if (!empty($cod) && preg_match('/^[A-Z]{3}\-\d{4}$/', $cod)){
    return 1;
  } else {
    return 0;
  }
}

// Función para validar el nombre
/* Crea una función en PHP llamada validarNombre, que reciba de  
 parámetro un nombre, compruebe si corresponde a un nombre
 válido de un bolígrafo.
 El nombre debe cumplir las siguientes condiciones:
 No es vacío y comprobar que el nombre tenga 
 entre 10 y 50 caracteres, ambos inclusive.
 La función devolverá 1 si es válido y en caso contrario 0.*/

function validarNombre($nombre){
  $nombre = trim($nombre);
  if (!empty($nombre) && strlen($nombre >= 10 && strlen($nombre) <= 50)){
    return 1;
  } else {
    return 0;
  }
}

// Función para validar email del diseñador
/* Crea una función en PHP llamada validarEmail, que reciba de parámetro 
un email y compruebe si es un email válido.

El email no estará vacío y comprobar que el enail cumpla 
con el formato estándar (nombre@dominio.ext).
La función devolverá 1 si es válido y en caso contrario 0.*/

function validarEmail($email){
  $email = trim($email);
  if (!empty($email) && !empty(filter_var($email, FILTER_VALIDATE_EMAIL))){
    return 1;
  } else {
    return 0;
  }
}

// Función para validar el material
/* Crea una función en PHP llamada validarMaterial, que 
reciba de parámetro un material y compruebe 
si es un material válido.
El material no estará vacío y tendrá un valor permitido entre los siguientes: 'oro',
 'platino', 'rodio', 'paladio' o 'carbono'.
 La función devolverá 1 si es válido y en caso contrario 0.*/

function validarMaterial($material){
  $material = trim($material);
  $validos = array('oro', 'platino', 'rodio', 'paladio', 'carbono');
  if (!empty($material) && in_array($material, $validos)){
    return 1;
  } else {
    return 0;
  }
}

// Función para validar precio
/* Crea una función en PHP llamada validarPrecio($precio) 
que reciba de parámetro el precio de un bolígrafo de lujo y
compruebe si es válido.
El precio no estará vacío y que sea un número válido (is_numeric), y 
que el precio no sea menor de 30000 €.
La función devolverá 1 si es válido y en caso contrario 0.
*/

function validarPrecio($precio){
  $precio = trim($precio);
  if (!empty($precio) && is_numeric($precio) && $precio >= 30000){
    return 1;
  } else {
    return 0;
  }
}

// Función para validar tipo de estuche
/* Crea una función en PHP llamada validarEstuche, que 
reciba de parámetro un tipo de estuche y compruebe 
si es un estuche válido.
El tipo de estuche no estará vacío y tendrá un valor permitido: 'piel_italiana' o 
'estuche_lujo',
La función devolverá 1 si es válido y en caso contrario 0.*/

function validarEstuche($tipoEstuche){
  $tipoEstuche = trim($tipoEstuche);
  if (!empty($tipoEstuche) && ($tipoEstuche == 'piel_italiana' || $tipoEstuche == 'estuche_lujo')){
    return 1;
  } else {
    return 0;
  }
}

?>