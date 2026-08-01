InstaApp
A simple instagram-like web application built with Laravel & Breeze.
Features: 
- Authentication (Register, Login, Logout)
- User Profile (photo, bio, edit profile)
- Create, delete posts with photo & caption
- Like & comment on posts
- Follow / Unfollow users
- Timeline (see posts from people you follow)

Tech Stack:
Framework: Laravel 12
Auth: Laravel Breeze
Frontend: Blade, Tailwind CSS, Alpine.js
Database: MySQL (via XAMPP)
Storage: Laravel local storage

Getting Started
Requirements
PHP >= 8.2
Composer
Node.js & npm
MySQL (XAMPP / Laragon / etc.)

Installation

1. Clone the repository
git clone https://github.com/angelaudia/dummyinstaApp.git
cd dummyinstaApp

2. Install PHP dependencies
composer install

3. Install Node dependencies & build assets
npm install
npm run dev

4. Setup environment
cp .env.example .env
php artisan key:generate

5. Configure database
Edit .env and set your database credentials:

6. Run migrations
php artisan migrate

7. Create storage symlink
php artisan storage:link

8. Run the application
php artisan serve

Open your browser and go to: http://127.0.0.1:8000

Usage:
1. Register a new account
2. Update your profile (photo & bio)
3. Create a post with a photo and caption
4. Follow other users to see their posts on your timeline
5. Like and comment on posts

Notes:
This project was built as a technical assessment submission
Developed under time constraints as part of an internship selection process
Built with Laravel Breeze as the authentication scaffold

