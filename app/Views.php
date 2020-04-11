<?php


namespace App;


class Views
{
    static function view($template,$response)
    {
        include "views/".$template.".php";
    }
}