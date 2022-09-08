<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Strata Manager</title>

    <script type="text/javascript" src="js/fetchDisp.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<nav id="navbar-example2" class="navbar navbar-light bg-light px-3 sticky-top">
    <a class="navbar-brand" href="/strata/check-connection.php">Home</a>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="#scrollspyHeading1">All strata managers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#scrollspyHeading2">Insert</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Dropdown</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#scrollspyHeading3">Staff</a></li>
                <li><a class="dropdown-item" href="#scrollspyHeading4">Council meeting</a></li>
                <li><a class="dropdown-item" href="#scrollspyHeading4">Owner List</a></li>
            </ul>
        </li>
    </ul>
</nav>


<body class="d-flex flex-column">

    <?php
    include '../connect.php';
    $conn = OpenCon();
    $result = $conn->query("SELECT licenseNum, companyID, name, phoneNum FROM StrataManager_Work");
    $com = $conn->query("SELECT companyID FROM StrataManagementCompany");
    $staff = $conn->query("SELECT Manage.sinNum, Manage.trainingStatus, Manage.evaluation, Staff.name, Staff.phoneNum
        FROM Manage
        JOIN Staff ON Manage.sinNum = Staff.sinNum");
    $council = $conn->query("SELECT Monitor.meetingID, Monitor.cstatus, Monitor.announcement, Monitor.ownerID, CouncilMeeting.cdate, CouncilMeeting.location
        FROM Monitor
        JOIN CouncilMeeting ON CouncilMeeting.meetingID = Monitor.meetingID");
    $result2 = $conn->query("SELECT ownerID, phoneNum, name FROM owner");
    ?>

    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example container" tabindex="0">
        <div class="row mx-auto mt-5 mb-5">
            <h4 id="scrollspyHeading1">All Strata Managers</h4>
            <div class="mt-4 mb-5">
                <table class="table table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">License Number</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">CompanyID</th>
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
                                    <th scope="row"><?php echo $row["licenseNum"] ?></td>
                                    <td><?php echo $row["name"] ?></td>
                                    <td><?php echo $row["phoneNum"] ?></td>
                                    <td><?php echo $row["companyID"] ?></td>

                                    <td><a href="update.php?licenseNum=<?php echo $row["licenseNum"] ?>&name=<?php echo $row["name"] ?>&phoneNum=<?php echo $row["phoneNum"] ?>&companyID=<?php echo $row["companyID"] ?>" class="btn btn-primary">edit</a>
                                        <a href="delete.php?licenseNum=<?php echo $row["licenseNum"] ?>" class="btn btn-danger">delete</a>
                                        <a href="detail.php?licenseNum=<?php echo $row["licenseNum"] ?>" class="btn btn-success">detail</a>
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

            <h4 id="scrollspyHeading2">Insert a new Strata Manager</h4>
            <div class="container-fluid mb-5 mt-4">
                <div class="col-md-6 offset-md-3">
                    <form action="process-insert.php" method="POST">
                        <div class="mb-3">
                            <label for="id" class="form-label">LicenseNum</label>
                            <input type="text" class="form-control" id="id" name="id" placeholder="Enter LicenseNum in the format of 9001, 9002, ..." required>
                            <div class="form-text">LicenseNum can't be changed once set up!</div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Strata Manager Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Strata Manager name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" required>
                        </div>
                        <div class="mb-3">
                            <label for="company" class="form-label">New Company ID</label>
                            <select class="form-select" name="company" id="company">
                                <?php
                                while ($row = $com->fetch_assoc()) {
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
                    </form>
                </div>
            </div>

            <h4 id="scrollspyHeading3">Staff</h4>
            <div class="mt-4 mb-5">
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

            <h4 id="scrollspyHeading4">Council meeting</h4>
            <div class="mt-4 mb-5">
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
                        //CloseCon($conn);
                        ?>
                    </tbody>
                </table>
            </div>


            <!-- Show List Drop down -->

            <h4 id="scrollspyHeading5">Owner List</h4>
            <div class="mt-4 mb-5">
                <div class="container-fluid mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <select id="owner" class="form-select">
                                <option value="none" selected disabled hidden>Select owner name</option>
                                <option>All</option>
                                <?php
                                while ($rows = mysqli_fetch_array($result2)) {
                                ?>
                                    <option value=" <?php echo $rows['name']; ?>"> <?php echo $rows['name']; ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6" onclick="selectOwner()">
                            <button class="btn btn-primary" type="button">Go</button>
                        </div>
                    </div>
                </div>

                <table class="table table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">OwnerID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Email Address</th>
                            <th scope="col"> </th>
                        </tr>
                    </thead>
                    <tbody id="ans">
                    </tbody>
                </table>
            </div>
            <?php
            CloseCon($conn);
            ?>
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