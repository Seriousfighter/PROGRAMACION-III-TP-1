<?php include 'header.php'; ?>
<div class="landing-container">
        <div class="landing-content">
            <h1 class="brand-title">🍰 Tu Dulce Elección</h1>
            <h2 class="subtitle">TU TORTA IDEAL</h2>
            <p class="description">Diseñá tu torta perfecta con tus ingredientes favoritos.</p>
            
            <a href="torta-create.php" class="btn-primary-large">✨ Quiero mi torta →</a>
            
            <div class="auth-buttons">
                <button class="btn-outline" onclick="location.href='registro.php?tab=registro'">Registrarse</button>
                <button class="btn-outline" onclick="location.href='registro.php?tab=login'">Iniciar sesión</button>
            </div>
            <div style="text-align: center; margin-top: 1rem;">
    <a href="admin-login.php" style="color: #fe39b9; font-size: 0.85rem; text-decoration: none;">👑 Acceso Administradores</a>
</div>
        </div>
    </div>
<?php include 'footer.php'; ?>