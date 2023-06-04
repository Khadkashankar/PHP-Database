<?php

//create connection
$dsn = "mysql:host=localhost; dbname=mydb;"; //dsn= data source name
$dbuser = "root";
$dbpass = "";

try{
$conn = new PDO($dsn, $dbuser, $dbpass);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 echo "connected";  
}
catch(PDOException $e){
    echo "connection failed".$e->getMessage();
}
echo"<hr>";

//retrieving data from student table
$sql = "SELECT * FROM student";
$result = $conn->query($sql);
// $row = $result->fetch(PDO::FETCH_ASSOC);
foreach($result->fetchAll(PDO::FETCH_ASSOC) as $row){
    echo " ID:". $row['id']. " name:". $row['name']. " roll:". $row['roll']. 
    " address:" .$row['address']. "<br><br>";
}
// echo"<pre>",print_r($row),"</pre>";




?>