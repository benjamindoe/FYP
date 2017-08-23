# FYP
BSc Software Engineering Final Year Project "Primary School Reporting Management System", 1st Class

https://laravel.com/

https://getmdl.io/

## System Requirements
To run the prototype, there are a few system requirements to meet that Laravel requires to run. Laravel has supplied a development environment for Vagrant called Homestead and a Mac development environment called Valet, both of which meet the requirements to run this prototype. 

  -	Linux Distribution (Recommended, can be run on Windows or macOS however this guide will assume Linux OS)
  - Apache or Nginx
  -	MySQL
  -	Node and npm
  -	PHP >= 7.0
  -	Composer
  -	OpenSSL PHP Extension
  -	PDO PHP Extension
  -	Mbstring PHP Extension
  -	Tokenizer PHP Extension
  -	XML PHP Extension

## Setup
1.	In the root directory (where the `app`, `config`, `storage` and `public` folders are), run `composer install`
2.	In the same directory, `run npm install`
3.	The web server needs to be configured to point to the public directory. Laravel used the `index.php` file to handle all HTTP request.
4.	If using apache, the .htaccess file should take care of everything. If using Nginx, add the following directive to the site configuration and it will direct all traffic to the `index.php`
```
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```
5.	Rename the `.env.example` file to `.env`
6.	In the `.env` file, change the database credentials to the desired MySQL credentials
7.	The application uses the getAddress API (Codeberry Ltd 2017). Go to the website, sign up for a free API key and put this API key in the .env file
8.	Run `php artisan key:generate`
9.	Run `php artisan migrate`
10.	Run `php artisan db:seed`

## Usage
The seeding process has alleviated much of the admin work such as things like school data, staff accounts, student accounts and parent accounts. Every account has the password set to “password” for demonstration purposes. The accounts are stored in the “users” table in the MySQL database. Use any of these usernames to log into the system. The user level can also be deduced from the user table as the foreign key will be set unless the user is the system admin, if this is the case then the “is_super_admin” column will be set.
Attainment averages need to be manually calculated as it is designed to be ran with a job scheduler. There is an artisan command that has been written to do this and this is the command that gets run by the job scheduler if one has been set up. To calculate the attainment averages, run this command: 
```
php artisan avg-att
```
