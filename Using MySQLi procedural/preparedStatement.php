<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "mydb";


//create connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(!$conn){
    die("connection failed");
}
echo "connection success<hr>";

//select all data
// $sql = "SELECT * FROM student";

//fetch specific data
$sql = "SELECT * FROM student WHERE id = ?";

//prepare statement
$result = mysqli_prepare($conn, $sql);

//bind param
mysqli_stmt_bind_param($result, 'i', $id);

$id = 5;

//bind result set in variables
mysqli_stmt_bind_result($result, $id, $name, $roll, $address);

//execute prepared statement
mysqli_stmt_execute($result);

//fetch single row data
mysqli_stmt_fetch($result);
echo "I.D:".$id." Name:".$name." Roll:".$roll." Address:".$address."<br>";


//fetch all data
// while(mysqli_stmt_fetch($result))
// {
// echo "I.D:".$id." Name:".$name." Roll:".$roll." Address:".$address."<br>";
// }

//close the prepared statement
mysqli_stmt_close($result);

//close connection
mysqli_close($conn);
?>