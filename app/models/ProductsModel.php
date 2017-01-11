<?php

function get_cats(){
    $res = pg_query(db(), "SELECT * FROM categories ");
    while($rows = pg_fetch_assoc($res)){
        echo "<div id='l_m'><h2><a href='cat?id={$rows['id']}'> {$rows['category']}</a></h2>";
        $pod_cats = get_pod_cats($rows['id']);
        if(!empty($pod_cats))
        {
            foreach($pod_cats as $index => $value)
            {
                echo "<p><h3>&nbsp;&nbsp;&ndash;&ndash;<a href='pod_cat?id={$index}' style='text-decoration: none; color: black;'> {$value}</a></h3></p>";
            }
        }
       echo "</div>";
    }

}

function get_pod_cats($id_cat){
    $res = pg_query(db(), "SELECT * FROM pod_cat WHERE parent_id = '$id_cat'");
    $arr = array();
    while($rows = pg_fetch_assoc($res)){
        $arr[$rows["id"]]= $rows["descript"];
    }
    return $arr;
}

function get_products(){
    $res = pg_query(db(), "SELECT * FROM products ORDER BY ID DESC");
    if(empty($res))  return "Пока еще нет товаров в этой категории";
    echo "<div id='products'>";
    $i = 0;
    while($rows = pg_fetch_assoc($res)){
        $i++;
        echo "<div id='prod'><img src='images/products/{$rows["image"]}' style='width:240px;height:300px;'/><a href='product?id={$rows["id"]}'>{$rows['title']}</a></div>";
        if($i%3 == 0) echo "";

    }
    echo "</div>";
}

function get_add_cart_stat($id){
    $prod = in_array($id, $_SESSION['cart']);
    return empty($prod) ? "inline" : "none" ;
}

function get_del_cart_stat($id){
    $prod = in_array($id, $_SESSION['cart']);
    return empty($prod) ? "none" :  "inline";
}


function get_info($id){
    $res = pg_query(db(), "SELECT * FROM products WHERE id = $id");
    if(pg_num_rows($res) != 0) {
        $row = pg_fetch_assoc($res);
        echo "<div id='products'><img src='images/products/{$row["image"]}' style='width:240px;height:300px;margin: 7px 7px 7px 0; float:left;'/>{$row["price"]}грн.
        <a class= 'addCart_{$row["id"]}' style='display:".get_add_cart_stat($row["id"]).";'  onClick='addCart({$row["id"]}); return false;'  href='#' >Добавить товар в корзину</a>
        <a class= 'delCart_{$row["id"]}' style='display:".get_del_cart_stat($row["id"]).";'  onClick='delCart({$row["id"]}); return false;' href='#'>Убрать товар из корзины</a>
<a href='product?id={$row["id"]}'>{$row['title']}</a>
        <div>{$row['descript']}</div></div>";
    }
    else{
        echo "<script>window.location.href='/shop/web';</script>";
    }
}

function stat_cart()
{
    $ids = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
    if(!$ids) return false;
    else return $ids;
}

function get_prod_in_cart()
{
    $ids = stat_cart();
    $products = implode($ids, ',');
    $res = pg_query(db(), "SELECT * FROM products WHERE id in ({$products})  ORDER BY ID DESC");
    if(pg_num_rows($res) !=0 ){
        while($row = pg_fetch_assoc($res))
        {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td><a href='product?id={$row["id"]}'>{$row['title']}</a>&nbsp;&nbsp;</td>
                    <td><input name='{$row["id"]}' type='text' id='{$row["id"]}' value='1' onchange='convPrice({$row["id"]});' size='10' /></td>
                    <td>
                        <span id='price_{$row["id"]}' value='{$row["price"]}'>&nbsp;&nbsp;&nbsp;{$row['price']}</span> 
                    </td>
                    <td>
                        <span id='r_price_{$row["id"]}'>{$row['price']}</span> 
                    </td>
                    <td>&nbsp;&nbsp;<a class= 'addCart_{$row["id"]}' style='display:".get_add_cart_stat($row["id"]).";'  onclick='addCart({$row["id"]}); return false;'  href='#' >Добавить</a>
                        <a class= 'delCart_{$row["id"]}' style='display:".get_del_cart_stat($row["id"]).";'  onclick='delCart({$row["id"]}); return false;' href='#'>Убрать</a>
                    </td>
                   </tr>";
        }
    }
}