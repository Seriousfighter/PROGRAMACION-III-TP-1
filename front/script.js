// ========== ADMIN LOGIN ==========
function initAdminLogin() {
    const form = document.getElementById('adminLoginForm');
    if (!form) return;

    const ADMIN_EMAIL = 'pasteleria@midulce.com';
    const ADMIN_PASSWORD = 'torta2026';
    const errorMsg = document.getElementById('errorMsg');

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const email = document.getElementById('adminEmail').value.trim();
        const password = document.getElementById('adminPassword').value;

        if (errorMsg) {
            errorMsg.style.display = 'none';
            errorMsg.innerHTML = '';
        }

        if (email === ADMIN_EMAIL && password === ADMIN_PASSWORD) {
            localStorage.setItem('isAdmin', 'true');
            localStorage.setItem('adminEmail', email);
            window.location.href = 'admin.php';
        } else {
            if (errorMsg) {
                errorMsg.innerHTML = '❌ Correo o contraseña incorrectos';
                errorMsg.style.display = 'block';
            }
            document.getElementById('adminPassword').value = '';
            document.getElementById('adminPassword').focus();
        }
    });

    if (localStorage.getItem('isAdmin') === 'true') {
        window.location.href = 'admin.php';
    }
}

// ========== ADMIN PANEL ==========
let ingredientes = [];
let tamanios = [];
let pedidos = [];

function initAdmin() {
    // Cargar datos desde localStorage
    ingredientes = JSON.parse(localStorage.getItem('ingredientes')) || [
        "Dulce de Leche", "Frutilla", "Mantecol", "Bon o Bon",
        "Kinder", "Nutella", "Oreo", "Pistacho"
    ];
    tamanios = JSON.parse(localStorage.getItem('tamanios')) || [
        { nombre: "Chica", precio: 1800 },
        { nombre: "Mediana", precio: 2500 },
        { nombre: "Grande", precio: 3500 }
    ];
    pedidos = JSON.parse(localStorage.getItem('pedidos')) || [];

    // Verificar sesión
    if (localStorage.getItem('isAdmin') !== 'true') {
        alert('🔒 Acceso denegado');
        window.location.href = 'admin-login.php';
        return;
    }

    // Mostrar nombre del admin
    const adminEmail = localStorage.getItem('adminEmail');
    if (adminEmail) {
        const nombre = adminEmail.split('@')[0];
        const adminNameElements = document.querySelectorAll('#adminName, #adminNameWelcome');
        adminNameElements.forEach(el => {
            if (el) el.innerText = nombre;
        });
    }

    // Configurar eventos de navegación
    document.querySelectorAll('.admin-menu li').forEach(li => {
        li.addEventListener('click', () => {
            const seccion = li.getAttribute('data-section');
            cambiarSeccion(seccion);
        });
    });

    // Botones de modales
    const btnAgregarIngrediente = document.getElementById('btnAgregarIngrediente');
    const btnAgregarTamanio = document.getElementById('btnAgregarTamanio');
    const logoutBtn = document.getElementById('logoutBtn');

    if (btnAgregarIngrediente) {
        btnAgregarIngrediente.addEventListener('click', () => abrirModal('ingrediente'));
    }
    if (btnAgregarTamanio) {
        btnAgregarTamanio.addEventListener('click', () => abrirModal('tamanio'));
    }
    if (logoutBtn) {
        logoutBtn.addEventListener('click', () => {
            localStorage.removeItem('isAdmin');
            localStorage.removeItem('adminEmail');
            window.location.href = 'index.php';
        });
    }

    // Iniciar con dashboard
    cambiarSeccion('dashboard');
}

function guardarIngredientes() { localStorage.setItem('ingredientes', JSON.stringify(ingredientes)); }
function guardarTamanios() { localStorage.setItem('tamanios', JSON.stringify(tamanios)); }
function guardarPedidos() { localStorage.setItem('pedidos', JSON.stringify(pedidos)); }

