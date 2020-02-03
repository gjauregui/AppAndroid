<?php
require_once "models/ProductsModel.php";

class ProductsController
{
    public function save_post()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name=$_POST['name'];
            $price=$_POST['price'];

    
            $objprod = new ProductsModel();
    
            $objprod->setName($name);
            $objprod->setPrice($price);

        
            $save = $objprod->save();
    
            echo json_encode($save);
        }
    }
    
    public function all_get()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $objprod = (new ProductsModel)->all();

            header('Content-Type:Application/json; charset="utf-8"');
            
            echo json_encode($objprod);
        } else {
            echo "error";
        }
    }
}
