<?php 
$titulo = "Login Admin - Tu Dulce Elección";
include 'header.php'; 
?>

<div class="auth-container" style="max-width: 420px;">
    <a href="index.php" class="back-link">← Volver a la tienda</a>
    
    <div class="admin-login-icon">👑</div>
    <h1 style="text-align: center; color: #E87A5D; font-size: 1.8rem;">Panel Administrador</h1>
    <p style="text-align: center; color: #A8765A; margin-bottom: 2rem;">Ingresá con tus credenciales</p>
    
    <form id="adminLoginForm">
        <div class="form-group">
            <label>📧 Correo electrónico</label>
            <input type="email" id="adminEmail" placeholder="pasteleria@midulce.com" required>
        </div>
        <div class="form-group">
            <label>🔐 Contraseña</label>
            <input type="password" id="adminPassword" placeholder="••••••" required>
        </div>
        <button type="submit" class="btn-primary">Ingresar al Panel</button>
    </form>
    
    <div id="errorMsg" class="error-message"></div>
    
    <div class="info-credenciales">
        🔒 Acceso exclusivo para administradores
    </div>
</div>

<?php include 'footer.php'; ?>