function mostrarDashboard() {
    const ultimosPedidos = document.getElementById('ultimosPedidos');
    const statsGrid = document.getElementById('statsGrid');
    const ingredientesCatalogo = document.getElementById('ingredientesCatalogo');

    if (ultimosPedidos) {
        const ultimos = [...pedidos].reverse().slice(0, 5);
        ultimosPedidos.innerHTML = ultimos.map(p => {
            const estaListo = p.estado === 'Listo para entregar';
            return `
                <tr>
                    <td>#${p.id || 'N/A'}</td>
                    <td>${p.cliente || 'Cliente'}</td>
                    <td>${p.fecha || new Date(p.fechaPedido).toLocaleDateString()}</td>
                    <td>$${(p.total || 0).toLocaleString()}</td>
                    <td><span class="estado-${p.estado === 'Listo para entregar' ? 'listo' : p.estado === 'Cancelado' ? 'cancelado' : 'pendiente'}">${p.estado || 'Pendiente'}</span></td>
                    <td class="acciones-cell">
                        ${!estaListo ? `<button class="btn-accion btn-accion-success" onclick="window.marcarListoDashboard(${pedidos.indexOf(p)})">✅ Listo</button>` : '<span style="color: #4CAF50;">✓ Completado</span>'}
                    </td>
                </tr>
            `;
        }).join('') || '<tr><td colspan="6">No hay pedidos</td></tr>';
    }

    if (statsGrid) {
        const totalPedidos = pedidos.length;
        const totalVentas = pedidos.reduce((sum, p) => sum + (p.total || 0), 0);
        const pendientes = pedidos.filter(p => p.estado === 'Pendiente').length;
        statsGrid.innerHTML = `
            <div class="stat-card"><div class="number">${totalPedidos}</div><div class="label">Total Pedidos</div></div>
            <div class="stat-card"><div class="number">$${totalVentas.toLocaleString()}</div><div class="label">Ventas Totales</div></div>
            <div class="stat-card"><div class="number">${pendientes}</div><div class="label">Pendientes</div></div>
            <div class="stat-card"><div class="number">${ingredientes.length}</div><div class="label">Ingredientes</div></div>
        `;
    }

    if (ingredientesCatalogo) {
        ingredientesCatalogo.innerHTML = ingredientes.map(ing => `
            <div class="item-card"><span>🍰 ${ing}</span></div>
        `).join('');
    }
}

function marcarListoDashboard(index) {
    if (confirm('¿Marcar como listo?')) {
        pedidos[index].estado = 'Listo para entregar';
        guardarPedidos();
        mostrarDashboard();
        mostrarPedidosCompletos();
    }
}

function mostrarPedidosCompletos() {
    const tablaPedidos = document.getElementById('tablaPedidos');
    if (!tablaPedidos) return;
    tablaPedidos.innerHTML = pedidos.map((p, i) => {
        const estaListo = p.estado === 'Listo para entregar';
        const estaCancelado = p.estado === 'Cancelado';
        return `
            <tr>
                <td>#${p.id || (1000 + i)}</td>
                <td>${p.cliente || 'Cliente'}</td>
                <td>${p.tamanio || '-'}</td>
                <td>${p.gusto || '-'}</td>
                <td>${p.rellenos?.join(', ') || 'Ninguno'}</td>
                <td>$${(p.total || 0).toLocaleString()}</td>
                <td><span class="estado-${p.estado === 'Listo para entregar' ? 'listo' : p.estado === 'Cancelado' ? 'cancelado' : 'pendiente'}">${p.estado || 'Pendiente'}</span></td>
                <td class="acciones-cell">
                    ${!estaListo ? `<button class="btn-accion btn-accion-success" onclick="window.marcarListo(${i})">✅ Listo</button>` : '<span style="color:#4CAF50;">✓ Listo</span>'}
                    ${!estaCancelado && !estaListo ? `<button class="btn-accion btn-accion-danger" onclick="window.cancelarPedido(${i})">❌ Cancelar</button>` : ''}
                </td>
            </tr>
        `;
    }).join('');
}
function marcarListo(i) {
    pedidos[i].estado = 'Listo para entregar';
    guardarPedidos();
    mostrarPedidosCompletos();
    mostrarDashboard();
    alert('✅ Pedido marcado como listo');
}

function cancelarPedido(i) {
    if (confirm('¿Cancelar pedido?')) {
        pedidos[i].estado = 'Cancelado';
        guardarPedidos();
        mostrarPedidosCompletos();
        mostrarDashboard();
        alert('❌ Pedido cancelado');
    }
}

function mostrarIngredientes() {
    const listaIngredientes = document.getElementById('listaIngredientes');
    if (!listaIngredientes) return;
    listaIngredientes.innerHTML = ingredientes.map((ing, i) => `
        <div class="item-card"><span> ${ing}</span><button class="btn-eliminar" onclick="window.eliminarIngrediente(${i})">🗑️ Eliminar</button></div>
    `).join('');
}

