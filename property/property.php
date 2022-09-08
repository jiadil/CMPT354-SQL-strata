<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Property</title>
</head>

<nav id="navbar-example2" class="navbar navbar-light bg-light px-3 sticky-top">
    <a class="navbar-brand" href="/strata/check-connection.php">Home</a>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="#scrollspyHeading1">All properties</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#scrollspyHeading2">Insert</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Dropdown</a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#scrollspyHeading3">Sort</a></li>
                <li><a class="dropdown-item" href="#scrollspyHeading4">Owner List</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#scrollspyHeading5">Property Statements</a></li>
                <li><a class="dropdown-item" href="#scrollspyHeading6">Property Events</a></li>
            </ul>
        </li>
    </ul>
</nav>

<body class="d-flex flex-column">

    <?php
    include '../connect.php';
    $conn = OpenCon();
    $result = $conn->query("SELECT propertyID, propertyName, location, companyID FROM Property_AssignTo");
    $result2 = $conn->query("SELECT companyID FROM StrataManagementCompany");
    $sortC = $conn->query("SELECT Commercial.propertyID, Commercial.commercialStoreName, Commercial.commercialPermissionNum, Property_AssignTo.propertyName
            FROM Commercial
            JOIN Property_AssignTo ON Commercial.propertyID = Property_AssignTo.propertyID
            ");
    $sortR = $conn->query("SELECT Residential.propertyID, Residential.restrictedBuildingSize, Residential.yardArea, Property_AssignTo.propertyName
            FROM Residential
            JOIN Property_AssignTo ON Residential.propertyID = Property_AssignTo.propertyID
            ");
    $owner = $conn->query("SELECT HasOwnershipOf.propertyID, HasOwnershipOf.startDate, HasOwnershipOf.ownerID, Owner.name, Owner.phoneNum 
            FROM HasOwnershipOf
            INNER JOIN Owner ON HasOwnershipOf.ownerID = Owner.ownerID
            ORDER BY propertyID");
    $sortS = $conn->query("SELECT prepared.sinNum, prepared.propertyID, prepared.cdate, prepared.summary, prepared.pstatus,FinancialStatements_Has.cash, FinancialStatements_Has.debt
            FROM prepared
            JOIN FinancialStatements_Has 
            ON prepared.cdate = FinancialStatements_Has.cdate AND prepared.propertyID = FinancialStatements_Has.propertyID
            ORDER BY propertyID");
    $aggStatments = $conn->query("SELECT pstatus, COUNT(*),SUM(summary),SUM(FinancialStatements_Has.cash), SUM(FinancialStatements_Has.debt) 
            FROM prepared
            JOIN FinancialStatements_Has 
            ON prepared.propertyID =FinancialStatements_Has.propertyID
            GROUP BY pstatus");
    $repairList = $conn->query("SELECT staff.name, repairevent_undergoes.propertyID, repairevent_undergoes.eventNum, repairevent_undergoes.eventName, arrange.budget, repairevent_undergoes.cost, arrange.astatus
        FROM (`repairevent_undergoes`JOIN`arrange`
        ON repairevent_undergoes.eventNum = arrange.eventNum AND repairevent_undergoes.propertyID = arrange.propertyID) 
        JOIN staff 
        ON arrange.sinNum = staff.sinNum
        ORDER BY repairevent_undergoes.propertyID");
    $aggStatmentsC = $conn->query("SELECT Property_AssignTo.propertyID, Property_AssignTo.propertyName, SUM(FinancialStatements_Has.cash), SUM(FinancialStatements_Has.debt), SUM(prepared.summary), pstatus
        FROM Property_AssignTo JOIN prepared JOIN FinancialStatements_Has
        ON prepared.cdate = FinancialStatements_Has.cdate AND prepared.propertyID = FinancialStatements_Has.propertyID AND property_AssignTo.propertyID = prepared.propertyID
        WHERE NOT EXISTS
        (SELECT pstatus from prepared
        WHERE prepared.pstatus != 'completed' AND property_AssignTo.propertyID = prepared.propertyID)
        GROUP BY propertyID
        ORDER BY propertyID");
    $avgsum = $conn->query("SELECT AVG(prepared.summary) FROM prepared");
    $aggStatmentsA = $conn->query("SELECT Property_AssignTo.propertyID, Property_AssignTo.propertyName, FinancialStatements_Has.cash, FinancialStatements_Has.debt, prepared.summary, prepared.pstatus
        FROM Property_AssignTo JOIN prepared JOIN FinancialStatements_Has
        ON prepared.cdate = FinancialStatements_Has.cdate AND prepared.propertyID = FinancialStatements_Has.propertyID AND property_AssignTo.propertyID = prepared.propertyID
        WHERE prepared.summary < (SELECT AVG(prepared.summary) FROM prepared)
        ORDER BY propertyID");
    $aggStatmentsN = $conn->query("SELECT Property_AssignTo.propertyID, Property_AssignTo.propertyName, FinancialStatements_Has.cash, FinancialStatements_Has.debt, prepared.summary, prepared.pstatus
        FROM Property_AssignTo JOIN prepared JOIN FinancialStatements_Has
        ON prepared.cdate = FinancialStatements_Has.cdate AND prepared.propertyID = FinancialStatements_Has.propertyID AND property_AssignTo.propertyID = prepared.propertyID
        WHERE Property_AssignTo.propertyID IN
        (SELECT prepared.propertyID FROM prepared
        WHERE prepared.summary < 0)
        ORDER BY propertyID");
    $aggEvents = $conn->query("SELECT RepairEvent_Undergoes.propertyID, AVG(RepairEvent_Undergoes.cost), AVG(Arrange.budget), p.propertyName, AVG(Arrange.budget) - AVG(RepairEvent_Undergoes.cost) AS diff
        FROM RepairEvent_Undergoes, Property_AssignTo p, Arrange
        WHERE p.propertyID = RepairEvent_Undergoes.propertyID AND Arrange.propertyID = RepairEvent_Undergoes.propertyID
        GROUP BY RepairEvent_Undergoes.propertyID
        HAVING AVG(RepairEvent_Undergoes.cost) > 
        (SELECT AVG(Arrange.budget)
            FROM Arrange
            WHERE Arrange.propertyID = RepairEvent_Undergoes.propertyID
            GROUP BY propertyID)
        ");
    $aggEventsM = $conn->query("SELECT Temp.id, Temp.countn, Temp.bud, p.propertyName
        FROM (SELECT a.propertyID AS id, COUNT(a.eventNum) AS countn, AVG(a.budget) AS bud
                FROM Arrange a
                GROUP BY id) AS Temp, Property_AssignTo p
        WHERE Temp.countn > 1 AND Temp.id = p.propertyID");
    $aggEventA = $conn->query("SELECT p.propertyName, p.propertyID, AVG(r.cost), AVG(a.budget), AVG(a.budget) - AVG(r.cost) AS diff 
        FROM Property_AssignTo p, RepairEvent_Undergoes r, Arrange a
        WHERE p.propertyID = r.propertyID AND p.propertyID = a.propertyID AND 
        NOT EXISTS (SELECT * FROM RepairEvent_Undergoes r
            WHERE p.propertyID = r.propertyID AND 
            EXISTS(SELECT a.propertyID FROM Arrange a
                WHERE a.propertyID = r.propertyID AND p.propertyID = a.propertyID AND a.astatus != 'completed')) 
        GROUP BY p.propertyID
        ")

    ?>



    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example container" tabindex="0">

        <div class="row mx-auto mt-5 mb-5">

            <h4 id="scrollspyHeading1">All Properties</h4>
            <div class="mt-4 mb-5">
                <table class="table table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">PropertyID</th>
                            <th scope="col">Property Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Company ID</th>
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
                                    <th scope="row"><?php echo $row["propertyID"] ?></td>
                                    <td><?php echo $row["propertyName"] ?></td>
                                    <td><?php echo $row["location"] ?></td>
                                    <td><?php echo $row["companyID"] ?></td>

                                    <td><a href="update.php?propertyID=<?php echo $row["propertyID"] ?>&propertyName=<?php echo $row["propertyName"] ?>&location=<?php echo $row["location"] ?>&companyID=<?php echo $row["companyID"] ?>" class="btn btn-primary">edit</a>
                                        <a href="delete.php?propertyID=<?php echo $row["propertyID"] ?>" class="btn btn-danger">delete</a>
                                        <a href="detail.php?propertyID=<?php echo $row["propertyID"] ?>" class="btn btn-success">detail</a>
                                    </td>
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


            <h4 id="scrollspyHeading2">Insert a new Property</h4>
            <div class="container mb-5 mt-4">
                <div class="col-md-6 offset-md-3">
                    <form action="process-insert.php" method="POST">
                        <div class="mb-3">
                            <label for="id" class="form-label">PropertyID</label>
                            <input type="text" class="form-control" id="id" name="id" placeholder="Enter PropertyID in the format of 1,2,3,..." required>
                            <div class="form-text">PropertyID can't be changed once set up!</div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Property Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter property name" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="Enter location" required>
                        </div>
                        <div class="mb-3">
                            <label for="company" class="form-label">New Company ID</label>
                            <select class="form-select" name="company" id="company">
                                <?php
                                while ($row = $result2->fetch_assoc()) {
                                    unset($companyid);
                                    $companyid = $row['companyID'];
                                ?>
                                    <option value="<?php echo $companyid ?>"><?php echo $companyid ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-3">Insert</button>
                        </div>
                </div>
            </div>
            </form>


            <h4 id="scrollspyHeading3">Sort by Category</h4>
            <div class="row mt-4 mb-5">
                <div class="col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Commercial Properties</h5>
                            <table class="table table-hover text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">PropertyID</th>
                                        <th scope="col">Property Name</th>
                                        <th scope="col">Commercial Name</th>
                                        <th scope="col">Commercial Permission Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($sortC->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $sortC->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <th scope="row"><?php echo $row["propertyID"] ?></td>
                                                <td><?php echo $row["propertyName"] ?></td>
                                                <td><?php echo $row["commercialStoreName"] ?></td>
                                                <td><?php echo $row["commercialPermissionNum"] ?></td>
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
                </div>
                <div class="col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Residential Properties</h5>
                            <table class="table table-hover text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">PropertyID</th>
                                        <th scope="col">Property Name</th>
                                        <th scope="col">Restricted Building Size</th>
                                        <th scope="col">Yard Area</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($sortR->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $sortR->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <th scope="row"><?php echo $row["propertyID"] ?></td>
                                                <td><?php echo $row["propertyName"] ?></td>
                                                <td><?php echo $row["restrictedBuildingSize"] ?></td>
                                                <td><?php echo $row["yardArea"] ?></td>
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
                </div>
            </div>

            <h4 id="scrollspyHeading4">Owner List</h4>
            <div class="mt-4 mb-5">
                <table class="table table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">PropertyID</th>
                            <th scope="col">OwnerID</th>
                            <th scope="col">Owner Name</th>
                            <th scope="col">Owner Phone Number</th>
                            <th scope="col">date</th>
                            <th scope="col"> </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($owner->num_rows > 0) {
                            // output data of each row
                            while ($row = $owner->fetch_assoc()) {
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $row["propertyID"] ?></td>
                                    <td><?php echo $row["ownerID"] ?></td>
                                    <td><?php echo $row["name"] ?></td>
                                    <td><?php echo $row["phoneNum"] ?></td>
                                    <td><?php echo $row["startDate"] ?></td>
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

            <h4 id="scrollspyHeading5">Property Statements</h4>
            <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example container" tabindex="0">
                <div class="row mx-auto mt-4 mb-5">
                    <table class="table table-hover text-center">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">PropertyID</th>
                                <th scope="col">Process Date</th>
                                <th scope="col">Cash</th>
                                <th scope="col">Debt</th>
                                <th scope="col">Progress Status</th>
                                <th scope="col">Summary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($sortS->num_rows > 0) {
                                // output data of each row
                                while ($row = $sortS->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $row["propertyID"] ?></td>
                                        <td><?php echo $row["cdate"] ?></td>
                                        <td><?php echo $row["cash"] ?></td>
                                        <td><?php echo $row["debt"] ?></td>
                                        <td><?php echo $row["pstatus"] ?></td>
                                        <td><?php echo $row["summary"] ?></td>
                                    </tr>

                            <?php
                                }
                            } else
                                echo "0 results";
                            ?>
                        </tbody>
                    </table>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class=" btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Summary on status
                        </a>
                        <a class=" btn btn-primary" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Property with all completed statements
                        </a>
                        <a class=" btn btn-primary" data-bs-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Property with summary below average
                        </a>
                        <a class=" btn btn-primary" data-bs-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Property with negative summary
                        </a>
                    </div>
                    <div class="collapse mt-1" id="collapseExample">
                        <div class="card card-body">
                            <table class="table table-hover text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Progress Status</th>
                                        <th scope="col">Count</th>
                                        <th scope="col">Cash</th>
                                        <th scope="col">Debt</th>
                                        <th scope="col">Summary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($aggStatments->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $aggStatments->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <th scope="row"><?php echo $row["pstatus"] ?></td>
                                                <td><?php echo $row["COUNT(*)"] ?></td>
                                                <td><?php echo $row["SUM(FinancialStatements_Has.cash)"] ?></td>
                                                <td><?php echo $row["SUM(FinancialStatements_Has.debt)"] ?></td>
                                                <td><?php echo $row["SUM(summary)"] ?></td>
                                            </tr>

                                    <?php
                                        }
                                    } else
                                        echo "0 results";
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="collapse mt-1" id="collapseExample2">
                        <div class="card card-body">
                            <table class="table table-hover text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Property ID</th>
                                        <th scope="col">Property Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Cash</th>
                                        <th scope="col">Debt</th>
                                        <th scope="col">Summary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($aggStatmentsC->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $aggStatmentsC->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <th scope="row"><?php echo $row["propertyID"] ?></td>
                                                <td><?php echo $row["propertyName"] ?></td>
                                                <td><?php echo $row["pstatus"] ?></td>
                                                <td><?php echo $row["SUM(FinancialStatements_Has.cash)"] ?></td>
                                                <td><?php echo $row["SUM(FinancialStatements_Has.debt)"] ?></td>
                                                <td><?php echo $row["SUM(prepared.summary)"] ?></td>
                                            </tr>

                                    <?php
                                        }
                                    } else
                                        echo "0 results";
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="collapse mt-1" id="collapseExample3">
                        <div class="card card-body">
                            <table class="table table-hover text-center">
                                <?php
                                while ($row = $avgsum->fetch_assoc()) {
                                ?>
                                    <caption>Summary average: <?php echo $row["AVG(prepared.summary)"] ?></caption>
                                <?php
                                }
                                ?>
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Property ID</th>
                                        <th scope="col">Property Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Cash</th>
                                        <th scope="col">Debt</th>
                                        <th scope="col">Summary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($aggStatmentsA->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $aggStatmentsA->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <th scope="row"><?php echo $row["propertyID"] ?></td>
                                                <td><?php echo $row["propertyName"] ?></td>
                                                <td><?php echo $row["pstatus"] ?></td>
                                                <td><?php echo $row["cash"] ?></td>
                                                <td><?php echo $row["debt"] ?></td>
                                                <td><?php echo $row["summary"] ?></td>
                                            </tr>

                                    <?php
                                        }
                                    } else
                                        echo "0 results";
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="collapse mt-1" id="collapseExample4">
                        <div class="card card-body">
                            <table class="table table-hover text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Property ID</th>
                                        <th scope="col">Property Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Cash</th>
                                        <th scope="col">Debt</th>
                                        <th scope="col">Summary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($aggStatmentsN->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $aggStatmentsN->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <th scope="row"><?php echo $row["propertyID"] ?></td>
                                                <td><?php echo $row["propertyName"] ?></td>
                                                <td><?php echo $row["pstatus"] ?></td>
                                                <td><?php echo $row["cash"] ?></td>
                                                <td><?php echo $row["debt"] ?></td>
                                                <td><?php echo $row["summary"] ?></td>
                                            </tr>

                                    <?php
                                        }
                                    } else
                                        echo "0 results";
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>

            <h4 id="scrollspyHeading6">Property Events</h4>
            <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example container" tabindex="0">
                <div class="row mx-auto mt-4 mb-5">
                    <table class="table table-hover text-center">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Property ID</th>
                                <th scope="col">Event Number</th>
                                <th scope="col">Event Name</th>
                                <th scope="col">Budget</th>
                                <th scope="col">Cost</th>
                                <th scope="col">Repair Status</th>
                                <th scope="col">Contractor Name</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($repairList->num_rows > 0) {
                                // output data of each row
                                while ($row = $repairList->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $row["propertyID"] ?></td>
                                        <td><?php echo $row["eventNum"] ?></td>
                                        <td><?php echo $row["eventName"] ?></td>
                                        <td><?php echo $row["budget"] ?></td>
                                        <td><?php echo $row["cost"] ?></td>
                                        <td><?php echo $row["astatus"] ?></td>
                                        <td><?php echo $row["name"] ?></td>
                                    </tr>
                            <?php
                                }
                            } else
                                echo "0 results";
                            CloseCon($conn);
                            ?>
                        </tbody>
                    </table>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class=" btn btn-primary" data-bs-toggle="collapse" href="#collapseExample5" role="button" aria-expanded="false" aria-controls="collapseExample">
                            property with avg event cost > avg event budget
                        </a>
                        <a class=" btn btn-primary" data-bs-toggle="collapse" href="#collapseExample6" role="button" aria-expanded="false" aria-controls="collapseExample">
                            property with more than one events
                        </a>
                        <a class=" btn btn-primary" data-bs-toggle="collapse" href="#collapseExample7" role="button" aria-expanded="false" aria-controls="collapseExample">
                            property with all completed events
                        </a>
                    </div>
                    <div class="collapse mt-1" id="collapseExample5">
                        <div class="card card-body">
                            <table class="table table-hover text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Property ID</th>
                                        <th scope="col">Property Name</th>
                                        <th scope="col">Average Budget</th>
                                        <th scope="col">Average Cost</th>
                                        <th scope="col">Difference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($aggEvents->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $aggEvents->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <th scope="row"><?php echo $row["propertyID"] ?></td>
                                                <td><?php echo $row["propertyName"] ?></td>
                                                <td><?php echo $row["AVG(Arrange.budget)"] ?></td>
                                                <td><?php echo $row["AVG(RepairEvent_Undergoes.cost)"] ?></td>
                                                <td><?php echo $row["diff"] ?></td>
                                            </tr>

                                    <?php
                                        }
                                    } else
                                        echo "0 results";
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="collapse mt-1" id="collapseExample6">
                        <div class="card card-body">
                            <table class="table table-hover text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Property ID</th>
                                        <th scope="col">Property Name</th>
                                        <th scope="col">Event Count</th>
                                        <th scope="col">Average Budget</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($aggEventsM->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $aggEventsM->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <th scope="row"><?php echo $row["id"] ?></td>
                                                <td><?php echo $row["propertyName"] ?></td>
                                                <td><?php echo $row["countn"] ?></td>
                                                <td><?php echo $row["bud"] ?></td>
                                            </tr>

                                    <?php
                                        }
                                    } else
                                        echo "0 results";
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="collapse mt-1" id="collapseExample7">
                        <div class="card card-body">
                            <table class="table table-hover text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Property ID</th>
                                        <th scope="col">Property Name</th>
                                        <th scope="col">Average Budget</th>
                                        <th scope="col">Average Cost</th>
                                        <th scope="col">Difference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($aggEventA->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $aggEventA->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <th scope="row"><?php echo $row["propertyID"] ?></td>
                                                <td><?php echo $row["propertyName"] ?></td>
                                                <td><?php echo $row["AVG(a.budget)"] ?></td>
                                                <td><?php echo $row["AVG(r.cost)"] ?></td>
                                                <td><?php echo $row["diff"] ?></td>
                                            </tr>

                                    <?php
                                        }
                                    } else
                                        echo "0 results";
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
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