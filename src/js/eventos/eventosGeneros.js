import { validarAlfanumerico, validarLongitud } from '../validadores/validaciones.js';
import { mostrarError, mostrarExito, habilitarBoton } from '../doms/dom.js';

const nameInput = document.getElementById('name');
const descriptionInput = document.getElementById('description');

export function inicializarEventos() {
    nameInput.addEventListener('input', validarNombreEnTiempoReal);
    descriptionInput.addEventListener('input', validarDescripcionEnTiempoReal);
    document.querySelector('#genreForm').addEventListener('submit', manejarSubmit);
    window.addEventListener('load', () => habilitarBoton('genreForm', false)); // Deshabilitar botón al cargar
}

function validarNombreEnTiempoReal() {
    if (this.value.trim() === '') {
        mostrarError('name', 'Por favor, ingresa el nombre del género.');
    } else if (!validarAlfanumerico(this.value)) {
        mostrarError('name', 'Formato de nombre no válido.');
    } else if (!validarLongitud(this.value, 30)) {
        mostrarError('name', 'El nombre puede contener máximo 30 caracteres.');
    } else {
        mostrarExito('name');
    }
    actualizarEstadoBoton();
}

function validarDescripcionEnTiempoReal() {
    if (this.value.trim() === '') {
        mostrarError('description', 'Por favor, ingresa una descripción.');
    } else if (!validarAlfanumerico(this.value)) {
        mostrarError('description', 'El formato de la descripción es inválido.');
    } else if (!validarLongitud(this.value, 200)) {
        mostrarError('description', 'La descripción puede contener máximo 200 caracteres.');
    } else {
        mostrarExito('description');
    }
    actualizarEstadoBoton();
}

function manejarSubmit(event) {
    const nombre = nameInput.value.trim();
    const descripcion = descriptionInput.value.trim();
    let errors = 0;

    if (nombre === '') {
        mostrarError('name', 'Por favor, ingresa el nombre del género.');
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

    if (descripcion === '') {
        mostrarError('description', 'Por favor, ingresa una descripción.');
        errors++;
    } else if (!validarLongitud(descripcion, 200)) {
        mostrarError('description', 'La descripción puede contener máximo 200 caracteres.');
        errors++;
    } else {
        mostrarExito('description');
    }

    if (errors > 0) {
        event.preventDefault();
    }
}

function actualizarEstadoBoton() {
    habilitarBoton('genreForm', sonTodosLosCamposValidos());
}

function sonTodosLosCamposValidos() {
    const nameValido = validarAlfanumerico(nameInput.value) && validarLongitud(nameInput.value, 30);
    const descriptionValido = validarAlfanumerico(descriptionInput.value) && validarLongitud(descriptionInput.value, 200);
    return nameValido && descriptionValido;
}
