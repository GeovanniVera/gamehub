<?php

namespace App\Controllers;

use App\Classes\Middlewares;
use App\Classes\Validators;
use App\Classes\Session;
use MVC\Router;
use App\Models\User;

class RegisterController extends BaseController
{
    /**
     * Renderiza la vista de registro de usuario.
     *
     * @param Router $router El enrutador MVC.
     */
    public static function register(Router $router)
    {
        Middlewares::isGuest();
        $data = [];
        $data = extractMessages("errores");
        $router->render('auth/register', $data);
    }

    /**
     * Guarda un nuevo usuario o actualiza uno existente.
     *
     * Este método maneja la lógica para guardar o actualizar un usuario en la base de datos.
     * Primero, obtiene los datos del formulario, los valida y los sanitiza. Luego, crea una
     * instancia de la clase Usuario,revisa que no exista un usuario registrado llamando el metdodo findBy, 
     * asigna los valores y llama al método save() para guardar o actualizar el registro. 
     * Finalmente mmaneja el resultado instancia un objeto de la clase Email y ejecuta el metodo enviar confirmacion,
     * setea un mensaje apropiado y redirecciona a login.
     */
    public static function saveUser()
    {
        Middlewares::isGuest();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 1. Obtener los datos del formulario.
            Session::start();
            if (!isset($_POST['id']) || $_POST['id'] == '') {
                $id = null;
            }
            
            $data = [
                'id' => $id, // Obtener el ID si existe (para actualizar).
                'name' => $_POST['name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ];

            // 2. Validar datos.
            $errores = self::validateData($data);

            if (!empty($errores)) {
                Session::set('errores', $errores);
                header('Location: /register');
                exit;
            }

            // 3. Sanitizar datos.
            $userData = self::sanitizateData($data);

            // 4. Crear una instancia de Usuario.
            $user = User::arrayToObject($userData);
            $isValidEmail= User::where('email',$user->getEmail());
            //valida que no exista en la base de datos.
            if ($isValidEmail) {
                Session::set('errores', ["ⓘ El usuario {$isValidEmail->getEmail()} ya esta registrado"]);
                header('Location: /register');
                exit;
            }
            // 6. Llamar a la función save() para guardar o actualizar el registro.
            $resultado = User::save($user);

            // 7. Manejar el resultado.
            if ($resultado) {
                Session::set('exitos', ["Usuario {$user->getEmail()} creado correctamente verifica tu cuenta desde tu correo"]);
                header('Location: /');
                exit;
            }
        }
    }

    


    /**
     * Valida los datos del usuario.
     *
     * @param array $data Los datos del usuario.
     * @return array Un array de errores.
     */
    protected static function validateData($data)
    {
        $errors = [];
        // Revisar Vacíos
        $errors = self::validateEmpties($data);
        // Revisar formatos
        $errors[] = Validators::alfa($data['name'], 'Nombre');
        $errors[] = Validators::alfa($data['last_name'], 'Apellido');
        $errors[] = Validators::email($data['email'], 'Email');
        $errors[] = Validators::password($data['password']);
        // Filtrar valores vacíos para evitar NULLs en el array
        return array_filter($errors);
    }
}
