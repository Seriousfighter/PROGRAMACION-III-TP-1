<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->e($title) ?></title>
</head>

<?php include dirname(__DIR__).'/views/header.php'; ?>
<?php include dirname(__DIR__).'/views/UI/adminNav.php'; ?>
<section>
    <?=  $this->section('content') ?>
</section>

<?php include dirname(__DIR__).'/views/footer.php'; ?>