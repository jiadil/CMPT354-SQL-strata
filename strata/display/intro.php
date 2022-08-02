<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Introduction</title>
</head>

<nav id="navbar-example2" class="navbar navbar-light bg-light px-3 sticky-top">
    <a class="navbar-brand" href="/strata/check-connection.php">Home</a>
</nav>

<body class="d-flex flex-column vh-100">

    <main class="container-fluid">
        <div class="mt-5 mb-5 ml-5 mr-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Here is a brief introduction of our porject!</h5>
                    <p class="card-text">
                        <br>We have created a database and a web page for a strata management system consisting of all the relevant information and various functionalities required to smoothly operate a strata management company.
                        <br>The first glance of our web page depicts different user roles corresponding to the entities in our database along with access to information regarding all the undertaken properties and the teams managing them.
                        <br>When clicking into the target role, it allows the user to choose their role (Owner, Strata Manager, Staff and Company Owner) and perform actions such as edit, deletion or insertion.
                        <br><br>
                    <h6><b>Owner</b></h6>
                    When the role of the owner is selected, it depicts the list of current owners along with their names, phone numbers and email. Scrolling towards the bottom of the page, you can also see a separate table listing council meetings.
                    <br>In case of an event of buying or selling of a property, the information of the owners can be changed or deleted, and new owners can be added to the list.
                    <br>Clicking on the ‘Detail’ button for any owner directs the user to a new web page consisting of information regarding the Council Meetings that they have held, including details like the Meeting ID, location, duration, and the outcome of the meeting.
                    <br>It is further linked with the property table to verify the owners of each property.
                    <br><br>

                    <h6><b>Property</b></h6>
                    In order to view detailed information about any property undertaken by the company, we click on the property role on the web page. It shows the list of all properties as well as their names, propertyID and the location.
                    It is linked with the Strata Management Company and the owner table; hence this enables us to easily check which company is managing a particular property and the respective owners of each property.
                    <br>Furthermore, in case any property is demolished, or a new property is constructed, we can add or delete the property information accordingly.
                    <br>Moreover, in the event of the property being transferred to a different company, we can update the company information as well.
                    <br>As you scroll down to the bottom of the page, you can see all properties are categorised into commercial or residential.
                    <br>The list of the Commercial properties shows the Commercial Name and their permission numbers along with the property name and the property ID.
                    <br>The list of Residential properties gives extra information about the restricted building size and the yard area along with the property name and its ID.
                    <br>Moreover, each property has its financial statements and repair events that have been carried out in the past or are in progress along with details of the expenses, budget and the contractor responsible for the repairs.
                    <br>Two separate tables are also listed in the Property Page with all different GUI interface drop down buttons showing the statistics for the statements (Summary on status, Property with all completed statements, Property with summary below average, and Property with negative summary) and events (Property with avg event cost > avg event budget, Property with more than one event, and Property with all completed events).
                    <br>In addition, there is a ‘Detail’ button provided alongside each property on the list. Clicking on this detail button shows four tables displaying all the relevant information of a particular property collectively at one convenient web page. You can view the details of the financial statements, repair events, property name, location and category the property falls under commercial or residential.
                    <br><br>

                    <h6><b>Strata Management Company</b></h6> Clicking on the Strata Management Company role shows all the Company names with their Ids and addresses.
                    <br>The “Detail” button will guide the user to a new page providing access to the list of properties managed by each of them (with the GUI button “Summary” showing the statistics of the properties) and also their company owners.
                    <br>Strata Companies can be deleted and inserted or any information for the existing ones regarding their name and address can be updated.
                    <br><br>

                    <h6><b>Company Owner</b></h6> Clicking on the Company Owner role displays the names of all the company Owners and their respective Company’s RegisterID and phone number.
                    <br>We can add or delete any Company Owner or change any information for an existing owner.
                    <br>As you scroll down, you can also see a separate table listing all the Strata Companies.
                    <br>Clicking on the ‘Detail’ button for any company owner directs the user to a new web page consisting of information regarding the respective companies that they own including details like the company ID, company name, and address. It is further linked with the strata manager table to verify the managers that this company owner has supervised.
                    <br><br>

                    <h6><b>Strata Manager</b></h6> On choosing the role of Strata Manager, a list of strata managers appears showing their respective names, phone numbers and Licence numbers. Since it is linked with the Strata Management Company table, we can also see the Company ID where the Strata Managers work.
                    <br>In addition, we can also edit, delete, or insert details for any Strata Manager such as their name, contact information or the company they are/will be working for.
                    <br>As you scroll down, the Strata Manager table is linked with the Staff table; thereby displaying a list of staff members with their name, SIN, phone number, training status and evaluation of their performance in the company.
                    <br>Further at the bottom, the strata managers can also view details of the council meetings for the purpose of monitoring. In this way they can easily keep track of when the meetings were held and by which owners, what is the status of the meetings and whether the notice for certain meetings have been announced or not.
                    <br>The table below allowing managers to choose different owners and to check owners’ information.
                    <br>There is also a ‘Detail’ button alongside every strata manager. Clicking on it separately shows detailed information on another web page regarding the staff members (name, phone number, training status and evaluation) that the particular manager has been training and the council meetings (date, location, duration, meetingID and status) that is being monitored.
                    <br><br>

                    <h6><b>Staff</b></h6> The staff table lists all the staff members (excluding managers) working in the strata company with information of their name, phone number and SIN.
                    <br>As any employee resigns or new employees are hired, the staff information can be updated, added and deleted accordingly.
                    <br>Certain staff members are further sorted by roles into ‘Accountants’ and ‘Contractors’. Clicking on their respective buttons directs you to their web page with further additional information about staff in both these roles.
                    <br>When you click on the ‘Accountants’ button, a new web page opens up displaying the list of all accountants with their names, CPA Licence number and expiration date. The ‘Details’ button is provided alongside every accountant, which further redirects you to another web page. It shows a list of individual Processed Financial Statements for each property that have been assigned to a particular accountant, along with their processing date, cash, debt and summary. Another table displays a collective summary for financial statements.
                    <br>When you click on the ‘Contractor’ button, a new web page opens up displaying the list of contractors with their name, SIN, Licence number and expiration date. Further, it is also linked with the owner and property table, so it depicts each repair event that has been carried out by a particular contractor with information about the property the repair was done, name of the event, budget, cost, and its status.

                    </p>
                    <p class="card-text"><small class="text-muted">Completed on July 29th</small></p>
                </div>
                <img src="https://res.cloudinary.com/doctjjd/image/upload/v1659393448/%27YelpCamp%27/Blank_diagram_3_uuo7bw.jpg" class="card-img-bottom" alt="...">
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>


</body>

<?php
include("../display/footer.php");
?>

</html>