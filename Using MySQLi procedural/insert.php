<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "test_db";


//create connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(!$conn){
    die("connection failed");
}
echo "connection success<hr>";
//query for inserion
$sql = "INSERT INTO student (name, class, roll, address) VALUES('dinesh', 12, 123, 'mahendranagar'), ('bipin',11,123,'airee')";
if(mysqli_query($conn, $sql)){
    echo "new data inserted";

}
else{
   echo "unable to insert";
}


?>