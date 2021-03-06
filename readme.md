# Introduction

Online treasure hunt application built with Laravel

# Configuration

* Change application name in .env and it will be reflected in all locations automatically.
* Provide the following credentials in .env file:
- APP_SECRET to be used to run migration commands using simple GET requests if shell access is unavailable.
- APP_NAME which will change the application name globally
- Database credentials
- Email credentials if necessary, else it will default to php mail function
- The MAIL_FROM_ADDRESS and MAIL_FROM_NAME which will be used when sending email
- Game admin credentials (will be seeded during database migration only once)
- Game start and end time with timezone in .env file. This is important as the /play route will be activated only between the start and end times



## Migrating database

### If shell access is available
* Migrate the database using `php artisan migrate --seed`
* Generate a new key using `php artisan key:generate`

### If no shell access is available
There are some prebuilt routes which allow running artisan commands using GET requests. Please remember the APP_SECRET which was provided in the 
.env file. It has to be entered at the end of all the requests to authenticate the request as being performed by the system admin.
APP_KEY could also have been used for this purpose but since Laravel 5.4, the APP_KEY is a base64 encoded string which might include slash character.
Hence the router would not be able to match the requests. The formats are specified below:

1. your-host.com/artisan/migrate/<APP_SECRET>
2. your-host.com/artisan/migrate/rollback/<APP_SECRET>
3. your-host.com/artisan/migrate/seed/<APP_SECRET>
4. your-host.com/artisan/migrate/refresh/<APP_SECRET>

## Creating questions

* Login as admin and go to the QUESTIONS menu. 
* Click on the Create button
* Questions have to be created in html. Type html in the editor and it will be previewed in the output section. 
* For inserting images and media content into the questions use absolute URLs. You may put media content in the public folder and 
  provide absolute URL to them, or use a cloud storage service like Google Drive and provide the sharing link.
* Provide explanation, solution and serial number of the question as it should be during the game.
* Solution must be lowercase alphabets only! Participants' submission will be converted to lowercase alphabets, 
  stripped of any other symbols and then compared with the solution.

## UI modifications

* Feel free to modify any UI component as per requirements. 
* Write your own instructions in resources/home.blade.php
* Change welcome.blade.php to modify the landing page. Currently it only has the application name and countdown timer.
* All error page views are currently the same. They can be found in resources/views/errors. 