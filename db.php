<?php

require "libs/rb.php";
R::setup( 'mysql:host=localhost;dbname=makeev',
        'root', 'root' );

session_start();
