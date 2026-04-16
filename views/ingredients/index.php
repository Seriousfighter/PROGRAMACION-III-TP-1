<?php

 $this->layout('layout', ["title" => "Ingrediente"]) ?>

<?php foreach ($ingredients as $ingredient): ?>
    <h1>Ingrediente <?= $this->e($ingredient->id) ?></h1>
    <h2><?= $this->e($ingredient->name) ?></h2>
    <p><?= $this->e($ingredient->detail) ?></p>
<?php endforeach; ?>
<h1>Ingrediente </h1>
<h2>index</h2>