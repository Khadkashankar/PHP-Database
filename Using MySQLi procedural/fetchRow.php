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

// select all data
$sql = "SELECT * FROM student";

//prepare statement
$result = mysqli_prepare($conn, $sql);

//execute prepared statement
mysqli_stmt_execute($result);

//fetch single row data
mysqli_stmt_store_result($result);

//number of row
$total_row = mysqli_stmt_num_rows($result);
echo $total_row;

//free result
mysqli_stmt_free_result($result);

//close the prepared statement
mysqli_stmt_close($result);

//close connection
mysqli_close($conn);
?>