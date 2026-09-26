# TechQuiz

Interactive web quiz application developed for ICT 1209 Web Technologies mini project.

Project Details
- Course: ICT 1209 Web Technologies
- Academic Year: 2024 Batch, BICT (Hons)
- Faculty: Faculty of Technology, Rajarata University of Sri Lanka

Group Members
- H. S. N. Edman (Reg: ITT/2024/035, Index: 2720)
- V. P. G. G. P. Pathirana (Reg: ITT/2024/078, Index: 2763)

About The Project
TechQuiz is a simple multiple-choice quiz system built with PHP and MySQL. It lets registered users choose between ICT, Science, and General Knowledge topics. Each attempt contains 10 multiple-choice questions with a 30-second countdown for each question. Final scores are saved into MySQL, and the top 5 high scores are shown on the leaderboard page.

Main Features
- User registration and login with bcrypt password hashing
- Session based authentication and clean logout
- Category selection (ICT, Science, GK)
- Timed questions (30 seconds per question)
- Instant green/red feedback on answer click
- Automatic score calculation and AJAX save
- Dynamic leaderboard displaying top 5 ranking


Technologies Used
Frontend: HTML5, CSS3, Bootstrap 5, JavaScript
Backend: PHP 8 
Database: MySQL 
Environment: XAMPP 
Version Control: Git & GitHub

Project Structure
techquiz/
  auth/
    login.php
    register.php
    logout.php
  css/
    style.css
    leaderboard.css
  js/
    main.js
    quiz.js
  includes/
    db.php
  index.php
  dashboard.php
  quiz.php
  leaderboard.php
  contact.php
  save_score.php
  database.sql
  README.md

How To Setup And Run
1. Download or clone this repository:
   git clone https://github.com/GihanGiwmika2002/ICT-1209-Mini-project-.git
2. Copy the techquiz folder into your XAMPP htdocs directory (C:/xampp/htdocs/techquiz).
3. Open XAMPP Control Panel and start Apache and MySQL.
4. Go to http://localhost/phpmyadmin in your browser.
5. Create a new database named techquiz_db.
6. Open the Import tab, choose database.sql from the project folder, and click Go.
7. Open http://localhost/techquiz/ in your web browser.