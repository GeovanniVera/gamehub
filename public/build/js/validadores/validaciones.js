export function validarFormatoAlfabetico(t){return/^[A-Za-záéíóúÁÉÍÓÚñÑüÜ]+(?: [A-Za-záéíóúÁÉÍÓÚñÑüÜ]+)*$/.test(t.trim())}export function validarVacio(t){return""===t.trim()}export function validarAlfanumerico(t){return/^[A-Za-záéíóúÁÉÍÓÚñÑüÜ0-9\s:'\-&]+$/.test(t)}export function validarLongitud(t,r){return"string"==typeof t&&t.length<=r}