<?php
require_once 'app/models/user.model.php';
require_once 'app/views/auth.view.php';

class AuthController {

    private $model;
    private $view;
    
    function __construct(){
        $this->model = new UserModel();
        $this->view = new AuthView();
    }
    
        
    function showLogin(){

        return $this->view->showLogin();
    }

    public function login() {
        if (!isset($_POST['email']) || empty($_POST['email'])) {
            return $this->view->showLogin('Falta completar el nombre de usuario');
        }
    
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->view->showLogin('Falta completar la contraseña');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
    
        // Verificar que el usuario está en la base de datos
        $userFromDB = $this->model->getUserByEmail($email);

        if($userFromDB && password_verify($password, $userFromDB->password)){
            session_start();
            $_SESSION['ID_USER'] = $userFromDB->id;
            $_SESSION['EMAIL_USER'] = $userFromDB->email;
            $_SESSION['LAST_ACTIVITY'] = time();

            header('Location: ' . BASE_URL);
        } else{
            return $this->view->showLogin('Credenciales incorrectas');
        }
    }

    public function logout(){
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL);
    }
}