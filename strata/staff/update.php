<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Update Staff Info</title>
</head>

<nav class="navbar navbar-expand-md bg-light sticky-top">
    <div class="container-fluid">
        <div class="mx-auto order-0">
            <a class="navbar-brand mx-auto" href="/strata/check-connection.php">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/strata/staff/staff.php">Back to All Staff</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<body>

    <?php
    include '../connect.php';
    $conn = OpenCon();
    $id = $_GET['sinNum'];
    $name = $_GET['name'];
    $phone = $_GET['phoneNum'];
    ?>

    <form action="process-update.php?sinNum=<?php echo $id ?>" method="POST">
        <div class="container-fluid">
            <div class="mb-3 col-md-6 offset-md-3">
                <legend class=" text-center mt-5">Edit Staff #<?php echo $id ?></legend>
                <div class="mb-3">
                    <label for="newname" class="form-label">New Name</label>
                    <input type="text" class="form-control" id="newname" name="newname" value="<?php echo $name ?>" required>
                </div>
                <div class="mb-3">
                    <label for="newphone" class="form-label">New Phone Number</label>
                    <input type="number" class="form-control" id="newphone" name="newphone" value="<?php echo $phone ?>" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                </div>
            </div>
        </div>
    </form>

</body>

<?php
include("../display/footer.php");
?>

</html>