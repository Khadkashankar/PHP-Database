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
//sql to delete
if(isset($_REQUEST['delete'])){
    $sql = "DELETE FROM student WHERE roll = {$_REQUEST['roll']}";
if(mysqli_query($conn, $sql)){
echo "record deleted";
}
else{
    echo "unable to delete";
}
}
//sql to insert
// if(isset($_REQUEST['submit'])){
//     //checking for empty field
//     if(($_REQUEST['name'] == "") || ($_REQUEST['class'] == "") || ($_REQUEST['roll'] == "") || ($_REQUEST['address'] == ""))
// {
//     echo "fill all the fields";

// }
// else{
//     $name = $_REQUEST['name'];
//     $class = $_REQUEST['class'];
//     $roll = $_REQUEST['roll'];
//     $address = $_REQUEST['address'];
//     $sql = "INSERT INTO student (name, class, roll, address) VALUES('$name','$class','$roll','$address')";
// if(mysqli_query($conn, $sql)){
//     echo "new data inserted";
// }
// else{
//     echo "unable to insert";
// }
// }
// }



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
        <!-- <div class="row">
            <div class="col-sm-4">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name"><br>
                    </div>
                    <div class="form-group">
                        <label for="class">Class</label>
                        <input type="text" class="form-control" name="class" id="class"><br>
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
            <div class="col-sm-6 offset-sm-2"> -->
        <?php
    $sql = "SELECT * FROM student";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        echo '<table class ="table">';
        echo "<thead>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Class</th>";
        echo "<th>Roll No.</th>";
        echo "<th>Address</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['class']."</td>";
        echo "<td>".$row['roll']."</td>";
        echo "<td>".$row['address']."</td>";
        echo '<td><form action = "" method="POST"><input type="hidden" name="id"
        value='.$row['roll'].'><input type="submit" class="btn btn-sm btn-danger"
        name="delete" value="Delete"></form></td>';
        echo "</tr>";
        }
        echo "</tbody>";
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

</html>