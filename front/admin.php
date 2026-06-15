<?php 
$titulo = "Panel Administrador - Tu Dulce Elección";
include 'header.php'; 
?>

<div class="admin-container">
    <!-- SIDEBAR -->
    <div class="admin-sidebar">
        <h2>🍰 Tu Dulce Elección</h2>
        <div class="admin-welcome">
            Bienvenido/a, <strong id="adminName">Admin</strong>
        </div>
        <ul class="admin-menu">
            <li class="active" data-section="dashboard">📊 Inicio</li>
            <li data-section="pedidos">📦 Pedidos</li>
            <li data-section="ingredientes">🥄 Ingredientes/Rellenos</li>
            <li data-section="tamanios">📏 Tamaños</li>
        </ul>
        <button id="logoutBtn">🚪 Cerrar sesión</button>
    </div>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="admin-main">
        <!-- DASHBOARD - INICIO -->
        <div id="sectionDashboard" class="admin-section">
            <div class="welcome-card">
                <h1>Panel de Administrador</h1>
                <p>Bienvenido/a, <strong id="adminNameWelcome">Admin</strong></p>
            </div>

            <div class="quick-actions-section">
                <h3>⚡ Acciones rápidas</h3>
                <div class="quick-buttons">
                    <button class="btn-quick" onclick="cambiarSeccion('ingredientes')">➕ Agregar ingrediente</button>
                    <button class="btn-quick" onclick="cambiarSeccion('tamanios')">📏 Agregar tamaño</button>
                    <button class="btn-quick" onclick="exportarPedidos()">📎 Exportar reporte</button>
                </div>
            </div>

            <div class="pedidos-section">
                <h3>📋 Pedidos recientes</h3>
                <div class="pedidos-table-container">
                    <table class="pedidos-table">
                        <thead>
                            <tr><th>ID</th><th>Cliente</th><th>Fecha</th><th>Total</th><th>Estado</th><th>Acciones</th></tr>
                        </thead>
                        <tbody id="ultimosPedidos"></tbody>
                    </table>
                </div>
            </div>

            <div class="quick-actions-section">
                <h3>💰 Totales</h3>
                <div class="stats-grid" id="statsGrid"></div>
            </div>

            <div class="quick-actions-section">
                <h3>🥄 Ingredientes en catálogo</h3>
                <div id="ingredientesCatalogo" class="items-grid"></div>
            </div>
        </div>

        <!-- SECCIÓN PEDIDOS -->
        <div id="sectionPedidos" class="admin-section" style="display:none">
            <div class="pedidos-section">
                <h3>📦 Todos los pedidos</h3>
                <div class="quick-buttons" style="margin-bottom: 1rem;">
                    <button class="btn-quick" onclick="exportarPedidos()">📎 Exportar reporte</button>
                </div>
                <div class="pedidos-table-container">
                    <table class="pedidos-table">
                        <thead>
                            <tr><th>ID</th><th>Cliente</th><th>Tamaño</th><th>Gusto</th><th>Rellenos</th><th>Total</th><th>Estado</th><th>Acciones</th></tr>
                        </thead>
                        <tbody id="tablaPedidos"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- SECCIÓN INGREDIENTES -->
        <div id="sectionIngredientes" class="admin-section" style="display:none">
            <div class="pedidos-section">
                <h3>🥄 Gestión de Ingredientes / Rellenos</h3>
                <div class="quick-buttons" style="margin-bottom: 1rem;">
                    <button class="btn-quick" id="btnAgregarIngrediente">➕ Agregar nuevo relleno</button>
                </div>
                <h3>Rellenos disponibles</h3>
                <div id="listaIngredientes" class="items-grid"></div>
            </div>
        </div>

        <!-- SECCIÓN TAMAÑOS -->
        <div id="sectionTamanios" class="admin-section" style="display:none">
            <div class="pedidos-section">
                <h3>📏 Gestión de Tamaños</h3>
                <div class="quick-buttons" style="margin-bottom: 1rem;">
                    <button class="btn-quick" id="btnAgregarTamanio">➕ Agregar nuevo tamaño</button>
                </div>
                <h3>Tamaños disponibles</h3>
                <div id="listaTamanios" class="items-grid"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ingrediente -->
<div id="modalIngrediente" class="modal">
    <div class="modal-content">
        <h3>🍰 Agregar nuevo relleno</h3>
        <input type="text" id="nuevoIngredienteNombre" placeholder="Ej: Dulce de Leche, Nutella...">
        <div class="modal-buttons">
            <button class="btn-quick" onclick="cerrarModal()">Cancelar</button>
            <button class="btn-quick" style="background:#fe39b9; color:white;" onclick="agregarIngrediente()">Agregar</button>
        </div>
    </div>
</div>

<!-- Modal Tamaño -->
<div id="modalTamanio" class="modal">
    <div class="modal-content">
        <h3>📏 Agregar nuevo tamaño</h3>
        <input type="text" id="nuevoTamanioNombre" placeholder="Ej: Extra Grande, Mini...">
        <input type="number" id="nuevoTamanioPrecio" placeholder="Precio base ($)">
        <div class="modal-buttons">
            <button class="btn-quick" onclick="cerrarModal()">Cancelar</button>
            <button class="btn-quick" style="background:#fe39b9; color:white;" onclick="agregarTamanio()">Agregar</button>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>