<?php

require_once "config/db.php";

class UsersModel
{
    private $id;
    private $name;
    private $user;
    private $pass;
    private $delete_at;
    private $rol;
    private $con;

    public function __construct()
    {
        $this->con = new Connect();
    }


    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function getDelete_at()
    {
        return $this->delete_at;
    }
    
    public function getRol(){
        return $this->rol;
    }
    

    public function setId($id){
        $this->id = $id;
    }
    
    public function setName($name){
        $this->name = $name;
        
    }
    public function setUser($user){
        $this->user = $user;
    }

    public function setPass($pass){
        $this->pass =$pass;       
    }
    
    public function setDelete_at($delete_at){
        $this->delete_at = $delete_at;
        
    }
    
    public function setRol($rol){
        $this->rol = $rol;
    }
    
    public function save(){
        
        $result = false;
        
        $sql = "INSERT INTO Users VALUES (NULL,'{$this->getName()}','{$this->getUser()}','{$this->getPass()}',NULL,'{$this->getRol()}')";
        $save = $this->con->prepare($sql);
        
        if($save->execute()){
            $result = true;
        }
        
        return $result;
        
    }


    public function login()
    {
        $result = false;

        $sql = "SELECT id,name,user,pass,rol FROM Users WHERE user ='{$this->getUser()}' and deleted_at is NULL";
        $login = $this->con->prepare($sql);

        if ($login->execute()) {
            $objuser = $login->fetchObject();

            if($this->getPass() == $objuser->pass){
                $result = $objuser;
            }
        }
        return $result;
    }
}
