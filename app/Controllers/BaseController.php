<?php

namespace App\Controllers;

use App\Classes\Validators;

/**
 * Clase Abstracta base para todos los controladores tiene metodos 
 * reutilizables
 */
abstract class BaseController{

    /**
     * validateEmpty metodo estatico que evalua un arreglo y 
     * verifica que este no contenga datos vacios
     * Valida los datos 
     * @param array $data
     * @return array $errores 
     */
    protected static function validateEmpties(array $data){
        $errors = [];
        foreach ($data as $key => $value){
            if($key == 'id') continue;
            $errors[] =  Validators::required($value,$key);
        } 
        $errors = array_filter($errors);
        if(empty($errors)) return [];
        return $errors;
    }

    abstract protected static function validateData($data);

    /**
     * Sanitiza los datos del usuario.
     *
     * Este método utiliza htmlspecialchars() para escapar caracteres especiales y trim() para
     * eliminar espacios en blanco al principio y al final de cada valor.
     *
     * @param array $data Los datos del usuario.
     * @return array Los datos del usuario sanitizados.
     */
    protected static function sanitizateData($data)
    {
        foreach ($data as $key => $value) {
            // Sanitización general
            $sanitizedValue = $value !== null
                ? htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8')
                : null;

            // Sanitización especial para 'id'
            if ($key === 'id') {
                $sanitizedValue = ($sanitizedValue !== null && $sanitizedValue !== '')
                    ? (int) $sanitizedValue  // Convertir a entero
                    : null;
            }

            $data[$key] = $sanitizedValue;
        }
        return $data;
    }
}