<?php

class DataBase {
 
    
public static function getConnection() {

     
    
   $db_path = include ROOT.'/configs/db_config.php';
   
   $dsn = "mysql:dbname={$db_path['dbname']};host={$db_path['host']}";
   
   $db = new PDO($dsn, $db_path['user'], $db_path['password']);

    $db->exec('set names utf8');
   return $db;  
   
    
}    
    

    
    
    
    
}
