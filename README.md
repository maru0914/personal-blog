# Personal-Blog

Personal-Blog is a Laravel application that allows sole user to post and manage his/her own articles. <br/>
It features sole user authentication for article creation, editing, and deletion, as well as category and tag management.<br/>
Visitors can view articles and the "About Me" page without logging in.

## Preview
![Preview perspnal blog](https://github.com/user-attachments/assets/2aeced55-ddd9-40d3-b683-c6c363383f05)


## Features

- **User Authentication**: Login system for sole user. (You need insert a user by SQL or Seeder)
- **Article Management**:
    - Create new articles. (can attach a category and tags)
    - Edit existing articles.
    - Delete articles.
- **Category Management**:
    - Create new categories.
    - Edit existing categories.
    - Delete categories.
- **Tag Management**:
    - Create new tags.
    - Edit existing tags.
    - Delete tags.
- **Public Viewing**:
    - View articles without logging in.
    - Access the "About Me" page without logging in.

## Installation

1. Clone the repository:
   ```bash
   git clone git@github.com:maru0914/personal-blog.git
   cd personal-blog
   ```
2. Install dependencies:
    ```bash
    composer install
    npm install
    ```
3. Copy the .env.example file to .env:
    ```bash
    cp .env.example .env
    ```
4. Generate an application key:
    ```bash
    php artisan key:generate
    ```
5. Set up your database and update the .env file with your database credentials.
6. Run migrations:
    ```bash
    php artisan migrate
    ```
7.	Serve the application (or simply use [Laravel Herd](https://herd.laravel.com/)):
      ```bash
      php artisan serve
      ```
