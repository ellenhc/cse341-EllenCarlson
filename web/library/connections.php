<?php
function databaseConnect()
{
    $dbUrl = getenv('DATABASE_URL');
    if(empty($dbUrl)){
        return localConnect();
    }
    $dbOpts = parse_url($dbUrl);
    $dbHost = $dbOpts["host"];
    $dbPort = $dbOpts["port"];
    $dbUser = $dbOpts["user"];
    $dbPassword = $dbOpts["pass"];
    $dbName = ltrim($dbOpts["path"], '/');
    try {
        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        echo 'Error:' . $e->getMessage();
        header('Location: /view/500.php');
        die();
    }
}
function localConnect(){
    $server = 'localhost';
    $dbname = 'finanny';
    $username = 'iClient';
    $password = 'kqbSW8Mhjpp8uexd';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $link = new PDO($dsn, $username, $password, $options);
        return $link;
    } 
    catch(PDOException $e) {
        header('Location: /view/500.php');
        exit;
    }
}