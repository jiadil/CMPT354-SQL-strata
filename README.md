# Strata management system
* [Team Members](#team-members)

# Table of contents
* [Team Members](#team-members)
* [Project Description](#project-description)
  * [Owner](#project-description-owner)
  * [Property](#project-description-property)
  * [Strata Management Company](#project-description-company)
  * [Strata Management Company Owner](#project-description-company-owner)
  * [Strata Manager](#project-description-manager)
  * [Staff](#project-description-staff)
    * [Accountants](#project-description-staff-accountants)
    * [Contractors](#project-description-staff-contractors)
* [Project ERD](#project-erd)

# <a name="team-members"></a>Team Members
* @Jiadi Luo (@jiaidl)
* @Lavika Singh
* @Gurseerat Singh Brar

# <a name="project-description"></a>Project Description
We have created a simple database and a web page for a strata management system consisting of all the relevant information and various functionalities required to smoothly operate a strata management company. 

The first glance of our web page depicts different user roles corresponding to the entities in our database along with access to information regarding all the undertaken properties and the teams managing them. 

When clicking into the target role, it allows the user to choose their role (Owner, Strata Manager, Staff and Company Owner) and perform actions such as edit, deletion or insertion.

![image](https://user-images.githubusercontent.com/105253900/226074999-32968ec3-4867-4b40-8e52-ac2f95419aa8.png)



### <a name="project-description-owner"></a>Owner
When the role of the owner is selected, it depicts the list of current owners along with their names, phone numbers and email. 
Scrolling towards the bottom of the page, you can also see a separate table listing council meetings. 

![image](https://user-images.githubusercontent.com/105253900/226075208-bf32356a-eb57-4294-b322-5e3914b4f0eb.png)

In case of an event of buying or selling of a property, the information of the owners can be changed or deleted, and new owners can be added to the list. 

![image](https://user-images.githubusercontent.com/105253900/226074860-741dc0f8-9bf4-4cc0-999f-0418cd1db1ba.png)

Clicking on the ‘Detail’ button for any owner directs the user to a new web page consisting of information regarding the Council Meetings that they have held, including details like the Meeting ID, location, duration, and the outcome of the meeting. 
It is further linked with the property table to verify the owners of each property.

![image](https://user-images.githubusercontent.com/105253900/226074900-1bf98d81-550a-47d6-9569-17d9ac497a16.png)


### <a name="project-description-property"></a>Property
In order to view detailed information about any property undertaken by the company, we click on the property role on the web page. 

It shows the list of all properties as well as their names, propertyID and the location. 
It is linked with the Strata Management Company and the owner table; hence this enables us to easily check which company is managing a particular property and the respective owners of each property. 

As you scroll down to the bottom of the page, you can see all properties are categorised into commercial or residential. 

The list of the Commercial properties shows the Commercial Name and their permission numbers along with the property name and the property ID. 

The list of Residential properties gives extra information about the restricted building size and the yard area along with the property name and its ID. 

Moreover, each property has its financial statements and repair events that have been carried out in the past or are in progress along with details of the expenses, budget and the contractor responsible for the repairs. 

Two separate tables are also listed in the Property Page with all different GUI interface drop down buttons showing the statistics for the statements (Summary on status, Property with all completed statements, Property with summary below average, and Property with negative summary) and events (Property with avg event cost > avg event budget, Property with more than one event, and Property with all completed events).

![image](https://user-images.githubusercontent.com/105253900/226075086-bd3bb1bd-908b-4e2d-bf4e-b3f13a14a91d.png)
![image](https://user-images.githubusercontent.com/105253900/226075115-11b62dd8-69b3-4ebb-ba60-b207e4fe1264.png)
![image](https://user-images.githubusercontent.com/105253900/226075133-93b983dc-9712-4202-8d17-6c4bcf36e26a.png)
![image](https://user-images.githubusercontent.com/105253900/226075162-daa5055d-a6f2-44c3-a021-8ea9012d7ab4.png)
![image](https://user-images.githubusercontent.com/105253900/226075568-b1dbc6f2-17e1-4d30-91d2-e5db38b079b2.png)
![image](https://user-images.githubusercontent.com/105253900/226075597-e6a06807-e667-416b-ad94-a4b29288c662.png)
![image](https://user-images.githubusercontent.com/105253900/226075614-2c9d09c6-0379-4be7-a638-279618f706fa.png)
![image](https://user-images.githubusercontent.com/105253900/226075627-05d29d67-6bc6-4aea-bb9a-6d02f830d993.png)
![image](https://user-images.githubusercontent.com/105253900/226075642-3a5bf011-9afd-4336-88fb-b4416025493b.png)
![image](https://user-images.githubusercontent.com/105253900/226075660-e3add122-279f-49d8-a354-da5b11197064.png)

Furthermore, in case any property is demolished, or a new property is constructed, we can add or delete the property information accordingly. 
Moreover, in the event of the property being transferred to a different company, we can update the company information as well.

![image](https://user-images.githubusercontent.com/105253900/226075746-98183fce-0ecf-4d73-ac98-7a4579888081.png)

In addition, there is a ‘Detail’ button provided alongside each property on the list. 
Clicking on this detail button shows four tables displaying all the relevant information of a particular property collectively at one convenient web page. 
You can view the details of the financial statements, repair events, property name, location and category the property falls under commercial or residential.

![image](https://user-images.githubusercontent.com/105253900/226075766-68f941b9-5e4c-4fd8-b270-0d013a59b30b.png)



### <a name="project-description-company"></a>Strata Management Company
Clicking on the Strata Management Company role shows all the Company names with their Ids and addresses. 

![image](https://user-images.githubusercontent.com/105253900/226075877-8d264434-55a4-4a6d-87c5-df8ada5a8edb.png)

The “Detail” button will guide the user to a new page providing access to the list of properties managed by each of them (with the GUI button “Summary” showing the statistics of the properties) and also their company owners. 

![image](https://user-images.githubusercontent.com/105253900/226075930-ef539d2f-be7b-466b-aece-d40e9d1dd707.png)

Strata Companies can be deleted and inserted or any information for the existing ones regarding their name and address can be updated.

![image](https://user-images.githubusercontent.com/105253900/226075900-8715285a-4361-4366-af64-7e13a646b85d.png)



### <a name="project-description-company-owner"></a>Company Owner
Clicking on the Company Owner role displays the names of all the company Owners and their respective Company’s RegisterID and phone number. 

![image](https://user-images.githubusercontent.com/105253900/226478999-bd531827-d4c9-4f0a-a2c3-a03207dca744.png)

As you scroll down, you can also see a separate table listing all the Strata Companies. 
We can add or delete any Company Owner or change any information for an existing owner. 

![image](https://user-images.githubusercontent.com/105253900/226479228-4032b334-7054-4fcc-bebc-21e26f38667b.png)

Clicking on the ‘Detail’ button for any company owner directs the user to a new web page consisting of information regarding the respective companies that they own including details like the company ID, company name, and address. 
It is further linked with the strata manager table to verify the managers that this company owner has supervised.

![image](https://user-images.githubusercontent.com/105253900/226479291-e795540d-bc4d-4fb2-a789-635df35249bd.png)




### <a name="project-description-manager"></a>Strata Manager
On choosing the role of Strata Manager, a list of strata managers appears showing their respective names, phone numbers and Licence numbers. 

Since it is linked with the Strata Management Company table, we can also see the Company ID where the Strata Managers work. 

In addition, we can also edit, delete, or insert details for any Strata Manager such as their name, contact information or the company they are/will be working for.

As you scroll down, the Strata Manager table is linked with the Staff table; thereby displaying a list of staff members with their name, SIN, phone number, training status and evaluation of their performance in the company.

Further at the bottom, the strata managers can also view details of the council meetings for the purpose of monitoring. 
In this way they can easily keep track of when the meetings were held and by which owners, what is the status of the meetings and whether the notice for certain meetings have been announced or not.

The table below allowing managers to choose different owners and to check owners’ information.

![image](https://user-images.githubusercontent.com/105253900/226479342-56187ede-7d8f-4051-b5d6-c5f44ea9e1ea.png)

There is also a ‘Detail’ button alongside every strata manager. 
Clicking on it separately shows detailed information on another web page regarding the staff members (name, phone number, training status and evaluation) that the particular manager has been training and the council meetings (date, location, duration, meetingID and status) that is being monitored.

![image](https://user-images.githubusercontent.com/105253900/226479615-88849177-59c7-4a58-a8fc-968cfe16f1e0.png)



### <a name="project-description-staff"></a>Staff
The staff table lists all the staff members (excluding managers) working in the strata company with information of their name, phone number and SIN. 
![image](https://user-images.githubusercontent.com/105253900/226479644-83f6aff4-0713-4dfb-9c5e-25684ad30b5c.png)

As any employee resigns or new employees are hired, the staff information can be updated, added and deleted accordingly. 

![image](https://user-images.githubusercontent.com/105253900/226479706-6371d59e-eec2-4e3c-aafb-f125f41f202e.png)

Certain staff members are further sorted by roles into "Accountants" and "Contractors". 
Clicking on their respective buttons directs you to their web page with further additional information about staff in both these roles.

#### <a name="project-description-staff-accountants"></a>Accountants
![image](https://user-images.githubusercontent.com/105253900/226479847-d41652bd-617f-4455-a8d7-24854a223f9a.png)
![image](https://user-images.githubusercontent.com/105253900/226479899-82c0a79d-bf7e-4cc8-8d7d-5338109c02dc.png)

#### <a name="project-description-staff-contractors"></a>Contractors
![image](https://user-images.githubusercontent.com/105253900/226480064-0621e8da-287c-47c5-a690-37aa39881214.png)




# <a name="project-erd"></a>ERD
![image](https://user-images.githubusercontent.com/105253900/226481799-1512d998-10ef-4d77-a007-5f3a36edef53.png)
