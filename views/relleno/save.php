<!DOCTYPE html>
<html>
<head>
    <title><?= isset($relleno) ? 'Editar' : 'Nuevo' ?> Relleno</title>
</head>
<body>
    <h1><?= isset($relleno) ? 'Editar' : 'Nuevo' ?> Relleno</h1>
    <form action="<?= isset($relleno) ? '/rellenos/' . $relleno->id : '/rellenos' ?>" method="POST">
        <?php if (isset($relleno)): ?>
            <input type="hidden" name="_method" value="PUT">
        <?php endif; ?>
        <label>Nombre: <input type="text" name="nombre" value="<?= isset($relleno) ? htmlspecialchars($relleno->nombre) : '' ?>" required></label><br>
        <label>Precio Extra: <input type="number" step="0.01" name="precio_extra" value="<?= isset($relleno) ? htmlspecialchars((string)$relleno->precio_extra) : '0' ?>"></label><br>
        <button type="submit">Guardar</button>
    </form>
    <a href="/rellenos">Cancelar</a>
</body>
</html>
