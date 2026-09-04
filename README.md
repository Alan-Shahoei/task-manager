::: {align="center"}
# 🚀 Task Manager API

**A RESTful task management backend built with PHP using a custom MVC
architecture**

Build a scalable backend system with a layered architecture, dependency
injection, repository pattern, PostgreSQL, JWT authentication, and a
custom validation pipeline.

[![PHP
8.2+](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![PostgreSQL](https://img.shields.io/badge/PostgreSQL-Database-316192?style=for-the-badge&logo=postgresql&logoColor=white)](https://www.postgresql.org/)
[![Composer](https://img.shields.io/badge/Composer-Dependency%20Manager-885630?style=for-the-badge&logo=composer&logoColor=white)](https://getcomposer.org/)
[![JWT](https://img.shields.io/badge/JWT-Authentication-black?style=for-the-badge&logo=jsonwebtokens)](https://jwt.io/)

`PHP 8.2+` · `PostgreSQL` · `MVC Architecture` · `REST API` ·
`JWT Authentication`
:::

------------------------------------------------------------------------

## Overview

Task Manager API is a backend application built from scratch with PHP.
The project focuses on clean architecture principles and separating
responsibilities between controllers, services, repositories, and
framework-level components.

The application provides a RESTful API structure for managing users and
tasks while implementing authentication, validation, dependency
injection, and database abstraction.

------------------------------------------------------------------------

## Features

       Capability
  ---- ------------------------------------
   🔐  JWT based authentication
   👤  User registration and login
   🧱  Custom MVC architecture
   🔌  Dependency Injection Container
   🗄️  PostgreSQL database integration
   📦  Repository Pattern for persistence
   ⚙️  Service layer for business logic
   ✅  Custom validation system
   🌐  RESTful JSON API responses
   📋  Postman API documentation

------------------------------------------------------------------------

# 🧱 Architecture

  -----------------------------------------------------------------------
  Layer                               Responsibility
  ----------------------------------- -----------------------------------
  `Controllers`                       Handle HTTP requests and return
                                      responses

  `Services`                          Contain application business logic

  `Repositories`                      Manage database communication

  `Models`                            Represent domain entities

  `Framework`                         Contains Router, Container,
                                      Validator and Response components

  `Middleware`                        Handles cross-cutting request
                                      processing
  -----------------------------------------------------------------------

------------------------------------------------------------------------

## Request Flow

``` text
HTTP Request
      |
      v
   Router
      |
      v
 Controller
      |
      v
  Service Layer
      |
      v
 Repository Layer
      |
      v
 PostgreSQL
```

------------------------------------------------------------------------

# 🗂️ Project Structure

``` text
task-manager/
│
├── public/
│   └── index.php
│
├── src/
│   ├── App/
│   │   ├── Controllers/
│   │   ├── Models/
│   │   ├── Services/
│   │   ├── Repositories/
│   │   │   └── Interfaces/
│   │   └── Middleware/
│   │
│   └── Framework/
│       ├── Router/
│       ├── Container/
│       ├── Validator/
│       ├── Rules/
│       └── Response/
│
├── database/
├── docs/
│   └── task-manager.postman_collection.json
│
├── composer.json
├── .env
├── README.md
└── LICENSE
```

------------------------------------------------------------------------

# Getting Started

## Requirements

-   PHP 8.2+
-   Composer 2.x
-   PostgreSQL

------------------------------------------------------------------------

## Installation

Clone the repository:

``` bash
git clone <repository-url>
cd task-manager
```

Install dependencies:

``` bash
composer install
```

Create environment configuration:

``` bash
cp .env.example .env
```

Configure database and JWT settings.

------------------------------------------------------------------------

# Environment Variables

Example:

``` env
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=task_manager
DB_USERNAME=postgres
DB_PASSWORD=password

JWT_SECRET=your-secret-key
JWT_EXPIRATION=3600
```

------------------------------------------------------------------------

# Database

Create the database and run the schema:

``` bash
psql task_manager < database/schema.sql
```

------------------------------------------------------------------------

# Running The Application

Start PHP development server:

``` bash
php -S localhost:8000 -t public
```

API Base URL:

``` text
http://localhost:8000
```

------------------------------------------------------------------------

# 🔐 Authentication API

## Register User

Creates a new user account.

### Endpoint

``` http
POST /register
```

### Request

``` json
{
    "name": "Alan",
    "email": "alan@test.com",
    "password": "12345678",
    "profession": "Developer"
}
```

------------------------------------------------------------------------

## Login User

Authenticates a user and returns a JWT token.

### Endpoint

``` http
POST /login
```

### Request

``` json
{
    "email": "alan@test.com",
    "password": "12345678"
}
```

------------------------------------------------------------------------

# Protected Routes

Protected endpoints require a valid JWT token.

Header:

``` http
Authorization: Bearer {token}
```

Authentication flow:

``` text
Login
  |
  v
JWT Token
  |
  v
Authorization Header
  |
  v
Protected API Routes
```

------------------------------------------------------------------------

# Validation System

The project contains a custom validation framework.

Supported rules:

-   Required
-   Email
-   Min
-   Max
-   In

------------------------------------------------------------------------

# Postman Collection

API endpoints are documented using Postman.

Import collection:

``` text
docs/task-manager.postman_collection.json
```

------------------------------------------------------------------------

# Development Roadmap

Future improvements:

-   Complete Task Management APIs
-   Section and Category management
-   Role Based Access Control
-   Permission system
-   Refresh Token support
-   Request DTO layer
-   Global exception handler
-   Automated testing

------------------------------------------------------------------------

# Tech Stack

  Technology   Usage
  ------------ -----------------------
  PHP 8.2+     Backend development
  PostgreSQL   Database
  PDO          Database access
  Composer     Dependency management
  JWT          Authentication
  Postman      API testing

------------------------------------------------------------------------

# License

This project is available under the MIT License.

------------------------------------------------------------------------

# Author

Created by [Alan Shahoei](https://github.com/Alan-Shahoei)
