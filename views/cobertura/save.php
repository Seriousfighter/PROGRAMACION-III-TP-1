<!DOCTYPE html>
<html>
<head>
    <title><?= isset($cobertura) ? 'Editar' : 'Nueva' ?> Cobertura</title>
</head>
<body>
    <h1><?= isset($cobertura) ? 'Editar' : 'Nueva' ?> Cobertura</h1>
    
    <form action="<?= isset($cobertura) ? '/coberturas/' . (int)$cobertura->id . '/update' : '/coberturas/store' ?>" method="POST">
        <label>
            Nombre:
            <input type="text" name="nombre" value="<?= isset($cobertura) ? htmlspecialchars((string)$cobertura->nombre) : '' ?>" required>
        </label>
        <br><br>
        
        <label>
            Precio Extra:
            <input type="number" step="0.01" name="precio_extra" value="<?= isset($cobertura) ? htmlspecialchars((string)$cobertura->precio_extra) : '0' ?>">
        </label>
        <br><br>
        
        <button type="submit">Guardar</button>
        <a href="/coberturas">Cancelar</a>
    </form>
</body>
</html>