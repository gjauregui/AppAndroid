<?php
require_once "models/SalesModel.php";

class SalesController
{

    public function save_post()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $bussiness_name=$_POST['bussiness_name'];
            $ruc=$_POST['ruc'];
            $user_id=$_POST['user_id'];
            $representative=$_POST['representative'];
            $status_type=$_POST['status_type'];

            $objSales = new SalesModel();
    
            $objSales->setBussines_name($bussiness_name);
            $objSales->setRuc($ruc);
            $objSales->setUser_id($user_id);
            $objSales->setRepresentative($representative);
            $objSales->setStatus_type($status_type);
            
            $objSave = $objSales->save();
            
            header('Content-Type:Application/json; charset="UTF-8"');
            
            echo json_encode($objSave);
        }
    }
    
    public function all_get()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $objSales= (new SalesModel)->all();

            header('Content-Type:Application/json; charset="utf-8"');
            
            echo json_encode($objSales);
            
        } else {
            echo "error";
        }
    }
}
