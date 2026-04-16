<?php $this->layout('layout', ['title' => 'Registro']) ?> 

<h1>Crear cuenta</h1> <?php if (!empty($error)): ?>  
    <p><?= $this->e($error) ?></p><?php endif; ?> 
    <form method="POST" action="/register"> 
        <div> 
            <label for="name">Nombre</label> 
            <input id="name" type="text" name="name" placeholder="Tu nombre" required> 
        </div>  
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" placeholder="tu@email.com" required>
        </div>

        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Minimo 6 caracteres" required>
        </div>

        <button type="submit">Registrarme</button>
    </form>