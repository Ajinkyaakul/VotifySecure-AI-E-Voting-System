# VotifySecure-AI-E-Voting-System
AI Based Online Voting System with OTP authentication and Face Recognition using face-api.js


VotifySecure – AI Based E-Voting System

A secure web-based voting platform that combines Email OTP authentication and AI-powered face verification to ensure that only legitimate voters can cast their votes.
The system aims to increase transparency, security, and efficiency in digital voting environments such as colleges, organizations, and small communities.

1 Overview

Traditional voting methods are often time-consuming, error-prone, and difficult to manage. Basic online voting systems improve accessibility but still suffer from weak authentication mechanisms.

VotifySecure addresses these problems by integrating:

Email based One Time Password (OTP) authentication

AI face verification using webcam

Secure vote casting system

Admin control panel for election management

This ensures that only verified voters can participate in the election process.

Key Features

Secure OTP-based login

AI Face Recognition for voter verification

Admin Dashboard for election management

Voter Registration System

Candidate Management

Position-based Voting

One person – One vote enforcement

Live Webcam Face Detection

Secure database handling

System Architecture

The system consists of three major layers:

1. Frontend

  HTML
  CSS
  Bootstrap
  JavaScript

2. Backend

  PHP

3. Database

  MySQL

4. AI Face Recognition

  face-api.js
  TensorFlow.js models

Technologies Used

Technology	           Purpose
PHP	                   Backend development
MySQL               	 Database
HTML / CSS	           Frontend design
Bootstrap	             UI framework
JavaScript         	   Client-side logic
PHPMailer           	 Email OTP system
face-api.js	           Face detection & recognition
XAMPP             	   Local server environment

Project Structure
VotifySecure-AI-E-Voting-System
│
├── admin
│   ├── candidates.php
│   ├── voters.php
│   └── positions.php
│
├── includes
│   ├── conn.php
│   ├── session.php
│   └── functions.php
│
├── face-api
│   ├── models
│   └── face-api.min.js
│
├── css
├── js
├── images
│
├── voter_register.php
├── voter_login_otp.php
├── voter_verify_otp.php
├── face_verification.php
├── home.php
│
└── database.sql


System Workflow

Voter registers using Aadhaar-like ID and email.
System sends OTP to voter email.
Voter verifies OTP.
System starts webcam face verification.
AI compares live face with stored descriptor.
If verified → voter enters voting dashboard.
Voter casts vote.
System records vote securely.

Security Features

Password hashing
Email OTP verification
Face recognition authentication
Duplicate vote prevention
Session management
Secure database operations
