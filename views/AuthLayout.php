<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->e($title) ?></title>
    <script src="/js/main.js"></script>
    <link rel="stylesheet" href="/css/main.css">
</head>

<?php include dirname(__DIR__).'/views/header.php'; ?>
<?php include dirname(__DIR__).'/views/UI/adminNav.php'; ?>

<section>
    <?=  $this->section('content') ?>
</section>

<?php include dirname(__DIR__).'/views/footer.php'; ?>