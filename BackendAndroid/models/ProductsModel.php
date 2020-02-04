<?php

require_once "config/db.php";

class ProductsModel
{
    private $id;
    private $name;
    private $price;
    private $delete_at;
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

    public function getPrice()
    {
        return $this->price;
    }

    public function getDelete_at()
    {
        return $this->delete_at;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setDelete_at($delete_at)
    {
        $this->delete_at = $delete_at;
    }
    
    
    public function save()
    {
        $result = array();
        
        $sqlSave = "INSERT INTO Products VALUES (NULL,'{$this->getName()}',{$this->getPrice()},NULL)";
        
        $save = $this->con->prepare($sqlSave);
        
        if ($save->execute()) {
            $this->setId($this->con->LastInsertId());

            $sqlGet= "SELECT id,name,price FROM Products WHERE id = {$this->getId()}";

            $get = $this->con->prepare($sqlGet);

            if ($get->execute()) {
                $result = $get->fetchObject();
            }
        }
        
        return $result;
    }


    public function all()
    {
        $result = array();

        $sql = "SELECT id,name,price FROM Products WHERE deleted_at is NULL";
        
        $all = $this->con->prepare($sql);

        if ($all->execute()) {
            $result = $all->fetchAll();
        }
        return $result;
    }
}
