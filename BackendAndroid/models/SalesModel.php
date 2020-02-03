<?php

require_once "config/db.php";

class SalesModel
{
    private $id;
    private $bussines_name;
    private $ruc;
    private $user_id;
    private $representative;
    private $delete_at;
    private $status_type;
    private $con;

    public function __construct()
    {
        $this->con = new Connect();
    }


    public function getId()
    {
        return $this->id;
    }

    public function getBussines_name()
    {
        return $this->bussines_name;
    }

    public function getRuc()
    {
        return $this->ruc;
    }


    public function getUser_id(){
        return $this->user_id;
    }

    public function getRepresentative(){
        return $this->representative;
    }


    public function getDelete_at()
    {
        return $this->delete_at;
    }

    public function getStatus_type()
    {
        return $this->status_type;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setBussines_name($bussines_name){
        $this->bussines_name = $bussines_name;
        
    }

    public function setRuc($ruc){
        $this->ruc = $ruc;
    }

    public function setUser_id($user_id){
        $this->user_id = $user_id;
    }

    public function setRepresentative($representative){
        $this->representative = $representative;
    }

    public function setDelete_at($delete_at){
        $this->delete_at = $delete_at;
        
    }

    public function setStatus_type($status_type){
        $this->status_type = $status_type;
    }

    public function save()
    {
      $result = array();

      $sql = "INSERT INTO Sales VALUES (NULL,'{$this->getBussines_name()}','{$this->getRuc()}',{$this->getUser_id()},'{$this->getRepresentative()}',NULL,'{$this->getStatus_type()}')";

      $save = $this->con->prepare($sql);

      if($save->execute())
      {
          $result = [
            'id' => $this->con->lastInsertId()
          ];
      }
      return $result;
    }


    public function all()
    {
        $result = false;

        $sql = "SELECT sl.id, u.name as 'user_name', sl.bussiness_name, sl.status_type,(select sum(t.total) as 'total' from (select (price * quantity) as total, sd.sale_id as sale_id from Sales_detail as sd) as t WHERE t.sale_id = sl.id) as total from Sales as sl, Users as u where sl.user_id = u.id and sl.deleted_at is NULL";
  
        $all = $this->con->prepare($sql);

        if ($all->execute()) {
            
            $result = $all->fetchAll();

        }
        return $result;
    }
}
