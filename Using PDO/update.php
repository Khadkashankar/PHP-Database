<?php

$dsn = "mysql:host=localhost;dbname=mydb;";
$dbuser="root";
$dbpass="";


try{
    $conn = new PDO($dsn, $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //data insert from form
    if(isset($_REQUEST['update'])){
        //checking for empty fields
        if(($_REQUEST['name'] == "") || ($_REQUEST['roll'] == "")|| ($_REQUEST['address'] == "")){
            echo "<small>Fill all fields...</small><hr>";
        }
        else{
            $name = $_REQUEST['name'];
            $roll = $_REQUEST['roll'];
            $address = $_REQUEST['address'];
            
            $sql = "UPDATE student SET name='$name', roll='$roll', address='$address' WHERE id={$_REQUEST['id']}";
            $affected_row = $conn->exec($sql);
            echo $affected_row."row updated successfully";
        }
    }



}
catch(PDOException $e)
{
    echo "connection failed".$e->getMessage();
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
                <?php
                if(isset($_REQUEST['edit'])){
                $sql="SELECT * FROM student WHERE id = {$_REQUEST['id']}";
                $result = $conn->query($sql);
                $row = $result->fetch(PDO::FETCH_ASSOC);
                }
                ?>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?php if(isset($row['name']))
                        {echo $row['name'];} ?>"><br>
                    </div>

                    <div class=" form-group">
                        <label for="roll">Roll</label>
                        <input type="text" class="form-control" name="roll" id="roll" value="<?php if(isset($row['roll']))
                        {echo $row['roll'];} ?>"><br>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" id="address" value="<?php if(isset($row['address']))
                        {echo $row['address'];} ?>"><br>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-success" name="update">Update</button>
                </form>
            </div>
            <div class="col-sm-6 offset-sm-2">
                <?php
    $sql = "SELECT * FROM student";
    $result = $conn->query($sql);
    if($result->rowCount() > 0){
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
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['roll']."</td>";
        echo "<td>".$row['address']."</td>";
        echo '<td><form action = "" method="POST"><input type="hidden" name="id"
        value='.$row["id"].'><input type="submit" class="btn btn-sm btn-warning"
        name="edit" value="Edit"></form></td>';
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

</html>
<?php $conn = null; ?>