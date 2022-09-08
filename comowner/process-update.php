<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Update Company Owner Info</title>
</head>
<body>
    <div class="container-fluid">
    <div class="mb-3 mt-5 col-md-6 offset-md-3">
    
    <?php
    include '../connect.php';
    $id = $_GET['registerID']; 
    $newName = $_POST['newname'];
    $newPhone = $_POST['newphone'];
    $conn = OpenCon();

    $sql = "update CompanyOwner set name = '$newName', phoneNume = '$newPhone' where registerID = $id";

    if ($conn->query($sql) === TRUE){
    // echo "<script>location.href='owner.php';</script>";
    ?>
        <div class="alert alert-success text-center" role="alert">
            <h4 class="alert-heading">Success!</h4>
            <p>Company Owner Info Updated successfully!
            <hr>
            <a href="/strata/comowner/comowner.php" class="btn btn-primary">Back to All Company Owners</a>
        </div>
    <?php
    }
    else{
    ?>
        <div class="alert alert-danger text-center" role="alert">
            <h4 class="alert-heading">Error!</h4>
            <p><?php echo "Error updating record: " . $conn->error?>
            <hr>
            <a href="/strata/comowner/comowner.php" class="btn btn-primary">Go Back to All Company Owners</a>
        </div>
    <?php
    }
    ?>
    </div>
    </div>
    
</body>
</html>