function agregarIngrediente() {
    const nombre = document.getElementById('nuevoIngredienteNombre').value.trim();
    if (!nombre) return alert('Ingresá un nombre');
    ingredientes.push(nombre);
    guardarIngredientes();
    mostrarIngredientes();
    mostrarDashboard();
    cerrarModal();
    document.getElementById('nuevoIngredienteNombre').value = '';
    alert(`✅ "${nombre}" agregado`);
}

function eliminarIngrediente(i) {
    if (confirm(`¿Eliminar "${ingredientes[i]}"?`)) {
        ingredientes.splice(i, 1);
        guardarIngredientes();
        mostrarIngredientes();
        mostrarDashboard();
    }
}

function mostrarTamanios() {
    const listaTamanios = document.getElementById('listaTamanios');
    if (!listaTamanios) return;
    listaTamanios.innerHTML = tamanios.map((tam, i) => `
        <div class="item-card"><span>📏 ${tam.nombre} - $${tam.precio.toLocaleString()}</span><button class="btn-eliminar" onclick="window.eliminarTamanio(${i})">🗑️ Eliminar</button></div>
    `).join('');
}

function agregarTamanio() {
    const nombre = document.getElementById('nuevoTamanioNombre').value.trim();
    const precio = parseInt(document.getElementById('nuevoTamanioPrecio').value);
    if (!nombre) return alert('Ingresá un nombre');
    if (!precio) return alert('Ingresá un precio');
    tamanios.push({ nombre, precio });
    guardarTamanios();
    mostrarTamanios();
    cerrarModal();
    document.getElementById('nuevoTamanioNombre').value = '';
    document.getElementById('nuevoTamanioPrecio').value = '';
    alert(`✅ "${nombre}" agregado`);
}

function eliminarTamanio(i) {
    if (confirm(`¿Eliminar tamaño "${tamanios[i].nombre}"?`)) {
        tamanios.splice(i, 1);
        guardarTamanios();
        mostrarTamanios();
    }
}

function cambiarSeccion(seccion) {
    const secciones = ['dashboard', 'pedidos', 'ingredientes', 'tamanios'];
    secciones.forEach(sec => {
        const el = document.getElementById(`section${sec.charAt(0).toUpperCase() + sec.slice(1)}`);
        if (el) el.style.display = sec === seccion ? 'block' : 'none';
    });

    document.querySelectorAll('.admin-menu li').forEach(li => {
        li.classList.remove('active');
        if (li.getAttribute('data-section') === seccion) {
            li.classList.add('active');
        }
    });

    if (seccion === 'dashboard') mostrarDashboard();
    else if (seccion === 'pedidos') mostrarPedidosCompletos();
    else if (seccion === 'ingredientes') mostrarIngredientes();
    else if (seccion === 'tamanios') mostrarTamanios();
}

function exportarPedidos() {
    if (pedidos.length === 0) {
        alert('No hay pedidos para exportar');
        return;
    }
    const reporte = pedidos.map(p => `ID: ${p.id}, Cliente: ${p.cliente}, Total: $${p.total}, Estado: ${p.estado}`).join('\n');
    const blob = new Blob([reporte], { type: 'text/plain' });
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = `pedidos_${new Date().toISOString().slice(0, 10)}.txt`;
    link.click();
}

function abrirModal(tipo) {
    const modal = document.getElementById(tipo === 'ingrediente' ? 'modalIngrediente' : 'modalTamanio');
    if (modal) modal.style.display = 'flex';
}

function cerrarModal() {
    document.querySelectorAll('.modal').forEach(m => m.style.display = 'none');
}

// Exponer funciones globalmente para onclick
window.marcarListoDashboard = marcarListoDashboard;
window.marcarListo = marcarListo;
window.cancelarPedido = cancelarPedido;
window.agregarIngrediente = agregarIngrediente;
window.eliminarIngrediente = eliminarIngrediente;
window.agregarTamanio = agregarTamanio;
window.eliminarTamanio = eliminarTamanio;
window.cambiarSeccion = cambiarSeccion;
window.exportarPedidos = exportarPedidos;
window.cerrarModal = cerrarModal;
window.abrirModal = abrirModal;

