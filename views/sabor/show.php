<!DOCTYPE html>
<html>
<head>
    <title>Sabor #<?= htmlspecialchars((string)$id) ?></title>
</head>
<body>
    <h1>Sabor #<?= htmlspecialchars((string)$id) ?></h1>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($nombre) ?></p>
    <p><strong>Precio Extra:</strong> <?= htmlspecialchars((string)$precio_extra) ?></p>
    <a href="/sabores">Volver</a>
</body>
</html>