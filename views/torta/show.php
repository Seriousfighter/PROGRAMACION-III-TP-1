<!DOCTYPE html>
<html>
<head>
    <title>Torta #<?= htmlspecialchars((string)$id) ?></title>
</head>
<body>
    <h1>Torta #<?= htmlspecialchars((string)$id) ?></h1>
    <p><strong>Sabor:</strong> <?= htmlspecialchars($sabor) ?></p>
    <p><strong>Cobertura:</strong> <?= htmlspecialchars($cobertura) ?></p>
    <p><strong>Tamaño:</strong> <?= htmlspecialchars($tamano) ?></p>
    <p><strong>Precio Unitario:</strong> <?= htmlspecialchars((string)$precio_unitario) ?></p>
    <a href="/tortas">Volver</a>
</body>
</html>