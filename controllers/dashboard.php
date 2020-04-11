<?php


namespace MyControllers;


use App\Views;

class dashboard
{

    static function home($uri,$request)
    {
        //var_dump($re);

        Views::view("dashboard",$uri);

    }
}