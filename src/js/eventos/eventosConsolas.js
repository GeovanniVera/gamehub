import { validarAlfanumerico, validarLongitud } from '../validadores/validaciones.js';
import { mostrarError, mostrarExito, habilitarBoton } from '../doms/dom.js';

const nameInput = document.getElementById('name');

export function inicializarEventos() {
    nameInput.addEventListener('input', validarNombreEnTiempoReal);
    document.querySelector('#consoleForm').addEventListener('submit', manejarSubmit);
    window.addEventListener('load', () => habilitarBoton('consoleForm', false)); // Deshabilitar botón al cargar
}

function validarNombreEnTiempoReal() {
    const valor = nameInput.value.trim();
    
    if (valor === '') {
        mostrarError('name', 'Por favor, ingresa el nombre de la consola.');
    } else if (!validarAlfanumerico(valor)) {
        mostrarError('name', 'Formato de nombre no válido.');
    } else if (!validarLongitud(valor, 30)) {
        mostrarError('name', 'El nombre puede contener máximo 30 caracteres.');
    } else {
        mostrarExito('name');
    }
    actualizarEstadoBoton();
}

function manejarSubmit(event) {
    const nombre = nameInput.value.trim();
    let errors = 0;

    if (nombre === '') {
        mostrarError('name', 'Por favor, ingresa el nombre de la consola.');
        errors++;
    } else if (!validarAlfanumerico(nombre)) {
        mostrarError('name', 'El nombre no cumple con un formato válido.');
        errors++;
    } else if (!validarLongitud(nombre, 30)) {
        mostrarError('name', 'El nombre puede contener máximo 30 caracteres.');
        errors++;
    } else {
        mostrarExito('name');
    }

    if (errors > 0) {
        event.preventDefault();
    }
}

function actualizarEstadoBoton() {
    habilitarBoton('consoleForm', sonTodosLosCamposValidos());
}

function sonTodosLosCamposValidos() {
    return validarAlfanumerico(nameInput.value) && validarLongitud(nameInput.value, 30);
}
