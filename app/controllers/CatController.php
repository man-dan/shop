<?php

include_once '../app/models/CatsModel.php';

class CatController
{


    public function index()
    {
        pod_cats();
    }
    public function  products()
    {
        get_pod_products();
    }
}