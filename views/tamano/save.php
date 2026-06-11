<!DOCTYPE html>
<html>
<head>
    <title><?= isset($tamano) ? 'Editar' : 'Nuevo' ?> Tamaño</title>
</head>
<body>
    <h1><?= isset($tamano) ? 'Editar' : 'Nuevo' ?> Tamaño</h1>
    
    <form action="<?= isset($tamano) ? '/tamanos/' . (int)$tamano->id : '/tamanos' ?>" method="POST">
        <label>
            Nombre:
            <input type="text" name="nombre" value="<?= isset($tamano) ? htmlspecialchars((string)$tamano->nombre) : '' ?>" required>
        </label>
        <br><br>
        
        <label>
            Porciones:
            <input type="number" name="porciones" value="<?= isset($tamano) ? htmlspecialchars((string)$tamano->porciones) : '0' ?>" required>
        </label>
        <br><br>
        
        <label>
            Precio Base:
            <input type="number" step="0.01" name="precio_base" value="<?= isset($tamano) ? htmlspecialchars((string)$tamano->precio_base) : '0' ?>" required>
        </label>
        <br><br>
        
        <button type="submit">Guardar</button>
        <a href="/tamanos">Cancelar</a>
    </form>
</body>
</html>