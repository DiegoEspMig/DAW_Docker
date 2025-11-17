(ES) README - Servidor (Nginx + PHP) + Bind9

 –> Requisitos:
- Docker
- OpenSSL

 –> Recomendación
- Navegador Firefox, mejora el proceso de carga en dns local

 –> Puesta en marcha
- Cambiar configuración de adaptador de red Windows (DNS Primario 127.0.0.1)
- Descargar .zip / git clone / git fork
- En ./Docker-Container
- docker compose up -d --build
- Ejecutar crear-sitio.ps1

 –> Cómo crear nuevos sitios
- Abre PowerShell (recomendado como Administrador)
- cd rutaProyecto/Docker-Container
- Unblock-File .\crear-sitio.ps1
- Set-ExecutionPolicy RemoteSigned -Scope CurrentUser (respoder 's')
- ejecutar el script .\crear-sitio.ps1

 –> Cómo borrar sitios
- Abre PowerShell (recomendado como Administrador)
- cd rutaProyecto/Docker-Container
- Unblock-File .\borrar-sitio.ps1
- Set-ExecutionPolicy RemoteSigned -Scope CurrentUser (respoder 's')
- ejecutar el script .\borrar-sitio.ps1

-------------------------------------------------------------------------------

(EN) README – Server (Nginx + PHP) + Bind9

 –> Requirements:
- Docker
- OpenSSL

 –> Recommendation
- Use Firefox browser, it improves loading when using local DNS

 –> Startup
- Change Windows network adapter settings (Primary DNS 127.0.0.1)
- Download .zip / git clone / git fork
- Go to ./Docker-Container
- Run: docker compose up -d --build
- Run the script: crear-sitio.ps1

 –> How to create new sites
- Open PowerShell (recommended: Run as Administrator)
- cd pathToProject/Docker-Container
- Unblock-File .\crear-sitio.ps1
- Set-ExecutionPolicy RemoteSigned -Scope CurrentUser (answer “Y”)
- Run the script: .\crear-sitio.ps1

 –> How to delete sites
- Open PowerShell (recommended: Run as Administrator)
- cd pathToProject/Docker-Container
- Unblock-File .\borrar-sitio.ps1
- Set-ExecutionPolicy RemoteSigned -Scope CurrentUser (answer “Y”)
- Run the script: .\borrar-sitio.ps1
