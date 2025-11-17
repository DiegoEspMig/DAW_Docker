# Script: borrar-sitio.ps1

$nombre = Read-Host "Introduce el nombre del sitio a borrar (ej: pagina)"
$extension = Read-Host "Introduce la extension del dominio (ej: com)"
$nombreExt = "$nombre.$extension"

Write-Host ""
Write-Host "!!! Vas a eliminar completamente el sitio: $nombreExt"
Write-Host "Esto incluye:"
Write-Host " - Configuracion Nginx"
Write-Host " - Certificados SSL"
Write-Host " - Fichero de zona DNS"
Write-Host " - Entrada en named.conf.local"
Write-Host " - Carpeta web ./www/$nombre/"
Write-Host ""
$confirm = Read-Host "Estas seguro? (s/n)"

if ($confirm -ne "s") {
    Write-Host ""
    Write-Host " Operación cancelada."
    Read-Host "Pulsa ENTER para cerrar"
    exit
}

# -------------------------------------------------------
# 1. Eliminar archivo de configuración de Nginx
# -------------------------------------------------------

$nginxFile = "./conf/nginx/conf/$nombre.conf"

if (Test-Path $nginxFile) {
    Remove-Item $nginxFile -Force
    Write-Host "Eliminado: $nginxFile"
} else {
    Write-Host "No existe: $nginxFile"
}

# -------------------------------------------------------
# 2. Eliminar certificados SSL
# -------------------------------------------------------

$keyFile = "./certs/$nombre.key"
$crtFile = "./certs/$nombre.crt"

foreach ($file in @($keyFile, $crtFile)) {
    if (Test-Path $file) {
        Remove-Item $file -Force
        Write-Host "Eliminado: $file"
    } else {
        Write-Host "No existe: $file"
    }
}

# -------------------------------------------------------
# 3. Eliminar fichero de zona DNS
# -------------------------------------------------------

$zoneFilePath = "./conf/dns/zones/db.$nombreExt"

if (Test-Path $zoneFilePath) {
    Remove-Item $zoneFilePath -Force
    Write-Host "Eliminado: $zoneFilePath"
} else {
    Write-Host "No existe: $zoneFilePath"
}

# -------------------------------------------------------
# 4. Eliminar la entrada de la zona en named.conf.local
# -------------------------------------------------------

$namedConfPath = "./conf/dns/named.conf.local"

if (Test-Path $namedConfPath) {
    $contenido = Get-Content $namedConfPath -Raw

    # Regex multi-línea para eliminar la zona completa
    $contenidoNuevo = $contenido -replace "zone\s+`"$nombreExt`"\s+\{[^}]+\};\s*", ""

    Set-Content $namedConfPath -Value $contenidoNuevo
    Write-Host "Eliminada la zona de named.conf.local"
} else {
    Write-Host "No existe: $namedConfPath"
}

# -------------------------------------------------------
# 5. Eliminar carpeta web ./www/nombre
# -------------------------------------------------------

$wwwFolder = "./www/$nombre"

if (Test-Path $wwwFolder) {
    Remove-Item $wwwFolder -Force -Recurse
    Write-Host "Eliminada carpeta web: $wwwFolder"
} else {
    Write-Host "No existe: $wwwFolder"
}

# -------------------------------------------------------
# 6. Reinicio de contenedores
# -------------------------------------------------------

Write-Host ""
Write-Host "Reiniciando contenedores Docker..."
Write-Host ""
docker compose restart
Write-Host ""
Write-Host "Contenedores reiniciados correctamente."
Write-Host ""

Read-Host "Pulsa ENTER para cerrar"
