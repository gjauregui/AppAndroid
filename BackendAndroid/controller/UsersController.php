<?php
require_once "models/UsersModel.php";

class UsersController{
    
    public function save_post(){
        
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
            
            $save = $objuser->save();
    
 
            echo $save;
    
    
        }
        
        
    }
    
    public function login_post()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $json = array();
            $user= $_POST['user'];
            $pass = $_POST['pass'];

            $objuser = new UsersModel();
            $objuser->setUser($user);
            $objuser->setPass($pass);

            $object = $objuser->login();
            $json[]= $object;
            header('Content-Type:Application/json; charset="utf-8"');
            echo json_encode($json);
            
            
        }else
        {
            echo "error";
        }
    }



}