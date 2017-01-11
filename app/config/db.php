<?php
function db(){
    $pgcon = pg_connect("host=localhost port=5432 dbname=shop user=man-dan@mail.ru password=mandan1997");
    return $pgcon;
}
