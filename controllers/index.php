<?php

namespace MyControllers;

use App\Views;
use App\DB;

class index
{
    static function home($uri,$request)
    {
        //var_dump($uri);
        //echo "Hello Home!";

        $db = new DB();
        $r = $db->select("*","db")->all();

        //var_dump($r);

        Views::view("index","response deneme");
    }

    static function login($uri,$request)
    {
        header("Location: /dashboard");
        //var_dump($request);
    }

}