// ========== CLIENTE ==========
function initCliente() {
    const tamaniosContainer = document.getElementById('tamaniosContainer');
    const rellenosContainer = document.getElementById('rellenosContainer');
    const gustoBase = document.getElementById('gustoBase');
    const confirmarBtn = document.getElementById('confirmarPedidoBtn');

    if (!tamaniosContainer) return;

    function cargarTamanios() {
        let tamaniosData = JSON.parse(localStorage.getItem('tamanios'));
        if (!tamaniosData || tamaniosData.length === 0) {
            tamaniosData = [
                { nombre: "Chica", precio: 1800 },
                { nombre: "Mediana", precio: 2500 },
                { nombre: "Grande", precio: 3500 }
            ];
            localStorage.setItem('tamanios', JSON.stringify(tamaniosData));
        }
        tamaniosContainer.innerHTML = tamaniosData.map(tam => `
            <label>
                <input type="radio" name="tamanio" value="${tam.nombre}" data-precio="${tam.precio}">
                ${tam.nombre}
            </label>
        `).join('');
        document.querySelectorAll('input[name="tamanio"]').forEach(radio => {
            radio.addEventListener('change', actualizarElegidos);
        });
    }

    function cargarIngredientes() {
        let ingredientesData = JSON.parse(localStorage.getItem('ingredientes'));
        if (!ingredientesData || ingredientesData.length === 0) {
            ingredientesData = [
                "Dulce de Leche", "Frutilla", "Mantecol", "Bon o Bon",
                "Kinder", "Nutella", "Oreo", "Pistacho"
            ];
            localStorage.setItem('ingredientes', JSON.stringify(ingredientesData));
        }
        rellenosContainer.innerHTML = ingredientesData.map(ing => `
            <label>
                <input type="checkbox" value="${ing}"> ${ing}
            </label>
        `).join('');
        document.querySelectorAll('#rellenosContainer input[type="checkbox"]').forEach(cb => {
            cb.addEventListener('change', actualizarElegidos);
        });
    }

    function actualizarElegidos() {
        const elegidosDiv = document.getElementById('elegidosList');
        if (!elegidosDiv) return;

        let seleccionados = [];

        const tamanioSeleccionado = document.querySelector('input[name="tamanio"]:checked');
        if (tamanioSeleccionado) {
            seleccionados.push(`Tamaño: ${tamanioSeleccionado.value}`);
        }

        if (gustoBase && gustoBase.value && gustoBase.value !== '') {
            seleccionados.push(`Base: ${gustoBase.value}`);
        }

        const rellenosSeleccionados = Array.from(document.querySelectorAll('#rellenosContainer input[type="checkbox"]:checked'))
            .map(cb => cb.value);

        rellenosSeleccionados.forEach(relleno => {
            seleccionados.push(`${relleno}`);
        });

        if (seleccionados.length === 0) {
            elegidosDiv.innerHTML = '<p class="empty-message">Elegí los ingredientes de tu torta</p>';
        } else {
            elegidosDiv.innerHTML = seleccionados.map(s => `<div class="elegido-item">• ${s}</div>`).join('');
        }
    }

    function calcularTotal() {
        const tamanioSeleccionado = document.querySelector('input[name="tamanio"]:checked');
        let precioBase = 0;

        if (tamanioSeleccionado) {
            const tamaniosData = JSON.parse(localStorage.getItem('tamanios')) || [];
            const tamanioEncontrado = tamaniosData.find(t => t.nombre === tamanioSeleccionado.value);
            precioBase = tamanioEncontrado ? tamanioEncontrado.precio : 2000;
        }

        const rellenosSeleccionados = document.querySelectorAll('#rellenosContainer input[type="checkbox"]:checked').length;
        const extraPorRelleno = 250;

        return precioBase + (rellenosSeleccionados * extraPorRelleno);
    }

    function confirmarPedido() {
        const tamanioSeleccionado = document.querySelector('input[name="tamanio"]:checked');
        const gusto = gustoBase ? gustoBase.value : '';

        if (!tamanioSeleccionado) {
            alert('Por favor, seleccioná el tamaño de tu torta');
            return;
        }

        if (!gusto || gusto === '') {
            alert('Por favor, seleccioná un gusto base');
            return;
        }

        const rellenos = Array.from(document.querySelectorAll('#rellenosContainer input[type="checkbox"]:checked'))
            .map(cb => cb.value);
        const total = calcularTotal();

        let clienteNombre = localStorage.getItem('clienteNombre');
        if (!clienteNombre) {
            clienteNombre = prompt('Ingresá tu nombre para el pedido:', 'Cliente');
            if (clienteNombre) {
                localStorage.setItem('clienteNombre', clienteNombre);
            } else {
                clienteNombre = 'Cliente';
            }
        }

        const pedido = {
            id: Date.now(),
            cliente: clienteNombre,
            tamanio: tamanioSeleccionado.value,
            gusto: gusto,
            rellenos: rellenos,
            total: total,
            fecha: new Date().toLocaleString(),
            estado: 'Pendiente'
        };

        let pedidosData = JSON.parse(localStorage.getItem('pedidos') || '[]');
        pedidosData.unshift(pedido);
        localStorage.setItem('pedidos', JSON.stringify(pedidosData));
        localStorage.setItem('pedidoTemp', JSON.stringify(pedido));

        alert(`¡Pedido confirmado!\nTotal: $${total.toLocaleString()}\nEn breve nos contactamos.`);
        window.location.href = 'gracias.php';
    }

    cargarTamanios();
    cargarIngredientes();

    if (gustoBase) {
        gustoBase.addEventListener('change', actualizarElegidos);
    }
    if (confirmarBtn) {
        confirmarBtn.addEventListener('click', confirmarPedido);
    }
}

