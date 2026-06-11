<!DOCTYPE html>
<html>
<head>
    <title>Tamaño #<?= htmlspecialchars((string)$id) ?></title>
</head>
<body>
    <h1>Tamaño #<?= htmlspecialchars((string)$id) ?></h1>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($nombre) ?></p>
    <p><strong>Porciones:</strong> <?= htmlspecialchars((string)$porciones) ?></p>
    <p><strong>Precio Base:</strong> <?= htmlspecialchars((string)$precio_base) ?></p>
    <a href="/tamanos">Volver</a>
</body>
</html>