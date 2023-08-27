# Musette
Spotify clone project, used for demo purpose

# How to use?
First off, clone this project locally on a MacOS
Then run following commands in bash:
```$ brew install php```
To start php service now and restart at each login (as a background service), run:
```$ brew services start php``` 
Or, if you don't want/need a background service you can just run:
```$ /opt/homebrew/opt/php/sbin/php-fpm --nodaemonize```
Finally, To open php local dev server without XAMPP:
```
$ cd ~/parent_folder_of_musette
$ php -S localhost:8000 -t musette/
```
or, simplify it by:
```
$ cd ~/musette
$ php -S localhost:8000
```
Navigate to `database` directory, and import the sql files in your MySQL workbench
Change the username/passwords for your database inside `includes/config.php` file.

Open the URL `http://localhost:8000/Musette` and register/login to the website.
Done!


 
