CREATE DATABASE IF NOT EXISTS personel;
USE personel;

CREATE TABLE IF NOT EXISTS speciality(
    id INT(10) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS empl(
    id INT(10) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    dateBirth DATE NOT NULL,
    passport VARCHAR(11) NOT NULL,
    salary DECIMAL(10, 2) DEFAULT "0.00",
    speciality_id INT(10) DEFAULT '1',
    avatar_url VARCHAR(255),
    FOREIGN KEY (speciality_id) REFERENCES speciality (id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE `users` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    empl_id INT(10),
    role VARCHAR(255) NOT NULL DEFAULT 'empl',
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`),
    FOREIGN KEY (empl_id) REFERENCES empl (id) ON DELETE RESTRICT ON UPDATE CASCADE
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS employee_tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_id INT NOT NULL,
    employee_id INT NOT NULL,
    FOREIGN KEY (task_id) REFERENCES tasks(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (employee_id) REFERENCES empl(id) ON DELETE CASCADE ON UPDATE CASCADE
);



INSERT INTO speciality(name) VALUES 
('Noone'),
('Scientist 1'),
('Scientist 2'),
('Scientist 3');

-- INSERT INTO empl(name, dateBirth, passport, salary, speciality_id) VALUES
-- ('Andreev Joseph Maximovich', '2001-09-12', '4444-123456', '121.5', '1');