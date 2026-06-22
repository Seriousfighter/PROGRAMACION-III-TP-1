<?php 
$titulo = "¡Gracias por tu pedido! - Tu Dulce Elección";
include 'header.php'; 
?>

<div class="gracias-container">
    <div class="gracias-card">
        <div class="emoji">🍰</div>
        <h1>MUCHAS GRACIAS POR CONFIAR</h1>
        <p>Tu pedido ha sido registrado exitosamente.</p>
        <p>📞 En breve nos pondremos en contacto<br>para coordinar fecha y retiro.</p>
        <div>
            <button class="btn-primary" onclick="location.href='index.php'">Volver al inicio</button>
            <button class="btn-outline" onclick="location.href='torta-create.php'">Hacer otro pedido</button>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>