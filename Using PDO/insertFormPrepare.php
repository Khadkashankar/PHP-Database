<?php
$dsn = "mysql:host=localhost;dbname=mydb;";
$dbuser = "root";
$dbpass = "";


try{
    $conn = new PDO($dsn, $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}
catch(PDOException $e){
    echo "connection failed".$e->getMessage();
}

if(isset($_REQUEST['submit'])){
    if(($_REQUEST['name']=="")  || ($_REQUEST['roll']=="")|| ($_REQUEST['address']==""))
{
    echo "please fill all fields";
}
else{
    
    $sql = "INSERT INTO student(name, roll, address) VALUES (:name, :roll, :address)";

    //prepared statement
    $result = $conn->prepare($sql);

  
    // bind parameter to prepared statement
    $result->bindParam(':name', $name, PDO::PARAM_STR);
    $result->bindParam(':roll', $roll, PDO::PARAM_INT);
    $result->bindParam(':address', $address, PDO::PARAM_STR);

    $name = $_REQUEST['name'];
    $roll = $_REQUEST['roll'];
    $address = $_REQUEST['address'];

    $result->execute();

    echo $result->rowCount()."row inserted<br>";

//close prepared statement
unset($result);

}
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
</body>
<?php $conn = null; ?>

</html