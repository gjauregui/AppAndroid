<?php
require_once "models/InsertSalesModel.php";

class InsertSalesController
{
    public function saveSale_post()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = array();
            
            $bussiness_name=$_POST['bussiness_name'];
            $ruc=$_POST['ruc'];
            $user_id=$_POST['user_id'];
            $representative=$_POST['representative'];

            $objSales = new InsertSalesModel();
    
            $objSales->setS_bussiness_name($bussiness_name);
            $objSales->setS_ruc($ruc);
            $objSales->setS_user_id($user_id);
            $objSales->setS_representative($representative);

            
            $json[] = $objSales->saveSale();
            

            
            echo json_encode($json);
        }
    }
    
    public function saveSaleDetail_post()
    {
        if ($_SERVER['REQUEST_METHOD'] = 'POST') {
            $sale_id = $_POST['sale_id'];
            $prod_id = $_POST['prod_id'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            
            $objSalesDetail = new InsertSalesModel();
            
            $objSalesDetail->setS_id($sale_id);
            $objSalesDetail->setSd_prod_id($prod_id);
            $objSalesDetail->setSd_price($price);
            $objSalesDetail->setSd_quantity($quantity);
            
            $save = $objSalesDetail->saveSaleDetail();
            
            echo json_encode($save);
        }
    }
}
