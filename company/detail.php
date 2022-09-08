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
    <a class="navbar-brand" href="/strata/company/company.php">Back to all companies</a>
</nav>

<body>
    <?php
    include '../connect.php';
    $id = $_GET['companyID'];
    $conn = OpenCon();
    $com = $conn->query("SELECT companyID, name, address 
        FROM StrataManagementCompany
        WHERE StrataManagementCompany.companyID = '$id'");
    $result = $conn->query("SELECT propertyID, propertyName, location
        FROM Property_AssignTo
        WHERE NOT EXISTS 
        (SELECT companyID FROM StrataManagementCompany
        WHERE StrataManagementCompany.companyID != '$id' AND StrataManagementCompany.companyID = Property_AssignTo.companyID)");
    $total = $conn->query("SELECT COUNT(property_assignto.companyID), stratamanagementcompany.name
        FROM `property_assignto` JOIN stratamanagementcompany
        ON property_assignto.companyID = stratamanagementcompany.companyID
        WHERE stratamanagementcompany.companyID = '$id'");
    $owner = $conn->query("SELECT CompanyOwner.registerID, CompanyOwner.phoneNume, CompanyOwner.name, Own.role, Own.cdate 
        FROM CompanyOwner 
        INNER JOIN Own ON Own.registerID = CompanyOwner.registerID 
        WHERE Own.companyID = '$id'");
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
                                <p class="card-text">Company ID: <?php echo $row["companyID"] ?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><?php echo $row["address"] ?></li>
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
                        Properties Under Management
                    </div>
                    <div class="card-body">
                        <table class="table table-hover text-center">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">PropertyID</th>
                                    <th scope="col">Property Name</th>
                                    <th scope="col">Location</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo $row["propertyID"] ?></td>
                                            <td><?php echo $row["propertyName"] ?></td>
                                            <td><?php echo $row["location"] ?></td>
                                        </tr>

                                <?php
                                    }
                                } else
                                    echo "0 results";
                                //CloseCon($conn);
                                ?>
                            </tbody>
                        </table>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a class=" btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Summary
                            </a>
                        </div>
                        <div class="collapse mt-1" id="collapseExample">
                            <div class="card card-body">
                                <table class="table table-hover text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Strata Company Name</th>
                                            <th scope="col">Total Properties</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($total->num_rows > 0) {
                                            // output data of each row
                                            while ($row = $total->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <th scope="row"><?php echo $row["name"] ?></td>
                                                    <td><?php echo $row["COUNT(property_assignto.companyID)"] ?></td>

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

                <div class="card mb-5">
                    <div class="card-header">
                        Company Owner
                    </div>
                    <div class="card-body">
                        <table class="table table-hover text-center">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Register ID</th>
                                    <th scope="col">Company Owner Name</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Start Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($owner->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $owner->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo $row["registerID"] ?></td>
                                            <td><?php echo $row["name"] ?></td>
                                            <td><?php echo $row["phoneNume"] ?></td>
                                            <td><?php echo $row["role"] ?></td>
                                            <td><?php echo $row["cdate"] ?></td>
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