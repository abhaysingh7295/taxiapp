<?php

//Verify Referer
if(
    !isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] == "" ||
    !isset($_GET['apik']) || $_GET['apik'] == "" ||
    !isset($_SERVER['REMOTE_ADDR']) || $_SERVER['REMOTE_ADDR'] == "") {
        exit("API error, your referer informations aren't set");
} else {
    //Site referer
    $site = $_SERVER['HTTP_REFERER'];
    //Ip referer
    $ip = $_SERVER['REMOTE_ADDR'];
    //Get api key
    $apik = htmlentities($_GET['apik']);
    
    try
    {
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND    => "SET NAMES utf8"
        );
        //MySQL connection
        $bdd = new PDO('mysql:host=localhost;dbname=apitest', 'root', '', $options);
    }
    catch(Exception $e)
    {
        //If error, die
        die('Error: '.$e->getMessage());
    }
    
    
    //Lookup for the apikey in the database
    $answer = $bdd->query('SELECT * FROM apiCode WHERE apikey = "'.$apik.'" LIMIT 0,1');
    //Fetch settings for this api key
    while ($data = $answer->fetch()) {
        $limit_ip = $data['limit_ip'];
        $limit_referer = $data['limit_referer'];
        $limit_hour = $data['limit_hour'];
        $limit_day = $data['limit_day'];
    }
    
    //Verify API limits
    //Cookie, session, database? 
    
    
    //Return content
    echo "Api : Success!";
    
}