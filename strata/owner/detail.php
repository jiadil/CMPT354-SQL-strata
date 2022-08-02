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
    <a class="navbar-brand" href="/strata/owner/owner.php">Back to all owners</a>
</nav>

<body class="d-flex flex-column">

    <?php
    include '../connect.php';
    $id = $_GET['ownerID'];
    $conn = OpenCon();
    $result = $conn->query("SELECT ownerID, phoneNum, name, emailAddress 
        FROM Owner
        WHERE Owner.ownerID = '$id'");
    $property = $conn->query("SELECT HasOwnershipOf.propertyID, HasOwnershipOf.startDate, HasOwnershipOf.ownerID, Property_AssignTo.propertyName, Property_AssignTo.location
            FROM HasOwnershipOf
            INNER JOIN Property_AssignTo ON HasOwnershipOf.propertyID = Property_AssignTo.propertyID
            WHERE HasOwnershipOf.ownerID = '$id'
            ORDER BY propertyID");
    $council = $conn->query("SELECT Holds.meetingID, Holds.duration, Holds.outcome, CouncilMeeting.cdate, CouncilMeeting.location
            FROM Holds
            INNER JOIN CouncilMeeting ON Holds.meetingID = CouncilMeeting.meetingID
            WHERE Holds.ownerID = '$id'
            ORDER BY meetingID");
    ?>

    <div class="container">
        <div class="row mt-md-5">
            <div class="col-md-3">
                <?php
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row["name"] ?></h5>
                                <p class="card-text">Owner ID: <?php echo $row["ownerID"] ?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><?php echo $row["phoneNum"] ?></li>
                                <li class="list-group-item"><?php echo $row["emailAddress"] ?></li>
                            </ul>
                        </div>
                <?php
                    }
                } else
                    echo "0 results";
                //CloseCon($conn);
                ?>
            </div>

            <div class="col-md-9">
                <div class="card mb-5">
                    <div class="card-header">
                        Owned property
                    </div>
                    <div class="card-body">
                        <table class="table table-hover text-center">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Property ID</th>
                                    <th scope="col">Property Name</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Start Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($property->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $property->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo $row["propertyID"] ?></td>
                                            <td><?php echo $row["propertyName"] ?></td>
                                            <td><?php echo $row["location"] ?></td>
                                            <td><?php echo $row["startDate"] ?></td>
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
                        Council meeting
                    </div>
                    <div class="card-body">
                        <table class="table table-hover text-center">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Meeting ID</th>
                                    <th scope="col">Meeting Date</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Outcome</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($council->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $council->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo $row["meetingID"] ?></td>
                                            <td><?php echo $row["cdate"] ?></td>
                                            <td><?php echo $row["location"] ?></td>
                                            <td><?php echo $row["duration"] ?></td>
                                            <td><?php echo $row["outcome"] ?></td>
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
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

</body>

<?php
include("../display/footer.php");
?>

</html>