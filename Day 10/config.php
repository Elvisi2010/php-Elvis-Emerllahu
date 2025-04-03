<?php
 
 
 session_start();
     $usser="root";
     $pass="";
     $server="localhost";
     $dbname="dbelvis";
 
 
     try{
         $conn= new PDO("mysql:host=$server; dbname=$dbname",$usser,$pass);
         echo "connected";
     }catch(PDOException $e){
         echo "error : ". $e->getMessage();
     }
 
 
 ?>