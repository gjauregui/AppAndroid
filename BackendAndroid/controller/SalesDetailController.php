<?php
require_once "models/SalesDetailModel.php";

class SalesDetailController
{
    public function findSaleDetail_get()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $id= $_GET['id'];

            $objSD = new SalesDetailModel();
            $objSD->setId($id);
            $objGet = $objSD->findSaleDetail();
            
            header('Content-Type:Application/json; charset="utf-8"');
            
            echo json_encode($objGet);
        } else {
            echo "error";
        }
    }
    

    public function save_post()
    {
        if ($_SERVER['REQUEST_METHOD'] = 'POST') {
            
            $sale_id = $_POST['sale_id'];
            $prod_id = $_POST['prod_id'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            
            $objSalesDetail = new SalesDetailModel();
            
            $objSalesDetail->setSale_id($sale_id);
            $objSalesDetail->setProd_id($prod_id);
            $objSalesDetail->setPrice($price);
            $objSalesDetail->setQuantity($quantity);
            
            $objSave = $objSalesDetail->save();

            header('Content-Type:Application/json; charset="utf-8"');

            echo json_encode($objSave);
        }
    }
}
