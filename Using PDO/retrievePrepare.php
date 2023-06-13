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
echo "connected successfully<hr>";


try{
    //sql statement
    $sql = "SELECT * FROM student";

    //prepared statement
    $result = $conn->prepare($sql);

    //execute prepared statement
    $result->execute();

    //bind by column number
    $result->bindColumn('id', $id);
    $result->bindColumn('name', $name);
    $result->bindColumn('roll', $roll);
    $result->bindColumn('address', $address);


    while($result->fetch(PDO::FETCH_ASSOC)){
        echo "ID: ". $id ." Name: ". $name." Roll: ". $roll ." Address: ". $address."<br><br>";
    }
    
}

catch(PDOException $e){
    echo e->getMessage();
}
//close prepared statement
unset($result);

//close connection
$conn = null;

?>