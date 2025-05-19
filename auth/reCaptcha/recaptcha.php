<?php

    require_once('../../vendor/autoload.php');
    
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../../');

    $dotenv->load();


    $siteKey=  $_ENV['RECAPTCHA_SITE_KEY'];
    




?>