<?php
require_once "models/UsersModel.php";

class UsersController
{
    public function save_post()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name=$_POST['name'];
            $user=$_POST['user'];
            $pass=$_POST['pass'];
            $rol =$_POST['rol'];
    
            $objuser = new UsersModel();
    
            $objuser->setName($name);
            $objuser->setUser($user);
            $objuser->setPass($pass);
            $objuser->setRol($rol);
            
            $objSave = $objuser->save();

            header('Content-Type:Application/json; charset="UTF-8"');
 
            echo json_encode($objSave);
        }
    }
    
    public function login_post()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $user= $_POST['user'];
            $pass = $_POST['pass'];

            $objuser = new UsersModel();
            $objuser->setUser($user);
            $objuser->setPass($pass);

            $objLogin = $objuser->login();

            header('Content-Type:Application/json; charset="UTF-8"');

            echo json_encode($objLogin);
        } else {
            echo "error";
        }
    }
}
