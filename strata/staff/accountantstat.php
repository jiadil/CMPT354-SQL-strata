<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Accountant Details and Statistics</title>
</head>

<nav id="navbar-example2" class="navbar navbar-light bg-light px-3 sticky-top">
    <a class="navbar-brand" href="/strata/check-connection.php">Home</a>
    <a class="navbar-brand" href="/strata/staff/staff.php">Back to all staff</a>
    <a class="navbar-brand" href="/strata/staff/accountant.php">Back to all accountants</a>
</nav>

<body>
    <?php
    include '../connect.php';
    $id = $_GET['sinNum'];
    $conn = OpenCon();
    $sort = $conn->query("SELECT prepared.sinNum, prepared.propertyID, prepared.cdate, prepared.summary, FinancialStatements_Has.cash, FinancialStatements_Has.debt
            FROM prepared
            JOIN FinancialStatements_Has ON prepared.cdate = FinancialStatements_Has.cdate AND prepared.propertyID = FinancialStatements_Has.propertyID
            WHERE prepared.sinNum = $id");
    $stat = $conn->query("SELECT prepared.sinNum, prepared.propertyID, SUM(prepared.summary), SUM(FinancialStatements_Has.cash), SUM(FinancialStatements_Has.debt)
            FROM prepared
            JOIN FinancialStatements_Has 
            ON prepared.cdate = FinancialStatements_Has.cdate AND prepared.propertyID = FinancialStatements_Has.propertyID
            WHERE prepared.sinNum = $id
            GROUP BY prepared.propertyID");
    ?>


    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example container" tabindex="0">
        <div class="row mx-auto mt-5 mb-5">

            <div class="mt-4 mb-5 text-center">
                <legend>Processed Statements</legend>
                <table class="table table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">PropertyID</th>
                            <th scope="col">Process Date</th>
                            <th scope="col">Cash</th>
                            <th scope="col">Debt</th>
                            <th scope="col">Summary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($sort->num_rows > 0) {
                            // output data of each row
                            while ($row = $sort->fetch_assoc()) {
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $row["propertyID"] ?></td>
                                    <td><?php echo $row["cdate"] ?></td>
                                    <td><?php echo $row["cash"] ?></td>
                                    <td><?php echo $row["debt"] ?></td>
                                    <td><?php echo $row["summary"] ?></td>
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


            <div class="mt-4 mb-5 text-center">
                <legend>Summary for Each Property</legend>
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Property</th>
                            <th scope="col">Total Cash</th>
                            <th scope="col">Total Debt</th>
                            <th scope="col">Total Summary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($stat->num_rows > 0) {
                            // output data of each row
                            while ($row = $stat->fetch_assoc()) {
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $row["propertyID"] ?></td>
                                    <td><?php echo $row["SUM(FinancialStatements_Has.cash)"] ?></td>
                                    <td><?php echo $row["SUM(FinancialStatements_Has.debt)"] ?></td>
                                    <td><?php echo $row["SUM(prepared.summary)"] ?></td>
                                </tr>

                        <?php
                            }
                        } else {
                            echo "0 results";
                        }
                        CloseCon($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

<?php
include("../display/footer.php");
?>

</html>