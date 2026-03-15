-- metronic_app.sql
-- Run this in your MySQL/phpMyAdmin to set up the database

CREATE DATABASE IF NOT EXISTS metronic_app;
USE metronic_app;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Feature permissions table
CREATE TABLE IF NOT EXISTS feature_permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    feature_key VARCHAR(100) NOT NULL,
    feature_label VARCHAR(150) NOT NULL,
    is_enabled TINYINT(1) DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_feature (user_id, feature_key)
);

-- Available features table (master list)
CREATE TABLE IF NOT EXISTS features (
    id INT AUTO_INCREMENT PRIMARY KEY,
    feature_key VARCHAR(100) NOT NULL UNIQUE,
    feature_label VARCHAR(150) NOT NULL,
    feature_route VARCHAR(200) NOT NULL,
    description TEXT
);

-- Insert default features
INSERT INTO features (feature_key, feature_label, feature_route, description) VALUES
('dashboard', 'Dashboard', '/dashboard', 'Access to main dashboard'),
('reports', 'Reports', '/reports', 'View reports and analytics'),
('profile', 'My Profile', '/profile', 'Manage personal profile'),
('documents', 'Documents', '/documents', 'Access document library'),
('calendar', 'Calendar', '/calendar', 'View and manage calendar'),
('projects', 'Projects', '/projects', 'Access project management');

-- Insert default admin user (password: admin123)
INSERT INTO users (name, email, password, role, status) VALUES
('Admin User', 'admin@admin.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'active');

-- Insert a sample normal user (password: user123)
INSERT INTO users (name, email, password, role, status) VALUES
('John Doe', 'john@example.com', '$2y$10$TKh8H1.PfunmK7v/UN5ctu', 'user', 'active');

-- Note: The admin password above uses bcrypt. 
-- To generate correct hashes, run setup_passwords.php after importing this SQL.
-- Or use the setup.php script provided.
