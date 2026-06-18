# Three DOS Council Management System

A web-based management system developed for **Three DOS Student Activity** to replace the use of multiple external platforms such as Notion, Google Forms, and manual communication channels.

The system provides a centralized workspace where organizers and members can manage tasks, sessions, learning materials, feedback, and council members from a single platform.

---

# Project Overview

Managing student activities often requires switching between different tools for task management, announcements, material sharing, and collecting feedback.

This project aims to simplify that workflow by bringing all essential features into one integrated web application, making collaboration more organized and efficient.

---

# Features

- User Management
- Council Management
- Role-Based Access Control
- Task Creation & Assignment
- Task Submission Tracking
- Session Scheduling
- Learning Materials Management
- Feedback & Rating System
- Email Notifications
- Password Recovery
- Secure Data Handling
- RESTful API Design

---

# Project Architecture

The project follows a layered architecture to improve readability, maintainability, and scalability.

```
Routes
   │
Controllers
   │
Repositories
   │
Database
```

Utility functions are organized inside a dedicated **Helpers** layer.

Project Structure:

```
project/
│
├── routes/
├── controllers/
├── repositories/
├── helpers/
├── config/
├── vendor/
└── public/
```

---

# Technologies Used

### Backend

- PHP
- MySQL
- Redis
- PHPMailer

### Architecture

- Repository Pattern
- RESTful API
- Layered Architecture

### Security

- Password Hashing
- OTP Verification
- Input Validation
- Secure Authentication

---

# Database

Main entities include:

- Users
- Councils
- Tasks
- Sessions
- Materials
- Feedback
- Submissions




![alt text](image.png)







---

# Team Responsibilities

| Team Member | Responsibility |
|-------------|---------------|
| Yehia | Authentication |
| Mazen | Database Connection |
| Me | User & Council Management |
| Sarah | Task Management |
| Mazen & Shahd | Sessions & Materials |
| Sama | Feedback System |

---

# Future Improvements

- Dashboard & Analytics
- Attendance Tracking
- Notifications
- Calendar Integration
- File Upload Support
- Search & Filtering
- Real-time Updates
- Admin Dashboard

---

# Why This Project?

Unlike traditional student activity management that relies on several disconnected platforms, this system offers a unified solution where organizers and members can manage their daily workflow efficiently from one place.

The project improves collaboration, simplifies communication, and provides a better experience for everyone involved in the council.

---

# Developed By

**Three DOS Development Team**