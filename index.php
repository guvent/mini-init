<?php

ini_set("display_errors", 0);

include_once "app/helper.php";

foreach (glob("controllers/*.php") as $inc_files)
{
    include $inc_files;
}

include "sys/helper.php";




?>