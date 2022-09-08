<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Accountant</title>
</head>

<nav id="navbar-example2" class="navbar navbar-light bg-light px-3 sticky-top">
    <a class="navbar-brand" href="/strata/check-connection.php">Home</a>
    <a class="navbar-brand" href="/strata/staff/staff.php">Back to all staff</a>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="#scrollspyHeading1">All accountants</a>
        </li>
    </ul>
</nav>

<body class="d-flex flex-column">

    <?php
    include '../connect.php';
    $conn = OpenCon();
    $sort = $conn->query("SELECT Accountant.sinNum, Accountant.CPALicenseNum, Accountant.expirationDate, Staff.name
            FROM Accountant
            JOIN Staff ON Accountant.sinNum = Staff.sinNum
            ");
    ?>

    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example container" tabindex="0">
        <div class="row mx-auto mt-5 mb-5">
            <h4 id="scrollspyHeading1">All Accountants</h4>
            <div class="mt-4 mb-5">
                <table class="table table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">sinNum</th>
                            <th scope="col">Name</th>
                            <th scope="col">CPA Number</th>
                            <th scope="col">Expiration Date</th>
                            <th scope="col"></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($sort->num_rows > 0) {
                            // output data of each row
                            while ($row = $sort->fetch_assoc()) {
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $row["sinNum"] ?></td>
                                    <td><?php echo $row["name"] ?></td>
                                    <td><?php echo $row["CPALicenseNum"] ?></td>
                                    <td><?php echo $row["expirationDate"] ?></td>
                                    <td><a href="accountantstat.php?sinNum=<?php echo $row["sinNum"] ?>" class="btn btn-primary">details</a> </td>
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



    <!-- javascripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

</body>

<?php
include("../display/footer.php");
?>

</html>