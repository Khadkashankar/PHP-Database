<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "mydb";

//open connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(!$conn){
    die("connection failed".mysqli_connect_error());
}
echo "connect successfully<hr>";

//sql statement to delete
$sql = "DELETE FROM student WHERE id = ?";

//prepare statement
$result = mysqli_prepare($conn, $sql);

if($result){
     //Bind Variable to Prepare statement as parameters
     mysqli_stmt_bind_param($result,'i', $id);
     
     //variables and values
     $id = 23;

     //execute prepared statement
     mysqli_stmt_execute($result);

     echo mysqli_stmt_affected_rows($result)."Row deleted<br>";

}
//close prepared statement
mysqli_stmt_close($result);

//close connection
mysqli_close($conn); 

?>