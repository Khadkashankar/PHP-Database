<?php

$dsn = "mysql:host=localhost;dbname=mydb;";
$dbuser = "root";
$dbpass = "";

try{
    $conn = new PDO($dsn, $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //insert data 
$sql = "INSERT INTO student (id, name, roll, address) VALUES ('5', 'chandraMohan', '14', 'baitadi')";
$affected_row = $conn->exec($sql);
echo $affected_row."data inserted";
}
catch(PDOException $e){
    echo "connection failed".$e->getMessage();
}




?>