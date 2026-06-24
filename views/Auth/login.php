<?php $this->layout('layout', ['title' => 'Inicio de sesión']) ?> 
<h1>Iniciar sesión</h1> 
<?php if (!empty($error)): ?><p><?= $this->e($error) ?></p><?php endif; ?> 
<div class="auth-container">
    <a href="/" class="back-link">← Volver al inicio</a>
    
    <div class="admin-login-icon">🍰</div>
    <h1 style="text-align: center; color: #fe39b9; font-size: 1.8rem;">Iniciar Sesión</h1>
    <p style="text-align: center; color: #e976a7; margin-bottom: 2rem;">Ingresá con tus datos</p>
    
    <form id="loginForm" class="login-form" action="/login" method="POST">
        <div class="form-group">
            <label>📧 Correo electrónico o usuario</label>
            <input type="email" id="username" placeholder="tu@email.com" required name="email">
        </div>

        <div class="form-group">
            <label>🔐 Contraseña</label>
            <input type="password" id="password" placeholder="••••••" required name="password">
        </div>

        <button type="submit" class="btn-primary">Iniciar Sesión</button>
    </form>
    
    <p style="text-align: center; margin-top: 1.5rem;">
        ¿No tienes una cuenta? 
        <a href="/register" style="color: #fe39b9;">Regístrate aquí</a>
    </p>
</div>
