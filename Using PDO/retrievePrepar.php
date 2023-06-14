<?php

$dsn = "mysql:host=localhost;dbname=mydb;";
$db_user = "root";
$db_pass = "";


try{
    $conn = new PDO($dsn, $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   echo "connected<hr>";
}
catch(PDOException $e){
echo "connection failed" . $e->getMessage();
}

try{
// $sql = "SELECT * FROM student WHERE id = ? && name = ?";//positional parameter
$sql = "SELECT * FROM student WHERE id = :id && name = :name";//named parameter

//prepared statement
$result = $conn->prepare($sql);

// $id = 1;
//bind variables to value
// $result->bindParam(1,s $id);
// $result->bindParam(':id', $id);
// $result->bindValue(':id', 4);




// $result->execute(array(3,'lucky'));
$result->execute(array(':id'=>1,':name'=>'anil'));

$row = $result->fetch(PDO::FETCH_ASSOC);


echo "ID:".$row['id'] ." Name:".$row['name']." Roll:".$row['roll']." Address:".$row['address'];
}

catch(PDOException $e){
    echo $e->getMessage();
}
unset($result);

$conn = null;


?>