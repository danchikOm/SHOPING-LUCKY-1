<?php


class UserController
{

    public function actionRegister(){
        $name = '';
        $email ='';
        $password ='';
        $result = false;

        if (isset($_POST['registr'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confPassw = $_POST['confPassw'];


            $errors = false;


            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 3 символов';
               }

            if (!User::checkEmail($email)){
                $errors[] = 'Неправильно набран E-mail';
            }
            if (!User::checkPassword($password)){
                $errors[] = 'Пароль должен быть не менее 6 символов';
            }
            if (User::checkEmailExists($email)){
                $errors[] = 'Такой e-mail уже используется';
            }
            if ($errors == false){
                $result = User::register($name, $email, $password);//save user;
            }


        }

        require_once(ROOT.'/views/user/register.php');

        return true;


    }

    public function actionLogin(){

        $email = '';
        $password = '';
        if (isset($_POST['auth'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;


            if (!User::checkEmail($email)){
                $errors[] = 'Неправильно набран E-mail';
            }
            if (!User::checkPassword($password)){
                $errors[] = 'Пароль должен быть не менее 6 символов';
            }

            $userId = User::checkUserData($email, $password);
            if ($userId == false){
                $errors[] = 'Неправильные данные для авторизации';

            }else{

                USER::auth($userId);

                header("Location:/myProfile/");
            }
        }

        require_once (ROOT.'/views/user/login.php');
        return true;

    }

    public function actionLogout(){
        unset($_SESSION['user']);
        header('Location: /');
    }
}