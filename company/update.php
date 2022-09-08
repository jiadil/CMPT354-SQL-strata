<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Update Strata Management Company</title>
</head>

<nav id="navbar-example2" class="navbar navbar-light bg-light px-3 sticky-top">
    <a class="navbar-brand" href="/strata/check-connection.php">Home</a>
    <a class="navbar-brand" href="/strata/company/company.php">Back to all companies</a>
</nav>

<body>
    <?php
    include '../connect.php';
    $conn = OpenCon();
    $id = $_GET['companyID'];
    $name = $_GET['name'];
    $address = $_GET['address'];
    ?>

    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example container" tabindex="0">
        <div class="row mx-auto mt-5 mb-5">
            <form action="process-update.php?companyID=<?php echo $id ?>" method="POST">
                <div class="container-fluid">
                    <div class="mb-3 col-md-6 offset-md-3">
                        <legend class=" text-center mt-5">Edit Company #<?php echo $id ?></legend>
                        <div class="mb-3">
                            <label for="newname" class="form-label">New Company Name</label>
                            <input type="text" class="form-control" id="newname" name="newname" value="<?php echo $name ?>"required>
                        </div>
                        <div class="mb-3">
                            <label for="newaddress" class="form-label">New Address</label>
                            <input type="text" class="form-control" id="newaddress" name="newaddress" value="<?php echo $address ?>"required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

<?php
include("../display/footer.php");
?>

</html>