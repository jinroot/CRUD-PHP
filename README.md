# CRUD-PHP

This project, CRUD-PHP, is a simple CRUD (Create, Read, Update, Delete) application implemented in PHP and MySQL. It was initially developed as a college task to demonstrate basic database operations using PHP.

## How to Get It Working

To run this project on your local machine, follow these steps:

1. **Download XAMPP**: Install and configure XAMPP, a free and open-source cross-platform web server solution stack package developed by Apache Friends.

2. **Import Database**: Import the `mycvproject.sql` file into your MySQL database using phpMyAdmin or any other MySQL client. This file contains the database schema and sample data required for the application to work.

3. **Set Up Database Credentials**: Open the `credentials.php` file and update the database connection credentials (`servername`, `username`, `password`, `dbname`) according to your MySQL server configuration.

4. **Place Files**: Place all project files in the appropriate directory of your XAMPP server. Typically, this would be in the `htdocs` directory.

5. **Access the Application**: Once everything is set up, you can access the CRUD application by navigating to `http://localhost/CRUD-PHP/main.php` in your web browser.

## About the Project

CRUD-PHP is a basic web application that allows users to perform CRUD operations on a database. Here's a brief overview of the project files:

- `calculate_aggregate.php`: PHP script to calculate aggregate functions (total apps, average apps per user, most common country of users).
- `create_user.php`: PHP script to create a new user and insert their data into the database.
- `delete_user.php`: PHP script to delete a user and their associated data from the database.
- `main.html`: HTML file containing the main user interface for interacting with the CRUD application.
- `main.php`: PHP file handling the backend logic for the main user interface.
- `populate.py`: Python script to populate the database with sample data.
- `read_user.php`: PHP script to retrieve user data from the database based on a search query.
- `update_user.php`: PHP script to update user data in the database.

## How It Works

- **Create**: Users can add new entries by filling out the form in `main.html` and submitting it. The data is then processed by `create_user.php` and inserted into the database.
  
- **Read**: Users can search for existing entries by entering a name in the search form in `main.html`. The data is retrieved from the database using `read_user.php` and displayed on the page.
  
- **Update**: Users can modify existing entries by entering the user ID and updated information in the update form in `main.html`. The data is processed by `update_user.php`, and the changes are reflected in the database.
  
- **Delete**: Users can remove entries by entering the user ID in the delete form in `main.html`. The data associated with the user is deleted from the database using `delete_user.php`.

This project serves as a simple demonstration of CRUD operations using PHP and MySQL, suitable for educational purposes and small-scale applications.
