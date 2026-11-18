<?php
// ARC Gym - Database Connection & Initialization

$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "db_arc_gym";

// 1. Connect to MySQL server (without selecting a DB first)
$conn = mysqli_connect($host, $db_user, $db_pass);
if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

// 2. Create database if not exists
$sql_db = "CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
if (!mysqli_query($conn, $sql_db)) {
    die("Error creating database: " . mysqli_error($conn));
}

// 3. Select database
if (!mysqli_select_db($conn, $db_name)) {
    die("Error selecting database: " . mysqli_error($conn));
}

// 4. Create Tables if they do not exist
$tables = [];

// Users Table
$tables['gym_users'] = "CREATE TABLE IF NOT EXISTS `gym_users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `name` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Workouts Table
$tables['gym_workouts'] = "CREATE TABLE IF NOT EXISTS `gym_workouts` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `workout_date` DATE NOT NULL,
    `routine_id` INT DEFAULT NULL,
    `routine_name` VARCHAR(100) DEFAULT NULL,
    `routine_focus` VARCHAR(100) DEFAULT NULL,
    `body_weight` DECIMAL(5,2) DEFAULT NULL,
    `notes` TEXT DEFAULT NULL,
    UNIQUE KEY `user_workout_date` (`user_id`, `workout_date`),
    FOREIGN KEY (`user_id`) REFERENCES `gym_users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Workout Exercises Table
$tables['gym_workout_exercises'] = "CREATE TABLE IF NOT EXISTS `gym_workout_exercises` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `workout_id` INT NOT NULL,
    `exercise_name` VARCHAR(100) NOT NULL,
    `target_muscle` VARCHAR(50) DEFAULT NULL,
    `rest_time` INT DEFAULT 90,
    `reps_range` VARCHAR(20) DEFAULT '10',
    `sort_order` INT DEFAULT 0,
    FOREIGN KEY (`workout_id`) REFERENCES `gym_workouts`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Workout Sets Table
$tables['gym_workout_sets'] = "CREATE TABLE IF NOT EXISTS `gym_workout_sets` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `workout_exercise_id` INT NOT NULL,
    `set_number` INT NOT NULL,
    `weight` DECIMAL(6,2) NOT NULL,
    `reps` INT NOT NULL,
    `completed` TINYINT(1) DEFAULT 0,
    FOREIGN KEY (`workout_exercise_id`) REFERENCES `gym_workout_exercises`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Custom Library Table
$tables['gym_custom_library'] = "CREATE TABLE IF NOT EXISTS `gym_custom_library` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `exercise_name` VARCHAR(100) NOT NULL,
    `target_muscle` VARCHAR(50) NOT NULL,
    UNIQUE KEY `user_exercise` (`user_id`, `exercise_name`),
    FOREIGN KEY (`user_id`) REFERENCES `gym_users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Custom Workout Plans Table (Routines Day 1-6)
$tables['gym_custom_plans'] = "CREATE TABLE IF NOT EXISTS `gym_custom_plans` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `day_number` INT NOT NULL,
    `routine_name` VARCHAR(100) NOT NULL,
    `routine_focus` VARCHAR(100) DEFAULT '',
    UNIQUE KEY `user_day` (`user_id`, `day_number`),
    FOREIGN KEY (`user_id`) REFERENCES `gym_users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Custom Plan Exercises Table
$tables['gym_custom_plan_exercises'] = "CREATE TABLE IF NOT EXISTS `gym_custom_plan_exercises` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `plan_id` INT NOT NULL,
    `exercise_name` VARCHAR(100) NOT NULL,
    `target_muscle` VARCHAR(50) NOT NULL,
    `sets` INT DEFAULT 3,
    `reps` VARCHAR(20) DEFAULT '10',
    `rest` INT DEFAULT 90,
    `sort_order` INT DEFAULT 0,
    FOREIGN KEY (`plan_id`) REFERENCES `gym_custom_plans`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Reviews Table
$tables['gym_reviews'] = "CREATE TABLE IF NOT EXISTS `gym_reviews` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `review_text` TEXT NOT NULL,
    `rating` INT DEFAULT 5,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `gym_users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

foreach ($tables as $name => $query) {
    if (!mysqli_query($conn, $query)) {
        die("Error creating table `$name`: " . mysqli_error($conn));
    }
}
?>
