<?php
include_once '../app/models/ProductsModel.php';

function pod_cats(){

    $pod_cats = get_pod_cats(intval($_GET['id']));
    if(!empty($pod_cats))
    {   echo "<br>";
        $cat = get_cat_name();
        echo "<div id='pod_cat'><h1><label>Подкатегории в разделе {$cat} </label></h1>";
        foreach($pod_cats as $index => $value)
        {
            echo "<h2 style='margin-left: 20%;'><a href='pod_cat?id={$index}' style=''> {$value}</a></h2>";
        }
        echo "</div>";
    }
    else{
        echo "<div id='products'><h2>Такой категории не существует</h2></div>";
    }
}

function get_cat_name(){
    $id = intval($_GET['id']);
    $res = pg_query(db(), "SELECT category FROM categories WHERE id = {$id}");
    $row = pg_fetch_row($res);
    return $row[0];
}

function get_pod_products(){
    $id = intval($_GET['id']);
    $res = pg_query(db(), "SELECT * FROM products WHERE pod_cat_id = {$id}ORDER BY ID DESC");
    if(pg_num_rows($res) == 0)
    {
        echo "<div id='products'><h2>В даной категории покаместь нету товаров</h2></div>";
    }
    else
    {
        echo "<div id='products'>";
        $i = 0;
        while ($rows = pg_fetch_assoc($res)) {
            $i++;
            echo "<div id='prod'><img src='images/products/{$rows["image"]}' style='width:240px;height:300px;'/><a href='product?id={$rows["id"]}'>{$rows['title']}</a></div>";
            if ($i % 3 == 0) echo "<br>";
        }
        echo "</div>";
    }
}