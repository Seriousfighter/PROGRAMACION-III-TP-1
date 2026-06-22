<?php
$title = isset($torta) ? 'Editar' : 'Nueva';
$this->layout('layout', ['title' => $title]);
$tamanos = $tamanos ?? [];
$sabores = $sabores ?? [];
$coberturas = $coberturas ?? [];
$rellenos = $rellenos ?? [];
$seleccionados = isset($rellenosSeleccionados) ? $rellenosSeleccionados : [];
?>

<div class="customize-container">
    <a href="/tortas" class="back-link">← Volver</a>
    <h1>🍰 Tu Dulce Elección</h1>
    <h2><?= isset($torta) ? 'Editar' : 'Nueva' ?> Torta</h2>

    <form class="customize-layout" action="<?= isset($torta) ? '/tortas/' . (int)$torta->id . '/update' : '/tortas/store' ?>" method="POST" id="formTorta">
        <div class="options-panel">
            <div class="option-group">
                <h3>📏 Tamaño:</h3>
                <div class="size-options" id="tamaniosContainer">
                    <?php foreach ($tamanos as $t): ?>
                        <label>
                            <input
                                type="radio"
                                name="tamano_id"
                                value="<?= (int)$t->id ?>"
                                data-precio-base="<?= (float)$t->precio_base ?>"
                                <?= (isset($torta) && $torta->tamano_id == $t->id) ? 'checked' : '' ?>
                                required
                            >
                            <?= htmlspecialchars($t->nombre) ?> (<?= htmlspecialchars((string)$t->porciones) ?> porciones - $<?= htmlspecialchars((string)$t->precio_base) ?>)
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="option-group">
                <h3>🍰 Gustos (Base):</h3>
                <select name="sabor_id" id="gustoBase" required>
                    <option value="" disabled <?= !isset($torta) ? 'selected' : '' ?>>-- Seleccionar gusto --</option>
                    <?php foreach ($sabores as $s): ?>
                        <option
                            value="<?= (int)$s->id ?>"
                            data-precio-extra="<?= (float)$s->precio_extra ?>"
                            <?= (isset($torta) && $torta->sabor_id == $s->id) ? 'selected' : '' ?>
                        >
                            <?= htmlspecialchars($s->nombre) ?> (+$<?= htmlspecialchars((string)$s->precio_extra) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="option-group">
                <h3>🍫 Cobertura:</h3>
                <select name="cobertura_id" id="cobertura_id" required>
                    <option value="" disabled <?= !isset($torta) ? 'selected' : '' ?>>-- Seleccionar cobertura --</option>
                    <?php foreach ($coberturas as $c): ?>
                        <option
                            value="<?= (int)$c->id ?>"
                            data-precio-extra="<?= (float)$c->precio_extra ?>"
                            <?= (isset($torta) && $torta->cobertura_id == $c->id) ? 'selected' : '' ?>
                        >
                            <?= htmlspecialchars($c->nombre) ?> (+$<?= htmlspecialchars((string)$c->precio_extra) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="option-group">
                <h3>🥄 RELLENOS:</h3>
                <div class="rellenos-grid" id="rellenosContainer">
                    <?php foreach ($rellenos as $r): ?>
                        <label>
                            <input
                                type="checkbox"
                                name="rellenos[]"
                                value="<?= (int)$r->id ?>"
                                data-precio-extra="<?= (float)$r->precio_extra ?>"
                                <?= in_array($r->id, $seleccionados) ? 'checked' : '' ?>
                            >
                            <?= htmlspecialchars($r->nombre) ?> (+$<?= htmlspecialchars((string)$r->precio_extra) ?>)
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="selected-panel">
            <h3>Elegidos:</h3>
            <div id="elegidosList" class="elegidos-list">
                <p class="empty-message">Elegí los ingredientes de tu torta</p>
            </div>

            <div class="elegido-item" style="display:flex;justify-content:space-between;align-items:center;font-weight:700;">
                <span>Precio Unitario:</span>
                <span id="precioDisplay">$<?= isset($torta) ? number_format($torta->precio_unitario, 2) : '0.00' ?></span>
            </div>

            <input type="hidden" name="precio_unitario" id="precio_unitario" value="<?= isset($torta) ? (float)$torta->precio_unitario : '0' ?>">

            <button class="btn-primary" id="confirmarPedidoBtn" type="submit">
                <?= isset($torta) ? 'Actualizar Torta' : 'Guardar Torta' ?>
            </button>
            <a href="/tortas" class="btn-outline" style="display:inline-block;margin-top:0.75rem;text-decoration:none;">Cancelar</a>
        </div>
    </form>
</div>

<script>
function actualizarElegidos() {
    const elegidosDiv = document.getElementById('elegidosList');
    if (!elegidosDiv) return;

    const seleccionados = [];

    const tamanoSeleccionado = document.querySelector('input[name="tamano_id"]:checked');
    if (tamanoSeleccionado) {
        const textoTamano = tamanoSeleccionado.parentElement.textContent.trim();
        seleccionados.push('Tamaño: ' + textoTamano);
    }

    const gustoBase = document.getElementById('gustoBase');
    if (gustoBase && gustoBase.value) {
        const gustoTexto = gustoBase.options[gustoBase.selectedIndex].textContent.trim();
        seleccionados.push('Base: ' + gustoTexto);
    }

    const coberturaSelect = document.getElementById('cobertura_id');
    if (coberturaSelect && coberturaSelect.value) {
        const coberturaTexto = coberturaSelect.options[coberturaSelect.selectedIndex].textContent.trim();
        seleccionados.push('Cobertura: ' + coberturaTexto);
    }

    const rellenosSeleccionados = Array.from(document.querySelectorAll('#rellenosContainer input[type="checkbox"]:checked'));
    rellenosSeleccionados.forEach((relleno) => {
        const textoRelleno = relleno.parentElement.textContent.trim();
        seleccionados.push(textoRelleno);
    });

    if (seleccionados.length === 0) {
        elegidosDiv.innerHTML = '<p class="empty-message">Elegí los ingredientes de tu torta</p>';
        return;
    }

    elegidosDiv.innerHTML = seleccionados.map((item) => '<div class="elegido-item">• ' + item + '</div>').join('');
}

function calcularPrecio() {
    let total = 0;

    const tamanoSeleccionado = document.querySelector('input[name="tamano_id"]:checked');
    if (tamanoSeleccionado) {
        total += parseFloat(tamanoSeleccionado.dataset.precioBase || 0);
    }

    const saborSelect = document.getElementById('gustoBase');
    if (saborSelect && saborSelect.selectedIndex >= 0) {
        const saborOption = saborSelect.options[saborSelect.selectedIndex];
        total += parseFloat((saborOption && saborOption.dataset.precioExtra) || 0);
    }

    const coberturaSelect = document.getElementById('cobertura_id');
    if (coberturaSelect && coberturaSelect.selectedIndex >= 0) {
        const coberturaOption = coberturaSelect.options[coberturaSelect.selectedIndex];
        total += parseFloat((coberturaOption && coberturaOption.dataset.precioExtra) || 0);
    }

    document.querySelectorAll('input[name="rellenos[]"]:checked').forEach((cb) => {
        total += parseFloat(cb.dataset.precioExtra || 0);
    });

    document.getElementById('precioDisplay').textContent = '$' + total.toFixed(2);
    document.getElementById('precio_unitario').value = total.toFixed(2);

    actualizarElegidos();
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('input[name="tamano_id"]').forEach(function (radio) {
        radio.addEventListener('change', calcularPrecio);
    });

    document.querySelectorAll('input[name="rellenos[]"]').forEach(function (checkbox) {
        checkbox.addEventListener('change', calcularPrecio);
    });

    const gustoBase = document.getElementById('gustoBase');
    if (gustoBase) {
        gustoBase.addEventListener('change', calcularPrecio);
    }

    const coberturaSelect = document.getElementById('cobertura_id');
    if (coberturaSelect) {
        coberturaSelect.addEventListener('change', calcularPrecio);
    }

    calcularPrecio();
});
</script>
