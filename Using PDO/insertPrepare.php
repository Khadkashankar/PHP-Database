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

try{
    //using anonymous positional placeholder
    // $sql = "INSERT INTO student(name, roll, address) VALUES (?, ?, ?)";
    $sql = "INSERT INTO student(name, roll, address) VALUES (:name, :roll, :address)";

    //prepared statement
    $result = $conn->prepare($sql);

    //bind parameter to prepared statement
    // $result->bindParam(1, $name, PDO::PARAM_STR);
    // $result->bindParam(2, $roll, PDO::PARAM_INT);
    // $result->bindParam(3, $address, PDO::PARAM_STR);

    //bind parameter to prepared statement
    $result->bindParam(':name', $name, PDO::PARAM_STR);
    $result->bindParam(':roll', $roll, PDO::PARAM_INT);
    $result->bindParam(':address', $address, PDO::PARAM_STR);

   // variables and values
    // $name = "selena";
    // $roll = 30;
    // $address = "japan";
    
    $name = "chris";
     $roll = 32;
     $address = "america";

    //execute prepared statement
    // $result->execute(array('bhuwan',29,'champhapur'));
    // $result->execute();
    // $result->execute(array(':name'=>'justin',':roll'=>31,':address'=>'bhamka'));
    $result->execute(array(':name'=>$name, ':roll'=>$roll, ':address'=>$address));

    echo $result->rowCount()."row inserted<br>";
}
catch(PDOException $e){
    echo $e->getMessage();
}

//close prepared statement
unset($result);

//close connection
$conn = null;

?>