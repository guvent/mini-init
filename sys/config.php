<?php

/*  Database Config  */

namespace Config;

class Database
{
    static $dbhost = "db";
    static $dbname = "keygen";
    static $dbuser = "root";
    static $dbpass = "root";
    static $dbport = "3306";

}

/* Application Config */

class Application
{
    static $app_path = "/var/www/html";

    static function gatherInfo()
    {
        self::$app_path = $_SERVER["CONTEXT_DOCUMENT_ROOT"];
    }
}






?>