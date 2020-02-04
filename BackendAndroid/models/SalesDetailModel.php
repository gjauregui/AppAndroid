<?php

require_once "config/db.php";

class SalesDetailModel
{
    private $id;
    private $sale_id;
    private $prod_id;
    private $price;
    private $quantity;
    private $con;
    private $error = true;
    private $rest = array();
    private $data = null;

    public function __construct()
    {
        $this->con = new Connect();
    }


    public function getId()
    {
        return $this->id;
    }

    public function getSale_id()
    {
        return $this->sale_id;
    }

    public function getProd_id()
    {
        return $this->prod_id;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getData(){
        return $this->data;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setSale_id($sale_id)
    {
        $this->sale_id = $sale_id;
    }

    public function setProd_id($prod_id)
    {
        $this->prod_id = $prod_id;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function result($message){
      
            $this->rest= [
                "error"  => $this->error,
                "message"=> $message,
                "code" => http_response_code(),
                "data"   =>$this->getData(),
                "debug" => null   
            ];
  
    }
    public function save()
    {   
        $sqlSave = "INSERT INTO Sales_detail VALUES (NULL,{$this->getSale_id()},{$this->getProd_id()},{$this->getPrice()},{$this->getQuantity()})";

        $save = $this->con->prepare($sqlSave);

        if($save->execute())
        {
            $this->setId($this->con->lastInsertId());

            $sqlGet="SELECT id,sale_id,prod_id,price,quantity FROM Sales_detail WHERE id = {$this->getId()}";

            $get = $this->con->prepare($sqlGet);

            if($get->execute())
            {
                $result = $get->fetchObject();

                if(is_object($result)){

                    $this->error = false;

                    $this->setData($result);

                    $this->result("Response.saved");

                }else{
                    $this->result("Response.error");
                }
            }else{                
                $this->result("Response.error");
            }
        }else{
            $this->result("Response.error");
        }

        return $this->rest;
    }


    public function findSaleDetail()
    {
        $sqlCabezera = "SELECT s.bussiness_name,s.ruc,s.representative,u.name as 'name_user',s.status_type FROM Sales s  INNER JOIN Users u on u.id = s.user_id WHERE s.id = {$this->getId()}";
        
        $sqlProducts = "SELECT p.name ,sd.price as 'unit_price', sd.quantity,(sd.price * sd.quantity) as 'sub_total' FROM Sales_detail sd INNER JOIN Sales s on s.id = sd.sale_id INNER JOIN Products p on p.id = sd.prod_id WHERE s.id = {$this->getId()}";
        
        $sqlTotal = "SELECT sum(price * quantity) as 'total'  from Sales_detail sd inner join Sales s on s.id = sd.sale_id WHERE s.id = {$this->getId()}";
        
        //obtengo los datos  del  detalle la venta
        $findCabezera = $this->con->prepare($sqlCabezera);

        if ($findCabezera->execute()) {
            $resultCabezera = $findCabezera->fetchObject();
            
            //obtengo los productos del detalle de la venta
            $findBody = $this->con->prepare($sqlProducts);

            if ($findBody->execute()) {
                $resultBody =$findBody->fetchAll();
                
                //obtengo el total a pagar del detalle de la venta
                $findTotal = $this->con->prepare($sqlTotal);
               
                if ($findTotal->execute()) {

                    $resultTotal = $findTotal->fetchObject();

                    if(is_object($resultTotal)){

                        $this->error = false;
                        $this->setData([
                                array_merge(
                                    (array)$resultCabezera,
                                    ["productos" => $resultBody],
                                    (array)$resultTotal
                                )
                            ]);

                        $this->result("Response.get");
                
                    }else{
                        $this->result("Response.error");
                    } 
                }else{
                    $this->result("Response.error");
                } 
            }else{
                $this->result("Response.error");
            } 
        }else{
            $this->result("Response.error");
        } 

        return  $this->rest;
    }
    
  
}
