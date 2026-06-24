<?php $this->layout('layout', ['title' => 'Registro']) ?> 

<h1>Crear cuenta</h1> 
<div class="auth-container">
    <a href="index.php" class="back-link">← Volver al inicio</a>
    
    <div class="admin-login-icon">🍰</div>
    <h1 style="text-align: center; color: #fe39b9; font-size: 1.8rem;">Crear cuenta</h1>
    <p style="text-align: center; color: #e976a7; margin-bottom: 2rem;">Ingresá tus datos para registrarte</p>

    <?php if (!empty($error)): ?> <p><?= $this->e($error) ?></p><?php endif; ?> 

    <form method="POST" action="/register"> 
        <div class="form-group">
            <label for="name">Nombre</label> 
            <input id="name" type="text" name="name" placeholder="Tu nombre" required> 
        </div>  
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" placeholder="tu@email.com" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Minimo 6 caracteres" required>
        </div>

        <button type="submit" class="btn-primary">Registrarme</button>
    </form>

    <p style="text-align: center; margin-top: 1.5rem;">
        ¿Ya tienes una cuenta? 
        <a href="/login" style="color: #fe39b9;">Inicia sesión aquí</a>