<?php

include_once '../app/models/CatsModel.php';


class CartController
{
    public function index()
    {
        include_once 'templates/cart.tpl';

    }

    public function add_to_Cart()
    {

        $id = isset($_GET["id"]) ? intval($_GET["id"]) : null;

        if(! $id) exit();
        $resData = array();
        if(isset($_SESSION['cart']) && array_search($id, $_SESSION['cart']) === false)
        {
            $_SESSION['cart'][] = $id;
            $resData['amount'] = count($_SESSION['cart']);
            $resData['success'] = 1;
        }
        else
        {
            $resData['success'] = 0;
        }
        ob_end_clean();
        echo json_encode($resData);
    }

    public function del_from_Cart()
    {
        $id = isset($_GET["id"]) ? intval($_GET["id"]) : null;
        if(! $id) exit();
        $resData = array();
        $prod = array_search($id,$_SESSION['cart']);
        if($prod !== false){
            unset($_SESSION['cart'][$prod]);
            $resData['success'] = 1;
            $resData['amount'] = count($_SESSION['cart']);
        }
        else{
            $resData['success'] = 0;
        }
        ob_end_clean();
        echo json_encode($resData);
    }
}
