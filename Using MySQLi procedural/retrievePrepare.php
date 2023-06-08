<?php 
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "mydb";


//open/create a connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

//check connection
if(!$conn)
{
    die("connection failed");
}
echo "connected successfully";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Database Connection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php
    $sql = "SELECT * FROM student";

    //prepare statement
    $result = mysqli_prepare($conn, $sql);

    //bind result set in variables
    mysqli_stmt_bind_result($result, $id, $name, $roll, $address);

    //execute prepared statement
    mysqli_stmt_execute($result);
   
    //store result
    mysqli_stmt_store_result($result);
    
    if(mysqli_stmt_num_rows($result) > 0){
        echo '<table class ="table">';
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Name</th>";
        echo "<th>Roll No.</th>";
        echo "<th>Address</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while($row = mysqli_stmt_fetch($result)){
        echo "<tr>";
        echo "<td>".$id."</td>";
        echo "<td>".$name."</td>";
        echo "<td>".$roll."</td>";
        echo "<td>".$address."</td>";
        echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        }
        else{
            echo "0 result";
        }
    ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>
<?php
//close the prepared statement
mysqli_stmt_close($result);

//close connection
mysqli_close($conn);
?>

</html>