<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Bolígrafos de Lujo</title>
</head>
<body>
    <h1>Registro de Bolígrafos de Lujo</h1>

    <form action="registrar_boli.php" method="POST">
        <fieldset>
            <legend>Datos del Bolígrafo</legend>

            <!-- Código de serie -->
            <label for="codigo">Código de serie:</label><br>
            <input type="text" id="codigo" name="codigo" placeholder="Ej: BLG-1256" required><br><br>

            <!-- Nombre -->
            <label for="nombre">Nombre del bolígrafo:</label><br>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <!-- Email del diseñador -->
            <label for="email">Email del diseñador:</label><br>
            <input type="email" id="email" name="email_disenador" placeholder="disenador@ejemplo.com" required><br><br>

            <!-- Material de fabricación -->
            <label for="material">Material de fabricación:</label><br>
            <select id="material" name="material" required>
                <option value="">Seleccione un material</option>
                <option value="oro">oro</option>
                <option value="platino">platino</option>
                <option value="rodio">rodio</option>
                <option value="paladio">paladio</option>
                <option value="carbono">carbono</option>
            </select><br><br>

            <!-- Precio -->
            <label for="precio">Precio (€):</label><br>
            <input type="number" id="precio" name="precio" step="0.01" min="0" placeholder="Ej: 30000" required><br><br>

            <!-- Tipo de estuche -->
            <label>Tipo de estuche:</label><br>
            <input type="radio" id="estuche_piel" name="estuche" value="piel_italiana" required>
            <label for="estuche_piel">Estuche de piel italiana</label><br>

            <input type="radio" id="estuche_lujo" name="estuche" value="estuche_lujo">
            <label for="estuche_lujo">Estuche de lujo</label><br><br>

        </fieldset>

        <button type="submit" name="registrar">Registrar Bolígrafo</button>
        <button type="reset">Limpiar</button>
        <button type="submit" formaction="index.php" formnovalidate>Cancelar</button>
        

    </form>
</body>
</html>
