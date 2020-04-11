<?php

use App\Routes;


Routes::Request("get","", array( "index"=>"home" ) );

Routes::Request("GET","/index", array( "index"=>"home" ) );

Routes::Request("POST","/login", array( "index"=>"login" ) );

Routes::Request("GET","/dashboard", array( "dashboard"=>"home" ) );

Routes::Request("GET","/index", array( "index"=>"home" ) );

Routes::Request("GET","/menu/keys", array( "menu"=>"keygen" ) );

Routes::Request("GET","/menu/userprofile", array( "menu"=>"profile" ) );


/* Starting Application */
Routes::Explore();

?>