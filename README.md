# 🔐 PHP RBAC Admin Dashboard (Metronic Theme)

A **Role-Based Access Control (RBAC) Admin Dashboard** built using **Core PHP, MySQL, Object-Oriented Programming (OOP), and MVC Architecture**.
The project uses the **Metronic Bootstrap Admin Theme** to provide a modern and responsive user interface.

This system allows administrators to **manage users and control access to specific pages in the dashboard based on assigned permissions**.

---

# 🚀 Features

## Admin Side

* **Admin Dashboard**

  * Central panel to manage the entire system.

* **User Management**

  * Add new users
  * Update user details
  * Delete users
  * View user list

* **Role-Based Access Control (RBAC)**

  * Assign roles to users
  * Control access to specific pages
  * Restrict unauthorized access

* **Permission Management**

  * Admin can assign page-level access permissions.
  * Each user can access only the pages allowed by the admin.

* **Secure Authentication**

  * Login system for users
  * Session-based authentication

---

# 🧠 System Workflow

1. Admin logs into the dashboard.
2. Admin creates users in the system.
3. Admin assigns roles and page permissions to users.
4. Users log in to the system.
5. Based on assigned permissions, users can access only specific dashboard pages.

---

# 🛠 Technologies Used

* **PHP (Object-Oriented Programming)**
* **MySQL Database**
* **MVC Architecture**
* **Bootstrap**
* **Metronic Admin Theme**
* **JavaScript**
* **HTML5 / CSS3**

---

# 📂 Project Architecture

The project follows the **MVC (Model-View-Controller) architecture** for clean code structure.

Model
Handles database interaction and business logic.

View
Responsible for UI and presentation.

Controller
Handles requests and application flow.

Example structure:

```
app/
 ├── controllers/
 ├── models/
 ├── views/

config/
public/
assets/
admin/
```

---

# 🗄 Database Tables

Example tables used in the project:

* users
* roles
* permissions
* role_permissions
* user_roles

These tables help implement the **Role-Based Access Control system**.

---

# ⚙ Requirements

Make sure the following are installed before running the project:

* PHP 7.4+
* MySQL
* Apache Server
* XAMPP / LAMP / WAMP

---

# ⚙ Installation

### 1 Clone the repository

```
git clone https://github.com/Priyanshu-ptechbuilder/php-rbac-admin-dashboard.git
```

### 2 Move the project to your server directory

Example:

```
xampp/htdocs/
```

### 3 Import the database

Import the SQL file from:

```
database/project.sql
```

using phpMyAdmin.

### 4 Configure database connection

Update database credentials in:

```
config/database.php
```

### 5 Run the project

Open in browser:

```
http://localhost/php-rbac-admin-dashboard
```

---

# 🎯 Purpose of the Project

This project was developed to practice and demonstrate:

* Object-Oriented Programming in PHP
* MVC Architecture
* Role-Based Access Control (RBAC)
* Admin dashboard development
* Secure user permission management

---

# 👨‍💻 Author

**Priyanshu **

---

# 📜 License

This project is open-source and intended for **learning and educational purposes**.
# php-rbac-admin-dashboard
