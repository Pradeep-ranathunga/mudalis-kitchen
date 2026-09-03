# 🍽️ Mudali's Kitchen - Dynamic Web Application

A responsive, full-stack web application built to handle both public-facing content and secure administrative tasks. This project features a custom backend feedback management system handling data processing, approval, and deletion operations using PHP, MySQL, HTML, CSS, and JavaScript.

## 🚀 Features

* **Secure Authentication:** Admin login and logout functionality to protect sensitive routes (`login.php`, `logout.php`).
* **Admin Dashboard:** A centralized control panel for administrative oversight (`admin.php`).
* **Feedback Management System:** Backend logic to process incoming messages, approve valid feedback, and delete unwanted entries (`process_feedback.php`, `approve_fb.php`, `delete_fb.php`).
* **Public Interface:** Interactive frontend pages for users to view portfolios and submit contact requests (`index.php`, `portfolio.php`, `contact.php`).

## 🛠️ Tech Stack

* **Backend:** PHP (74.8%), MySQL
* **Frontend:** HTML, CSS (21.4%), JavaScript (1.2%)

## 📂 Key File Structure

* `/assets` - Contains CSS, JavaScript, and image files.
* `/includes` - Reusable PHP components (e.g., database connection, headers, footers).
* `admin.php` - Main dashboard view for authenticated administrators.
* `approve_fb.php` & `delete_fb.php` - Action scripts for feedback moderation.
* `process_feedback.php` - Handles form submissions from the contact page.

## ⚙️ Getting Started

### Prerequisites
* A local server environment like XAMPP, WAMP, or MAMP.
* MySQL Database.

### Installation
1. Clone the repository:
   ```bash
   git clone [https://github.com/pradeep-ranathunga/mudalis-kitchen.git](https://github.com/pradeep-ranathunga/mudalis-kitchen.git)
Move the project folder to your local web server directory (e.g., C:\xampp\htdocs\mudalis-kitchen).

Start Apache and MySQL services in your local server control panel.

Create a new database in phpMyAdmin and import the project's .sql database file.

Update the database connection variables (hostname, username, password, database name) inside the /includes folder to match your local setup.

Open your web browser and navigate to: http://localhost/mudalis-kitchen/

👨‍💻 Developed By
Pradeep Ranathunga

GitHub: @pradeep-ranathunga
