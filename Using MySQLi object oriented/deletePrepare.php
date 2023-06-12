<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "mydb";


//create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if($conn->connect_error){
    die("connection failed");
}
echo "connection success<hr>";
 //sql to insert
 if(isset($_REQUEST['submit'])){
    //checking for empty field
    if(($_REQUEST['name'] == "")  || ($_REQUEST['roll'] == "") || ($_REQUEST['address'] == ""))
{
    echo "fill all the fields";

}
else{
    
    //sql statement to insert
    $sql = "INSERT INTO student (name, roll, address) VALUES (?, ?, ?)";

    //prepare statement
   $result = $conn->prepare($sql);

//binding 
if($result){
    //Bind Variable to Prepare statement as parameters
    $result->bind_param('sis', $name, $roll, $address);

      //variables and values
    $name = $_REQUEST['name'];
    $roll = $_REQUEST['roll'];
    $address = $_REQUEST['address'];

    $result->execute();

    echo $result->affected_rows."Row inserted <br>";
}
else{
    echo "not inserted";
}
//close the prepared statement
$result->close();
}
}
//sql to delete
if(isset($_REQUEST['delete'])){

    //sql statement to delete
    $sql = "DELETE FROM student WHERE id = ?";

    //prepare statement
    $result = $conn->prepare($sql);

if($result){
    //Bind Variable to Prepare statement as parameters
    $result->bind_param('i', $id);
     
    //variables and values
    $id = $_REQUEST['id'];

    //execute prepared statement
    $result->execute();

    echo $result->affected_rows."Row deleted<br>";
}
$result->close();

}
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
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name"><br>
                    </div>
                    <div class="form-group">
                        <label for="roll">Roll</label>
                        <input type="text" class="form-control" name="roll" id="roll"><br>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" id="address"><br>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>
            <div class="col-sm-6 offset-sm-2">
                <?php
    $sql = "SELECT * FROM student";
    //prepare statement
     $result=$conn->prepare($sql);

    //Bind result set in variables
    $result->bind_result($id, $name, $roll, $address);

    //execute statement
    $result->execute();

   //store result
    $result->store_result();
    
    if($result->num_rows > 0){
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
        while($result->fetch()){
        echo "<tr>";
        echo "<td>".$id."</td>";
        echo "<td>".$name."</td>";
        echo "<td>".$roll."</td>";
        echo "<td>".$address."</td>";
        echo '<td><form action = "" method="POST"><input type="hidden" name="id"
        value='.$id.'><input type="submit" class="btn btn-sm btn-danger"
        name="delete" value="Delete"></form></td>';
        echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        }else{
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
$result->close();
$conn->close();
?>

</html>