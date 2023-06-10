<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "mydb";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(!$conn){
    die("connection failed".mysqli_connect_error());
}
echo "connection successful<hr>";

if(isset($_REQUEST['update'])){
    //checking all fields
    if(($_REQUEST['name'] == "")  || ($_REQUEST['roll'] == "") || ($_REQUEST['address'] == ""))
    {
        echo "fill all the fields";
    
    }
    else{

    }
}

//sql statement to update
$sql = "UPDATE student SET name = ?, roll = ?, address = ? WHERE id = ?";
 
//prepare statement
$result = mysqli_prepare($conn, $sql);

if($result){
    //bind variables to prepare statement as parameters
    mysqli_stmt_bind_param($result, 'sisi', $name, $roll, $address, $id);

    //variables and values
    $name = "lucky";
    $roll = 3;
    $address = "sadakpur";
    $id = 3;

     //execute statement
     mysqli_stmt_execute($result);
 
     //store
    echo mysqli_stmt_affected_rows($result)."Row updated <br>";

}
//close prepared statement
mysqli_stmt_close($result);

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
        <div class="row">
            <div class="col-sm-4">
                <?php
                if(isset($_REQUEST['edit'])){
                    //select the specific data
                    $sql = "SELECT * FROM student WHERE id = ?";
                    
                    //prepare statement 
                    $result = mysqli_prepare($conn, $sql);

                    //bind the variable to values
                    mysqli_stmt_bind_param($result, 'i', $id);

                    $id = $_REQUEST['id'];

                    //bind result set in variables
                    mysqli_stmt_bind_result($result, $id, $name, $roll, $address);

                    //execute 
                    mysqli_stmt_execute($result);

                    //fetch single row data
                    mysqli_stmt_fetch($result);

                    //close prepared statement important
                    mysqli_stmt_close($result);
                }
                ?>
                <form action="" method="POST">

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?php if(isset($name))
                        {echo $name;} ?>"><br>
                    </div>
                    <div class="form-group">
                        <label for="roll">Roll</label>
                        <input type="text" class="form-control" name="roll" id="roll" value="<?php if(isset($roll))
                        {echo $roll;}?>"> <br>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" id="address" value="<?php if(isset($address))
                        {echo $address;} ?>"><br>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit" class="btn btn-success" name="update">Update</button>
                </form>
            </div>
            <div class="col-sm-6 offset-sm-2">
                <?php
    $sql = "SELECT * FROM student";

    //prepare statement
     $result = mysqli_prepare($conn, $sql);

     //Bind result set in variables
     mysqli_stmt_bind_result($result, $id,$name, $roll, $address);

     //execute statement
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
        echo "<th>Action</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        //fetch all data
        while(mysqli_stmt_fetch($result)){
        echo "<tr>";
        echo "<td>".$id."</td>";
        echo "<td>".$name."</td>";
        echo "<td>".$roll."</td>";
        echo "<td>".$address."</td>";
        echo '<td>
        <form action ="" method="POST"> 
        <input type="hidden" name ="id" value='.$id.'>
        <input type="submit" class = "btn btn-sm btn-warning" name ="edit" value="Edit">
        </form></td>';
        echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        }
        else{
            echo "0 results";
        }
    ?>
            </div>
        </div>
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
//close prepared statement
mysqli_stmt_close($result);

//close connection
mysqli_close($conn); 
?>

</html>