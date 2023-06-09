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


//insert data
$sql = "INSERT INTO student(name, roll, address) VALUES(?, ?, ?)";

//prepare statement
$result = mysqli_prepare($conn, $sql);

//binding 
if($result){
    //Bind Variable to Prepare statement as parameters
    mysqli_stmt_bind_param($result,'sis',$name, $roll, $address);

    //Variables and Values
    $name = "debindra bist";
    $roll = 21;
    $address ="Bauniya";

    //Execute the prepared statement
    mysqli_stmt_execute($result);
    //Variables and Values
    $name = "ratan karki";
    $roll = 22;
    $address ="Dang";

    //Execute the prepared statement
    mysqli_stmt_execute($result);
    //Variables and Values
    $name = "ansh verma";
    $roll = 23;
    $address ="gaddachauki";

    //Execute the prepared statement
    mysqli_stmt_execute($result);
}
//close the prepared statement
mysqli_stmt_close($result);

//close connection
mysqli_close($conn);

?>