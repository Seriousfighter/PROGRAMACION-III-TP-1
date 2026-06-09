<!DOCTYPE html>
<html>
<head>
    <title>Error <?= htmlspecialchars((string)($status ?? '500')) ?></title>
</head>
<body>
    <h1>Error <?= htmlspecialchars((string)($status ?? '500')) ?></h1>
    <p><?= htmlspecialchars($message ?? 'Ha ocurrido un error inesperado') ?></p>
    <a href="/">Volver al inicio</a>
</body>
</html>