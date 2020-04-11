<?php

include "config.php";

use Config\Application;
Application::gatherInfo();

include_once Application::$app_path . "/app/helper.php";

include "routes.php";

?>