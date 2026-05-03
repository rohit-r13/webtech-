-- Run this in phpMyAdmin (SQL tab) or MySQL CLI before using the project

CREATE DATABASE IF NOT EXISTS student_management;

USE student_management;

CREATE TABLE IF NOT EXISTS students (
    id              INT PRIMARY KEY AUTO_INCREMENT,
    name            VARCHAR(100),
    email           VARCHAR(100),
    registration_no VARCHAR(20),
    department      VARCHAR(50)
);
