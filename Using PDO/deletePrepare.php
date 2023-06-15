<?php
$dsn = "mysql:host=localhost;dbname=mydb;";
$dbuser = "root";
$dbpass = "";


try{
    $conn = new PDO($dsn, $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}
catch(PDOException $e){
    echo "connection failed".$e->getMessage();
}

    
    $sql = "DELETE FROM student WHERE id = :id";

    //prepared statement
    $result = $conn->prepare($sql);

   

    //bind parameter to prepared statement
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    

    $id = 39;
   
  
    $result->execute();

    echo $result->rowCount()."row deleted<br>";



//close prepared statement
unset($result);

//close connection
$conn = null;

?>