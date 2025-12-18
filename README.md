# Blood_Lifestyle_Tracking_System
A PHP-based web application for managing blood donation and blood bank operations.

**🩸 Blood Lifestyle Tracking System**

📌 Project Description

The Blood Lifestyle Tracking System is a PHP-based web application developed to manage blood donation, blood requests, and donor information efficiently. The system provides separate modules for users, hospitals, and administrators, ensuring smooth coordination and quick access to blood availability during emergencies.

This project is designed to reduce manual record keeping by maintaining all blood bank operations digitally, including donor registration, blood donation records, blood requests, hospital requests, and geolocation-based donor search.


**🎯 Objectives**

-To digitalize blood bank and donation management

-To maintain accurate donor and blood stock records

-To support hospitals during emergency blood requests

-To enable location-based donor search using geolocation

-To improve response time and reduce manual errors


**👥 User Roles & Modules**

🔹 User / Donor

-Register and login to the system

-Donate blood and update profile details

-View blood availability and requests

-Search nearby donors using geolocation

🔹 Hospital

-Register and login as a hospital

-Send blood requests to the blood bank

-Track request status (Accepted / Rejected)

🔹 Admin
-Manage donors, hospitals, and blood stock

-Accept or reject blood and hospital requests

-Monitor overall system activities


**🗂️ Project Structure Overview**

📁 Root Files

-index.php – Entry point of the application

-login.php / register.php / logout.php – Authentication modules

-home.php / main.php – Main user dashboard

-about.php / contact.php – Informational pages

-README.md – Project documentation

-README_GEOLOCATION.md – Geolocation feature documentation

📁 css/

Contains all stylesheets used for the project UI:

-style.css

-styles.css

-blood3d.css

📁 image/ & jastimage/

Stores images and visual assets used in the application.

📁 sql/

Contains database-related files:

-bloodbank.sql – Main database structure

-add_quantity_column.sql – Blood quantity updates

-add_geolocation_columns.sql – Geolocation support

-create_hospitalrequest_table.sql – Hospital request table

-README_DATABASE_UPDATES.md – Database change history

📁 file/

Handles backend operations and database actions:

-connection.php – Database connection

-accept.php / reject.php / cancel.php / delete.php – Request handling

-hospitalLogin.php / hospitalReg.php – Hospital authentication

-receiverLogin.php / receiverReg.php – Receiver authentication

-getnearby.php – Geolocation-based donor search

-acceptrequest.php / rejectrequest.php – Blood request actions


**⚙️ Technologies Used**

-Frontend: HTML, CSS, JavaScript

-Backend: PHP

-Database: MySQL

-Server: XAMPP / WAMP


**🛠️ Installation & Setup**

Step 1: Server Setup

  -Install XAMPP or WAMP

  Start Apache and MySQL

Step 2: Project Setup

  -Extract the project folder

Place it inside:

  C:\xampp\htdocs\
  
Step 3: Database Setup

1. Open:

  http://localhost/phpmyadmin

2. Create a database (example):

  bloodbank

4. Import the SQL file from:

  /sql/bloodbank.sql


**▶️ Run the Project**
  
  -Home(Common) Panel
    
    http://localhost/Blood_Lifestyle_Tracking_System/home.php


**✅ Key Features**

-Blood donation and request management

-Hospital request handling system

-Geolocation-based nearby donor search

-Admin approval and rejection workflow

-Secure login and role-based access


**🚀 Future Enhancements**

-SMS and Email alerts for urgent blood needs

-Mobile application support

-Advanced security and authentication

-Real-time blood availability updates


**📝 Conclusion**

The Blood Lifestyle Tracking System is a complete digital solution for managing blood donation and distribution processes. By integrating donor management, hospital requests, and geolocation features, the system improves efficiency, accuracy, and responsiveness—helping save lives during critical situations.

⭐ If you find this project useful, don’t forget to give it a Star on GitHub!
