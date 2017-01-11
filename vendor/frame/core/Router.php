<?php

namespace frame\core;

class Router
{
    public function start()
    {

        $route =  urldecode(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
        $routing = [
               "/shop/web/"=>['controller'=>"Main", 'action'=>"index"],
               "/shop/web/article"=>['controller'=>"Main", 'action'=>"article"],
               "/shop/web/product"=>['controller'=>"Main", 'action'=>"product"],
               "/shop/web/cat"=>['controller'=>"Cat", 'action'=>"index"],
               "/shop/web/pod_cat"=>['controller'=>"Cat", 'action'=>"products"],
            "/shop/web/add_cart"=>['controller'=>"Cart", 'action'=>"add_to_Cart"],
            "/shop/web/del_cart"=>['controller'=>"Cart", 'action'=>"del_from_Cart"],
            "/shop/web/cart"=>['controller'=>"Cart", 'action'=>"index"],
            "/shop/web/reg_user"=>['controller'=>"User", 'action'=>"regUser"],
            "/shop/web/auth_user"=>['controller'=>"User", 'action'=>"authUser"],
            "/shop/web/log_out"=>['controller'=>"User", 'action'=>"logOut"],
            "/shop/web/user"=>['controller'=>"User", 'action'=>"index"],
            "/shop/web/update_prof"=>['controller'=>"User", 'action'=>"update_prof"]
                ];
        if(isset($routing[$route]))
        {
            $controller =  $routing[$route]['controller']."Controller";
            $obj = new $controller();
            $obj->$routing[$route]['action']();
        }
        else
        {
            echo "<script>window.location.href='/shop/web';</script>";
        }
    }

} 