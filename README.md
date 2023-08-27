# Musette
Spotify clone project, used for demo purpose

# How to use?
First off, clone this project locally on a MacOS <br>
Then run following commands in bash: <br>
```$ brew install php``` <br>
To start php service now and restart at each login (as a background service), run: <br>
```$ brew services start php``` <br>
Or, if you don't want/need a background service you can just run: <br>
```$ /opt/homebrew/opt/php/sbin/php-fpm --nodaemonize``` <br>
Finally, To open php local dev server without XAMPP:
```
$ cd ~/parent_folder_of_musette
$ php -S localhost:8000 -t musette/
```
or, simplify it by: <br>
```
$ cd ~/musette
$ php -S localhost:8000
```
Navigate to `database` directory, and import the sql files in your MySQL workbench <br>
Change the username/passwords for your database inside `includes/config.php` file. <br>
<br>
Open the URL `http://localhost:8000/Musette` and register/login to the website. <br>
Done!


 
