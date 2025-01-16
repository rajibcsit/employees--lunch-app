# T-lunch: Employee Lunch Management System

T-lunch is a Laravel-based web application designed to manage employee lunch entries. The application provides functionality to add, edit, view, and delete lunch entries for employees. It is built with Laravel, uses Tailwind CSS for the frontend design, and the Laravel UI Bootstrap Auth package for authentication.

## Features

- **Employee Lunch Entries**: Manage lunch details for employees, including the type of meal, date, and special requests.
- **Employee Get Notification-Reminder**: Employees receive a daily reminder to mark their lunch entry.
- **User Authentication**: Employees and admins can log in to manage lunch entries using the Laravel UI Bootstrap Auth package.
- **Frontend Design**: The UI is styled with Tailwind CSS for a responsive and modern layout.
- **CRUD Operations**: Create, read, update and delete lunch entries.
- **Admin Panel**: Admin users can view and manage all lunch entries for the organization.

## Installation

Follow these steps to set up the application locally:

1. Clone the repository:

   ```bash
   git clone https://github.com/rajibcsit/twiteLunch-app

2. Navigate to the project folder:
   cd t-lunch
   
3. Install the required dependencies:
   composer install
   npm install

4. Install the Laravel UI Bootstrap Auth package:
   php artisan ui bootstrap --auth
   npm run dev
   
5. Set up the environment file:
   cp .env.example .env
   
6. Generate the application key:
   php artisan key:generate
   
7. Configure the database connection in .env file:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=t_lunch
    DB_USERNAME=root
    DB_PASSWORD=
   
8. Run database migrations:
   php artisan migrate

9. Start the local development server:
   php artisan serve

 Now, open your browser and go to http://127.0.0.1:8000 to see the application in action.

## Usage:
    -Employee Panel: Employees can view and manage their lunch entries through the application.
    -Admin Panel: Admins can view all employees' lunch entries and perform administrative tasks like editing or deleting entries.
    -Authentication: Employees and admins can log in using the authentication system provided by Laravel UI Bootstrap Auth package.


## Contributing

Feel free to fork this repository, submit issues, or send pull requests for any improvements.

## License

This project is licensed under the MIT License. [MIT license](https://opensource.org/licenses/MIT). © 2025 TwiteSoft. All rights reserved.
