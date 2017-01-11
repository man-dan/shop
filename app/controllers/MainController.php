<?php
include_once '../app/models/ProductsModel.php';

class MainController
{
    public function  index()
    {
        get_products();
    }
    public function  product(){

        get_info(intval($_GET['id']));

    }
    public function article()
    {
        echo "this is Article";
    }

} 