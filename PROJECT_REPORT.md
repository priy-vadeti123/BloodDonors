# BLOOD DONORS MANAGEMENT SYSTEM

## 1. Introduction

The Blood Donors Management System is a web-based application developed to help manage blood donor information and blood requests. It allows users to register as donors, log in, search for donors by blood group and city, and submit blood requests. An administrator can view donor records and monitor system information.

The main purpose of this project is to make donor information easier to manage and help users find potential blood donors when needed.

## 2. Objectives

- To develop a simple and user-friendly blood donor management website.
- To allow donors to register and log in securely.
- To search for donors according to blood group and city.
- To allow users to submit and view blood requests.
- To provide an administrator dashboard for managing donor information.
- To store application data in a MySQL database.

## 3. Software Requirements

- Operating System: Windows
- Code Editor: Visual Studio Code
- Local Server: XAMPP
- Backend Language: PHP
- Database: MySQL
- Frontend Technologies: HTML and CSS
- Web Browser: Google Chrome or another modern browser

## 4. Technologies Used

**HTML:** Used to structure the web pages and forms.

**CSS:** Used to style the pages and improve the user interface.

**PHP:** Used to process forms, manage sessions, validate input, and communicate with the database.

**MySQL:** Used to store donor details and blood requests.

**XAMPP:** Used to run Apache and MySQL locally during development.

## 5. System Modules

### 5.1 Home Page
Provides an introduction to the application and links to the main features.

### 5.2 Donor Registration
Allows users to register by entering their personal details, blood group, contact information, and login credentials.

### 5.3 Donor Login
Authenticates registered donors and provides access to protected features.

### 5.4 Donor Dashboard
Provides navigation to donor search, blood requests, and other account features.

### 5.5 Search Donors
Allows logged-in users to search for potential donors by blood group and city.

### 5.6 Blood Request
Allows users to submit blood requests containing patient details, blood group, number of units, hospital, city, contact number, and urgency.

### 5.7 My Requests
Displays the blood requests submitted by the logged-in user.

### 5.8 Admin Panel
Provides an administrator login, dashboard statistics, and a page for viewing registered donors.

### 5.9 Logout
Ends the user's or administrator's session.

## 6. Database Design

Database name: `blood_donors_db`

### Table 1: donors

Stores donor registration and account information.

- `id`: Unique donor ID
- `full_name`: Donor's full name
- `age`: Donor's age
- `gender`: Gender
- `blood_group`: Blood group
- `phone`: Contact number
- `city`: City
- `email`: Email address
- `password`: Hashed password
- `created_at`: Registration timestamp

### Table 2: blood_requests

Stores submitted blood requests.

- `id`: Unique request ID
- `donor_id`: ID of the user who submitted the request
- `patient_name`: Patient's name
- `blood_group`: Required blood group
- `units`: Number of units requested
- `hospital`: Hospital name
- `city`: City
- `contact_phone`: Contact number
- `urgency`: Request urgency
- `status`: Request status
- `created_at`: Request timestamp

The `donor_id` field links each blood request to a donor account.

## 7. Security Features

- Passwords are stored using password hashing.
- Prepared statements are used for database queries.
- Sessions protect donor and administrator pages.
- Donor search excludes the currently logged-in user's own account.
- Donor search does not display donor phone numbers or email addresses.

## 8. Testing

The following features were tested during development:

- Donor registration
- Donor login and dashboard access
- Donor search by blood group and city
- Blood request submission
- Viewing submitted requests
- Administrator login
- Admin dashboard statistics
- Viewing donor records
- Logout functionality
- Website styling

The tested features worked during local testing.

## 9. Limitations

- The application currently runs on a local XAMPP server.
- Administrator authentication uses demo credentials.
- The system does not automatically verify donor availability.
- Blood requests are recorded in the database but are not automatically fulfilled.
- Additional security and deployment configuration would be needed before public use.

## 10. Future Enhancements

- Add administrator management of blood requests.
- Add donor availability updates.
- Add notifications for urgent blood requests.
- Improve administrator authentication and permissions.
- Add more detailed search filters.
- Deploy the application to a secure web server.

## 11. Conclusion

The Blood Donors Management System demonstrates how PHP, MySQL, HTML, and CSS can be combined to create a basic web application for managing donor information and blood requests. It provides registration, login, donor search, request management, and basic administrative features.

The project helped demonstrate practical skills in web development, database connectivity, session management, and form processing.