<?php


namespace MyControllers;


use App\DB;
use App\Views;

class menu
{

    static function keygen($uri,$request)
    {
        //var_dump($uri);

        $db = new DB();
        $rq = $db->select("*","`keys`")->all(MYSQLI_ASSOC);

        Views::view("keygen",$rq);

    }
    static function profile($uri,$request)
    {
        //var_dump($uri);

        Views::view("profile",$uri);

    }
}