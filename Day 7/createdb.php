<?php

$host="localhost";
$user="root";
$pass="";


try {
    $conn = new PDO("mysql:host=$host",$user,$pass);
    $sql="Create database testdb";
    $conn->exec($sql);
    echo "connected";
}catch(Exception $e){
    echo "not connected";
}
?>