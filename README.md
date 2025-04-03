# ♻️ E-Sabililah - Simple Waste Bank Management System

## 📌 Introduction
E-Sabililah is a **Simple Waste Bank Management System** designed as a community service project to support waste management initiatives. This application was developed in **2023 during the second semester** as part of a social responsibility effort. The system was created specifically for the **Mitra RW 11 Binalindung Waste Bank** in **Pondok Gede**, aiming to facilitate and digitalize waste transactions within the community.

## 🚀 Features
- 🔐 **User Registration & Authentication**: Enables users to register and securely log in to the system.
- 🗑️ **Waste Collection Management**: Allows users to record waste deposits and track their contributions.
- 🛠️ **Admin Dashboard**: Allows administrators to manage users, waste categories, and transaction records.
- 📱 **Responsive Design**: Ensures accessibility across various devices, including desktops, tablets, and mobile phones.

## 🏗️ Technology Stack
- 💻 **Frontend**: HTML, CSS(Tailwind), JavaScript (Bootstrap)
- 🖥️ **Backend**: PHP (MVC Architecture)
- 🗄️ **Database**: MySQL
- 🔄 **Version Control**: Git & GitHub
- 🌐 **Server**: XAMPP (Apache, MySQL, PHP)

## 📥 Installation Guide
### ⚙️ Prerequisites
Ensure that you have the following installed on your system:
- 🛠️ XAMPP (or any local server environment with PHP & MySQL support)
- 🔧 Git (for version control)

### 📌 Steps
1. **Clone the Repository**
   ```sh
   git clone https://github.com/Putusutha/mvc_php-simple_waste_bank.git
   ```
2. **Move the Project to the Server Directory**
   Copy the project folder to `C:/xampp/htdocs/`.

3. **Create the Database**
   - Open **phpMyAdmin** (via `http://localhost/phpmyadmin`)
   - Create a new database, e.g., `waste_bank`
   - Import the provided `.sql` file (found in the project directory)

4. **Configure the Database Connection**
   - Navigate to `app/config/database.php`
   - Update the database credentials if necessary:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     define('DB_NAME', 'waste_bank');
     ```

5. **Run the Application**
   - ▶️ Start Apache and MySQL from XAMPP
   - Open a browser and go to `http://localhost/waste-bank-app`

## 🤝 Contribution
This project was developed as part of a **community service program**, and contributions are always welcome! If you wish to improve or extend this system, feel free to **fork the repository, make changes, and submit a pull request.**

---
**🌍 E-Sabililah - Empowering Communities Through Waste Management ♻️**

