<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Update Strata Manager Info</title>
</head>

<nav id="navbar-example2" class="navbar navbar-light bg-light px-3 sticky-top">
    <a class="navbar-brand" href="/strata/check-connection.php">Home</a>
    <a class="navbar-brand" href="/strata/manager/manager.php">Back to all strata managers</a>
</nav>

<body>

    <?php
    include '../connect.php';
    $conn = OpenCon();
    $id = $_GET['licenseNum'];
    $company = $_GET['companyID'];
    $name = $_GET['name'];
    $phone = $_GET['phoneNum'];

    $sql = "SELECT companyID FROM StrataManagementCompany";
    $result = $conn->query($sql);

    ?>

    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example container" tabindex="0">
        <div class="row mx-auto mt-5 mb-5">
            <form action="process-update.php?licenseNum=<?php echo $id ?>" method="POST">
                <div class="container-fluid">
                    <div class="mb-3 col-md-6 offset-md-3">
                        <legend class=" text-center mt-5">Edit Strata Manager #<?php echo $id ?></legend>
                        <div class="mb-3">
                            <label for="newname" class="form-label">New Strata Manager Name</label>
                            <input type="text" class="form-control" id="newname" name="newname" value="<?php echo $name ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="newphone" class="form-label">New phone</label>
                            <input type="text" class="form-control" id="newphone" name="newphone" value="<?php echo $phone ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="newcompany" class="form-label">New Company ID</label>
                            <select class="form-select" name="newcompany" id="newcompany">
                                <option selected><?php echo $company ?></option>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    unset($companyid);
                                    $companyid = $row['companyID'];
                                ?>
                                    <option value="<?php echo $companyid ?>"><?php echo $companyid ?></option>
                                <?php
                                }
                                ?>
                            </select>
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