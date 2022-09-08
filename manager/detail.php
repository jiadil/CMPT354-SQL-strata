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
    <a class="navbar-brand" href="/strata/manager/manager.php">Back to all strata managers</a>
</nav>

<body>
    <?php
    include '../connect.php';
    $id = $_GET['licenseNum'];
    $conn = OpenCon();
    $manager = $conn->query("SELECT licenseNum, phoneNum, name, companyID
        FROM StrataManager_Work
        WHERE StrataManager_Work.licenseNum = '$id'");
    $staff = $conn->query("SELECT Manage.sinNum, Manage.trainingStatus, Manage.evaluation, Staff.name, Staff.phoneNum
        FROM Manage
        JOIN Staff ON Manage.sinNum = Staff.sinNum
        WHERE Manage.licenseNum = '$id'");
    $council = $conn->query("SELECT Monitor.meetingID, Monitor.cstatus, Monitor.announcement, Monitor.ownerID, CouncilMeeting.cdate, CouncilMeeting.location
        FROM Monitor
        JOIN CouncilMeeting ON CouncilMeeting.meetingID = Monitor.meetingID
        WHERE Monitor.licenseNum = '$id'");

    ?>

    <div class="container">
        <div class="row mt-md-5">
            <div class="col-md-3">
                <?php
                if ($manager->num_rows > 0) {
                    // output data of each row
                    while ($row = $manager->fetch_assoc()) {
                ?>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row["name"] ?></h5>
                                <p class="card-text">License Number: <?php echo $row["licenseNum"] ?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><?php echo $row["phoneNum"] ?></li>
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
                        Staff
                    </div>
                    <div class="card-body">
                        <table class="table table-hover text-center">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">SIN</th>
                                    <th scope="col">Staff Name</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Training Status</th>
                                    <th scope="col">Evaluation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($staff->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $staff->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo $row["sinNum"] ?></td>
                                            <td><?php echo $row["name"] ?></td>
                                            <td><?php echo $row["phoneNum"] ?></td>
                                            <td><?php echo $row["trainingStatus"] ?></td>
                                            <td><?php echo $row["evaluation"] ?></td>
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
                        Council Meeting
                    </div>
                    <div class="card-body">
                        <table class="table table-hover text-center">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Meeting ID</th>
                                    <th scope="col">Owner ID</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Announcement</th>
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
                                            <td><?php echo $row["ownerID"] ?></td>
                                            <td><?php echo $row["cdate"] ?></td>
                                            <td><?php echo $row["cstatus"] ?></td>
                                            <td><?php echo $row["announcement"] ?></td>
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