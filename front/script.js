// ========== REGISTRO/LOGIN ==========
function initAuthTabs() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const loginPanel = document.getElementById('loginPanel');
    const registroPanel = document.getElementById('registroPanel');
    const switchToRegistro = document.getElementById('switchToRegistro');
    const switchToLogin = document.getElementById('switchToLogin');

    if (!tabBtns.length) return;

    function switchTab(tabId) {
        if (tabId === 'login') {
            loginPanel.classList.add('active');
            registroPanel.classList.remove('active');
            tabBtns.forEach((btn, i) => {
                btn.classList.toggle('active', i === 0);
            });
        } else {
            loginPanel.classList.remove('active');
            registroPanel.classList.add('active');
            tabBtns.forEach((btn, i) => {
                btn.classList.toggle('active', i === 1);
            });
        }
    }

    tabBtns[0]?.addEventListener('click', () => switchTab('login'));
    tabBtns[1]?.addEventListener('click', () => switchTab('registro'));
    switchToRegistro?.addEventListener('click', (e) => { e.preventDefault(); switchTab('registro'); });
    switchToLogin?.addEventListener('click', (e) => { e.preventDefault(); switchTab('login'); });
    
    // Verificar parámetro URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('tab') === 'registro') switchTab('registro');
}

// ========== CLIENTE ==========
function initCliente() {
    const checkboxes = document.querySelectorAll('#rellenosGrid input[type="checkbox"]');
    const radios = document.querySelectorAll('input[name="tamanio"]');
    const gustoSelect = document.getElementById('gustoBase');
    const elegidosDiv = document.getElementById('elegidosList');
    const confirmarBtn = document.getElementById('confirmarPedidoBtn');

    if (!checkboxes.length) return;

    function actualizarElegidos() {
        let seleccionados = [];
        
        radios.forEach(r => { if(r.checked) seleccionados.push(`🍰 ${r.value}`); });
        if(gustoSelect?.value && gustoSelect.value !== 'Seleccionar') {
            seleccionados.push(`🎂 Base: ${gustoSelect.value}`);
        }
        checkboxes.forEach(c => { if(c.checked) seleccionados.push(`🥄 ${c.value}`); });
        
        if(seleccionados.length === 0) {
            elegidosDiv.innerHTML = '<p style="color:#D4A594; text-align:center;">✨ Elegí los ingredientes de tu torta ✨</p>';
        } else {
            elegidosDiv.innerHTML = seleccionados.map(s => `<div class="elegido-item">❤️ ${s}</div>`).join('');
        }
    }

    checkboxes.forEach(cb => cb.addEventListener('change', actualizarElegidos));
    radios.forEach(r => r.addEventListener('change', actualizarElegidos));
    gustoSelect?.addEventListener('change', actualizarElegidos);

    confirmarBtn?.addEventListener('click', () => {
        const tamanio = document.querySelector('input[name="tamanio"]:checked')?.value;
        const gusto = gustoSelect?.value;
        const rellenos = Array.from(checkboxes).filter(c => c.checked).map(c => c.value);
        
        if(!tamanio) { 
            alert('🍰 Por favor, seleccioná el tamaño de tu torta'); 
            return; 
        }
        
        localStorage.setItem('pedidoTemp', JSON.stringify({ tamanio, gusto, rellenos }));
        window.location.href = './resumen.html';
    });
}

// ========== RESUMEN ==========
function initResumen() {
    const pedido = JSON.parse(localStorage.getItem('pedidoTemp') || '{}');
    const precios = { Chica: 1800, Mediana: 2500, Grande: 3500 };
    const precioBase = precios[pedido.tamanio] || 0;
    const extraPorRelleno = 250;
    const total = precioBase + (pedido.rellenos?.length || 0) * extraPorRelleno;
    
    document.getElementById('resumenTamanio').innerText = pedido.tamanio || '-';
    document.getElementById('resumenGusto').innerText = pedido.gusto || '-';
    document.getElementById('resumenRellenos').innerText = pedido.rellenos?.join(', ') || 'Sin rellenos extra';
    document.getElementById('resumenTotal').innerHTML = `$${total.toLocaleString()}`;
    
    document.getElementById('finalizarPedidoBtn')?.addEventListener('click', () => {
        const pedidoFinal = { 
            ...pedido, 
            total, 
            fecha: new Date().toISOString(), 
            estado: '🍰 Pendiente',
            id: Date.now()
        };
        let pedidos = JSON.parse(localStorage.getItem('pedidos') || '[]');
        pedidos.push(pedidoFinal);
        localStorage.setItem('pedidos', JSON.stringify(pedidos));
        localStorage.removeItem('pedidoTemp');
        window.location.href = './gracias.html';
    });
}

// ========== ADMIN ==========
function initAdmin() {
    const tablaBody = document.getElementById('tablaPedidos');
    if(tablaBody) {
        const pedidos = JSON.parse(localStorage.getItem('pedidos') || '[]');
        if(pedidos.length > 0) {
            tablaBody.innerHTML = pedidos.slice().reverse().map((p, idx) => `
                <tr>
                    <td>#${p.id || (1000 + idx)}</td>
                    <td>Cliente</td>
                    <td>${new Date(p.fecha).toLocaleDateString()}</td>
                    <td>$${p.total?.toLocaleString()}</td>
                    <td>${p.estado}</td>
                    <td><button class="btn-sm" onclick="marcarListo(${pedidos.length - 1 - idx})">✅ Listo</button></td>
                </tr>
            `).join('');
        } else {
            tablaBody.innerHTML = '<tr><td colspan="6" style="text-align:center">✨ No hay pedidos aún ✨</td></tr>';
        }
    }
}

function marcarListo(idx) {
    let pedidos = JSON.parse(localStorage.getItem('pedidos') || '[]');
    pedidos[idx].estado = '🎂 Listo para entregar';
    localStorage.setItem('pedidos', JSON.stringify(pedidos));
    location.reload();
}

// ========== INICIALIZAR ==========
document.addEventListener('DOMContentLoaded', () => {
    initAuthTabs();
    initCliente();
    if(window.location.pathname.includes('resumen')) initResumen();
    if(window.location.pathname.includes('admin')) initAdmin();
});