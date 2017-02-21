# Introduction

Online treasure hunt application built with Laravel

# Configuration

* Change application name in config/app.php. It will be reflected in all locations automatically.
* Provide database and email credentials in .env
* Modify database/seeds/DatabaseSeeder.php to whatever you want for the admin.
* Migrate the database using `php artisan migrate --seed`
* Set the game start and end time in .env
* Generate a new key using `php artisan key:generate`

## Creating questions

* Login as admin and go to the QUESTIONS menu. 
* Click on the Create button
* Questions have to be created in html. Type html in the editor and it will be previewed in the output section. 
* For inserting images and media content into the questions use absolute URLs. You may put media content in the public folder and 
  provide absolute URL to them, or use a cloud storage service like Google Drive and provide the sharing link.
* Provide explanation, solution and serial number of the question as it should be during the game.
* Solution must be lowercase alphabets only! Participants' submission will be converted to lowercase alphabets, 
  stripped of any other symbols and then compared with the solution.