// ========== RESUMEN ==========
function initResumen() {
    const pedido = JSON.parse(localStorage.getItem('pedidoTemp') || '{}');
    const precios = { Chica: 1800, Mediana: 2500, Grande: 3500 };
    const precioBase = precios[pedido.tamanio] || 0;
    const extraPorRelleno = 250;
    const total = precioBase + (pedido.rellenos?.length || 0) * extraPorRelleno;

    const resumenTamanio = document.getElementById('resumenTamanio');
    const resumenGusto = document.getElementById('resumenGusto');
    const resumenRellenos = document.getElementById('resumenRellenos');
    const resumenTotal = document.getElementById('resumenTotal');
    const finalizarBtn = document.getElementById('finalizarPedidoBtn');

    if (resumenTamanio) resumenTamanio.innerText = pedido.tamanio || '-';
    if (resumenGusto) resumenGusto.innerText = pedido.gusto || '-';
    if (resumenRellenos) resumenRellenos.innerText = pedido.rellenos?.join(', ') || 'Sin rellenos extra';
    if (resumenTotal) resumenTotal.innerHTML = `$${total.toLocaleString()}`;

    if (finalizarBtn) {
        finalizarBtn.addEventListener('click', () => {
            const pedidoFinal = {
                ...pedido,
                total,
                fecha: new Date().toISOString(),
                estado: 'Pendiente',
                id: Date.now()
            };
            let pedidosData = JSON.parse(localStorage.getItem('pedidos') || '[]');
            pedidosData.push(pedidoFinal);
            localStorage.setItem('pedidos', JSON.stringify(pedidosData));
            localStorage.removeItem('pedidoTemp');
            window.location.href = 'gracias.php';
        });
    }
}

// ========== REGISTRO/LOGIN (TABS) ==========
function initAuthTabs() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const loginPanel = document.getElementById('loginPanel');
    const registroPanel = document.getElementById('registroPanel');
    const switchToRegistro = document.getElementById('switchToRegistro');
    const switchToLogin = document.getElementById('switchToLogin');

    if (!tabBtns.length) return;

    function switchTab(tabId) {
        if (tabId === 'login') {
            if (loginPanel) loginPanel.classList.add('active');
            if (registroPanel) registroPanel.classList.remove('active');
            tabBtns.forEach((btn, i) => {
                btn.classList.toggle('active', i === 0);
            });
        } else {
            if (loginPanel) loginPanel.classList.remove('active');
            if (registroPanel) registroPanel.classList.add('active');
            tabBtns.forEach((btn, i) => {
                btn.classList.toggle('active', i === 1);
            });
        }
    }

    if (tabBtns[0]) tabBtns[0].addEventListener('click', () => switchTab('login'));
    if (tabBtns[1]) tabBtns[1].addEventListener('click', () => switchTab('registro'));
    if (switchToRegistro) switchToRegistro.addEventListener('click', (e) => { e.preventDefault(); switchTab('registro'); });
    if (switchToLogin) switchToLogin.addEventListener('click', (e) => { e.preventDefault(); switchTab('login'); });

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('tab') === 'registro') switchTab('registro');
}

// ========== INICIALIZAR SEGÚN LA PÁGINA ==========
document.addEventListener('DOMContentLoaded', () => {
    const path = window.location.pathname;
    const filename = path.split('/').pop();

    // Inicializar según el archivo actual
    if (filename === 'admin-login.php') {
        initAdminLogin();
    } else if (filename === 'admin.php') {
        initAdmin();
    } else if (filename === 'torta-create.php') {
        initCliente();
    } else if (filename === 'resumen.php') {
        initResumen();
    } else if (filename === 'registro.php') {
        initAuthTabs();
    }
});