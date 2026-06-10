<!DOCTYPE html>
<html>
<head>
    <title>Cobertura #<?= htmlspecialchars((string)$id) ?></title>
</head>
<body>
    <h1>Cobertura #<?= htmlspecialchars((string)$id) ?></h1>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($nombre) ?></p>
    <p><strong>Precio Extra:</strong> <?= htmlspecialchars((string)$precio_extra) ?></p>
    <a href="/coberturas">Volver</a>
</body>
</html>