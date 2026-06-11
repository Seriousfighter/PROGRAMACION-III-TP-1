<!DOCTYPE html>
<html>
<head>
    <title><?= isset($sabor) ? 'Editar' : 'Nuevo' ?> Sabor</title>
</head>
<body>
    <h1><?= isset($sabor) ? 'Editar' : 'Nuevo' ?> Sabor</h1>
    
    <form action="<?= isset($sabor) ? '/sabores/' . (int)$sabor->id : '/sabores' ?>" method="POST">
        <label>
            Nombre:
            <input type="text" name="nombre" value="<?= isset($sabor) ? htmlspecialchars((string)$sabor->nombre) : '' ?>" required>
        </label>
        <br><br>
        
        <label>
            Precio Extra:
            <input type="number" step="0.01" name="precio_extra" value="<?= isset($sabor) ? htmlspecialchars((string)$sabor->precio_extra) : '0' ?>">
        </label>
        <br><br>
        
        <button type="submit">Guardar</button>
        <a href="/sabores">Cancelar</a>
    </form>
</body>
</html>