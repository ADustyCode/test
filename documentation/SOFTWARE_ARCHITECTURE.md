# Software Architecture Document (SAD)

## 1. Introduction
This document provides a comprehensive architectural overview of the **Pentawork** application. It depicts the design decisions, architectural patterns, and technology stack used to build the system.

## 2. Architectural Pattern
The application follows the **Model-View-Controller (MVC)** architectural pattern, leveraging the **Laravel** framework.

-   **Model**: Represents the data structure and business logic (e.g., `Job`, `Application`, `User`). Managed via Eloquent ORM.
-   **View**: The presentation layer using **Blade Templates**. It renders the user interface with HTML and dynamic data.
-   **Controller**: Handles user requests, interacts with Models, and returns Views (e.g., `JobController`, `ApplicationController`).

## 3. Technology Stack

### 3.1 Backend
-   **Framework**: Laravel 12.x
-   **Language**: PHP 8.2+
-   **Server**: Nginx (via Docker)
-   **Broadcasting**: Laravel Reverb (WebSocket for realtime notifications)

### 3.2 Frontend
-   **Templating**: Blade
-   **Styling**: Tailwind CSS (inferred from config)
-   **JavaScript**: Vanilla JS / Alpine.js (standard with Laravel Breeze/Jetstream stacks)

### 3.3 Database
-   **RDBMS**: MySQL 8.0
-   **ORM**: Eloquent

### 3.4 Infrastructure & DevOps
-   **Containerization**: Docker & Docker Compose
-   **Web Server**: Nginx

## 4. System Modules

### 4.1 Authentication & Authorization
-   **Roles**:
    -   **Jobseeker**: Can search jobs and apply.
    -   **Employer**: Can post jobs and manage applications.
-   **Features**: Registration, Login, Email Verification, Password Reset.

### 4.2 Job Management (Employer)
-   **CRUD Operations**: Create, Read, Update, Delete job postings.
-   **Attributes**: Title, Description, Category, Salary, Location.

### 4.3 Job Board & Application (Jobseeker)
-   **Job Search**: Filtering by category/saved jobs.
-   **Application Flow**: Submit application -> Employer reviews -> Status updates (Accepted/Rejected).

### 4.4 User Settings
-   **Profile**: Manage personal detailed info (Resume, Contact).
-   **Account**: Change Email, Change Password.
-   **Notifications**: Real-time updates on application status.

## 5. Database Schema Overview
Key entities in the system:
-   **users**: Base authentication table (stores basic info + role).
-   **jobseeker_profiles**: Extended details for jobseekers.
-   **employer_profiles**: Extended details for employers.
-   **jobs**: Job listings posted by employers.
-   **applications**: Link between a Jobseeker and a Job.
-   **saved_jobs**: Jobs bookmarked by jobseekers.
-   **notifications**: System alerts.
-   **categories**: Job categories/industries.

## 6. Security
-   **CSRF Protection**: All forms are protected against Cross-Site Request Forgery.
-   **Authentication**: Secure session-based auth.
-   **Authorization**: Middleware (`auth`, `role:employer`, `role:jobseeker`) ensures access control.
