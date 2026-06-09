<!DOCTYPE html>
<html>
<head>
    <title>Error <?= htmlspecialchars((string)$status) ?></title>
</head>
<body>
    <h1>Error <?= htmlspecialchars((string)$status) ?></h1>
    <p><?= htmlspecialchars($message) ?></p>
    <a href="/rellenos">Volver</a>
</body>
</html>