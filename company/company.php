<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Strata Management Company</title>
</head>

<nav id="navbar-example2" class="navbar navbar-light bg-light px-3 sticky-top">
    <a class="navbar-brand" href="/strata/check-connection.php">Home</a>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="#scrollspyHeading1">All companies</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#scrollspyHeading2">Insert</a>
        </li>
    </ul>
</nav>

<body class="d-flex flex-column">

    <?php
    include '../connect.php';
    $conn = OpenCon();
    $sql = "SELECT companyID, name, address FROM StrataManagementCompany";
    $result = $conn->query($sql);
    ?>

    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example container" tabindex="0">
        <div class="row mx-auto mt-5 mb-5">

            <h4 id="scrollspyHeading1">All Strata Management Companies</h4>
            <div class="mt-4 mb-5">
                <table class="table table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">CompanyID</th>
                            <th scope="col">Company Name</th>
                            <th scope="col">Company Address</th>
                            <th scope="col"> </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $row["companyID"] ?></td>
                                    <td><?php echo $row["name"] ?></td>
                                    <td><?php echo $row["address"] ?></td>

                                    <td><a href="update.php?companyID=<?php echo $row["companyID"] ?>&name=<?php echo $row["name"] ?>&address=<?php echo $row["address"] ?>" class="btn btn-primary">edit</a>
                                        <a href="delete.php?companyID=<?php echo $row["companyID"] ?>" class="btn btn-danger">delete</a>
                                        <a href="detail.php?companyID=<?php echo $row["companyID"] ?>" class="btn btn-success">detail</a>
                                    </td>
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


            <h4 id="scrollspyHeading2">Insert a new Company</h4>
            <div class="container-fluid mt-4 mb-5">
                <div class="col-md-6 offset-md-3">
                    <form action="process-insert.php" method="POST">
                        <div class="mb-3">
                            <label for="id" class="form-label">CompanyID</label>
                            <input type="text" class="form-control" id="id" name="id" placeholder="Enter CompanyID in the format of 1,2,3,..." required>
                            <div class="form-text">CompanyID can't be changed once set up!</div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-3">Insert</button>
                        </div>
                </div>
            </div>
            </form>

        </div>
    </div>


    <!-- javascripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>

<?php
include("../display/footer.php");
?>

</html>