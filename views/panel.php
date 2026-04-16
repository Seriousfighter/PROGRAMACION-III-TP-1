<?php
declare(strict_types=1);

$this->layout('AuthLayout', ["title" => "Panel"]) 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars((string) $user, ENT_QUOTES, 'UTF-8') ?></h1>
</body>
</html>