# Script: crear-sitio.ps1

$nombre = Read-Host "Introduce el nombre del sitio (ej: pagina)"
$extension = Read-Host "Introduce la extension del dominio (ej: com)"
$nombreExt = "$nombre.$extension"

# -------------------------------------------------------
# 1. Crear archivo de configuración Nginx
# -------------------------------------------------------

$nginxConf = @'
server {
    listen 80;
    server_name NOMBREEXT www.NOMBREEXT;
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl;
    server_name NOMBREEXT www.NOMBREEXT;

    ssl_certificate /etc/ssl/private/NOMBRE.crt;
    ssl_certificate_key /etc/ssl/private/NOMBRE.key;

    root /var/www/html/NOMBRE;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
'@

# Reemplazos seguros
$nginxConf = $nginxConf.Replace("NOMBREEXT", $nombreExt)
$nginxConf = $nginxConf.Replace("NOMBRE", $nombre)

# Guardar
Set-Content -Path "./conf/nginx/conf/$nombre.conf" -Value $nginxConf

# -------------------------------------------------------
# 2. Generar certificados SSL
# -------------------------------------------------------

Write-Host ""
Write-Host "Generando certificados SSL..."
Write-Host ""
& openssl req -x509 -nodes -days 365 -newkey rsa:2048 `
    -keyout "./certs/$nombre.key" `
    -out "./certs/$nombre.crt" `
    -subj "/CN=$nombreExt"

# -------------------------------------------------------
# 3. Añadir zona a named.conf.local (solo si no existe)
# -------------------------------------------------------

$namedConfPath = "./conf/dns/named.conf.local"
$contenidoActual = Get-Content $namedConfPath -Raw

if ($contenidoActual -notmatch $nombreExt) {

$zona = @"
zone "$nombreExt" {
    type master;
    file "/etc/bind/zones/db.$nombreExt";
};
"@

    Add-Content -Path $namedConfPath -Value $zona
}

# -------------------------------------------------------
# 4. Crear fichero de zona db.dominio
# -------------------------------------------------------

$zoneFile = @'
$TTL    604800
$ORIGIN NOMBREEXT.
@       IN      SOA     ns1.NOMBREEXT. admin.NOMBREEXT. (
                        SERIALNUMBER ; Serial
                        604800     ; Refresh
                        86400      ; Retry
                        2419200    ; Expire
                        604800 )   ; Negative Cache TTL

@               IN      NS      ns1.NOMBREEXT.
ns1             IN      A       172.99.0.20

@               IN      A       127.0.0.1
www             IN      A       127.0.0.1
'@

$serial = (Get-Date -Format "yyyyMMddHH")

$zoneFile = $zoneFile.Replace("NOMBREEXT", $nombreExt)
$zoneFile = $zoneFile.Replace("SERIALNUMBER", $serial)

Set-Content -Path "./conf/dns/zones/db.$nombreExt" -Value $zoneFile

# -------------------------------------------------------
# 5. Crear carpeta para ficheros web (.html, .php, .js, .css)
# -------------------------------------------------------

New-Item -Path "./www/$nombre" -ItemType Directory

Write-Host ""
Write-Host "Sitio $nombreExt creado con exito"
Write-Host ""
Write-Host "Ahora agrega tus ficheros .html, .css, .js y .php en la carpeta:"
Write-Host "   ./www/$nombre/"
Write-Host ""
Write-Host "Reiniciando contenedores Docker..."
Write-Host ""
docker compose restart
Write-Host ""
Write-Host "Contenedores 'web' y 'dns' reiniciados correctamente."
Write-Host ""
Read-Host "Pulsa ENTER para cerrar"