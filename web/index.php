<?php
    include_once 'templates/site_init.tpl';
    show_header();
    use frame\core\Router;
    include_once '../app/config/db.php';
    include_once '../app/config/config.php';
    $loader = new Loader();
    spl_autoload_register([$loader, 'loadClass']);
    $router = new Router();
    include_once 'templates/left_side.tpl';
    $router->start();

    show_footer();

?>
