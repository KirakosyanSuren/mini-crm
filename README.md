# Mini CRM (Feedback System)

This is a simple mini CRM system for managing feedback (tickets).

Users can create feedback, and an administrator can view, filter, and update the status of feedback.

## Installation

Clone the repository:

git clone https://github.com/username/project-name.git
cd project-name

Install dependencies:

composer install

## Setup

Create .env file and generate application key:

cp .env.example .env
php artisan key:generate

Publish required packages:

php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider"

## Database

Run migrations and seeders:

php artisan migrate
php artisan db:seed

## Storage

Create storage link:

php artisan storage:link

## Run project

php artisan serve

After this, the project is ready to use.

## Features

- Create feedback (tickets)
- Admin can view all feedback
- Filter feedback
- Update status
- File upload support
- Role and permission system

## API

POST /api/tickets  
GET /api/tickets/statistics  

## Notes

All routes and middleware are defined in web.php.

API routes are used only for:
- creating tickets
- getting statistics
