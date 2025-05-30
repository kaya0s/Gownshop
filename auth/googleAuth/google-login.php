<?php

    require_once('../../vendor/autoload.php');
    
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../../');

    $dotenv->load();


    $client=  new Google_Client();
    $client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
    $client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
    $client->setRedirectUri($_ENV['GOOGLE_REDIRECT']);

    $client->addScope($_ENV['email']);
    $client->addScope($_ENV['profile']);
    $client->setPrompt('select_account');

    // Create auth URL with prompt=select_account parameter
    $authUrl = $client->createAuthUrl();
    
    header('location:'.$authUrl);
    exit();


    





?>