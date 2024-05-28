# eCommerce Application

## Overview
This eCommerce application is designed to provide a dynamic shopping experience for customers, robust management features for administrators, and efficient order handling for delivery person. The platform includes distinct functionalities for three types of users: clients, admin, and delivery personnel.

## Features

### Client (Customer)
- **Authentication**:
  - Login
  - Logout
  - Signup
  - Forgot password with email verification

- **Product Interaction**:
  - View products
  - View product categories
  - View product details
  - Add products to wishlist
  - Add products to cart
  - Place orders
  - Search products
  - Filter products

- **Order Management**:
  - View orders with delivery status
  - Download order invoice

- **User Profile**:
  - Manage profile
  - Change password

- **Communication**:
  - Contact us form

### Admin
- **Authentication**:
  - Login
  - Logout
  - Signup
    
- **Dashboard**:
  - View number of products, brands, categories, delivery person, customers, contacts, revenue
  - View 5 recent orders and their delivery status

- **Order Management**:
  - View all orders
  - Assign orders to delivery person

- **Product Management**:
  - Manage brands
  - Manage categories
  - Manage products

- **User Management**:
  - Manage delivery person
  - View customers

- **Contact Management**:
  - Manage contact us messages

- **Reporting**:
  - Generate reports of orders

### Delivery Person
- **Authentication**:
  - Login
  - Logout

- **Order Management**:
  - View assigned orders
  - Change order status (e.g., delivered, shipped)

## Technology Stack
- **Frontend**: HTML,CSS,JavaScript,JQuery,AJAX
- **Backend**: Core PHP
- **Database**: MySQL
- **Server**: XAMPP

## Installation

### Prerequisites
- XAMPP server installed on your local machine. 

### Steps
1. **Clone the repository**:
    ```sh
    git clone https://github.com/kishan-kareliya/php-ecommerce-application.git
    ```

2. **Move the project to XAMPP's `htdocs` directory**:
    ```sh
    mv techworld /xampp/htdocs/
    cd /xampp/htdocs/techworld
    ```

3. **Create the MySQL database**:
    - Open phpMyAdmin by navigating to `http://localhost/phpmyadmin/` in your web browser.
    - Create a new database named `techworld`.

4. **Import the database schema**:
    - In phpMyAdmin, select the `techworld` database.
    - Click on the `Import` tab.
    - Choose the SQL file provided with your project database/techworld.sql and import it.

5. **Configure the database connection**:
    - Open the `db_connect.php` file (or whichever file you use for database configuration) in your project.
    - Update the database configuration details as follows:
    ```php
    <?php
    $servername = "localhost";
    $username = "root";  // default XAMPP MySQL username
    $password = "";      // default XAMPP MySQL password
    $dbname = "techworld";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
    ```

6. **Start the XAMPP server**:
    - Open the XAMPP Control Panel.
    - Start the Apache and MySQL modules.

7. **Run the application**:
    - Open your web browser and navigate to `http://localhost/techworld`.


## Usage
1. **Client**: Navigate to the homepage and explore the products. Sign up or log in to add products to your cart or wishlist, place orders, and manage your profile.
2. **Admin**: Log in to access the admin dashboard where you can manage products, categories, orders, users, and more.
3. **Delivery Person**: Log in to view your assigned orders and update their status as they are processed.

## Contact
For any inquiries, please contact us at kareliyakishan007@gmail.com.

