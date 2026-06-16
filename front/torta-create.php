<?php 
$titulo = "Personalizar mi torta - Tu Dulce Elección";
include 'header.php'; 
?>

<div class="customize-container">
    <a href="index.php" class="back-link">← Volver</a>
    <h1>🍰 Tu Dulce Elección</h1>
    
    <div class="customize-layout">
        <!-- Columna izquierda: Opciones -->
        <div class="options-panel">
            <div class="option-group">
                <h3>📏 Tamaño:</h3>
                <div class="size-options" id="tamaniosContainer">
                    <p style="color: #e976a7;">Cargando tamaños...</p>
                </div>
            </div>

            <div class="option-group">
                <h3>🍰 Gustos (Base):</h3>
                <select id="gustoBase">
                    <option value="" selected disabled>-- Seleccionar gusto --</option>
                    <option value="Vainilla">Vainilla</option>
                    <option value="Chocolate">Chocolate</option>
                    <option value="Lemon Pie">Lemon Pie</option>
                    <option value="Red Velvet">Red Velvet</option>
                    <option value="Coco">Coco</option>
                    <option value="Dulce de Leche">Dulce de Leche</option>
                </select>
            </div>

            <div class="option-group">
                <h3>🥄 RELLENOS:</h3>
                <div class="rellenos-grid" id="rellenosContainer">
                    <p style="color: #e976a7;">Cargando rellenos...</p>
                </div>
            </div>
        </div>

        <!-- Columna derecha: Elegidos y confirmar -->
        <div class="selected-panel">
            <h3>Elegidos:</h3>
            <div id="elegidosList" class="elegidos-list">
                <p class="empty-message">Elegí los ingredientes de tu torta</p>
            </div>
            <button class="btn-primary" id="confirmarPedidoBtn">Confirmar Pedido</button>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>