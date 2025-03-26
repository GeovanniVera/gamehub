// Módulo de validación -> Encargado de validar los campos del formulario
/**
 * Validaciones generales de formularios
 */

export function validarFormatoAlfabetico(value) {
    const regex = /^[A-Za-záéíóúÁÉÍÓÚñÑüÜ]+(?: [A-Za-záéíóúÁÉÍÓÚñÑüÜ]+)*$/;
    return regex.test(value.trim());
}

export function validarVacio(value) {
    return value.trim() === '';
}

export function validarAlfanumerico(nombre) {
    const regex = /^[A-Za-záéíóúÁÉÍÓÚñÑüÜ0-9\s:'\-&]+$/;
    return regex.test(nombre);
}

export function validarLongitud(valor, longitud) {
    if (typeof valor !== 'string') {
        return false; // Devuelve falso si el valor no es una cadena
    }
    return valor.length <= longitud;
}