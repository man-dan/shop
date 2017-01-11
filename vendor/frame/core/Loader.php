<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 17.10.16
 * Time: 21:03
 */

class Loader
{
    public  function  loadClass($class)
    {
        $arr = explode('\\',$class);
        $prefix = array_shift($arr);
        if($prefix == 'app'){
            $file = '../app/classes/';

        }
        elseif($prefix == 'frame'){
            $file = '../vendor/frame/';
        }
        $f_file = $file . implode('/',$arr) . '.php';
        if(is_file($f_file)){
            require_once $f_file;
        }

    }
} 