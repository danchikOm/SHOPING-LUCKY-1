<?php


class User
{


    public static function register($name, $email, $password)
    {
       $dataBase = DataBase::getConnection();
       $sql = 'insert into user(name, email, password) values(:name, :email, :password)';
       $result = $dataBase->prepare($sql);
       $result->bindParam(':name',$name, PDO::PARAM_STR);
       $result->bindParam(':email',$email, PDO::PARAM_STR);
       $result->bindParam(':password',$password, PDO::PARAM_STR);

       return $result->execute();



    }

    public static function checkName($name)
    {
        if (strlen($name)>= 3){
            return true;
        }
        return false;
    }

    public static function checkPhone($phone){

        if(preg_match('/^[0-9]{10}+$/', $phone)){
            return true;
        }
        return  false;
    }

    public static function checkEmail($email)
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL); // Removes all illegal characters from an e-mail address
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;


    }

    public static function checkPassword($password)
    {
        if (strlen($password)>= 6){
            return true;
        }
        return  false;

    }

    public static function checkEmailExists($email)
    {
        $dateBase = DataBase::getConnection();
        $sql = 'select count(*) from user where email = :email';
        $result = $dateBase->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn()){
            return true;
        }
        return false;

    }

    public static function checkUserData($email, $password)
    {
        $dataBase = DataBase::getConnection();
        $sql = 'SELECT * FROM `user` WHERE email = :email AND password = :password ';
        $result = $dataBase->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if ($user){
            return $user['id'];
        }
        else{
            return false;
        }

    }

    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    {
        if (isset($_SESSION['user'])){
            return $_SESSION['user'];
        }else{
            header('Location: /user/login/');
        }
    }

    public static function getUserById($id)
    {
        if ($id){
            $db = DataBase::getConnection();
            $sql = 'select * from user where id = :id';
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();

        }
    }

    public static function isGuest(){
        if (isset($_SESSION['user'])){
            return false;
        }

        return true;
    }

    public static function edit($id, $name, $password)
    {
        $db = DataBase::getConnection();
        $sql = 'update user set name = :name, password = :password where id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();

    }



}