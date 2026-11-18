-- ARC Gym Workout Tracker - Database Schema Script
-- This SQL script can be imported directly into phpMyAdmin or MySQL console.

CREATE DATABASE IF NOT EXISTS `db_arc_gym` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_arc_gym`;

-- 1. Users Table
CREATE TABLE IF NOT EXISTS `gym_users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `name` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Daily Workouts Metadata Table
CREATE TABLE IF NOT EXISTS `gym_workouts` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Workout Log Exercises Table
CREATE TABLE IF NOT EXISTS `gym_workout_exercises` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `workout_id` INT NOT NULL,
    `exercise_name` VARCHAR(100) NOT NULL,
    `target_muscle` VARCHAR(50) DEFAULT NULL,
    `rest_time` INT DEFAULT 90,
    `reps_range` VARCHAR(20) DEFAULT '10',
    `sort_order` INT DEFAULT 0,
    FOREIGN KEY (`workout_id`) REFERENCES `gym_workouts`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Workout Exercise Sets Table
CREATE TABLE IF NOT EXISTS `gym_workout_sets` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `workout_exercise_id` INT NOT NULL,
    `set_number` INT NOT NULL,
    `weight` DECIMAL(6,2) NOT NULL,
    `reps` INT NOT NULL,
    `completed` TINYINT(1) DEFAULT 0,
    FOREIGN KEY (`workout_exercise_id`) REFERENCES `gym_workout_exercises`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. User Custom Exercise Library Table
CREATE TABLE IF NOT EXISTS `gym_custom_library` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `exercise_name` VARCHAR(100) NOT NULL,
    `target_muscle` VARCHAR(50) NOT NULL,
    UNIQUE KEY `user_exercise` (`user_id`, `exercise_name`),
    FOREIGN KEY (`user_id`) REFERENCES `gym_users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. User Custom Routine Plans Table (Day 1 - Day 6 schedules)
CREATE TABLE IF NOT EXISTS `gym_custom_plans` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `day_number` INT NOT NULL,
    `routine_name` VARCHAR(100) NOT NULL,
    `routine_focus` VARCHAR(100) DEFAULT '',
    UNIQUE KEY `user_day` (`user_id`, `day_number`),
    FOREIGN KEY (`user_id`) REFERENCES `gym_users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 7. Custom Routine Exercises Table
CREATE TABLE IF NOT EXISTS `gym_custom_plan_exercises` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `plan_id` INT NOT NULL,
    `exercise_name` VARCHAR(100) NOT NULL,
    `target_muscle` VARCHAR(50) NOT NULL,
    `sets` INT DEFAULT 3,
    `reps` VARCHAR(20) DEFAULT '10',
    `rest` INT DEFAULT 90,
    `sort_order` INT DEFAULT 0,
    FOREIGN KEY (`plan_id`) REFERENCES `gym_custom_plans`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
