<?php 
$titulo = "Iniciar Sesión - Tu Dulce Elección";
include 'header.php'; 
?>

<div class="auth-container">
    <a href="index.php" class="back-link">← Volver al inicio</a>
    
    <div class="admin-login-icon">🍰</div>
    <h1 style="text-align: center; color: #fe39b9; font-size: 1.8rem;">Iniciar Sesión</h1>
    <p style="text-align: center; color: #e976a7; margin-bottom: 2rem;">Ingresá con tus datos</p>
    
    <form id="loginForm" class="login-form">
        <div class="form-group">
            <label>📧 Correo electrónico o usuario</label>
            <input type="email" id="username" placeholder="tu@email.com" required>
        </div>

        <div class="form-group">
            <label>🔐 Contraseña</label>
            <input type="password" id="password" placeholder="••••••" required>
        </div>

        <button type="submit" class="btn-primary">Iniciar Sesión</button>
    </form>
    
    <p style="text-align: center; margin-top: 1.5rem;">
        ¿No tienes una cuenta? 
        <a href="registro.php?tab=registro" style="color: #fe39b9;">Regístrate aquí</a>
    </p>
</div>

<?php include 'footer.php'; ?>