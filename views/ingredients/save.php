<?php 

    $this->layout('AuthLayout', ["title" => "Crear Ingrediente"]) ?>
<h1>Crear Ingrediente</h1>
<form method="POST" action="/ingredients">
    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" required>

    <label for="detail">Detalle:</label>
    <textarea id="detail" name="detail"></textarea>

    <button type="submit">Guardar</button>  
</form>
