# Blood Donors Management System

## Project Overview
The Blood Donors Management System is a web-based application developed using PHP, MySQL, HTML, and CSS. It helps users register as blood donors, search for donors, and submit blood requests.

## Technologies Used
- Frontend: HTML and CSS
- Backend: PHP
- Database: MySQL
- Local Server: XAMPP
- Code Editor: Visual Studio Code

## Main Features
1. Donor registration and login
2. Donor dashboard
3. Search donors by blood group and city
4. Submit blood requests
5. View submitted blood requests
6. Admin login
7. Admin dashboard with donor and request counts
8. View registered donors
9. Logout functionality

## Database
Database name: `blood_donors_db`

Tables:
- `donors`
- `blood_requests`

## How to Run the Project
1. Install and open XAMPP.
2. Start Apache and MySQL.
3. Copy the project folder into `C:\xampp\htdocs\BloodDonors`.
4. Open phpMyAdmin at `http://localhost/phpmyadmin`.
5. Create the database `blood_donors_db`.
6. Create the required tables using the project's SQL queries.
7. Check the database connection settings in `config/db.php`.
8. Open `http://localhost/BloodDonors/` in a web browser.

## Admin Login
Username: `admin`

Password: `Admin@123`

## Project Development Schedule

The project development was organized into five phases over five days.

| Day | Date | Work Completed |
|---|---|---|
| Day 1 | 10 October 2026 | Project setup, requirements, and database design |
| Day 2 | 11 October 2026 | Donor registration and login functionality |
| Day 3 | 12 October 2026 | Donor search and blood request functionality |
| Day 4 | 13 October 2026 | Admin panel, CSS styling, and feature integration |
| Day 5 | 14 October 2026 | Testing, bug fixing, and project documentation |

## Conclusion
This project demonstrates how PHP and MySQL can be used to develop a basic blood donor management application with donor registration, donor searching, blood requests, and administrative features.