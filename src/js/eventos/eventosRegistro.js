/*
Módulo de manejo de eventos
Encargado de gestionar los eventos del formulario.
*/

import { validarEmail } from './../validadores/validacionesLogin.js';
import { validarFormatoAlfabetico, validarVacio } from '../validadores/validaciones.js';
import { mostrarError, mostrarExito, habilitarBoton } from './../doms/dom.js';
import { validarPasswordRegister, validarFormatoPassword } from '../validadores/validacionesRegistro.js';

//inputs que se validaran del formulario
const nombreInput = document.getElementById('name');
const lastNameInput = document.getElementById('last_name');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');

//Funcion que inicializa los eventos 
export function inicializarEventos() {
    lastNameInput.addEventListener('input', () => validarNombreGenerico(lastNameInput, 'last_name'));
    nombreInput.addEventListener('input', () => validarNombreGenerico(nombreInput, 'name'));
    emailInput.addEventListener('input', validarEmailEnTiempoReal);
    passwordInput.addEventListener('input', validarPasswordEnTiempoReal);
    document.querySelector('#registerForm').addEventListener('submit', manejarSubmit);
    window.addEventListener('load', () => habilitarBoton('registerForm',false)); // Deshabilitar botón al cargar
}

//Funcion que valida campos genericos se puede extraer en un futuro 
function validarNombreGenerico(input, inputName) {
    if (validarVacio(input.value.trim())) {
        mostrarError(inputName, 'El campo no puede estar vacío.');
    } else if (!validarFormatoAlfabetico(input.value)) {
        mostrarError(inputName, 'El campo solo puede contener letras.');
    } else {
        mostrarExito(inputName);
    }
    actualizarEstadoBoton();
}

//Validar email en tiempo real se puede extraer en el futuro para siimplificar 
// pues se utiliza de forma repetitiva en varias funciones 
function validarEmailEnTiempoReal() {
    if (validarVacio(emailInput.value)) {
        mostrarError('email', 'Porfavor Ingresa un email.');
    } else if (!validarEmail(emailInput.value)) {
        mostrarError('email', 'El email no cumple con un formato válido.');
    } else {
        mostrarExito('email');
    }
    actualizarEstadoBoton();
}


function validarPasswordEnTiempoReal() {
    const password = passwordInput.value;
    if (validarVacio(password)) {
        mostrarError('password', 'Por favor, ingresa tu contraseña.');
    } else if (!validarFormatoPassword(password)) {
        mostrarError('password', 'La contraseña debe tener al menos 8 caracteres, incluir mayúsculas, minúsculas, un número y un símbolo especial.');
    } else {
        mostrarExito('password');
    }
    actualizarEstadoBoton();
}

function manejarSubmit(event) {
    let errors = 0;

    if (!validarFormatoAlfabetico(nombreInput.value) || validarVacio(nombreInput.value)) {
        mostrarError('name', 'El nombre es obligatorio y solo puede contener letras.');
        errors++;
    } else {
        mostrarExito('name');
    }

    if (!validarEmail(emailInput.value)) {
        mostrarError('email', 'Por favor, ingresa un correo válido.');
        errors++;
    } else {
        mostrarExito('email');
    }

    if (!validarFormatoPassword(passwordInput.value)) {
        mostrarError('password', 'La contraseña no cumple con los requisitos de seguridad.');
        errors++;
    } else {
        mostrarExito('password');
    }

    if (errors > 0) {
        event.preventDefault();
    }
}

function actualizarEstadoBoton() {
    habilitarBoton('registerForm',sonTodosLosCamposValidos);
}

function sonTodosLosCamposValidos() {
    const nombreValido = !validarVacio(nombreInput.value) && validarFormatoAlfabetico(nombreInput.value);
    const apellidoValido = !validarVacio(lastNameInput.value) && validarFormatoAlfabetico(lastNameInput.value);
    const emailValido = validarEmail(emailInput.value);
    const passwordValido = validarPasswordRegister(passwordInput.value);
    return nombreValido && emailValido && passwordValido && apellidoValido;
}


