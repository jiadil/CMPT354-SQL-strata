<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Detail</title>
</head>

<nav id="navbar-example2" class="navbar navbar-light bg-light px-3 sticky-top">
    <a class="navbar-brand" href="/strata/check-connection.php">Home</a>
    <a class="navbar-brand" href="/strata/comowner/comowner.php">Back to all company owners</a>
</nav>

<body>
    <?php
    include '../connect.php';
    $id = $_GET['registerID'];
    $conn = OpenCon();
    $com = $conn->query("SELECT registerID, phoneNume, name 
        FROM CompanyOwner
        WHERE CompanyOwner.registerID = '$id'");
    $company = $conn->query("SELECT StrataManagementCompany.companyID, StrataManagementCompany.name, StrataManagementCompany.address
        FROM StrataManagementCompany
        JOIN Own ON Own.companyID = StrataManagementCompany.companyID
        WHERE Own.registerID = '$id'");
    $manager = $conn->query("SELECT Supervise.licenseNum, Supervise.evaluation, Supervise.bonus, StrataManager_Work.name, StrataManager_Work.phoneNum
        FROM StrataManager_Work
        JOIN Supervise ON StrataManager_Work.licenseNum = Supervise.licenseNum
        WHERE Supervise.registerID = '$id'");

    ?>

    <div class="container">
        <div class="row mt-md-5">
            <div class="col-md-3">
                <?php
                if ($com->num_rows > 0) {
                    // output data of each row
                    while ($row = $com->fetch_assoc()) {
                ?>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row["name"] ?></h5>
                                <p class="card-text">Register ID: <?php echo $row["registerID"] ?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><?php echo $row["phoneNume"] ?></li>
                            </ul>
                        </div>
                <?php
                    }
                } else
                    echo "0 results";
                //CloseCon($conn);
                ?>
            </div>

            <div class="col-md-9 mb-5">
                <div class="card mb-5">
                    <div class="card-header">
                        Companies Under Management
                    </div>
                    <div class="card-body">
                        <table class="table table-hover text-center">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Company ID</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($company->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $company->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo $row["companyID"] ?></td>
                                            <td><?php echo $row["name"] ?></td>
                                            <td><?php echo $row["address"] ?></td>
                                        </tr>

                                <?php
                                    }
                                } else
                                    echo "0 results";
                                //CloseCon($conn);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mb-5">
                    <div class="card-header">
                        Strata Manager Under Supervised
                    </div>
                    <div class="card-body">
                        <table class="table table-hover text-center">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">License Number</th>
                                    <th scope="col">Strata Manager Name</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Evaluation</th>
                                    <th scope="col">Bonus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($manager->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $manager->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo $row["licenseNum"] ?></td>
                                            <td><?php echo $row["name"] ?></td>
                                            <td><?php echo $row["phoneNum"] ?></td>
                                            <td><?php echo $row["evaluation"] ?></td>
                                            <td><?php echo $row["bonus"] ?></td>
                                        </tr>
                                <?php
                                    }
                                } else
                                    echo "0 results";
                                CloseCon($conn);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>


</body>

<?php
include("../display/footer.php");
?>

</html>