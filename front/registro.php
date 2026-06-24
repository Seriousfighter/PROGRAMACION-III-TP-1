<?php include 'header.php'; ?>

<div class="auth-container">
    <button class="btn-outline" onclick="location.href='index.php'">Volver</button>
    <h1 class="brand-title-small">🍰 Tu Dulce Elección</h1>
    <p class="subtitle-small">Diseñá tu torta perfecta de forma rápida y fácil.</p>
    
    <div class="tab-container">
        <button class="tab-btn active" data-tab="login">Iniciar sesión</button>
        <button class="tab-btn" data-tab="registro">Registrarse</button>
    </div>

    <!-- Login -->
    <div id="loginPanel" class="auth-panel active">
        <h3>Iniciar sesión</h3>
        <form method="POST" action="/register" id="loginForm">
            <div class="form-group">
                <label>Correo electrónico</label>
                <input type="email" placeholder="tu@email.com" required>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" placeholder="••••••" required>
            </div>
            <button type="submit" class="btn-primary">Entrar</button>
        </form>
        <p class="switch-text">¿No tenés cuenta? <a href="#" id="switchToRegistro">Regístrate</a></p>
    </div>

    <!-- Registro -->
    <div id="registroPanel" class="auth-panel">
        <h3>REGISTRARSE</h3>
        <form id="registroForm">
            <div class="form-group">
                <label>Nombre Usuario</label>
                <input type="text" placeholder="Juan Pérez" required>
            </div>
            <div class="form-group">
                <label>Correo electrónico</label>
                <input type="email" placeholder="juan@email.com" required>
            </div>
            <div class="form-group">
                <label>Teléfono</label>
                <input type="tel" placeholder="11 1234 5678" required>
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <input type="text" placeholder="Calle Falsa 123" required>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" placeholder="••••••" required>
            </div>
            <button type="submit" class="btn-primary">Crear Cuenta</button>
        </form>
        <p class="switch-text">¿Ya tenés cuenta? <a href="#" id="switchToLogin">Iniciar sesión</a></p>
    </div>
</div>

<?php include 'footer.php'; ?>